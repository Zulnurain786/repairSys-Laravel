@extends('layouts.adminLayout')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Add New Update
    </h2>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form action="{{route('super-admin.updatesSave')}}" method="post">
                @csrf
                <div class="mt-3">
                    <label for="change-password-form-3" class="form-label">Version</label>
                    <input id="change-password-form-3" name="version" type="text" class="form-control" value="{{ old('version') }}">
                </div>
                <div class="mt-3">
                    <label for="change-password-form-3" class="form-label">Content</label>
                    <textarea id="change-password-form-3" name="content" class="form-control editor"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Save</button>
            </form>
        </div>
    </div>
</div>
<!-- END: HTML Table Data -->
@endsection
