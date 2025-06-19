@php 
    $layout = auth()->user()->role->name;
@endphp
@extends('layouts.'.$layout.'Layout')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Booking Repairs
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <form action="{{route($layout.'.repairs')}}" method="get" class="status-form mr-2">
            <select name="status" class="form-control" onchange="$('.status-form').submit()">
                <option value="" {{request('status')=='' ? 'selected' : ''}}>All ({{$allRepair->count()}})</option>
                <option value="Awaiting inspection" {{request('status')=='Awaiting inspection' ? 'selected' : ''}}>Awaiting inspection ({{$allRepair->where('status','Awaiting inspection')->count()}})</option>
                <option value="Awaiting parts" {{request('status')=='Awaiting parts' ? 'selected' : ''}}>Awaiting parts ({{$allRepair->where('status','Awaiting parts')->count()}})</option>
                <option value="In progress" {{request('status')=='In progress' ? 'selected' : ''}}>In progress ({{$allRepair->where('status','In progress')->count()}})</option>
                <option value="Completed" {{request('status')=='Completed' ? 'selected' : ''}}>Completed ({{$allRepair->where('status','Completed')->count()}})</option>
                <option value="Paid" {{request('status')=='Paid' ? 'selected' : ''}}>Paid ({{$allRepair->where('status','Paid')->count()}})</option>
                <option value="Collected" {{request('status')=='Collected' ? 'selected' : ''}}>Collected ({{$allRepair->where('status','Collected')->count()}})</option>
            </select>
        </form>
        <a href="{{route($layout.'.repairsAdd')}}" class="btn btn-primary shadow-md mr-2">Add New Booking</a>
    </div>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="intro-y box p-5 mt-5">
    <div class="overflow-x-auto">
        <table class="table dt">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">#Invoice</th>
                    <th class="whitespace-nowrap">Name</th>
                    <th class="whitespace-nowrap">Email</th>
                    <th class="whitespace-nowrap">Phone</th>
                    <th class="whitespace-nowrap">Type</th>
                    <th class="whitespace-nowrap">Status</th>
                    <th class="whitespace-nowrap">warranty</th>
                    <th class="whitespace-nowrap">Date</th>
                    <th class="whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($repairs)
                    @foreach($repairs as $key=>$val)
                        <tr>
                            <td class="whitespace-nowrap"><a style="color: #1f3a8a" target="_blank" href="{{url('home?invoice='.$val->token)}}">#{{$val->token}}</a></td>
                            <td class="whitespace-nowrap">{{$val->name}}</td>
                            <td class="whitespace-nowrap">{{$val->email}}</td>
                            <td class="whitespace-nowrap">{{$val->phone}}</td>
                            <td class="whitespace-nowrap">{{$val->type}}</td>
                            <td class="whitespace-nowrap">
                                <span class="{{$val->status=='Completed' || $val->status=='Paid' || $val->status=='Collected' ?  'alert-success-soft' : 'alert-primary-soft'}} p-2" style="border-radius: 10px">
                                    {{$val->status}}
                                     <small>{{$val->status_date}}</small>
                                </span>
                            </td>
                            <td class="whitespace-nowrap">{{$val->warranty ? 'Yes' : 'No'}}</td>
                            <td class="whitespace-nowrap">{{ \Carbon\Carbon::parse($val->created_at)->format('F d, Y') }}</td>
                            <td class="whitespace-nowrap">
                                <div class="dropdown">
                                    <button class="dropdown-toggle btn btn-primary btn-sm" aria-expanded="false" data-tw-toggle="dropdown"><i data-lucide="layout" class="w-4 h-4 mr-2"></i> Options</button>
                                    <div class="dropdown-menu w-56">
                                        <ul class="dropdown-content">
                                            <li>
                                                <h6 class="dropdown-header">
                                                    Actions
                                                </h6>
                                            </li>
                                            <li>
                                                <hr>
                                            </li>
                                            @if($val->status=='Completed')
                                            <li>
                                                <button style="width: 100%" class="dropdown-item" data-url='{{route('resendEmail',$val->id)}}'  onclick="resendEmail($(this))">  
                                                    <span style="margin-right: 5px;" class="material-symbols-rounded mail-icon">
                                                        outgoing_mail
                                                    </span>
                                                    <span class="loading" style="margin-right: 5px;display: none">
                                                        <i data-loading-icon="ball-triangle" class="w-4 h-6"></i> 
                                                    </span>
                                                    Resend Mail 
                                                </button>
                                            </li>
                                            @endif
                                            <li>
                                                <a href="{{route($layout.'.material',$val->id)}}" class="dropdown-item">  
                                                    <svg style="filter: invert(1);opacity: 0.6;margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#FFFFFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg> 
                                                    Materials 
                                                </a>
                                            </li>
                                            <li>
                                                <a  href="{{route($layout.'.media',$val->id)}}" class="dropdown-item">  
                                                    <svg style="opacity: 0.6;margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 0 24 24" width="18px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M22 18V2H6v16h16zm-11-6l2.03 2.71L16 11l4 5H8l3-4zM2 6v16h16v-2H4V6H2z"/></svg>
                                                    Images 
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route($layout.'.repairsEdit',$val->id)}}" class="dropdown-item">  
                                                    <svg style="margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-1">
                                                        <polyline points="9 11 12 14 22 4"></polyline>
                                                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                                    </svg>
                                                    Edit 
                                                </a>
                                            </li>
                                            <li>
                                                <hr>
                                            </li>
                                            <li>
                                                <a href="{{route($layout.'.repairsDelete',$val->id)}}" class="delete dropdown-item text-danger" data-tw-toggle="modal" data-tw-target="#delete-modal-preview">  
                                                    <svg style="margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2" data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                      </svg>
                                                    Delete 
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
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
