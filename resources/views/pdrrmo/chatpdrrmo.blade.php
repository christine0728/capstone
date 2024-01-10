<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Resquire</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link rel="stylesheet" type="text/css" href="{{asset('/css/style.css')}}">
        <style>
            :root {
              --body-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
              --msger-bg: #fff;
              --border: 2px solid #ddd;
              --left-msg-bg: #ececec;
              --right-msg-bg: #579ffb;
            }
            .body {
              display: flex;
              justify-content: center;
              align-items: center;
              height: 90vh;
              font-family: Helvetica, sans-serif;
            }
                        .msger {
              display: flex;
              flex-flow: column wrap;
              justify-content: space-between;
              width: 100%;
              max-width: 867px;
              margin: 25px 10px;
              height: calc(100% - 50px);
              border: var(--border);
              border-radius: 5px;
              background: var(--msger-bg);
              box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
            }

            .msger-header {
              display: flex;
              justify-content: space-between;
              padding: 10px;
              border-bottom: var(--border);
              background: #eee;
              color: #666;
            }

            .msger-chat {
              flex: 1;
              overflow-y: auto;
              padding: 10px;
            }
            .msger-chat::-webkit-scrollbar {
              width: 6px;
            }
            .msger-chat::-webkit-scrollbar-track {
              background: #ddd;
            }
            .msger-chat::-webkit-scrollbar-thumb {
              background: #bdbdbd;
            }
            .msg {
              display: flex;
              align-items: flex-end;
              margin-bottom: 10px;
            }
            .msg:last-of-type {
              margin: 0;
            }
            .chat-image {
                max-width: 100%; /* Set a maximum width for the image */
                height: auto; /* Maintain the aspect ratio */
            }
            .msg-img {
              width: 50px;
              height: 50px;
              margin-right: 10px;
              background: #ddd;
              background-repeat: no-repeat;
              background-position: center;
              background-size: cover;
              border-radius: 50%;
            }
            .msg-bubble {
              max-width: 450px;
              padding: 15px;
              border-radius: 15px;
              background: var(--left-msg-bg);
            }
            .msg-info {
              display: flex;
              justify-content: space-between;
              align-items: center;
              margin-bottom: 10px;
            }
            .msg-info-name {
              margin-right: 10px;
              font-weight: bold;
            }
            .msg-info-time {
              font-size: 0.85em;
            }

            .left-msg .msg-bubble {
              border-bottom-left-radius: 0;
            }

            .right-msg {
              flex-direction: row-reverse;
            }
            .right-msg .msg-bubble {
              background: var(--right-msg-bg);
              color: #fff;
              border-bottom-right-radius: 0;
            }
            .right-msg .msg-img {
              margin: 0 0 0 10px;
            }

            .msger-inputarea {
              display: flex;
              padding: 10px;
              border-top: var(--border);
              background: #eee;
            }
            .msger-inputarea * {
              padding: 10px;
              border: none;
              border-radius: 3px;
              font-size: 1em;
            }
            .msger-input {
              flex: 1;
              background: #ddd;
            }
            .msger-send-btn {
              margin-left: 10px;
              background: #2196f3;
              color: #fff;
              font-weight: bold;
              cursor: pointer;
              transition: background 0.23s;
            }
            .msger-send-btn:hover {
              background: rgb(0, 180, 50);
            }

        </style>
    </head>
    <body>

        <div class="wrapper">
            <div class="body-overlay"></div>
                @include('/pdrrmo/nav')
                <div id="content">
                <div class="top-navbar">
              <nav class="navbar navbar-expand-lg">
                  <div class="container-fluid">
                   
                      <button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-toggle="collapse"
                  data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="material-icons">more_vert</span></button>
                  <h6 id="datetime"></h6>
           
                          
                           
                        </div>
                    </nav>
  </div>
        <div class="body">
                <section class="msger">
            <header class="msger-header">
                <div class="msger-header-title"><div class="user-selection"> 
                    <img src="{{ asset('uploads/logo/' . $selectedUserImage) }}" alt="User Profile Picture" style="border-radius: 50%; width: 40px; height: 40px; margin-right: 10px;">
                <span class="user-name">{{ $selectedUserName }}</span>
        </div></div>
            </header>
        <main class="msger-chat">
            @php
                $previousSender = null;
            @endphp

            @foreach($combinedMessages as $message)
                @if($message->sender->id != $previousSender)
                    <center><p>{{ $message->created_at->diffForHumans() }}</p></center><br>
                @endif

                <div class="msg @if($message->sender->id == auth()->user()->id) right-msg @else left-msg @endif">
                    <div class="msg-img" style="background-image: url('{{ asset('uploads/logo/' . $message->sender->image) }}')"></div>
                    
                    @if ($message->image) <!-- Check if the message has an image -->
                        <div class="msg-bubble msg-image" style="background-color: transparent; text-align: right;">
                            <img class="chat-image" src="{{ asset('uploads/messages/' . $message->image->image_path) }}" alt="Image"><br><br>
                            @if ($message->message)
                                @if ($message->sender->id == auth()->user()->id)
                                    <div class="msg-bubble msg-text" style="text-align: right; width: auto;">
                                        {{ $message->message }}
                                    </div>
                                @else
                                    <div class="msg-bubble msg-text" style="text-align: left; width: auto;">
                                        {{ $message->message }}
                                    </div>
                                @endif
                            @endif
                        </div>
                    @else
                        @if ($message->message)
                            <div class="msg-bubble msg-text" style="text-align: right; width: auto;">
                                {{ $message->message }}
                            </div>
                        @endif
                    @endif
                </div>

                @php
                    $previousSender = $message->sender->id;
                @endphp
            @endforeach
        </main>
            <form class="msger-inputarea" action="{{ route('chatpdrrmo.send', ['userId' => $userId]) }}" method="post" enctype="multipart/form-data">
                @csrf
                 <label for="image" class="msger-image-label">
                    <img src="{{ asset('uploads/image.png') }}" alt="Image Icon" class="msger-image-button" style="width: 40px; height: 40px;">
                </label>

                <input type="file" name="image" accept="image/*" id="image" class="msger-image-input" style="display: none;" onchange="validateInput()">
                <input type="text" name="message" class="msger-input" placeholder="Enter your message..." oninput="validateInput()">
                <button type="submit" id="sendButton" class="msger-send-btn" disabled>Send</button>

            </form>


        </section>

            </div>
            @include('/pdrrmo/footer')
            </div>
        </div>
    </body>
    <script>
        // Function to scroll the chat to the bottom
        function scrollChatToBottom() {
            var chat = document.querySelector(".msger-chat");
            chat.scrollTop = chat.scrollHeight;
        }

        function validateInput() {
        const messageInput = document.querySelector('.msger-input');
        const imageInput = document.querySelector('#image');
        const sendButton = document.querySelector('#sendButton');

        if (messageInput.value.trim() === '' && !imageInput.files.length) {
            sendButton.disabled = true;
        } else {
            sendButton.disabled = false;
        }
    }

    // Call the function to check the input fields when the page loads
    window.addEventListener("load", validateInput);

    

        // Call the function to scroll to the bottom when the page loads
        window.addEventListener("load", scrollChatToBottom);
    </script>
    </html>

    <script>
        function updateDateTime() {
            var dateTimeElement = document.getElementById('datetime');
            var now = new Date();
            
            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            var dateTimeString = now.toLocaleDateString('en-US', options);

            dateTimeElement.textContent = dateTimeString;
        }

        // Update date and time every second
        setInterval(updateDateTime, 1000);

        // Initial update
        updateDateTime();
    </script>