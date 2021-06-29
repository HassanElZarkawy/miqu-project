<html lang="{!! lang() !!}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('APP_NAME') }} - @yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset( 'img/logo.ico' ) }}">

    <!-- Core css -->
    <link href="{{ asset( 'css/app.min.css' ) }}" rel="stylesheet">

    {!! debugBarAssets() !!}

    <script>
        const config = {
            base: '{{ url('') }}'
        };
    </script>

    @stack('styles')
</head>

<body>
<div class="app">
    <div class="layout">
        <!-- Header START -->
        <div class="header">
            <div class="logo logo-dark">
                <a href="{{ url('') }}" class="mt-3">
                    <img src="{{ asset('img/logo.ico') }}" alt="Logo" style="width: 150px; height: 40px; object-fit: contain">
                    <img class="logo-fold m-auto" src="{{ asset('img/logo.ico') }}" alt="Logo" style="width: 60px; height: 40px; object-fit: contain">
                </a>
            </div>
            <div class="logo logo-white">
                <a href="{{ url('') }}">
                    <img src="{{ asset('img/logo.ico') }}" alt="Logo">
                    <img class="logo-fold" src="{{ asset( 'img/logo.ico' ) }}" alt="Logo">
                </a>
            </div>
            <div class="nav-wrap">
                <ul class="nav-left">
                    <li class="desktop-toggle">
                        <a href="javascript:void(0);">
                            <i class="anticon"></i>
                        </a>
                    </li>
                    <li class="mobile-toggle">
                        <a href="javascript:void(0);">
                            <i class="anticon"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#search-drawer">
                            <i class="anticon anticon-search"></i>
                        </a>
                    </li>
                </ul>
                <ul class="nav-right">
                    <li class="dropdown dropdown-animated scale-left">
                        <a href="javascript:void(0);" data-toggle="dropdown">
                            <i class="anticon anticon-bell notification-badge"></i>
                        </a>
                        <div class="dropdown-menu pop-notification">
                            <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                                <p class="text-dark font-weight-semibold m-b-0">
                                    <i class="anticon anticon-bell"></i>
                                    <span class="m-l-10">Notification</span>
                                </p>
                                <a class="btn-sm btn-default btn" href="javascript:void(0);">
                                    <small>View All</small>
                                </a>
                            </div>
                            <div class="relative">
                                <div class="overflow-y-auto relative scrollable ps-container ps-theme-default ps-active-y" style="max-height: 300px" data-ps-id="83dbf368-0d5c-00ec-d6ee-aac53c8dfd1b">
                                    <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                        <div class="d-flex">
                                            <div class="avatar avatar-blue avatar-icon">
                                                <i class="anticon anticon-mail"></i>
                                            </div>
                                            <div class="m-l-15">
                                                <p class="m-b-0 text-dark">You received a new message</p>
                                                <p class="m-b-0"><small>8 min ago</small></p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                        <div class="d-flex">
                                            <div class="avatar avatar-cyan avatar-icon">
                                                <i class="anticon anticon-user-add"></i>
                                            </div>
                                            <div class="m-l-15">
                                                <p class="m-b-0 text-dark">New user registered</p>
                                                <p class="m-b-0"><small>7 hours ago</small></p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                        <div class="d-flex">
                                            <div class="avatar avatar-red avatar-icon">
                                                <i class="anticon anticon-user-add"></i>
                                            </div>
                                            <div class="m-l-15">
                                                <p class="m-b-0 text-dark">System Alert</p>
                                                <p class="m-b-0"><small>8 hours ago</small></p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item d-block p-15 ">
                                        <div class="d-flex">
                                            <div class="avatar avatar-gold avatar-icon">
                                                <i class="anticon anticon-user-add"></i>
                                            </div>
                                            <div class="m-l-15">
                                                <p class="m-b-0 text-dark">You have a new update</p>
                                                <p class="m-b-0"><small>2 days ago</small></p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="ps-scrollbar-x-rail" style="left: 0; bottom: 0;">
                                        <div class="ps-scrollbar-x" tabindex="0" style="left: 0; width: 0;"></div>
                                    </div>
                                    <div class="ps-scrollbar-y-rail" style="top: 0; height: 300px; right: 0;">
                                        <div class="ps-scrollbar-y" tabindex="0" style="top: 0; height: 278px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown dropdown-animated scale-left">
                        <div class="pointer" data-toggle="dropdown">
                            <div class="avatar avatar-image  m-h-10 m-r-15">
                                <img src="{{ asset('img/default-male.png') }}" alt="">
                            </div>
                        </div>
                        <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                            <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                <div class="d-flex m-r-50">
                                    <div class="avatar avatar-lg avatar-image">
                                        <img src="{{ asset('img/default-male.png') }}" alt="">
                                    </div>
                                    <div class="m-l-10">
                                        <p class="m-b-0 text-dark font-weight-semibold">

                                        </p>
                                        <p class="m-b-0 opacity-07"></p>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="dropdown-item d-block p-h-15 p-v-10">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                                        <span class="m-l-10">Edit Profile</span>
                                    </div>
                                    <i class="anticon font-size-10 anticon-right"></i>
                                </div>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item d-block p-h-15 p-v-10">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="anticon opacity-04 font-size-16 anticon-lock"></i>
                                        <span class="m-l-10">Account Setting</span>
                                    </div>
                                    <i class="anticon font-size-10 anticon-right"></i>
                                </div>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item d-block p-h-15 p-v-10">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="anticon opacity-04 font-size-16 anticon-project"></i>
                                        <span class="m-l-10">Projects</span>
                                    </div>
                                    <i class="anticon font-size-10 anticon-right"></i>
                                </div>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item d-block p-h-15 p-v-10">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                        <span class="m-l-10">Logout</span>
                                    </div>
                                    <i class="anticon font-size-10 anticon-right"></i>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Header END -->

        <!-- Side Nav START -->
        <div class="side-nav">
            <div class="side-nav-inner">
                <ul class="side-nav-menu scrollable ps-container ps-theme-default" data-ps-id="78813a40-d508-7820-87ab-dd57a6342339">
                    <li class="nav-item dropdown open">
                        <a href="{{ route('home') }}">
                            <span class="icon-holder">
                                <i class="anticon anticon-dashboard"></i>
                            </span>
                            <span class="title">{{ __('Dashboard') }}</span>
                        </a>
                    </li>
{{--                    <li class="nav-item dropdown">--}}
{{--                        <a class="dropdown-toggle" href="javascript:void(0);">--}}
{{--                            <span class="icon-holder">--}}
{{--                                <i class="anticon anticon-question-circle"></i>--}}
{{--                            </span>--}}
{{--                            <span class="title">{{ __('Learning') }}</span>--}}
{{--                            <span class="arrow">--}}
{{--                                <i class="arrow-icon"></i>--}}
{{--                            </span>--}}
{{--                        </a>--}}
{{--                        <ul class="dropdown-menu">--}}
{{--                            <li>--}}
{{--                                <a>{{ __('Topics') }}</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a>{{ __('Lessons') }}</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a>{{ __('Quizzes') }}</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <div class="ps-scrollbar-x-rail" style="left: 0; bottom: 0;">
                        <div class="ps-scrollbar-x" tabindex="0" style="left: 0; width: 0;"></div>
                    </div>
                    <div class="ps-scrollbar-y-rail" style="top: 0; right: 0;">
                        <div class="ps-scrollbar-y" tabindex="0" style="top: 0; height: 0;"></div>
                    </div>
                </ul>
            </div>
        </div>
        <!-- Side Nav END -->

        <!-- Page Container START -->
        <div class="page-container">

            <!-- Content Wrapper START -->
            <div class="main-content">
                @yield('content')
            </div>
            <!-- Content Wrapper END -->

            <!-- Footer START -->
            <footer class="footer">
                <div class="footer-content">
                    <p class="m-b-0">Copyright © 2019 Theme_Nate. All rights reserved.</p>
                    <span>
                            <a href="" class="text-gray m-r-15">Term &amp; Conditions</a>
                            <a href="" class="text-gray">Privacy &amp; Policy</a>
                        </span>
                </div>
            </footer>
            <!-- Footer END -->

        </div>
        <!-- Page Container END -->

        <!-- Search Start-->
        <div class="modal modal-left fade search" id="search-drawer">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-between align-items-center">
                        <h5 class="modal-title">Search</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </div>
                    <div class="modal-body scrollable ps-container ps-theme-default" data-ps-id="17c599c9-0066-f0a9-7126-b2ede5b72491">
                        <div class="input-affix">
                            <i class="prefix-icon anticon anticon-search"></i>
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <div class="m-t-30">
                            <h5 class="m-b-20">Results</h5>
                            <div class="d-flex m-b-30">
                                <div class="avatar avatar-cyan avatar-icon">
                                    <i class="anticon anticon-file-excel"></i>
                                </div>
                                <div class="m-l-15">
                                    <a href="javascript:void(0);" class="text-dark m-b-0 font-weight-semibold">Sample Result Item</a>
                                    <p class="m-b-0 text-muted font-size-13">by User</p>
                                </div>
                            </div>
                        </div>
                        <div class="ps-scrollbar-x-rail" style="left: 0; bottom: 0;">
                            <div class="ps-scrollbar-x" tabindex="0" style="left: 0; width: 0;"></div>
                        </div>
                        <div class="ps-scrollbar-y-rail" style="top: 0; right: 0;">
                            <div class="ps-scrollbar-y" tabindex="0" style="top: 0; height: 0;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search End-->
    </div>
</div>


<script src="{{ asset('js/vendors.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
@stack('scripts')

{!! renderDebugBar() !!}

</body>
</html>