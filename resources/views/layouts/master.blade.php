<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Najeeb</title>
    <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="{{ asset('images/najeb.png') }}">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="{{ asset('images/najeb.png') }}">

    <!-- style -->
    <link rel="stylesheet" href="{{ asset('assets/animate.css/animate.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/glyphicons/glyphicons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/material-design-icons/material-design-icons.css') }}"
        type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}"type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">        

    <!-- build:css ../assets/styles/app.min.css -->
    <link rel="stylesheet" href="{{ asset('assets/styles/app.css') }}" type="text/css" />
    <!-- endbuild -->
    <link rel="stylesheet" href="{{ asset('assets/styles/font.css') }}" type="text/css" />
    
    @stack('css')

    
</head>

<body>
    <div class="app" id="app">

        <!-- ############ LAYOUT START-->
        @include('layouts.sideNav')
        <!-- content -->
        <div id="content" class="app-content box-shadow-z1" role="main">
            <div class="app-header white box-shadow">
                @include('layouts.navBar')
            </div>
           
            <div ui-view class="app-body" id="view">
                <div class="col-md-6 offset-md-3 mt-1">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                @yield('content')
            </div>
        </div>
        <!-- / content -->

        <div class="app-footer">
            <div class="p-2 text-xs">
                <div class="text-center text-muted py-1">
                    &copy; 2023 <strong>Najeeb</strong>
                    <a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
                </div>
            </div>
        </div>

    </div>

    {{-- Sweet Alert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- jQuery -->
    <script src="{{ asset('libs/jquery/jquery/dist/jquery.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> --}}
    
	
    <!-- Bootstrap -->
    <script src="{{ asset('libs/jquery/tether/dist/js/tether.min.js') }}"></script>
    <script src="{{ asset('libs/jquery/bootstrap/dist/js/bootstrap.js') }}"></script>
    <!-- core -->
    <script src="{{ asset('libs/jquery/underscore/underscore-min.js') }}"></script>
    <script src="{{ asset('libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js') }}"></script>
    <script src="{{ asset('libs/jquery/PACE/pace.min.js') }}"></script>

    <script src="{{ asset('scripts/config.lazyload.js') }}"></script>

    <script src="{{ asset('scripts/palette.js') }}"></script>
    <script src="{{ asset('scripts/ui-load.js') }}"></script>
    <script src="{{ asset('scripts/ui-jp.js') }}"></script>
    <script src="{{ asset('scripts/ui-include.js') }}"></script>
    <script src="{{ asset('scripts/ui-device.js') }}"></script>
    <script src="{{ asset('scripts/ui-form.js') }}"></script>
    <script src="{{ asset('scripts/ui-nav.js') }}"></script>
    <script src="{{ asset('scripts/ui-screenfull.js') }}"></script>
    <script src="{{ asset('scripts/ui-scroll-to.js') }}"></script>
    <script src="{{ asset('scripts/ui-toggle-class.js') }}"></script>

    <script src="{{ asset('scripts/app.js') }}"></script>

    <!-- ajax -->
    {{-- <script src="{{ asset('libs/jquery/jquery-pjax/jquery.pjax.js') }}"></script> --}}
    <script src="{{ asset('scripts/ajax.js') }}"></script>
    {{-- font-awsome --}}
    <script src="{{ asset('scripts/all.min.js') }}"></script>
    @stack('js')

   
</body>

</html>
