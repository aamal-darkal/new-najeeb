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
    <link rel="apple-touch-icon" href="../assets/images/logo.png">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">

    <!-- style -->
    <link rel="stylesheet" href="../assets/animate.css/animate.min.css" type="text/css" />
    <link rel="stylesheet" href="../assets/glyphicons/glyphicons.css" type="text/css" />
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="../assets/material-design-icons/material-design-icons.css" type="text/css" />

    <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
    <!-- build:css ../assets/styles/app.min.css -->
    <link rel="stylesheet" href="../assets/styles/app.css" type="text/css" />
    <!-- endbuild -->
    <link rel="stylesheet" href="../assets/styles/font.css" type="text/css" />
</head>
<body>
<div class="app" id="app">

    <!-- ############ LAYOUT START-->
    <div class="center-block w-xxl w-auto-xs p-y-md">
        <div class="navbar">
            <div class="pull-center">
                <div ui-include="'../views/blocks/navbar.brand.html'"></div>
            </div>
        </div>
        <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
            <div class="m-b text-sm">
                Sign in
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="md-form-group float-label">
                    <input type="text" class="md-input"  name="user_name" value="{{old('email')}}" ng-model="user.email" required>

                    <label>User name</label>
                    <x-input-error :messages="$errors->get('user_name')" class="mt-2" />
                </div>
                <div class="md-form-group float-label">
                    <input type="password" class="md-input" name="password" ng-model="user.password" required>
                    <label>Password</label>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="m-b-md">
                    <label class="md-check">
                        <input type="checkbox" name="remember" value="1"><i class="primary"></i> Keep me signed in
                    </label>
                </div>
                <button type="submit" class="btn primary btn-block p-x-md">Sign in</button>
            </form>
        </div>

{{--        <div class="p-v-lg text-center">--}}
{{--            <div class="m-b"><a ui-sref="access.forgot-password" href="forgot-password.html" class="text-primary _600">Forgot password?</a></div>--}}
{{--            <div>Do not have an account? <a ui-sref="access.signup" href="signup.html" class="text-primary _600">Sign up</a></div>--}}
{{--        </div>--}}
    </div>

    <!-- ############ LAYOUT END-->

</div>
<!-- build:js scripts/app.html.js -->
<!-- jQuery -->
<script src="../libs/jquery/jquery/dist/jquery.js"></script>
<!-- Bootstrap -->
<script src="../libs/jquery/tether/dist/js/tether.min.js"></script>
<script src="../libs/jquery/bootstrap/dist/js/bootstrap.js"></script>
<!-- core -->
<script src="../libs/jquery/underscore/underscore-min.js"></script>
<script src="../libs/jquery/jQuery-Storage-API/jquery.storageapi.min.js"></script>
<script src="../libs/jquery/PACE/pace.min.js"></script>

<script src="scripts/config.lazyload.js"></script>

<script src="scripts/palette.js"></script>
<script src="scripts/ui-load.js"></script>
<script src="scripts/ui-jp.js"></script>
<script src="scripts/ui-include.js"></script>
<script src="scripts/ui-device.js"></script>
<script src="scripts/ui-form.js"></script>
<script src="scripts/ui-nav.js"></script>
<script src="scripts/ui-screenfull.js"></script>
<script src="scripts/ui-scroll-to.js"></script>
<script src="scripts/ui-toggle-class.js"></script>

<script src="scripts/app.js"></script>

<!-- ajax -->
<script src="../libs/jquery/jquery-pjax/jquery.pjax.js"></script>
<script src="scripts/ajax.js"></script>
<!-- endbuild -->
</body>
</html>

{{--<x-guest-layout>--}}
{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="current-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="block mt-4">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">--}}
{{--                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <x-primary-button class="ml-3">--}}
{{--                {{ __('Log in') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}
