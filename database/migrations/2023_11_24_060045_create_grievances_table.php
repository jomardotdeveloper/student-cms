<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grievances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('is_student_plm')->default(false);
            $table->string('plm_email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('course')->nullable();
            $table->string('year')->nullable();
            $table->string('block')->nullable();
            $table->string('concern')->nullable();
            $table->string('subject_of_concern')->nullable();
            $table->text('description_of_concern')->nullable();
            $table->string('allowed_users')->nullable();
            $table->string('rate')->nullable();
            $table->string('feedback')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grievances');
    }
};
