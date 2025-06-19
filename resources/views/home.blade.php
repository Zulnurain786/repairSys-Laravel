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
                        <li class="breadcrumb-item active" aria-current="page">Search Booking</li>
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
                    <div class="intro-y box p-5" style="max-width:670px;margin:50px auto 10px;">
                        <form action="{{route('home')}}" method="get">
                            <div class="mt-3" style="position: relative">
                                <input id="change-password-form-3" name="invoice" type="text" class="form-control" placeholder="Search by Repair no." value="{{ isset(request()->invoice) ? request()->invoice : '' }}">
                                <button style="position: absolute;right: 12px;top: 8px;opacity: 0.5" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M779.385-153.846 528.923-404.307q-30 25.538-69 39.538-39 14-78.385 14-96.1 0-162.665-66.529-66.566-66.529-66.566-162.577t66.529-162.702q66.529-66.654 162.577-66.654 96.049 0 162.702 66.565Q610.769-676.101 610.769-580q0 41.692-14.769 80.692-14.769 39-38.769 66.693l250.462 250.461-28.308 28.308ZM381.538-390.769q79.616 0 134.423-54.808Q570.769-500.385 570.769-580q0-79.615-54.808-134.423-54.807-54.808-134.423-54.808-79.615 0-134.423 54.808Q192.308-659.615 192.308-580q0 79.615 54.807 134.423 54.808 54.808 134.423 54.808Z"/></svg>
                                </button>
                                @if(isset(request()->invoice) && !$repair)
                                    <div class="p-2" style="color: #d50202">No result found!</div>
                                @endif
                            </div>
                        </form>
                    </div>
                    @if(isset(request()->invoice) && $repair)
                        @php 
                            $dateTime = new DateTime($repair->created_at);
                            $readableDate = $dateTime->format('F d, Y');
                        @endphp
                        <div class="intro-y box invoice" style="position: relative;max-width:670px;margin:20px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);{{$repair->status=='Completed' || $repair->status=='Paid' || $repair->status=='Collected' ? 'border-top: solid 10px green;' : 'border-top: solid 10px #233e8c;'}}">
                            <a href="{{url('pdf/'.$repair->token)}}" target="_blank" class="btn btn-light btn-sm" style="background: white;position: absolute;right: 15px;top: 15px;"> 
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-328.462 309.233-499.229l42.153-43.384 98.615 98.615v-336.001h59.998v336.001l98.615-98.615 42.153 43.384L480-328.462ZM252.309-180.001q-30.308 0-51.308-21t-21-51.308v-108.46H240v108.46q0 4.616 3.846 8.463 3.847 3.846 8.463 3.846h455.382q4.616 0 8.463-3.846 3.846-3.847 3.846-8.463v-108.46h59.999v108.46q0 30.308-21 51.308t-51.308 21H252.309Z"/></svg>
                            </a>
                            <table style="width: 100%">
                                <thead>
                                    <tr>
                                        <th style="text-align:left;">
                                            <img style="max-width: 150px;" src="{{$repair->company->profile}}" alt="company logo">
                                        </th>
                                        <th style="text-align:right;font-weight:400;">{{$readableDate}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="height:35px;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
                                            <p style="font-size:14px;margin:0 0 6px 0;">
                                            <span style="font-weight:bold;display:inline-block;min-width:150px">Order status</span>
                                            <b style="{{$repair->status=='Completed' || $repair->status=='Paid' || $repair->status=='Collected' ? 'color:green;' : 'color:#ff9400;'}} font-weight:normal;margin:0">{{$repair->status}}</b>
                                            </p>
                                            <p style="font-size:14px;margin:0 0 6px 0;">
                                                <span style="font-weight:bold;display:inline-block;min-width:146px">Repair ID</span> {{$repair->token}}
                                            </p>
                                            <p style="font-size:14px;margin:0 0 0 0;">
                                            <span style="font-weight:bold;display:inline-block;min-width:146px">Total amount</span> {{$repair->status=='Completed' || $repair->status=='Paid' || $repair->status=='Collected' ? '£'.$repair->getTotalPrice() + ($repair->hours * $repair->hour_rate) : 'Price is not confirmed till marked as completed'}}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="height:35px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;padding:20px;vertical-align:top">
                                            <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                                <span style="display:block;font-weight:bold;font-size:13px">Name</span> {{$repair->name}}
                                            </p>
                                            <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                                <span style="display:block;font-weight:bold;font-size:13px;">Email</span> {{$repair->email}}
                                            </p>
                                            <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                                <span style="display:block;font-weight:bold;font-size:13px;">Phone</span> {{$repair->phone}}
                                            </p>
                                            <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                                <span style="display:block;font-weight:bold;font-size:13px;">Prior work </span> {!! $repair->prior_work !!}
                                            </p>
                                            <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                                <span style="display:block;font-weight:bold;font-size:13px;">Accessories </span> {!! $repair->accessories !!}
                                            </p>
                                        </td>
                                        <td style="width:50%;padding:20px;vertical-align:top">
                                            <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                                <span style="display:block;font-weight:bold;font-size:13px;">Brand</span> {{$repair->brand}}
                                            </p>
                                            <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                                <span style="display:block;font-weight:bold;font-size:13px;">Colour</span> {{$repair->color}}
                                            </p>
                                            <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                                <span style="display:block;font-weight:bold;font-size:13px;">Type </span> {{$repair->type}}
                                            </p>
                                            <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                                <span style="display:block;font-weight:bold;font-size:13px;">Work requested </span> {!! $repair->work_requested !!}
                                            </p>
                                            <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                                <span style="display:block;font-weight:bold;font-size:13px;">Warranty </span> {{$repair->warranty ? 'Yes' : 'No'}}
                                            </p>
                                        </td>
                                    </tr>
                                    @if($repair->note)
                                        <tr>
                                            <td colspan="2" style="padding:0px 20px">
                                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                                    <span style="display:block;font-weight:bold;font-size:13px;">Notes </span> {!! $repair->note !!}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($repair->technician_notes)
                                        <tr>
                                            <td colspan="2" style="padding:0px 20px">
                                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;">
                                                    <span style="display:block;font-weight:bold;font-size:13px;">Technician Notes </span> {!! $repair->technician_notes !!}
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                    @if(count($repair->materials) > 0)
                                        <tr>
                                            <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Materials</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding:15px;">
                                                @foreach($repair->materials as $r)
                                                <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                                                    <span style="display:block;font-size:13px;font-weight:normal;">{{$r->name}} {{$r->qty}}</span> £{{$r->price}} <b style="font-size:12px;font-weight:300;"> (Per unit £{{$r->price/$r->qty}})</b>
                                                </p>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                    @if($repair->hours)
                                        <tr>
                                            <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Labour Cost</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding:15px;">
                                                <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                                                    <span style="display:block;font-size:13px;font-weight:normal;"></span> Total Hours : {{$repair->hours}} H <b style="font-size:12px;font-weight:300;float:right"> (Cost per hour : <strong>£{{$repair->hour_rate}}</strong>)</b>
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                    @if(count($repair->media) > 0)
                                        <tr>
                                            <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Work Images</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="display: grid;grid-template-columns: repeat(4, 1fr);gap: 0px">
                                                @foreach($repair->media as $md)
                                                    <span style="margin: 20px 10px">
                                                        <a href="{{$md->path}}" target="_blank"><img style="max-width: 80px" src="{{$md->path}}" alt="" srcset=""></a>
                                                    </span>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
                                            <strong style="display:block;margin:0 0 10px 0;">Contact Email: </strong> {{$repair->company->email}}
                                        </td>
                                    </tr>
                                </tfooter>
                            </table>
                        </div>
                    @endif
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

