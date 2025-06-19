@extends('layouts.adminLayout')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Companies
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="{{route('super-admin.companiesAdd')}}" class="btn btn-primary shadow-md mr-2">Add New Company</a>
    </div>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="intro-y box p-5 mt-5">
    <div class="overflow-x-auto">
        <table class="table dt">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">Company</th>
                    <th class="whitespace-nowrap">Email</th>
                    <th class="whitespace-nowrap">Employees</th>
                    <th class="whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($companies)
                    @foreach($companies as $key=>$val)
                        <tr>
                            <td class="whitespace-nowrap">{{$key+1}}</td>
                            <td class="whitespace-nowrap d-flex">
                                <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                    <img alt="Airsoft" class="tooltip rounded-full" src="{{ $val->profile ? $val->profile : asset('dist/images/profile-10.jpg')}}">
                                </div>
                                <div class="ml-2">{{$val->name}}</div>
                            </td>
                            <td class="whitespace-nowrap">{{$val->email}}</td>
                            <td class="whitespace-nowrap">{{count($val->users)}}</td>
                            <td class="whitespace-nowrap">
                                <div class="flex lg:justify-center items-center">
                                    <a class="edit flex items-center mr-3" href="{{route('super-admin.companiesEdit',$val->id)}}">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="check-square" data-lucide="check-square" class="lucide lucide-check-square w-4 h-4 mr-1">
                                        <polyline points="9 11 12 14 22 4"></polyline>
                                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                      </svg> Edit </a>
                                    <a class="delete flex items-center text-danger" href="{{route('super-admin.companiesDelete',$val->id)}}" data-tw-toggle="modal" data-tw-target="#delete-modal-preview">
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
