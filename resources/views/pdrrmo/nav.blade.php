<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-header" style="background: #2C3B41; display: flex; align-items: center; justify-content: space-between;">
        @csrf
        @forelse ($users as $user)
            @if ($user->image)
                <div style="display: flex; align-items: center;">
                    <img src="{{ asset('uploads/logo/' . $user->image) }}" class="img-fluid" style="max-width: 60px; max-height: 60px; border-radius: 50%; object-fit: cover; margin-right: 8px; border: 2px solid #2196f3">
                    <div class="user-details">
                        <h3 class="user-name" style="color: white; font-size: 18px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 100%;">{{$user->name}}</h3>
                        <p class="user-info" style="color: white; font-size: 10px; margin-top: 0px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 100%;">
                            {{$user->email}}<br>
                            {{$user->contact_number}}
                        </p>
                    </div>
                </div>
            @else
                <div style="display: flex; align-items: center;">
                    <img src="{{ asset('uploads/logo/logo.png') }}" class="user-image img-fluid" style="max-width: 60px; max-height: 60px; border-radius: 50%; object-fit: cover;  margin-right: 8px; border: 2px solid #2196f3">
                    <div class="user-details">
                        <h3 class="user-name" style="color: white; font-size: 10px;">{{$user->name}}</h3>
                        <p class="user-info" style="color: white; font-size: 10px; margin-top: 0px">
                            <i class="fa fa-envelope"></i> {{$user->email}}<br>
                            <i class="fa fa-phone"></i> {{$user->contact_number}}
                        </p>
                    </div>
                </div>
            @endif
        @empty
            <div style="display: flex; align-items: center;">
                <img src="{{ asset('uploads/logo/logo.png') }}" id="logo" class="user-image img-fluid" style="max-width: 60px; max-height: 60px; border-radius: 50%; object-fit: cover;  margin-right: 8px; border: 2px solid #2196f3">
            </div>
        @endforelse
    </div>

    <ul class="list-unstyled components">
        <li class="{{ request()->is('pdrrmo/') ? 'active' : '' }}">
            <a href="/" class="dashboard" style="color: white; display: flex; align-items: center;">
                <span><i class="fas fa-tachometer-alt" style="color: white; font-size: 24px;"></i>
Dashboard</span>
            </a>
        </li>

        <li class="{{ request()->is('pdrrmo/memo') ? 'active' : '' }}">
            <a href="/pdrrmo/memo" class="dashboard" style="color: white; text-decoration: none;">
            <i class="fas fa-file-alt" style="color: white; font-size: 24px;"></i>

                <span style="">Memos</span>
            </a>
        </li>

        <li class="dropdown {{ request()->is('pdrrmo/receive-assistance') ? 'active' : '' }}">
            <a href="#pageSubmenu6" style="color: white;" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fa fa-life-ring" style="color: white; font-size: 24px;"></i>


                <span>Assistance Request</span>
            </a>
            <ul class="collapse list-unstyled menu" style="color: white;" id="pageSubmenu6">
                <li class="{{ request()->is('pdrrmo/receive-assistance') ? 'active' : '' }}">
                    <a href="/pdrrmo/receive-assistance" style=" color: white;">&nbsp;&nbsp;&nbsp;Receive Assistance</a>
                </li>
                <li class="{{ request()->is('pdrrmo/incidents') ? 'active' : '' }}">
                    <a href="/pdrrmo/incidents" style=" color: white;">&nbsp;&nbsp;&nbsp;Manage Covered Incidents</a>
                </li>
            </ul>
        </li>

        <li class="{{ request()->is('pdrrmo/sitrep') ? 'active' : '' }}">
            <a href="#pageSubmenu5" style="color: white;" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-info-circle" style="color: white; font-size: 24px;"></i><span>Situational Report</span>
            </a>
            <ul class="collapse list-unstyled menu" id="pageSubmenu5">
                <li>
                    <a href="/pdrrmo/sitrep" class="dashboard" style="color: white; text-decoration: none;">
                        <i class="fa fa-sticky-note" style="color: white; font-size: 24px;"></i>
                        <span>&nbsp;&nbsp;&nbsp;Situational Report<span style="color: red; font-size: 15px; margin-left: 4px; margin-right: 0px">+{{$unreadsitrep}}</span></span>
                    </a>
                </li>
                <li class="{{ request()->is('pdrrmo/sitrepsub') ? 'active' : '' }}">
                    <a href="/pdrrmo/sitrepsub" style="color: white;">     <i class="fa fa-sticky-note" style="color: white; font-size: 24px;"></i>&nbsp;&nbsp;&nbsp; Subjects</a>
                </li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="#pageSubmenu4" style="color: white;" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-calendar" style="color: white; font-size: 24px;"></i><span>Schedule</span>
            </a>
            <ul class="collapse list-unstyled menu" id="pageSubmenu4">
                <li class="">
                    <a href="/pdrrmo/schedule" class="dashboard" style="color: white;">
                        <i class="fa fa-calendar-o" style="color: white; font-size: 24px;"></i><span>&nbsp;&nbsp;&nbsp;Schedule</span>
                    </a>
                </li>
                <li class="{{ request()->is('pdrrmo/Schedule-table') ? 'active' : '' }}">
                    <a href="/pdrrmo/Schedule-table" style="color: white;"> <i class="fa fa-calendar" style="color: white; font-size: 24px;"></i>&nbsp;&nbsp;&nbsp;List of schedules</a>
                </li>
            </ul>
        </li>

        <li class="{{ request()->is('pdrrmo/manage-user') ? 'active' : '' }}">
            <a href="/pdrrmo/manage-user" class="dashboard" style="color: white;">
                <i class="fa fa-users" style="color: white; font-size: 24px;"></i>
                <span>Manage Users</span>
            </a>
        </li>

        <li class="dropdown {{ request()->is('pdrrmo/personnel') ? 'active' : '' }}">
            <a href="#pageSubmenu5" style="color: white;" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-user" style="color: white; font-size: 24px;"></i>
                <span>Personnel</span>
            </a>
            <ul class="collapse list-unstyled menu" id="pageSubmenu5">
                <li class="{{ request()->is('pdrrmo/personnel') ? 'active' : '' }}">
                    <a href="/pdrrmo/personnel" style="color: white;">&nbsp;&nbsp;&nbsp;Manage Personnel</a>
                </li>
                <li class="{{ request()->is('pdrrmo/position') ? 'active' : '' }}">
                    <a href="/pdrrmo/position" style="color: white;">&nbsp;&nbsp;&nbsp;Manage Position</a>
                </li>
                <li class="{{ request()->is('pdrrmo/department') ? 'active' : '' }}">
                    <a href="/pdrrmo/department" style="color: white;">&nbsp;&nbsp;&nbsp;Manage Department</a>
                </li>
            </ul>
        </li>

        <li class="{{ request()->is('pdrrmo/MyAccount') ? 'active' : '' }}">
            <a href="/pdrrmo/MyAccount" class="dashboard" style="color: white;">
                <i class="fa fa-user-circle" style="color: white; font-size: 24px;"></i>
                <span>My Account</span>
            </a>
        </li>

        <li>
            <a href="{{ route('logout') }}" class="dashboard" style="color: white; text-decoration: none; display: flex; align-items: center;">
                <i class="fa fa-sign-out" style="color: white; font-size: 24px;"></i>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" style="color: white; text-decoration: none; background: none; border: none; cursor: pointer;">&nbsp;&nbsp;
                        {{ __('Log Out') }}
                    </button>
                </form>
            </a>
        </li>
    </ul>
</nav>
