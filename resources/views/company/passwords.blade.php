@extends('layouts.companyLayout')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Change Password
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
                    Change Password
                </h2>
            </div>
            <div class="p-5">
                <form action="{{route('company.passwordsSave')}}" method="post">
                    @csrf
                    <div>
                        <label for="change-password-form-1" class="form-label">Old Password</label>
                        <input id="change-password-form-1" name="current_password" type="password" class="form-control" placeholder="Old Password">
                    </div>
                    <div class="mt-3">
                        <label for="change-password-form-2" class="form-label">New Password</label>
                        <input id="change-password-form-2" name="new_password" type="password" class="form-control" placeholder="New Password">
                    </div>
                    <div class="mt-3">
                        <label for="change-password-form-3" class="form-label">Confirm New Password</label>
                        <input id="change-password-form-3" name="new_password_confirmation" type="password" class="form-control" placeholder="Confirm New Password">
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Change Password</button>
                </form>
            </div>
        </div>
        <!-- END: Change Password -->
    </div>
</div>
@endsection
