@php 
    $layout = auth()->user()->role->name;
@endphp
@extends('layouts.'.$layout.'Layout')

@section('content')

<div class="intro-y box p-5 mt-5">
    <h2 class="text-lg font-medium mr-auto">
        Add Material
    </h2>
    <form action="{{route($layout.'.materialsSave')}}" method="post">
        @csrf
        <div class="grid grid-cols-12 gap-3 mb-5">
            <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y">
                <div class="mt-3">
                    <label for="change-password-form-3" class="form-label">Title</label>
                    <input id="change-password-form-3" name="name" type="text" class="form-control" value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y">
                <div class="mt-3">
                    <label for="unitPrices" class="form-label">Unit Price £</label>
                    <input id="unitPrices" name="price" type="number" step=".01" class="form-control" value="{{ old('price') }}" required>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y flex" style="align-items: end">
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary shadow-md mr-2">Add Material</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="intro-y box p-5 mt-5">
    <h2 class="text-lg font-medium mr-auto">
        Company Materials
    </h2>
    <div class="overflow-x-auto">
        <table class="table dt">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">#ID</th>
                    <th class="whitespace-nowrap">Title</th>
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
                            <td class="whitespace-nowrap">{{$val->price}}</td>
                            <td class="whitespace-nowrap">
                                <div class="flex items-center">
                                    <a class="edit flex items-center mr-3" href="{{route($layout.'.materialsEdit',[$val->id])}}">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-1">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                      </svg> Edit </a>
                                    <a class="delete flex items-center text-danger" href="{{route($layout.'.materialsDelete',$val->id)}}" data-tw-toggle="modal" data-tw-target="#delete-modal-preview">
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
