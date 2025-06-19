<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <title> {{ config('app.name', 'Laravel') }} </title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{asset('dist/css/app.css')}}" />
        <link rel="stylesheet" href="{{asset('dist/css/custom.css')}}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="main">
        @if(session('success'))
            @include('components.alert', ['message' => session('success'),'type'=>'success'])
        @endif
        @if(session('error'))
            @include('components.alert', ['message' => session('error'),'type'=>'error'])
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                @include('components.alert', ['message' => $error,'type'=>'error'])
            @endforeach
        @endif
        <!-- BEGIN: Top Bar -->
        <div class="top-bar-boxed h-[70px] z-[51] relative border-b border-white/[0.08] -mt-7 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 md:pt-0 mb-12">
            <div class="h-full flex items-center">
                <!-- BEGIN: Logo -->
                <a href="" class="-intro-x hidden md:flex">
                    <img alt="Airsoft - Admin" class="w-6" src="{{asset('dist/images/logo.svg')}}">
                    <span class="text-white text-lg ml-3"> {{ config('app.name', 'Laravel') }} </span> 
                </a>
                <!-- END: Logo -->
                <!-- BEGIN: Breadcrumb -->
                <nav aria-label="breadcrumb" class="-intro-x h-full mr-auto">
                    <ol class="breadcrumb breadcrumb-light">
                        <li class="breadcrumb-item"><a href="#">Application</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Versions</li>
                    </ol>
                </nav>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Account Menu -->
                @if(Auth::check())
                <div class="intro-x dropdown mr-4 sm:mr-6">
                    <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500"> 
                        <a href="{{route(auth()->user()->role->name.'.home')}}">Dashboard</a>
                    </div>
                </div>
                @else 
                    <div class="intro-x dropdown mr-4 sm:mr-6">
                        <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500" style="font-size: 14px;"> 
                            <a href="{{url('login')}}">Login</a>
                        </div>
                    </div>
                @endif
                @if(Auth::check())
                    <div class="intro-x dropdown w-8 h-8">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                            <img alt="Airsoft - Admin" src="{{ Auth::user()->profile ? Auth::user()->profile : asset('dist/images/profile-10.jpg')}}">
                        </div>
                        <div class="dropdown-menu w-56">
                            <ul class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                                <li class="p-2">
                                    <div class="font-medium"> {{ Auth::user()->name }}</div>
                                    <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500"> {{ Auth::user()->role->name }}</div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider border-white/[0.08]">
                                </li>
                                <li>
                                    <a href="{{route('super-admin.settings')}}" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profile </a>
                                </li>
                                <li>
                                    <a href="{{route('super-admin.passwords')}}" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider border-white/[0.08]">
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item hover:bg-white/5"> 
                                        <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> 
                                        Logout 
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END: Account Menu -->
                @endif
            </div>
        </div>
        <!-- END: Top Bar -->
        <div class="wrapper">
            <div class="wrapper-box">
                <!-- BEGIN: Content -->
                <div class="content">
                    <div class="intro-y p-5">
                        @if($updates)
                            @foreach ($updates as $key=>$item)
                                <h1 class="text-xl font-bold flex mt-4" style="cursor: pointer" onclick="$(this).next('.data').toggle('slow');$(this).find('.icon-toggle').toggle();">
                                    Version {{$item->version}} 
                                    <img class="icon-toggle" src="{{asset('dist/images/arrow-right.jpg')}}" style="width: 27px;height: 27px;margin-left: 10px;{{$key==0 ? 'display: none' : ''}}" alt="" srcset="">
                                    <img class="icon-toggle" src="{{asset('dist/images/arrow-down.jpg')}}" style="width: 27px;height: 27px;margin-left: 10px;{{$key==0 ? '' : 'display: none'}}" alt="" srcset="">
                                </h1>
                                <div class="data mt-4" style="{{$key==0 ? '' : 'display: none'}}">
                                    {!! $item->content !!}
                                </div>
                                <hr class="mt-4">
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- END: Content -->
            </div>
        </div>
        
        <!-- BEGIN: JS Assets -->
       <script src="{{asset('dist/js/app.js')}}"></script>
       <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
       <script src="{{asset('dist/js/custom.js')}}"></script>
        <!-- END: JS Assets-->
    </body>
</html>

