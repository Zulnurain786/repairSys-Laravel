<!DOCTYPE html>
<html {{ str_replace('_', '-', app()->getLocale()) }} class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{asset('dist/css/app.css')}}" />
        <link rel="stylesheet" href="{{asset('dist/css/custom.css')}}" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="login">
        @error('email')
            @include('components.alert', ['message' => $message,'type'=>'error'])
        @enderror
        @error('password')
            @include('components.alert', ['message' => $message,'type'=>'error'])
        @enderror
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="Airsoft - Admin" class="w-6" src="{{asset('dist/images/logo.svg')}}">
                        <span class="text-white text-lg ml-3"> {{ config('app.name', 'Laravel') }} </span> 
                    </a>
                    <div class="my-auto">
                        <img alt="Airsoft - Admin" class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/illustration.svg')}}">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            A few more clicks to 
                            <br>
                            sign in to your account.
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your repairing system in one place</div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <form method="POST" class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0" action="{{ route('login') }}">
                    @csrf
                    <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                        <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                                Sign In
                            </h2>
                            <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your repairing system in one place</div>
                            <div class="intro-x mt-8">
                                <input type="email" name="email" class="intro-x login__input form-control py-3 px-4 block @error('email') is-invalid @enderror" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <input type="password" name="password" class="intro-x login__input form-control py-3 px-4 block mt-4 @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" required autocomplete="current-password">
                            </div>
                            <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                                <div class="flex items-center mr-auto">
                                    <input name="remember" id="remember" type="checkbox" class="form-check-input border mr-2" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="cursor-pointer select-none" for="remember">{{ __('Remember Me') }}</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top" type="submit">{{ __('Login') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END: Login Form -->
            </div>
        </div>
        <!-- END: Dark Mode Switcher-->
        
        <!-- BEGIN: JS Assets-->
        <script src="{{asset('dist/js/app.js')}}"></script>
        <!-- END: JS Assets-->
    </body>
</html>