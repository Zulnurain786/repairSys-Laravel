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
        <link rel="stylesheet" href="{{asset('dist/css/custom.css?v='.rand(1000, 100))}}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,200,0,0" />
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
        <div class="my-notify">
            <div class="alert alert-success my-alert"></div>
            <div class="alert alert-danger my-alert"></div>
        </div>
        @include('components.confirm')
        <!-- BEGIN: Mobile Menu -->
        <div class="mobile-menu md:hidden">
            <div class="mobile-menu-bar">
                <a href="" class="flex mr-auto">
                    <img alt="Airsoft - Admin" class="w-6" src="{{asset('dist/images/logo.svg')}}">
                </a>
                <a href="javascript:;" id="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            </div>
            <ul class="border-t border-white/[0.08] py-5 hidden">
                <li>
                    <a href="{{route(auth()->user()->role->name.'.home')}}" class="menu {{ request()->is('staff') ? 'menu--active' : ''}}">
                        <div class="menu__icon"> <i data-lucide="home"></i> </div>
                        <div class="menu__title"> Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="menu">
                        <div class="menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="menu__title"> Repair Booking <i data-lucide="chevron-down" class="menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="{{route('staff.repairs')}}" class="menu">
                                <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="menu__title"> List </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('staff.repairsAdd')}}" class="menu">
                                <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="menu__title"> Add </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('staff.materials')}}" class="menu">
                        <div class="menu__icon"> <i data-lucide="box"></i> </div>
                        <div class="menu__title"> Materials</div>
                    </a>
                </li>
                <li>
                    <a href="{{route('updates')}}" class="menu {{ request()->is('updates') ? 'menu--active' : ''}}">
                        <div class="menu__icon"> <i data-lucide="rotate-ccw"></i> </div>
                        <div class="menu__title"> Versions</div>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END: Mobile Menu -->
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
                        <li class="breadcrumb-item active" aria-current="page">{{ request()->path()=='staff' ? 'home' : substr(request()->path(), strpos(request()->path(), '/') + 1) }}</li>
                    </ol>
                </nav>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Account Menu -->
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
                                <a href="{{route('staff.settings')}}" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profile </a>
                            </li>
                            <li>
                                <a href="{{route('staff.passwords')}}" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
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
            </div>
        </div>
        <!-- END: Top Bar -->
        <div class="wrapper">
            <div class="wrapper-box">
                <!-- BEGIN: Side Menu -->
                <nav class="side-nav">
                    <ul>
                        <li>
                            <a href="{{route(auth()->user()->role->name.'.home')}}" class="side-menu {{ request()->is('staff') ? 'side-menu--active' : ''}}">
                                <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                                <div class="side-menu__title">
                                    Dashboard 
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" class="side-menu {{ request()->is('staff/repairs/*') || request()->is('staff/repairs') ? 'side-menu--open' : ''}}">
                                <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                                <div class="side-menu__title">
                                    Booking Repairs
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="{{ request()->is('staff/repairs/*') || request()->is('staff/repairs') ? 'side-menu__sub-open' : ''}}">
                                <li>
                                    <a href="{{route('staff.repairs')}}" class="side-menu {{ request()->is('staff/repairs') ? 'side-menu--active' : ''}}">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> List </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('staff.repairsAdd')}}" class="side-menu {{ request()->is('staff/repairs/add') ? 'side-menu--active' : ''}}">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> Add New </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" class="side-menu {{ request()->is('staff/materials/*') || request()->is('staff/materials') ? 'side-menu--open' : ''}}">
                                <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
                                <div class="side-menu__title">
                                    Materials
                                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                                </div>
                            </a>
                            <ul class="{{ request()->is('staff/materials/*') || request()->is('staff/materials') ? 'side-menu__sub-open' : ''}}">
                                <li>
                                    <a href="{{route('staff.materials')}}" class="side-menu {{ request()->is('staff/materials') ? 'side-menu--active' : ''}}">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> List </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('updates')}}" class="side-menu {{ request()->is('updates') ? 'side-menu--active' : ''}}">
                                <div class="side-menu__icon"> <i data-lucide="rotate-ccw"></i> </div>
                                <div class="side-menu__title">
                                    Versions 
                                </div>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- END: Side Menu -->
                <!-- BEGIN: Content -->
                <div class="content">
                    {{-- Content here --}}
                    @yield('content')
                </div>
                <!-- END: Content -->
            </div>
        </div>
        
        <!-- BEGIN: JS Assets -->
       <script src="{{asset('dist/js/app.js')}}"></script>
       <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.5.1/axios.min.js" integrity="sha512-emSwuKiMyYedRwflbZB2ghzX8Cw8fmNVgZ6yQNNXXagFzFOaQmbvQ1vmDkddHjm5AITcBIZfC7k4ShQSjgPAmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
       <script src="{{asset('dist/js/custom.js?v='.rand(1000, 100))}}"></script>
        <!-- END: JS Assets-->
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
       <script>
        $(document).ready( function () {
            $('.dt').DataTable({
                lengthChange: false
            })

            /* Manage Navigation breadcrumps */
            $('.breadcrumb-item').each(function(){
                var cloned = $(this).clone()
                var parts = $(this).text().split('/')
                if(parts.length > 1){
                    $(this).text(parts[0])
                    for (let index = 1; index < parts.length; index++) {
                        cloned.text(parts[index])
                        $(this).after(cloned)
                    }
                }
            })

            /* calculate total */
            function calculateTotal() {
                var quantity = parseFloat($("#quantity").val())
                var unitPrice = parseFloat($("#unitPrice").val())
                if(!isNaN(quantity) && !isNaN(unitPrice)){
                    var total = quantity * unitPrice;
                    $("#total").val(total.toFixed(2))
                } 
                else $("#total").val("")
            }
            /* Attach event listeners to quantity and unit price fields */
            $("#quantity, #unitPrice").on("input", calculateTotal)


            var deleteUrl = ''
            /* Confirm Deletion */
            $('.delete').click(function(e){
                e.preventDefault()
                deleteUrl = $(this).attr('href')
            })

            $('.deleteConfirm').click(function(){
                window.location.href = deleteUrl
            })

            $('.deleteCancel').click(function(){
                deleteUrl = ''
            })

            $('.mt').change(function(){
                var selectedOption = $(this).find('option:selected')
                if(selectedOption=='0'){
                    $('.t,.p').val('')
                }
                else{
                    $('.t').val(selectedOption.data('title'))
                    $('.p').val(selectedOption.data('price'))
                }
            })
        })
       </script>
    </body>
</html>

