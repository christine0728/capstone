<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MessageImage;
use App\Models\Message;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ChatNotification;
use App\Models\User;

class ChatController extends Controller
{
  public function index(Request $request, $userId)
{
    // Check if the user is authenticated
    if (Auth::check()) {
        $currentUserId = Auth::id();
        $image = Auth()->user()->image;

        // Fetch all users except the currently logged-in user
        $persons = User::where('id', '!=', $currentUserId)->get();

        // Get messages that involve the selected recipient (specified by $userId)
        $combinedMessages = Message::with('sender')
            ->where(function ($query) use ($currentUserId, $userId) {
                $query->where('receiver_id', $currentUserId)
                    ->where('sender_id', $userId);
            })
            ->orWhere(function ($query) use ($currentUserId, $userId) {
                $query->where('receiver_id', $userId)
                    ->where('sender_id', $currentUserId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        $selectedUser = User::find($userId);

        if ($selectedUser) {
            $selectedUserName = $selectedUser->name;
            $selectedUserImage = $selectedUser->image;
        } else {
            // Handle the case where the user is not found
            $selectedUserName = 'User Not Found';
            $selectedUserImage = 'default.png';
        }
  
        $notifications = Auth::user()->notifications
        ->where('data.newid', $userId)
        ->where('type', ChatNotification::class);

        $notifications->each(function ($notification) {
            // Perform actions on the filtered notifications, if needed
            $notification->markAsRead();
        });

        if (Auth()->user()->usertype == 'mdrrmo') {
            return view('mdrrmo.chat', compact('combinedMessages', 'image', 'persons','userId', 'selectedUserName', 'selectedUserImage'));
        } elseif (Auth()->user()->usertype == 'pdrrmo') {
            return view('pdrrmo.chatpdrrmo', compact('combinedMessages', 'image', 'persons', 'userId', 'selectedUserName', 'selectedUserImage'));
        } else {
            return redirect()->back();
        }
    }

    // Handle the case where the user is not authenticated
    return redirect('/login');
}






 public function send(Request $request, $userId)
{
    $currentUserId = Auth::id();

    if (Auth::id()) {
        $usertype = Auth()->user()->usertype;

        if ($usertype == 'mdrrmo' || $usertype == 'pdrrmo') {
            // Validate the 'message' field to allow it to be optional
            $request->validate([
                'message' => 'nullable',
            ]);

            $message = new Message;
            $message->sender_id = auth()->user()->id;
            $message->receiver_id = $userId;
            $message->message = $request->input('message');
            $message->save();

            // Check if an image was uploaded
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/messages/', $filename);
                $messageImage = new MessageImage(['image_path' => $filename]);
                $message->image()->save($messageImage); // Save the image association
            }
            $username=Auth()->user()->name;
            $notifiableUser = User::find($userId);
            Notification::send($notifiableUser, new ChatNotification(auth()->user()->id, 'has sent a message.', $username));
      
            if ($usertype == 'mdrrmo') {
                return redirect()->route('chat.index', ['userId' => $userId]);
            } elseif ($usertype == 'pdrrmo') {
                return redirect()->route('chatpdrrmo.index', ['userId' => $userId]);
            }
        } else {
            return redirect()->back();
        }
    }

    // Handle the case where the user is not authenticated
    return redirect('/login');
}




}