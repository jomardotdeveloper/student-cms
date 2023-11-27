<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Contact;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $admin = Role::create([
            'role' => 'Administrator',
            'dashboard_read_only' => true,
            'dashboard_read_write' => true,
            'dashboard_read_delete' => true,
            'dashboard_read_create' => true,
            'roles_read_only' => true,
            'roles_read_write' => true,
            'roles_read_delete' => true,
            'roles_read_create' => true,
            'students_read_only' => true,
            'students_read_write' => true,
            'students_read_delete' => true,
            'students_read_create' => true,
            'committees_read_only' => true,
            'committees_read_write' => true,
            'committees_read_delete' => true,
            'committees_read_create' => true,
            'registration_requests_read_only' => true,
            'registration_requests_read_write' => true,
            'registration_requests_read_delete' => true,
            'registration_requests_read_create' => true,
            'pinboard_read_only' => true,
            'pinboard_read_write' => true,
            'pinboard_read_delete' => true,
            'pinboard_read_create' => true,
            'helpdesk_read_only' => true,
            'helpdesk_read_write' => true,
            'helpdesk_read_delete' => true,
            'helpdesk_read_create' => true,
            'complaints_read_only' => true,
            'complaints_read_write' => true,
            'complaints_read_delete' => true,
            'complaints_read_create' => true,
            'stats_read_only' => true,
            'stats_read_write' => true,
            'stats_read_delete' => true,
            'stats_read_create' => true,
            'access_to_message' => true,
            'complaints_read_own_only' => true,
            'complaints_read_allowed_users' => true,
            'suggestion_read_only' => true,
            'suggestion_read_write' => true,
            'suggestion_read_delete' => true,
            'suggestion_read_create' => true,
        ]);

        $student = Role::create([
            'role' => 'Student',
            'dashboard_read_only' => true,
            'dashboard_read_write' => true,
            'dashboard_read_delete' => true,
            'dashboard_read_create' => true,
            'roles_read_only' => true,
            'roles_read_write' => true,
            'roles_read_delete' => true,
            'roles_read_create' => true,
            'students_read_only' => true,
            'students_read_write' => true,
            'students_read_delete' => true,
            'students_read_create' => true,
            'committees_read_only' => true,
            'committees_read_write' => true,
            'committees_read_delete' => true,
            'committees_read_create' => true,
            'registration_requests_read_only' => true,
            'registration_requests_read_write' => true,
            'registration_requests_read_delete' => true,
            'registration_requests_read_create' => true,
            'pinboard_read_only' => true,
            'pinboard_read_write' => true,
            'pinboard_read_delete' => true,
            'pinboard_read_create' => true,
            'helpdesk_read_only' => true,
            'helpdesk_read_write' => true,
            'helpdesk_read_delete' => true,
            'helpdesk_read_create' => true,
            'complaints_read_only' => true,
            'complaints_read_write' => true,
            'complaints_read_delete' => true,
            'complaints_read_create' => true,
            'stats_read_only' => true,
            'stats_read_write' => true,
            'stats_read_delete' => true,
            'stats_read_create' => true,
            'access_to_message' => true,
            'complaints_read_own_only' => true,
            'complaints_read_allowed_users' => true,
            'suggestion_read_only' => true,
            'suggestion_read_write' => true,
            'suggestion_read_delete' => true,
            'suggestion_read_create' => true,
        ]);

        $committee = Role::create([
            'role' => 'Committee',
            'dashboard_read_only' => true,
            'dashboard_read_write' => true,
            'dashboard_read_delete' => true,
            'dashboard_read_create' => true,
            'roles_read_only' => true,
            'roles_read_write' => true,
            'roles_read_delete' => true,
            'roles_read_create' => true,
            'students_read_only' => true,
            'students_read_write' => true,
            'students_read_delete' => true,
            'students_read_create' => true,
            'committees_read_only' => true,
            'committees_read_write' => true,
            'committees_read_delete' => true,
            'committees_read_create' => true,
            'registration_requests_read_only' => true,
            'registration_requests_read_write' => true,
            'registration_requests_read_delete' => true,
            'registration_requests_read_create' => true,
            'pinboard_read_only' => true,
            'pinboard_read_write' => true,
            'pinboard_read_delete' => true,
            'pinboard_read_create' => true,
            'helpdesk_read_only' => true,
            'helpdesk_read_write' => true,
            'helpdesk_read_delete' => true,
            'helpdesk_read_create' => true,
            'complaints_read_only' => true,
            'complaints_read_write' => true,
            'complaints_read_delete' => true,
            'complaints_read_create' => true,
            'stats_read_only' => true,
            'stats_read_write' => true,
            'stats_read_delete' => true,
            'stats_read_create' => true,
            'is_committee' => true,
            'access_to_message' => true,
            'complaints_read_own_only' => true,
            'complaints_read_allowed_users' => true,
            'suggestion_read_only' => true,
            'suggestion_read_write' => true,
            'suggestion_read_delete' => true,
            'suggestion_read_create' => true,
        ]);



        $committee_type = Role::create([
            'role' => 'Academe',
            'is_committee' => true,
        ]);

        $committee_type = Role::create([
            'role' => 'RA',
            'is_committee' => true,
        ]);

        $committee_type = Role::create([
            'role' => 'SPCA',
            'is_committee' => true,
        ]);

        $committee_type = Role::create([
            'role' => 'Grievance',
            'is_committee' => true,
        ]);

        $committee_type = Role::create([
            'role' => 'Committee Head',
            'is_committee' => true,
        ]);

        $user = User::create([
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);

        $contact = Contact::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'middle_name' => 'F',
            'gender' => 'Male',
            'civil_status' => 'Single',
            'role_id' => $admin->id,
            'email' => 'admin@superuser.com',
            'user_id' => $user->id,
        ]);
    }
}
