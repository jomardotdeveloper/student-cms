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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role')->unique();

            $table->boolean('is_committee')->default(false);

            $table->boolean('dashboard_read_only')->default(false);
            $table->boolean('dashboard_read_write')->default(false);
            $table->boolean('dashboard_read_delete')->default(false);
            $table->boolean('dashboard_read_create')->default(false);

            $table->boolean('roles_read_only')->default(false);
            $table->boolean('roles_read_write')->default(false);
            $table->boolean('roles_read_delete')->default(false);
            $table->boolean('roles_read_create')->default(false);

            $table->boolean('students_read_only')->default(false);
            $table->boolean('students_read_write')->default(false);
            $table->boolean('students_read_delete')->default(false);
            $table->boolean('students_read_create')->default(false);

            $table->boolean('committees_read_only')->default(false);
            $table->boolean('committees_read_write')->default(false);
            $table->boolean('committees_read_delete')->default(false);
            $table->boolean('committees_read_create')->default(false);

            $table->boolean('registration_requests_read_only')->default(false);
            $table->boolean('registration_requests_read_write')->default(false);
            $table->boolean('registration_requests_read_delete')->default(false);
            $table->boolean('registration_requests_read_create')->default(false);

            $table->boolean('pinboard_read_only')->default(false);
            $table->boolean('pinboard_read_write')->default(false);
            $table->boolean('pinboard_read_delete')->default(false);
            $table->boolean('pinboard_read_create')->default(false);

            $table->boolean('helpdesk_read_only')->default(false);
            $table->boolean('helpdesk_read_write')->default(false);
            $table->boolean('helpdesk_read_delete')->default(false);
            $table->boolean('helpdesk_read_create')->default(false);

            $table->boolean('complaints_read_only')->default(false);
            $table->boolean('complaints_read_own_only')->default(false);
            $table->boolean('complaints_read_allowed_users')->default(false);
            $table->boolean('complaints_read_write')->default(false);
            $table->boolean('complaints_read_delete')->default(false);
            $table->boolean('complaints_read_create')->default(false);

            $table->boolean('stats_read_only')->default(false);
            $table->boolean('stats_read_write')->default(false);
            $table->boolean('stats_read_delete')->default(false);
            $table->boolean('stats_read_create')->default(false);

            $table->boolean('access_to_message')->default(false);


            $table->boolean('suggestion_read_only')->default(false);
            $table->boolean('suggestion_read_own_only')->default(false);
            $table->boolean('suggestion_read_write')->default(false);
            $table->boolean('suggestion_read_delete')->default(false);
            $table->boolean('suggestion_read_create')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
