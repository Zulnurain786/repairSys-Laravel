<div class="notify">
    <div class="alert {{ $type=='error' ? 'alert-danger' : 'alert-success'}} alert-dismissible show flex items-center mb-2" role="alert"> 
        <i data-lucide="alert-circle" class="w-6 h-6 mr-2"></i> 
        {{ $message }}
        <button type="button" class="btn-close text-white" data-tw-dismiss="alert" aria-label="Close"> 
            <i data-lucide="x" class="w-4 h-4"></i> 
        </button> 
    </div> 
</div>