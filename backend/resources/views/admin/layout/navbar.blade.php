
<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" style="background-color: #fff ;">
        @if(setting('general.logo'))
            <a href="#" class="logo">
                <img src="{{asset('logo/'.setting('general.logo'))}}" alt="navbar brand" class="navbar-brand" width="115px" height="37px">
            </a>
        @endif
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu" style="color: #081f7b"></i>
            </button>
        </div>
    </div>

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" style="background-color: #081f7b">

        <div class="container-fluid">

            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                @role('admin')
                <li>
                    <a class="btn btn-sm btn-default mx-3"  style="background: #f7941d !important" href="{{route('admin.settings.edit')}}">
                        {{__('Setting')}}
                    </a>`
                </li>
                @endrole
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                        <i class="fas fa-user-alt" style="color: #fff; font-size:30px"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated ">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                {{-- <div class="dropdown-divider"></div> --}}
                                <a class="dropdown-item" href="{{url('admin/profile')}}">{{__('My Profile')}}</a>
                                @role('admin')
                                <a class="dropdown-item" href="{{route('admin.users.all')}}">{{__('Users')}}</a>
                                @endrole
                                {{-- <a class="dropdown-item" href="{{route('admin.role.all')}}">{{__('Roles')}}</a> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    <i class="fa fa-lock"></i> {{__('Logout')}}
                                </a>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
                {{-- <li class="lang"><a href="{{ url( App::isLocale('ar') ? 'lang/en' :'lang/ar' )}}" ><i class="fa fa-language" style="font-size:27px;    color: #fff;"></i></a></li> --}}
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->

</div><!-- main header -->


