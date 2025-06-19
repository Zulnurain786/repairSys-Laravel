@php 
    $layout = auth()->user()->role->name;
@endphp
@extends('layouts.'.$layout.'Layout')

@section('content')

<div class="intro-y mt-5">
    <h2 class="text-lg font-medium mr-auto">
        Add Material
    </h2>
    <form action="{{route($layout.'.materialSave',[$id])}}" method="post">
        @csrf
        <div class="grid grid-cols-12 gap-2 mb-5">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="mt-3">
                    <label for="change-password-form-3" class="form-label">Company Materials</label>
                    <select data-placeholder="Select from company material" class="tom-select w-full tomselected mt" id="crud-form-2" name="material" tabindex="-1" hidden="hidden">
                        <option value="0" selected>Add new</option>
                        @if($materialsCompany)
                            @foreach($materialsCompany as $key=>$mt)
                                <option value="{{$mt->name}}" data-title="{{$mt->name}}" data-price="{{$mt->price}}">{{$mt->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                <div class="mt-3">
                    <label for="change-password-form-3" class="form-label">Title</label>
                    <input id="change-password-form-3" name="name" type="text" class="form-control t" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-1 intro-y">
                <div class="mt-3">
                    <label for="quantity" class="form-label">Qty</label>
                    <input id="quantity" name="qty" type="number" class="form-control" value="{{ old('qty') }}" required>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                <div class="mt-3">
                    <label for="unitPrice" class="form-label">Unit Price £</label>
                    <input id="unitPrice" name="unit_price" type="number" step=".01" class="form-control p" value="{{ old('unit_price') }}" required>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                <div class="mt-3">
                    <label for="total" class="form-label">Total Price £</label>
                    <input id="total" step=".01" name="price" type="number" class="form-control" value="{{ old('price') }}" required readonly>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y flex items-end justify-end">
                <div>
                    <button type="submit" class="btn btn-primary shadow-md mr-2">Add Material</button>
                </div>
            </div>
        </div>
    </form>
    <hr>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="intro-y box p-5 mt-5">
    <h2 class="text-lg font-medium mr-auto">
        Materials
    </h2>
    <div class="overflow-x-auto">
        <table class="table dt">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">#ID</th>
                    <th class="whitespace-nowrap">Title</th>
                    <th class="whitespace-nowrap">Qty</th>
                    <th class="whitespace-nowrap">Price</th>
                    <th class="whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($materials)
                    @foreach($materials as $key=>$val)
                        <tr>
                            <td class="whitespace-nowrap">{{$key+1}}</td>
                            <td class="whitespace-nowrap">{{$val->name}}</td>
                            <td class="whitespace-nowrap">{{$val->qty}}</td>
                            <td class="whitespace-nowrap">{{$val->price}}</td>
                            <td class="whitespace-nowrap">
                                <div class="flex items-center">
                                    {{-- <a class="edit flex items-center mr-3" href="{{route($layout.'.materialEdit',[$val->repair->id,$val->id])}}">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-1">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                      </svg> Edit </a> --}}
                                    <a class="delete flex items-center text-danger" href="{{route($layout.'.materialDelete',$val->id)}}" data-tw-toggle="modal" data-tw-target="#delete-modal-preview">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                      </svg> Delete </a>
                                  </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<!-- END: HTML Table Data -->
@endsection
