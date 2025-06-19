@php 
    $layout = auth()->user()->role->name;
@endphp
@extends('layouts.'.$layout.'Layout')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Add Booking
    </h2>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form action="{{route($layout.'.repairsSave')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-span-12 grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y">
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Name *</label>
                            <input id="change-password-form-3" name="name" type="text" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Email *</label>
                            <input id="change-password-form-3" name="email" type="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Phone *</label>
                            <input id="change-password-form-3" name="phone" type="text" class="form-control" value="{{ old('phone') }}" required>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Prior work</label>
                            <textarea id="change-password-form-3" name="prior_work"class="form-control">{{ old('prior_work') }}</textarea>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Work requested</label>
                            <textarea id="change-password-form-3" name="work_requested"class="form-control">{{ old('work_requested') }}</textarea>
                        </div>
                        {{-- <div class="mt-3" id="dynamicinput-second">

                        </div> --}}
                        <div class="mt-5">
                            <div class="form-check form-switch"> 
                                <input id="checkbox-switch-7" class="form-check-input" name="warranty" type="checkbox" value="1"> 
                                <label class="form-check-label" for="checkbox-switch-7">Warranty</label> 
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y">
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Brand</label>
                            <input id="change-password-form-3" name="brand" type="text" class="form-control" value="{{ old('brand') }}">
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Colour</label>
                            <input id="change-password-form-3" name="color" type="text" class="form-control" value="{{ old('color') }}">
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Type</label>
                            <input id="change-password-form-3" name="type" type="text" class="form-control" value="{{ old('type') }}">
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Accessories</label>
                            <textarea id="change-password-form-3" name="accessories"class="form-control">{{ old('accessories') }}</textarea>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Note</label>
                            <textarea id="change-password-form-3" name="note"class="form-control">{{ old('note') }}</textarea>
                        </div>
                        @foreach ($data as $key => $value)
                        <div class="mt-3" id="dynamicinput-first">
                            <label for="change-password-form-3" class="form-label">{!! str_replace('_', ' ', $key) !!}</label>
                            <input id="change-password-form-3" name="{{ $key }}" type="text" class="form-control" >
                        </div>
                        @endforeach
                        <div class="mt-3" style="display: flex; justify-content: end;">
                            <a href="{{route($layout.'.repairs')}}" class="btn btn-light mt-4 mr-3">Cancel</a>
                            <button type="submit" class="btn btn-primary mt-4">Save Booking</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
     
    </div>
</div>
<!-- END: HTML Table Data -->
@endsection
