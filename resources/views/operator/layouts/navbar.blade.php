<header id="header" class="header fixed-top d-flex align-items-center pt-2 pb-2">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/home" class="logo d-flex align-items-center">
            <div class="d-flex align-items-center">
{{--                <img src="{{ asset('logo.png') }}" alt="Logo" width="20%">--}}
                    <span class="text-danger text-center">E-NAZORAT<br></span>
                    <span class="text-success ml-1" style="font-size: 12px"></span>
            </div>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>

            {{--            <li class="nav-item dropdown">--}}

            {{--                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">--}}
            {{--                    <i class="bi bi-bell"></i>--}}
            {{--                    <span class="badge bg-primary badge-number"></span>--}}
            {{--                </a><!-- End Notification Icon -->--}}

            {{--                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">--}}
            {{--                    <li class="dropdown-header">--}}
            {{--                        You have 4 new notifications--}}
            {{--                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>--}}
            {{--                    </li>--}}
            {{--                    <li>--}}
            {{--                        <hr class="dropdown-divider">--}}
            {{--                    </li>--}}

            {{--                    <li class="notification-item">--}}
            {{--                        <i class="bi bi-exclamation-circle text-warning"></i>--}}
            {{--                        <div>--}}
            {{--                            <h4>Lorem Ipsum</h4>--}}
            {{--                            <p>Quae dolorem earum veritatis oditseno</p>--}}
            {{--                            <p>30 min. ago</p>--}}
            {{--                        </div>--}}
            {{--                    </li>--}}

            {{--                    <li>--}}
            {{--                        <hr class="dropdown-divider">--}}
            {{--                    </li>--}}

            {{--                    <li class="notification-item">--}}
            {{--                        <i class="bi bi-x-circle text-danger"></i>--}}
            {{--                        <div>--}}
            {{--                            <h4>Atque rerum nesciunt</h4>--}}
            {{--                            <p>Quae dolorem earum veritatis oditseno</p>--}}
            {{--                            <p>1 hr. ago</p>--}}
            {{--                        </div>--}}
            {{--                    </li>--}}

            {{--                    <li>--}}
            {{--                        <hr class="dropdown-divider">--}}
            {{--                    </li>--}}

            {{--                    <li class="notification-item">--}}
            {{--                        <i class="bi bi-check-circle text-success"></i>--}}
            {{--                        <div>--}}
            {{--                            <h4>Sit rerum fuga</h4>--}}
            {{--                            <p>Quae dolorem earum veritatis oditseno</p>--}}
            {{--                            <p>2 hrs. ago</p>--}}
            {{--                        </div>--}}
            {{--                    </li>--}}

            {{--                    <li>--}}
            {{--                        <hr class="dropdown-divider">--}}
            {{--                    </li>--}}

            {{--                    <li class="notification-item">--}}
            {{--                        <i class="bi bi-info-circle text-primary"></i>--}}
            {{--                        <div>--}}
            {{--                            <h4>Dicta reprehenderit</h4>--}}
            {{--                            <p>Quae dolorem earum veritatis oditseno</p>--}}
            {{--                            <p>4 hrs. ago</p>--}}
            {{--                        </div>--}}
            {{--                    </li>--}}

            {{--                    <li>--}}
            {{--                        <hr class="dropdown-divider">--}}
            {{--                    </li>--}}
            {{--                    <li class="dropdown-footer">--}}
            {{--                        <a href="#">Show all notifications</a>--}}
            {{--                    </li>--}}

            {{--                </ul><!-- End Notification Dropdown Items -->--}}

            {{--            </li><!-- End Notification Nav -->--}}

            {{--            <li class="nav-item dropdown">--}}

            {{--                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">--}}
            {{--                    <i class="bi bi-chat-left-text"></i>--}}
            {{--                    <span class="badge bg-success badge-number">3</span>--}}
            {{--                </a><!-- End Messages Icon -->--}}

            {{--                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">--}}
            {{--                    <li class="dropdown-header">--}}
            {{--                        You have 3 new messages--}}
            {{--                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>--}}
            {{--                    </li>--}}
            {{--                    <li>--}}
            {{--                        <hr class="dropdown-divider">--}}
            {{--                    </li>--}}

            {{--                    <li class="message-item">--}}
            {{--                        <a href="#">--}}
            {{--                            <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">--}}
            {{--                            <div>--}}
            {{--                                <h4>Maria Hudson</h4>--}}
            {{--                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>--}}
            {{--                                <p>4 hrs. ago</p>--}}
            {{--                            </div>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    <li>--}}
            {{--                        <hr class="dropdown-divider">--}}
            {{--                    </li>--}}

            {{--                    <li class="message-item">--}}
            {{--                        <a href="#">--}}
            {{--                            <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">--}}
            {{--                            <div>--}}
            {{--                                <h4>Anna Nelson</h4>--}}
            {{--                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>--}}
            {{--                                <p>6 hrs. ago</p>--}}
            {{--                            </div>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    <li>--}}
            {{--                        <hr class="dropdown-divider">--}}
            {{--                    </li>--}}

            {{--                    <li class="message-item">--}}
            {{--                        <a href="#">--}}
            {{--                            <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">--}}
            {{--                            <div>--}}
            {{--                                <h4>David Muldon</h4>--}}
            {{--                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>--}}
            {{--                                <p>8 hrs. ago</p>--}}
            {{--                            </div>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    <li>--}}
            {{--                        <hr class="dropdown-divider">--}}
            {{--                    </li>--}}

            {{--                    <li class="dropdown-footer">--}}
            {{--                        <a href="#">Show all messages</a>--}}
            {{--                    </li>--}}

            {{--                </ul><!-- End Messages Dropdown Items -->--}}

            {{--            </li><!-- End Messages Nav -->--}}

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    {{--                    <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">--}}
                    <span
                        class="d-none d-md-block dropdown-toggle ps-2">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ \Illuminate\Support\Facades\Auth::user()->name }}</h6>
                        <span></span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        {{--                        <a class="dropdown-item d-flex align-items-center" href="#">--}}

                        <a class="dropdown-item" href="{{ route('logout') }}"

                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            Tizimdan chiqish
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        {{--                            <span>Sign Out</span>--}}
                        {{--                        </a>--}}
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
