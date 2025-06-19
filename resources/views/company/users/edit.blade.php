@extends('layouts.companyLayout')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Edit User
    </h2>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form action="{{route('company.usersUpdate')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="w-10 h-10 image-fit zoom-in -ml-5 p-5 mb-5">
                    <img alt="Airsoft" class="tooltip rounded-full" src="{{ $user->profile ? $user->profile : asset('dist/images/profile-10.jpg')}}">
                </div>
                <div>
                    <label for="change-password-form-3" class="form-label">Profile</label>
                    <input id="change-password-form-3" name="profile" type="file" class="form-control">
                </div>
                <div class="mt-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-control">
                        <option value="3" {{$user->role_id==3 ? 'selected' : ''}}>Staff</option>
                        <option value="4" {{$user->role_id==4 ? 'selected' : ''}}>Technician</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="change-password-form-3" class="form-label">Name</label>
                    <input id="change-password-form-3" name="name" type="text" class="form-control" value="{{$user->name}}">
                </div>
                <div class="mt-3">
                    <label for="change-password-form-3" class="form-label">Email</label>
                    <input id="change-password-form-3" name="email" type="email" class="form-control" value="{{$user->email}}" required>
                </div>
                <div class="mt-3">
                    <label for="change-password-form-3" class="form-label">Password</label>
                    <input id="change-password-form-3" name="password" type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-4">Update</button>
            </form>
        </div>
    </div>
</div>
<!-- END: HTML Table Data -->
@endsection
