@php 
    $layout = auth()->user()->role->name;
@endphp
@extends('layouts.'.$layout.'Layout')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Edit Material
    </h2>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form action="{{route($layout.'.materialUpdate',[$material->repair->id])}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{$material->id}}">
                @csrf
                <div class="col-span-12 grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y">
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Name</label>
                            <input id="change-password-form-3" name="name" type="text" class="form-control" value="{{$material->name}}" required>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Qty</label>
                            <input id="quantity" name="qty" type="number" class="form-control" value="{{$material->qty}}" required>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y">
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Unit Price £</label>
                            <input id="unitPrice" name="unit_price" type="number" class="form-control" value="{{$material->price/$material->qty}}" required>
                        </div>
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Total Price £</label>
                            <input id="total" name="price" type="number" class="form-control" value="{{$material->price}}" required readonly>
                        </div>
                        <div class="mt-3" style="display: flex; justify-content: end;">
                            <a href="{{route($layout.'.material',[$material->repair->id])}}" class="btn btn-light mt-4 mr-3">Cancel</a>
                            <button type="submit" class="btn btn-primary mt-4">Save Material</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END: HTML Table Data -->
@endsection
