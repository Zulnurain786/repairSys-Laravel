@php 
    $layout = auth()->user()->role->name;
@endphp
@extends('layouts.'.$layout.'Layout')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Edit Booking
    </h2>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form action="{{route($layout.'.repairsUpdate')}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{$repair->id}}">
                @csrf
                <div class="col-span-12 grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y">
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Name *</label>
                            <input id="change-password-form-3" name="name" type="text" class="form-control" value="{{$repair->name}}" required>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Email *</label>
                            <input id="change-password-form-3" name="email" type="email" class="form-control" value="{{$repair->email}}" required>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Phone *</label>
                            <input id="change-password-form-3" name="phone" type="text" class="form-control" value="{{$repair->phone}}" required>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Prior work</label>
                            <textarea id="change-password-form-3" name="prior_work"class="form-control">{!! $repair->prior_work !!}</textarea>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Work requested</label>
                            <textarea id="change-password-form-3" name="work_requested"class="form-control">{!! $repair->work_requested !!}</textarea>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Technician Notes</label>
                            <textarea id="change-password-form-3" name="technician_notes"class="form-control technician_notes">{!! $repair->technician_notes !!}</textarea>
                        </div>
                        <div class="mt-5">
                            <div class="form-check form-switch"> 
                                <input id="checkbox-switch-7" class="form-check-input" name="warranty" type="checkbox" value="1" {{$repair->warranty==1 ? 'checked' : ''}}> 
                                <label class="form-check-label" for="checkbox-switch-7">Warranty</label> 
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y">
                        <div class="mt-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-control status">
                                <option value="Awaiting inspection" {{$repair->status=='Awaiting inspection' ? 'selected': ''}}>Awaiting inspection</option>
                                <option value="Awaiting parts" {{$repair->status=='Awaiting parts' ? 'selected': ''}}>Awaiting parts</option>
                                <option value="In progress" {{$repair->status=='In progress' ? 'selected': ''}}>In progress</option>
                                <option value="Completed" {{$repair->status=='Completed' ? 'selected': ''}}>Completed</option>
                                <option value="Paid" {{$repair->status=='Paid' ? 'selected': ''}}>Paid</option>
                                <option value="Collected" {{$repair->status=='Collected' ? 'selected': ''}}>Collected</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Brand</label>
                            <input id="change-password-form-3" name="brand" type="text" class="form-control" value="{{$repair->brand}}">
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Colour</label>
                            <input id="change-password-form-3" name="color" type="text" class="form-control" value="{{$repair->color}}">
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Type</label>
                            <input id="change-password-form-3" name="type" type="text" class="form-control" value="{{$repair->type}}">
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Accessories</label>
                            <textarea id="change-password-form-3" name="accessories"class="form-control">{!! $repair->accessories !!}</textarea>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Note</label>
                            <textarea id="change-password-form-3" name="note"class="form-control">{!! $repair->note !!}</textarea>
                        </div>
                        {{-- @if($data && count($data) > 0)
                            @foreach ($data as $key => $value)
                            <div class="mt-3">
                                <label for="change-password-form-3" class="form-label"> {!! str_replace('_', ' ', $key) !!}</label>
                                <input id="change-password-form-3" name="{{$key}}" type="text" class="form-control" value="{{$value}}">
                            </div>
                            @endforeach
                        @endif --}}
                    </div>
                    <div class="col-span-12 sm:col-span-12 2xl:col-span-12 intro-y mt-2">
                        <hr class="mt-2 mb-2">
                        <h2 class="text-lg font-medium mr-auto">Labour Cost</h2>
                        <div class="col-span-12 grid grid-cols-12 gap-4">
                            <div class="col-span-12 sm:col-span-4 2xl:col-span-3 intro-y">
                                <div class="mt-3">
                                    <label for="change-password-form-3" class="form-label">Hours</label>
                                    <input id="change-password-form-3" name="hours" type="number" step="0.01" min="0" class="form-control" value="{{$repair->hours}}">
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-4 2xl:col-span-3 intro-y">
                                <div class="mt-3">
                                    <label for="change-password-form-3" class="form-label">Cost per hour</label>
                                    <input id="change-password-form-3" name="hour_rate" type="number" step="0.01" min="0" class="form-control" value="{{$repair->hour_rate}}">
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-4 2xl:col-span-3 intro-y">
                                <div class="mt-3 h-full" style="display: flex; justify-content: end;align-items: center;">
                                    <a href="{{route($layout.'.repairs')}}" class="btn btn-light mt-4 mr-3">Cancel</a>
                                    <button type="submit" class="btn btn-primary mt-4">Save Booking</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END: HTML Table Data -->
@endsection
