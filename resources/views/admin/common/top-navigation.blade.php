<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                       id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">

{{--                        <img src="{{Auth::user()->profile_picture}}"
                             alt="">--}}
                        <img src="http://127.0.0.1:8000/images/user.jpg" alt="">
                        {{ Auth::user()->name . ' ' . Auth::user()->surname   }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="profil.html"> Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             class="dropdown-item"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Çıkış Yap') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </li>

            </ul>
        </nav>
    </div>
</div>
