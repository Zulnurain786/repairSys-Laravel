@php 
    $layout = auth()->user()->role->name;
@endphp
@extends('layouts.'.$layout.'Layout')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Add Fields
    </h2>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-span-12 grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y">
                        <div class="mt-3">
                            <label for="change-password-form-3" class="form-label">Name *</label>
                            <input id="addinput" name="name" type="text" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mt-3" style="display: flex; justify-content: end;">
                            <button type="button" class="btn btn-primary mt-4"  onclick="addInput()">Add</button>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Fields
    </h2>
</div>
<!-- BEGIN: HTML Table Data -->
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-12">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <form action="{{route($layout.'.filedssave')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-span-12 grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y">
                        <div class="mt-3" id="dynamicinput-first">
                            
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 2xl:col-span-3 intro-y">
                        <div class="mt-3" id="dynamicinput-second">

                        </div>
                        <div id="d-div" class="mt-3" style="display: flex; justify-content: end;">
                            <a href="{{route($layout.'.repairs')}}" class="btn btn-light mt-4 mr-3">Cancel</a>
                            <button type="submit" class="btn btn-primary mt-4">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END: HTML Table Data -->
<script>
    let count=0,display_div=0;
    function addInput() {
      var labelofinput=document.getElementById("addinput").value;
      var inputContainer1 = document.getElementById("dynamicinput-first");
      var inputContainer2 = document.getElementById("dynamicinput-second");


      if(labelofinput!=""){
            var modifylable = labelofinput.replace(/ /g, "_");
            
            count++;
            var lable = document.createElement("lable");
            lable.id = "input" + count;
            lable.className = "form-lable";
            lable.textContent = labelofinput;

            var inputElement = document.createElement("input");
            inputElement.id = "input" + count;
            inputElement.type = "text";
            inputElement.className = "form-control inputclass";
            inputElement.name = modifylable;

            var a = document.createElement("a");
            a.id = "input" + count;
            a.className = "btn btn-danger btn-sm mt-4 mb-4 inputclass";
            a.textContent = "delete";
            a.addEventListener("click", function() {
                var id = this.id;
                $("#" + id).remove();
                $("#" + id).remove();
                $("#" + id).remove();
            });
            var br = document.createElement("br");
            // Append the input element to a container (in this case, a div)
            if(display_div==0){

                inputContainer1.appendChild(lable);
                inputContainer1.appendChild(inputElement);
                inputContainer1.appendChild(a);
                inputContainer1.appendChild(br);
                display_div=1;
                document.getElementById("addinput").value = "";
            }
            else{
                inputContainer2.appendChild(lable);
                inputContainer2.appendChild(inputElement);
                inputContainer2.appendChild(a);
                inputContainer2.appendChild(br);
                display_div=0;
                document.getElementById("addinput").value = "";
            }
         }
    }
 
</script>
@endsection
