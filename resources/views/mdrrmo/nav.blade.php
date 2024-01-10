
        <!-- Sidebar  -->
        <nav id="sidebar">
            
          <div class="sidebar-header" style="background: #2C3B41; display: flex; align-items: center; justify-content: space-between;">
                @csrf
                @forelse ($users as $user)
                @if ($user->image)
                    <div style="display: flex; align-items: center;">
                        <img src="{{ asset('uploads/logo/' . $user->image) }}" class="img-fluid" style="max-width: 60px; max-height: 60px; border-radius: 50%; object-fit: cover; margin-right: 8px;border:2px solid #2196f3">
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
                        <img src="{{ asset('uploads/logo/logo.png') }}" class="user-image img-fluid" style="max-width: 80px; max-height: 80px; border-radius: 50%; object-fit: cover;  margin-right: 8px;border:2px solid #2196f3">
                        <div class="user-details">
                            <h3 class="user-name" style="color: white;font-size: 10px;">{{$user->name}}</h3>
                            <p class="user-info" style="color: white;font-size: 10px;margin-top: 0px">
                                {{$user->email}}<br>
                                {{$user->contact_number}}
                            </p>
                        </div>
                    </div>
                @endif
                @empty
                    <div style="display: flex; align-items: center;">
                        <img src="{{ asset('uploads/logo/logo.png') }}" id="logo" class="user-image img-fluid" style="max-width: 80px; max-height: 80px; border-radius: 50%; object-fit: cover;  margin-right: 8px;border:2px solid #2196f3">
                    </div>
                @endforelse
            </div>

            <ul class="list-unstyled components">
            <li class="{{ request()->is('') ? 'active' : '' }}" >
                <a href="/" class="dashboard" style="color: white;">
                <i class="fas fa-tachometer-alt" style="color: white; font-size: 24px;"></i>
<span>Dashboard</span>
                </a>
            </li>

            <li class="{{ request()->is('mdrrmo/memo') ? 'active' : '' }}">
                <a href="/mdrrmo/memo" class="dashboard" style="color: white; text-decoration: none;">
                <i class="fas fa-file-alt" style="color: white; font-size: 24px;"></i>

                    <span style="">Memos<span style="color: red; font-size: 15px; margin-left: 4px; margin-right: 100px">+{{$unreadmemo}}</span></span>
                </a>
            </li>
            <li class="dropdown {{ request()->is('mdrrmo/request-assistance') ? 'active' : '' }}">
                    <a href="#pageSubmenu6" style="color: white;" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fa fa-life-ring" style="color: white; font-size: 24px;"></i><span>Assistance Request</span></a>
                    <ul class="collapse list-unstyled menu" style="color: white;" id="pageSubmenu6">

                        <li class="{{ request()->is('mdrrmo/request-assistance') ? 'active' : '' }}">
                            <a href="/mdrrmo/request-assistance"  style=" color: white;">&nbsp;&nbsp;&nbsp;Assistance request</a>
                        </li>
                        <li class="{{ request()->is('mdrrmo/receive-assistance') ? 'active' : '' }}">
                            <a href="/mdrrmo/receive-assistance"  style=" color: white;">&nbsp;&nbsp;&nbsp;Receive Assistance</a>
                        </li>
                        <li class="{{ request()->is('pdrrmo/severity') ? 'active' : '' }}">
                            <a href="/mdrrmo/severity"  style=" color: white;">&nbsp;&nbsp;&nbsp;Severity</a>
                        </li>
                    </ul>
            </li>

            <li class="{{ request()->is('pdrrmo/sitrep') ? 'active' : '' }}">
    <a href="#pageSubmenu5" style="color: white;" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
    <i class="fa fa-info-circle" style="color: white; font-size: 24px;"></i><span>Situational Report</span>
    </a>
    <ul class="collapse list-unstyled menu" id="pageSubmenu5">
        <li>
        <a href="/mdrrmo/sitrep" class="dashboard" style="color: white;">
              
                    <span>&nbsp;&nbsp;&nbsp;Situational Report</span>
                </a>
        </li>

        <li class="{{ request()->is('mdrrmo/sitrepsub') ? 'active' : '' }}">
            <a href="/mdrrmo/sitrepsub" style="color: white;">&nbsp;&nbsp;&nbsp;Subjects</a>
        </li>
    </ul>
</li>


            
            <li class="dropdown">
                <a href="#pageSubmenu4" style="color: white;" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-calendar" style="color: white; font-size: 24px;"></i><span>Schedule</span>
            </a>
                <ul class="collapse list-unstyled menu" id="pageSubmenu4">
                <li class="">
                <a href="/mdrrmo/Schedule" class="dashboard" style="color: white;">
                    <i class="material-icons" style="color: white;">schedule</i><span>Schedule</span>
                </a>
                </li>
                <li class="{{ request()->is('pdrrmo/Schedule-table') ? 'active' : '' }}">
                <a href="/mdrrmo/Schedule-table" style="color: white;"> <i class="material-icons" style="color: white;">schedule</i>List of Schedules</a>
                </li>
        
                </ul>
    </li>
         
            <!-- <li class="dropdown {{ request()->is('mdrrmo/inventory') ? 'active' : '' }}">
                <a href="#pageSubmenu4" style="color: white;" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons" style="color: white;">extension</i><span>Inventory</span></a>
                <ul class="collapse list-unstyled menu" id="pageSubmenu4">
                <li class="{{ request()->is('mdrrmo/inventory') ? 'active' : '' }}">
                    <a href="/mdrrmo/inventory" style="color: white;">Items</a>
                </li>
                <li class="{{ request()->is('mdrrmo/category') ? 'active' : '' }}">
                    <a href="/mdrrmo/category" style="color: white;">Categories</a>
                </li>
                <li class="{{ request()->is('mdrrmo/supplier') ? 'active' : '' }}">
                    <a href="/mdrrmo/supplier" style="color: white;">Suppliers</a>
                </li>
                </ul>
            </li> -->
            <li class="dropdown {{ request()->is('mdrrmo/personnel') ? 'active' : '' }}">
                <a href="#pageSubmenu8" style="color: white;" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-users" style="color: white; font-size: 24px;"></i><span>Personnel</span>
                </a>
                <ul class="collapse list-unstyled menu" id="pageSubmenu8">
                    <li class="{{ request()->is('mdrrmo/personnel') ? 'active' : '' }}">
                        <a href="/mdrrmo/personnel" style="color: white;">   &nbsp;&nbsp;&nbsp; Personnel</a>
                    </li>
                    <li class="{{ request()->is('mdrrmo/position') ? 'active' : '' }}">
                        <a href="/mdrrmo/position" style="color: white;">  &nbsp;&nbsp;&nbsp;Position</a>
                    </li>
                    <li class="{{ request()->is('mdrrmo/department') ? 'active' : '' }}">
                        <a href="/mdrrmo/department" style="color: white;"> &nbsp;&nbsp;&nbsp;Department</a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->is('mdrrmo/MyAccount') ? 'active' : '' }}">
                <a href="/mdrrmo/MyAccount" class="dashboard" style="color: white;">
                <i class="fa fa-user" style="color: white; font-size: 24px;"></i><span>My Account</span>
                </a>
            </li>
                <li>
                    <div style="display: flex; align-items: center;">
                        <a href="{{ route('logout') }}" class="dashboard" style="color: white; text-decoration: none; display: flex; align-items: center;">
                        <i class="fa fa-sign-out" style="color: white; font-size: 24px;"></i>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" style="color: white; text-decoration: none;">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </a>
                    </div>
                </li>
            </ul>

           
        </nav>