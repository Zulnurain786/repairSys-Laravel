@extends('layouts.staffLayout')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        General Report
                    </h2>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="monitor" class="report-box__icon text-warning"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{\App\Models\Repair::where(['company_id'=>auth()->user()->company_id])->count()}}</div>
                                <div class="text-base text-slate-500 mt-1">Total Orders</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="shopping-cart" class="report-box__icon text-primary"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{\App\Models\Repair::where(['company_id'=>auth()->user()->company_id,'status'=>'Paid'])->count()}}</div>
                                <div class="text-base text-slate-500 mt-1">Paid</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="credit-card" class="report-box__icon text-pending"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{\App\Models\Repair::where(['company_id'=>auth()->user()->company_id,'status'=>'Completed'])->count()}}</div>
                                <div class="text-base text-slate-500 mt-1">Completed</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="credit-card" class="report-box__icon text-pending"></i> 
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{\App\Models\Repair::where(['company_id'=>auth()->user()->company_id,'status'=>'Collected'])->count()}}</div>
                                <div class="text-base text-slate-500 mt-1">Collected</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
        </div>
    </div>
</div>
@endsection
