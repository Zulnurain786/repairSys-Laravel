@php 
    $layout = auth()->user()->role->name;
@endphp
@extends('layouts.'.$layout.'Layout')

@section('content')

<div class="intro-y mt-5">
    <h2 class="text-lg font-medium mr-auto">
        Add Images
    </h2>
    <form method="POST" enctype="multipart/form-data" data-file-types="image/jpeg|image/png|image/jpg" action="{{route($layout.'.mediaSave',[$id])}}" class="dropzone">
        <div>
            @csrf
            <div class="fallback"> 
                <input name="file" type="file" multiple/> 
            </div>
            <div class="dz-message" data-dz-message>
                <div class="text-lg font-medium">Upload Profile</div>
                <div class="text-slate-500"> Select a photo to upload for your profile picture (.jpg, .jpeg, .png).</div>
            </div>
        </div>
    </form>
    <hr>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="intro-y box p-5 mt-5">
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Images
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="{{route($layout.'.media',$id)}}" class="btn btn-light shadow-md mr-2 btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M482.077-166q-129.25 0-220.625-91.339-91.375-91.34-91.375-220.539 0-129.199 91.375-222.661Q352.827-794 482.077-794q72.308 0 135.538 34.384 63.231 34.385 106.308 90.077V-794h66v263.231H526.692v-66h168q-33.231-57.846-89.384-91.539Q549.154-722 482.077-722q-103 0-174.5 71t-71.5 173q0 103 71.5 174.5t174.5 71.5q78 0 141.5-44.5t88.5-119.5h68.462Q753.077-294.154 670.5-230.077T482.077-166Z"/></svg>
                Refresh
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="table">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">#ID</th>
                    <th class="whitespace-nowrap">Image</th>
                    <th class="whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($media)
                    @foreach($media as $key=>$val)
                        <tr>
                            <td class="whitespace-nowrap">{{$key+1}}</td>
                            <td class="whitespace-nowrap"><a href="{{$val->path}}" target="_blank"><img src="{{$val->path}}" alt="" width="40px"></a></td>
                            <td class="whitespace-nowrap">
                                <div class="">
                                    <a class="delete flex items-center text-danger" href="{{route($layout.'.mediaDelete',$val->id)}}" data-tw-toggle="modal" data-tw-target="#delete-modal-preview">
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
