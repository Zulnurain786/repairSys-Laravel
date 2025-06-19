@extends('layouts.companyLayout')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Settings
    </h2>
</div>
<div class="grid grid-cols-12 gap-6">
    <!-- BEGIN: Profile Menu -->
    <div class="col-span-12 lg:col-span-4 2xl:col-span-3 flex lg:block flex-col-reverse">
        <div class="intro-y box mt-5">
            <div class="relative flex items-center p-5">
                <div class="w-12 h-12 image-fit">
                    <img alt="Airsoft - Admin" class="rounded-full" src="{{ Auth::user()->profile ? Auth::user()->profile : asset('dist/images/profile-10.jpg')}}">
                </div>
                <div class="ml-4 mr-auto">
                    <div class="font-medium text-base">{{ Auth::user()->name }}</div>
                    <div class="text-slate-500">{{ Auth::user()->role->name }}</div>
                </div>
            </div>
            <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400">
                <a class="flex items-center {{request()->is('company/settings') ? 'text-primary font-medium' : ''}}" href="{{route('company.settings')}}"> <i data-lucide="activity" class="w-4 h-4 mr-2"></i> Personal Information </a>
                <a class="flex items-center mt-5 {{request()->is('company/passwords') ? 'text-primary font-medium' : ''}}" href="{{route('company.passwords')}}"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Change Password </a>
            </div>
            <div class="p-5 border-t border-slate-200/60 dark:border-darkmode-400 flex">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-outline-secondary py-1 px-2 ml-auto">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <!-- END: Profile Menu -->
    <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
        <!-- BEGIN: Change Password -->
        <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                <h2 class="font-medium text-base mr-auto">
                    Settings
                </h2>
            </div>
            <div class="p-5">
                <form data-single="true" method="POST" enctype="multipart/form-data" data-file-types="image/jpeg|image/png|image/jpg" action="{{route('company.uploadProfile')}}" class="dropzone">
                    <div>
                        @csrf
                        <div class="fallback"> 
                            <input name="file" type="file" /> 
                        </div>
                        <div class="dz-message" data-dz-message>
                            <div class="text-lg font-medium">Upload Profile</div>
                            <div class="text-slate-500"> Select a photo to upload for your profile picture (.jpg, .jpeg, .png).</div>
                        </div>
                    </div>
                </form>
            </div>
           <div class="p-5">
                <form action="{{route('company.uploadProfileData')}}" method="post" id="formData">
                    @csrf
                    <div class="mt-3">
                        <label for="change-password-form-3" class="form-label">Name</label>
                        <input id="change-password-form-3" name="name" type="text" class="form-control" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mt-3">
                        <label for="change-password-form-3" class="form-label">Email</label>
                        <input id="change-password-form-3" name="email" type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                    </div>
                    <button type="button" onclick="saveProfile()" type="submit" class="btn btn-primary mt-4">Save</button>
                </form>
           </div>
        </div>
        <!-- END: Change Password -->
    </div>
</div>
@endsection
