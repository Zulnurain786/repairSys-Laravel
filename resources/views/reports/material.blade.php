@php 
    $layout = auth()->user()->role->name;
@endphp
@extends('layouts.'.$layout.'Layout')

@section('content')
<!-- BEGIN: HTML Table Data -->
<div class="intro-y box p-5 mt-5">
    <div class="intro-y">
        <h2 class="text-lg font-medium mr-auto">
            Material Report
        </h2>
        <div class="w-full sm:w-auto sm:flex mt-4">
            <form action="" method="get">
                <div class="grid grid-cols-12 gap-3 mb-5">
                    <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y">
                        <label for="change-password-form-3" class="form-label">From</label>
                        <div class="relative w-56 mx-auto"> 
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400"> 
                                <i data-lucide="calendar" class="w-4 h-4"></i> 
                            </div> 
                            <input type="text" name="from" class="datepicker form-control pl-12" data-single-mode="true" value="{{request()->from}}" required> 
                        </div> 
                    </div>
                    <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y">
                        <label for="change-password-form-3" class="form-label">To</label>
                        <div class="relative w-56 mx-auto flex"> 
                            <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500 dark:bg-darkmode-700 dark:border-darkmode-800 dark:text-slate-400"> 
                                <i data-lucide="calendar" class="w-4 h-4"></i> 
                            </div> 
                            <input type="text" name="to" class="datepicker form-control pl-12" data-single-mode="true" value="{{request()->to}}" required> 
                        </div> 
                    </div>
                    <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y flex">
                        <div class="flex" style="align-items:flex-end">
                            <button type="submit" class="btn btn-primary shadow-md btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#FFFFFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/></svg>
                            </button>
                            @if(request('from') || request('to'))
                                <a href="{{route('company.materialReport')}}" class="btn btn-light shadow-md btn-sm ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="intro-y overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">#Repair ID</th>
                    <th class="whitespace-nowrap">Name</th>
                    <th class="whitespace-nowrap">Date</th>
                    <th class="whitespace-nowrap">Qty</th>
                    <th class="whitespace-nowrap">Unit Price</th>
                    <th class="whitespace-nowrap">Total</th>
                </tr>
            </thead>
            <tbody>
                @if(count($material) > 0)
                    @php $total = 0 @endphp
                    @foreach($material as $key=>$val)
                        @php $total = $total + $val->price @endphp
                        <tr>
                            <td class="whitespace-nowrap">
                                @if($val->repair)
                                <a style="color: #1f3a8a" target="_blank" href="{{url('home?invoice='.$val->repair->token)}}">#{{$val->repair->token}}</a>
                                @else <span class="text-danger">Deleted</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap">{{$val->name}}</td>
                            <td class="whitespace-nowrap">{{ \Carbon\Carbon::parse($val->created_at)->format('F d, Y') }}</td>
                            <td class="whitespace-nowrap">{{$val->qty}}</td>
                            <td class="whitespace-nowrap">£{{$val->price/$val->qty}}</td>
                            <td class="whitespace-nowrap">£{{$val->price}}</td>
                        </tr>
                    @endforeach
                    <tr style="background-color: whitesmoke">
                        <td class="whitespace-nowrap"></td>
                        <td class="whitespace-nowrap"></td>
                        <td class="whitespace-nowrap"></td>
                        <td class="whitespace-nowrap"></td>
                        <td class="whitespace-nowrap"></td>
                        <td class="whitespace-nowrap"><h2 class="text-lg font-medium mr-auto">Total Cost: £{{$total}}</h2></td>
                    </tr>
                @else 
                    <tr><td colspan="5" class="text-center">No record found!</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<!-- END: HTML Table Data -->
@endsection
