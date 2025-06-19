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
        @if(session('error'))
            @include('components.alert', ['message' => session('error'),'type'=>'error'])
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                @include('components.alert', ['message' => $error,'type'=>'error'])
            @endforeach
        @endif
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
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <form method="POST" class="xl:h-screen xl:h-auto xl:flex py-5 xl:py-0 my-10 xl:my-0" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="xl:h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                        <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                                Set new password
                            </h2>
                            <div class="intro-x mt-8">
                                <input type="email" name="email" class="intro-x login__input form-control py-3 px-4 block @error('email') is-invalid @enderror" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <input id="password" placeholder="New password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-2 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <input id="password-confirm" placeholder="Confirm password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-2" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                                <button class="btn btn-primary py-3 px-4 w-full xl:mr-3 align-top" type="submit"> {{ __('Reset Password') }}</button>
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

