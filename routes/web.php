<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/resendEmail/{id}', [App\Http\Controllers\HomeController::class, 'resendEmail'])->name('resendEmail');
Route::get('/pdf/{invoice}', [App\Http\Controllers\HomeController::class, 'pdf'])->name('pdf');
Route::get('/mail/{invoice}', [App\Http\Controllers\HomeController::class, 'sendMailInvoice'])->name('sendMailInvoice');

/* Updates */
Route::get('/updates', [App\Http\Controllers\UpdateController::class, 'show'])->name('updates');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role'])->group(function () {
        Route::prefix('super-admin')->group(function () {
            Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('super admin.home');
            Route::get('/passwords', [App\Http\Controllers\AdminController::class, 'passwords'])->name('super-admin.passwords');
            Route::post('/passwordsSave', [App\Http\Controllers\AdminController::class, 'passwordsSave'])->name('super-admin.passwordsSave');
            Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('super-admin.settings');
            Route::post('/uploadProfile', [App\Http\Controllers\AdminController::class, 'uploadProfile'])->name('super-admin.uploadProfile');
            Route::post('/uploadProfileData', [App\Http\Controllers\AdminController::class, 'uploadProfileData'])->name('super-admin.uploadProfileData');
            
            /* Companies */
            Route::get('/companies', [App\Http\Controllers\AdminController::class, 'companies'])->name('super-admin.companies');
            Route::get('/companies/add', [App\Http\Controllers\AdminController::class, 'companiesAdd'])->name('super-admin.companiesAdd');
            Route::post('/companies/save', [App\Http\Controllers\AdminController::class, 'companiesSave'])->name('super-admin.companiesSave');
            Route::get('/companies/edit/{id}', [App\Http\Controllers\AdminController::class, 'companiesEdit'])->name('super-admin.companiesEdit');
            Route::post('/companies/update', [App\Http\Controllers\AdminController::class, 'companiesUpdate'])->name('super-admin.companiesUpdate');
            Route::get('/companies/delete/{id}', [App\Http\Controllers\AdminController::class, 'companiesDelete'])->name('super-admin.companiesDelete');

             /* Updates */
             Route::get('/updates', [App\Http\Controllers\UpdateController::class, 'index'])->name('super-admin.updates');
             Route::get('/updates/add', [App\Http\Controllers\UpdateController::class, 'create'])->name('super-admin.updatesAdd');
             Route::post('/updates/save', [App\Http\Controllers\UpdateController::class, 'store'])->name('super-admin.updatesSave');
             Route::get('/updates/edit/{id}', [App\Http\Controllers\UpdateController::class, 'edit'])->name('super-admin.updatesEdit');
             Route::post('/updates/update', [App\Http\Controllers\UpdateController::class, 'update'])->name('super-admin.updatesUpdate');
             Route::get('/updates/delete/{id}', [App\Http\Controllers\UpdateController::class, 'destroy'])->name('super-admin.updatesDelete');
        });
        Route::prefix('company')->group(function () {
            Route::get('/', [App\Http\Controllers\CompanyController::class, 'index'])->name('company.home');
            Route::get('/passwords', [App\Http\Controllers\CompanyController::class, 'passwords'])->name('company.passwords');
            Route::post('/passwordsSave', [App\Http\Controllers\CompanyController::class, 'passwordsSave'])->name('company.passwordsSave');
            Route::get('/settings', [App\Http\Controllers\CompanyController::class, 'settings'])->name('company.settings');
            Route::post('/uploadProfile', [App\Http\Controllers\CompanyController::class, 'uploadProfile'])->name('company.uploadProfile');
            Route::post('/uploadProfileData', [App\Http\Controllers\CompanyController::class, 'uploadProfileData'])->name('company.uploadProfileData');

            /* Users */
            Route::get('/users', [App\Http\Controllers\CompanyController::class, 'users'])->name('company.users');
            Route::get('/users/add', [App\Http\Controllers\CompanyController::class, 'usersAdd'])->name('company.usersAdd');
            Route::post('/users/save', [App\Http\Controllers\CompanyController::class, 'usersSave'])->name('company.usersSave');
            Route::get('/users/edit/{id}', [App\Http\Controllers\CompanyController::class, 'usersEdit'])->name('company.usersEdit');
            Route::post('/users/update', [App\Http\Controllers\CompanyController::class, 'usersUpdate'])->name('company.usersUpdate');
            Route::get('/users/delete/{id}', [App\Http\Controllers\CompanyController::class, 'usersDelete'])->name('company.usersDelete');

            /* Booking Repairs */
            Route::get('/repairs', [App\Http\Controllers\RepairController::class, 'index'])->name('company.repairs');
            Route::get('/repairs/add', [App\Http\Controllers\RepairController::class, 'create'])->name('company.repairsAdd');
            Route::get('/repairs/fields', [App\Http\Controllers\RepairController::class, 'fields'])->name('company.fields');
            Route::post('/repairs/filedssave', [App\Http\Controllers\RepairController::class, 'filedssave'])->name('company.filedssave');
            Route::post('/repairs/save', [App\Http\Controllers\RepairController::class, 'save'])->name('company.repairsSave');
            Route::get('/repairs/edit/{id}', [App\Http\Controllers\RepairController::class, 'edit'])->name('company.repairsEdit');
            Route::post('/repairs/update', [App\Http\Controllers\RepairController::class, 'update'])->name('company.repairsUpdate');
            Route::get('/repairs/delete/{id}', [App\Http\Controllers\RepairController::class, 'delete'])->name('company.repairsDelete');

            /* Material */
            Route::get('/repairs/{id}/material', [App\Http\Controllers\MaterialController::class, 'index'])->name('company.material');
            Route::get('/repairs/{id}/material/add', [App\Http\Controllers\MaterialController::class, 'create'])->name('company.materialAdd');
            Route::post('repairs/{id}/material/save', [App\Http\Controllers\MaterialController::class, 'store'])->name('company.materialSave');
            Route::get('repairs/{id}/material/edit/{materialId}', [App\Http\Controllers\MaterialController::class, 'edit'])->name('company.materialEdit');
            Route::post('repairs/{id}/material/update', [App\Http\Controllers\MaterialController::class, 'update'])->name('company.materialUpdate');
            Route::get('repairs/material/delete/{materialId}', [App\Http\Controllers\MaterialController::class, 'destroy'])->name('company.materialDelete');

            /* Company Material */
            Route::get('/materials', [App\Http\Controllers\CompanyMaterialController::class, 'index'])->name('company.materials');
            Route::get('/materials/add', [App\Http\Controllers\CompanyMaterialController::class, 'create'])->name('company.materialsAdd');
            Route::post('/materials/save', [App\Http\Controllers\CompanyMaterialController::class, 'store'])->name('company.materialsSave');
            Route::get('/materials/edit/{materialId}', [App\Http\Controllers\CompanyMaterialController::class, 'edit'])->name('company.materialsEdit');
            Route::post('/materials/update', [App\Http\Controllers\CompanyMaterialController::class, 'update'])->name('company.materialsUpdate');
            Route::get('/materials/delete/{materialId}', [App\Http\Controllers\CompanyMaterialController::class, 'destroy'])->name('company.materialsDelete');

            /* Media */
            Route::get('/repairs/{id}/media', [App\Http\Controllers\MediaController::class, 'index'])->name('company.media');
            Route::get('/repairs/{id}/media/add', [App\Http\Controllers\MediaController::class, 'create'])->name('company.mediaAdd');
            Route::post('repairs/{id}/media/save', [App\Http\Controllers\MediaController::class, 'store'])->name('company.mediaSave');
            Route::get('repairs/{id}/media/edit/{mediaId}', [App\Http\Controllers\MediaController::class, 'edit'])->name('company.mediaEdit');
            Route::post('repairs/{id}/media/update', [App\Http\Controllers\MediaController::class, 'update'])->name('company.mediaUpdate');
            Route::get('repairs/media/delete/{mediaId}', [App\Http\Controllers\MediaController::class, 'destroy'])->name('company.mediaDelete');

            /* Reports */
            Route::get('/report/labour', [App\Http\Controllers\CompanyController::class, 'labourReport'])->name('company.labourReport');
            Route::get('/report/material', [App\Http\Controllers\CompanyController::class, 'materialReport'])->name('company.materialReport');
        
        });
        Route::prefix('staff')->group(function () {
            Route::get('/', [App\Http\Controllers\StaffController::class, 'index'])->name('staff.home');
            Route::get('/passwords', [App\Http\Controllers\StaffController::class, 'passwords'])->name('staff.passwords');
            Route::post('/passwordsSave', [App\Http\Controllers\StaffController::class, 'passwordsSave'])->name('staff.passwordsSave');
            Route::get('/settings', [App\Http\Controllers\StaffController::class, 'settings'])->name('staff.settings');
            Route::post('/uploadProfile', [App\Http\Controllers\StaffController::class, 'uploadProfile'])->name('staff.uploadProfile');
            Route::post('/uploadProfileData', [App\Http\Controllers\StaffController::class, 'uploadProfileData'])->name('staff.uploadProfileData');

            /* Booking Repairs */
            Route::get('/repairs', [App\Http\Controllers\RepairController::class, 'index'])->name('staff.repairs');
            Route::get('/repairs/add', [App\Http\Controllers\RepairController::class, 'create'])->name('staff.repairsAdd');
            Route::post('/repairs/save', [App\Http\Controllers\RepairController::class, 'save'])->name('staff.repairsSave');
            Route::get('/repairs/edit/{id}', [App\Http\Controllers\RepairController::class, 'edit'])->name('staff.repairsEdit');
            Route::post('/repairs/update', [App\Http\Controllers\RepairController::class, 'update'])->name('staff.repairsUpdate');
            Route::get('/repairs/delete/{id}', [App\Http\Controllers\RepairController::class, 'delete'])->name('staff.repairsDelete');

            /* Add Material */
            Route::get('/repairs/{id}/material', [App\Http\Controllers\MaterialController::class, 'index'])->name('staff.material');
            Route::get('/repairs/{id}/material/add', [App\Http\Controllers\MaterialController::class, 'create'])->name('staff.materialAdd');
            Route::post('repairs/{id}/material/save', [App\Http\Controllers\MaterialController::class, 'store'])->name('staff.materialSave');
            Route::get('repairs/{id}/material/edit/{materialId}', [App\Http\Controllers\MaterialController::class, 'edit'])->name('staff.materialEdit');
            Route::post('repairs/{id}/material/update', [App\Http\Controllers\MaterialController::class, 'update'])->name('staff.materialUpdate');
            Route::get('repairs/material/delete/{materialId}', [App\Http\Controllers\MaterialController::class, 'destroy'])->name('staff.materialDelete');

             /* Staff Material */
             Route::get('/materials', [App\Http\Controllers\CompanyMaterialController::class, 'index'])->name('staff.materials');
             Route::get('/materials/add', [App\Http\Controllers\CompanyMaterialController::class, 'create'])->name('staff.materialsAdd');
             Route::post('/materials/save', [App\Http\Controllers\CompanyMaterialController::class, 'store'])->name('staff.materialsSave');
             Route::get('/materials/edit/{materialId}', [App\Http\Controllers\CompanyMaterialController::class, 'edit'])->name('staff.materialsEdit');
             Route::post('/materials/update', [App\Http\Controllers\CompanyMaterialController::class, 'update'])->name('staff.materialsUpdate');
             Route::get('/materials/delete/{materialId}', [App\Http\Controllers\CompanyMaterialController::class, 'destroy'])->name('staff.materialsDelete');

             /* Media */
             Route::get('/repairs/{id}/media', [App\Http\Controllers\MediaController::class, 'index'])->name('staff.media');
             Route::get('/repairs/{id}/media/add', [App\Http\Controllers\MediaController::class, 'create'])->name('staff.mediaAdd');
             Route::post('repairs/{id}/media/save', [App\Http\Controllers\MediaController::class, 'store'])->name('staff.mediaSave');
             Route::get('repairs/{id}/media/edit/{mediaId}', [App\Http\Controllers\MediaController::class, 'edit'])->name('staff.mediaEdit');
             Route::post('repairs/{id}/media/update', [App\Http\Controllers\MediaController::class, 'update'])->name('staff.mediaUpdate');
             Route::get('repairs/media/delete/{mediaId}', [App\Http\Controllers\MediaController::class, 'destroy'])->name('staff.mediaDelete');
        });
        Route::prefix('technician')->group(function () {
            Route::get('/', [App\Http\Controllers\TechnicianController::class, 'index'])->name('technician.home');
            Route::get('/passwords', [App\Http\Controllers\TechnicianController::class, 'passwords'])->name('technician.passwords');
            Route::post('/passwordsSave', [App\Http\Controllers\TechnicianController::class, 'passwordsSave'])->name('technician.passwordsSave');
            Route::get('/settings', [App\Http\Controllers\TechnicianController::class, 'settings'])->name('technician.settings');
            Route::post('/uploadProfile', [App\Http\Controllers\TechnicianController::class, 'uploadProfile'])->name('technician.uploadProfile');
            Route::post('/uploadProfileData', [App\Http\Controllers\TechnicianController::class, 'uploadProfileData'])->name('technician.uploadProfileData');

            /* Booking Repairs */
            Route::get('/repairs', [App\Http\Controllers\RepairController::class, 'index'])->name('technician.repairs');
            Route::get('/repairs/add', [App\Http\Controllers\RepairController::class, 'create'])->name('technician.repairsAdd');
            Route::post('/repairs/save', [App\Http\Controllers\RepairController::class, 'save'])->name('technician.repairsSave');
            Route::get('/repairs/edit/{id}', [App\Http\Controllers\RepairController::class, 'edit'])->name('technician.repairsEdit');
            Route::post('/repairs/update', [App\Http\Controllers\RepairController::class, 'update'])->name('technician.repairsUpdate');
            Route::get('/repairs/delete/{id}', [App\Http\Controllers\RepairController::class, 'delete'])->name('technician.repairsDelete');

            /* Add Material */
            Route::get('/repairs/{id}/material', [App\Http\Controllers\MaterialController::class, 'index'])->name('technician.material');
            Route::get('/repairs/{id}/material/add', [App\Http\Controllers\MaterialController::class, 'create'])->name('technician.materialAdd');
            Route::post('repairs/{id}/material/save', [App\Http\Controllers\MaterialController::class, 'store'])->name('technician.materialSave');
            Route::get('repairs/{id}/material/edit/{materialId}', [App\Http\Controllers\MaterialController::class, 'edit'])->name('technician.materialEdit');
            Route::post('repairs/{id}/material/update', [App\Http\Controllers\MaterialController::class, 'update'])->name('technician.materialUpdate');
            Route::get('repairs/material/delete/{materialId}', [App\Http\Controllers\MaterialController::class, 'destroy'])->name('technician.materialDelete');

             /* Technician Material */
             Route::get('/materials', [App\Http\Controllers\CompanyMaterialController::class, 'index'])->name('technician.materials');
             Route::get('/materials/add', [App\Http\Controllers\CompanyMaterialController::class, 'create'])->name('technician.materialsAdd');
             Route::post('/materials/save', [App\Http\Controllers\CompanyMaterialController::class, 'store'])->name('technician.materialsSave');
             Route::get('/materials/edit/{materialId}', [App\Http\Controllers\CompanyMaterialController::class, 'edit'])->name('technician.materialsEdit');
             Route::post('/materials/update', [App\Http\Controllers\CompanyMaterialController::class, 'update'])->name('technician.materialsUpdate');
             Route::get('/materials/delete/{materialId}', [App\Http\Controllers\CompanyMaterialController::class, 'destroy'])->name('technician.materialsDelete');

             /* Media */
             Route::get('/repairs/{id}/media', [App\Http\Controllers\MediaController::class, 'index'])->name('technician.media');
             Route::get('/repairs/{id}/media/add', [App\Http\Controllers\MediaController::class, 'create'])->name('technician.mediaAdd');
             Route::post('repairs/{id}/media/save', [App\Http\Controllers\MediaController::class, 'store'])->name('technician.mediaSave');
             Route::get('repairs/{id}/media/edit/{mediaId}', [App\Http\Controllers\MediaController::class, 'edit'])->name('technician.mediaEdit');
             Route::post('repairs/{id}/media/update', [App\Http\Controllers\MediaController::class, 'update'])->name('technician.mediaUpdate');
             Route::get('repairs/media/delete/{mediaId}', [App\Http\Controllers\MediaController::class, 'destroy'])->name('technician.mediaDelete');
        });
    });
});

