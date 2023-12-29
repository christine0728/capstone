<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Get the currently logged-in user
            $user = Auth::user();
            $currentUserId = Auth::id();
            if ($user) {
                $persons = User::where('id', '!=', $currentUserId)->get();
                $unreadNotificationCount = auth()->user()->unreadNotifications()->count();

                // Access the user's image
                $userImage = $user->image;
                $currentUserId = Auth::id();
            // $notifications = auth()->user()->notifications->sortByDesc('created_at')->groupBy('read_at')->reverse();
                $notifications = auth()->user()->notifications->sortByDesc('created_at');

                $unreadNotifications = $notifications->where('read_at', null);
            
                $readNotifications = $notifications->where('read_at', '!=', null);
                
                $notifications = $unreadNotifications->concat($readNotifications);

         
                $unreadchat = $notifications->where('read_at', null);
            
        

            // Now $unreadChatNotifications contains the unread notifications with type 'App\Notifications\ChatNotification'
            
// Now $newidArray contains all 'newid' values from matching notifications

            $unreads = auth()->user()->unreadNotifications;
            $chatnotif =0;
            foreach (auth()->user()->unreadNotifications as $notification) {
                if ($notification->data['nameNotif'] === 'has sent a message.') {
                    $chatnotif++;
                }
            }
                $user = User::where('id', $currentUserId)->get();
                // Pass the user image to the view
                $memonotif=0;
                foreach (auth()->user()->unreadNotifications as $notification) {
                if ($notification->data['nameNotif'] === 'has sent a file') {
                    $memonotif++;
                }
            }

            $sitrepnotif=0;
            foreach (auth()->user()->unreadNotifications as $notification) {
                if ($notification->data['nameNotif'] === 'has sent a Situational Report') {
                    $sitrepnotif++;
                }
            }
                $view->with([
                   
                    '$unreads'=>$unreads,
                    'users' => $user,
                    'unread' => $unreadNotificationCount,
                    'notifications' => $notifications,
                    'unreadmemo'=> $memonotif,
                    'unreadsitrep'=> $sitrepnotif,
                    'persons'=>$persons,
                    'chatnotif'=>$chatnotif
                ]);
            } else {
                // Handle the case where no user is logged in
            }
        });
    }
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

}
