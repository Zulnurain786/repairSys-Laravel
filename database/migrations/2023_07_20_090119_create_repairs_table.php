<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->integer('created_by');
            $table->string('token')->unique();
            $table->enum('status', [
                'Awaiting inspection',
                'Awaiting parts',
                'In progress',
                'Completed',
                'Paid',
                'Collected',
            ])->default('Awaiting inspection');
            $table->date('status_date')->nullable();
            $table->integer('updated_by')->nullable();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('brand')->nullable();
            $table->string('color')->nullable();
            $table->string('type')->nullable();
            $table->text('prior_work')->nullable();
            $table->text('accessories')->nullable();
            $table->integer('hours')->nullable()->default(0);
            $table->decimal('hour_rate')->nullable()->default(0);
            $table->text('work_requested')->nullable();
            $table->integer('warranty')->nullable()->default(0);
            $table->text('note')->nullable();
            $table->text('technician_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repairs');
    }
}
