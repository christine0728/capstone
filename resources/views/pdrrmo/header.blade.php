   <div class="top-navbar">
              <nav class="navbar navbar-expand-lg">
                  <div class="container-fluid">
                   
                      <button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-toggle="collapse"
                  data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="material-icons">more_vert</span></button>
                  <h6 id="datetime"></h6>
           
                          <div class="collapse navbar-collapse d-lg-block d-xl-block d-sm-none d-md-none d-none" id="navbarSupportedContent">
                              <ul class="nav navbar-nav ml-auto">   
                                  <li class="dropdown nav-item">
                                    <a href="#" class="nav-link" data-toggle="dropdown"><span class="material-icons">notifications</span>
                                        <span class="notification">{{$unread}}</span>
                                    </a>
                                    <ul class="dropdown-menu" style="max-height: 300px;
    overflow-y: auto;"><p style="margin-left: 10px">Notifications</p>
                            @forelse($notifications as $notification)
                            @php
                                $isNew = !$notification->read_at; // Check if the notification is new
                            @endphp
                            <div class="notification-item {{ $notification->read_at ? 'read' : 'unread' }}" style="margin-bottom: 10px; padding: 10px; border: 1px solid #eee; border-radius: 5px; display: flex; align-items: center;">
                                <!-- Profile Picture for Notification -->
                                <img src="{{ asset('images/notification-bell.png') }}" alt="Profile Picture" style="border-radius: 50%; width: 30px; height: 30px; margin-right: 5px;">

                                <div class="notification-content" style="font-size: 10px; /* Set your desired font size here */">
                                <a href="{{

                                        $notification->data['nameNotif'] === 'report' ? '/pdrrmo/Sendreport' :

                                        ($notification->data['nameNotif'] === 'is requesting assistance' ? '/pdrrmo/receivedRequest-notifs/' . $notification->id :

                                            ($notification->data['nameNotif'] === 'has sent a Situational Report' ? '/pdrrmo/sitrep-notifs/' . $notification->id :

                                                ($notification->data['nameNotif'] === 'has responded to your request' ? '/pdrrmo/response-notifs/'.$notification->id :

                                                    ($notification->data['nameNotif'] === 'has send a file' ? '/pdrrmo/memo-notifs/'.$notification->id : '/dashboard')))

                                        )

                                        }}" style="text-decoration: none; color: #333;">


                                        <span style="font-weight: bold;">[{{ $notification->created_at->diffForHumans() }}]</span>
                                        @if($isNew)
                                        <span class="new-notification-label" style="background-color: #007bff; color: #fff; border-radius: 3px; padding: 2px 5px; font-size: 11px; margin-right: 5px;">New</span>
                                        @endif
                                        <span class="text">{{ ucfirst($notification->data['username']) }} {{ $notification->data['nameNotif'] }}. </span>
                                    </a>
                                </div>
                            </div>
                            @empty
                            <p class="no-notifications" style="margin-top: 20px; text-align: center; font-size: 12px;">There are no new notifications</p>
                            @endforelse
                        </ul>
                                    <li class="dropdown nav-item">
    <a href="#" class="nav-link text-white" data-toggle="dropdown">
    <span class="material-icons text-white">email</span>
    <span class="notification">{{$chatnotif}}</span>
    </a>
    <ul class="dropdown-menu" style="max-height: 300px; overflow-y: auto;">
        <p style="margin-left: 15px">Messages</p>
       @foreach($persons as $person)
    <li>
        <a href="{{ route('chatpdrrmo.index', ['userId' => $person->id]) }}" style="text-decoration: none; color: #333;">
            @if($person->image)
                <img src="{{ asset('uploads/logo/' . $person->image) }}" alt="Profile Picture" style="border-radius: 50%; width: 40px; height: 40px; margin-right: 10px;">
            @else
                <img src="{{ asset('uploads/man.png') }}" alt="Default Profile Picture" style="border-radius: 50%; width: 40px; height: 40px; margin-right: 10px;">
            @endif
            <span class="notification-content" style="font-size: 14px;">
                {{ ucfirst($person->name) }}
            </span>
        </a>
    </li>
@endforeach

                              </ul>
                            </div>
                        </div>
                    </nav>
  </div><script>
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