<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'dashboard_read_only',
        'dashboard_read_write',
        'dashboard_read_delete',
        'dashboard_read_create',
        'roles_read_only',
        'roles_read_write',
        'roles_read_delete',
        'roles_read_create',
        'students_read_only',
        'students_read_write',
        'students_read_delete',
        'students_read_create',
        'committees_read_only',
        'committees_read_write',
        'committees_read_delete',
        'committees_read_create',
        'registration_requests_read_only',
        'registration_requests_read_write',
        'registration_requests_read_delete',
        'registration_requests_read_create',
        'pinboard_read_only',
        'pinboard_read_write',
        'pinboard_read_delete',
        'pinboard_read_create',
        'helpdesk_read_only',
        'helpdesk_read_write',
        'helpdesk_read_delete',
        'helpdesk_read_create',
        'complaints_read_only',
        'complaints_read_write',
        'complaints_read_delete',
        'complaints_read_create',
        'stats_read_only',
        'stats_read_write',
        'stats_read_delete',
        'stats_read_create',
        'is_committee',
        'access_to_message',
        'complaints_read_own_only',
        'complaints_read_allowed_users',
        'suggestion_read_only',
        'suggestion_read_own_only',
        'suggestion_read_write',
        'suggestion_read_delete',
        'suggestion_read_create',

    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function getHasDashboardAccessAttribute()
    {
        return $this->dashboard_read_only || $this->dashboard_read_write || $this->dashboard_read_delete || $this->dashboard_read_create;
    }

    public function getHasRolesAccessAttribute()
    {
        return $this->roles_read_only || $this->roles_read_write || $this->roles_read_delete || $this->roles_read_create;
    }

    public function getHasStudentsAccessAttribute()
    {
        return $this->students_read_only || $this->students_read_write || $this->students_read_delete || $this->students_read_create;
    }

    public function getHasCommitteesAccessAttribute()
    {
        return $this->committees_read_only || $this->committees_read_write || $this->committees_read_delete || $this->committees_read_create;
    }

    public function getHasRegistrationRequestsAccessAttribute()
    {
        return $this->registration_requests_read_only || $this->registration_requests_read_write || $this->registration_requests_read_delete || $this->registration_requests_read_create;
    }

    public function getHasPinboardAccessAttribute()
    {
        return $this->pinboard_read_only || $this->pinboard_read_write || $this->pinboard_read_delete || $this->pinboard_read_create;
    }

    public function getHasHelpdeskAccessAttribute()
    {
        return $this->helpdesk_read_only || $this->helpdesk_read_write || $this->helpdesk_read_delete || $this->helpdesk_read_create;
    }

    public function getHasComplaintsAccessAttribute()
    {
        return $this->complaints_read_only || $this->complaints_read_write || $this->complaints_read_delete || $this->complaints_read_create || $this->complaints_read_own_only || $this->complaints_read_allowed_users;
    }

    public function getHasStatsAccessAttribute()
    {
        return $this->stats_read_only || $this->stats_read_write || $this->stats_read_delete || $this->stats_read_create;
    }

    public function getHasSuggestionAccessAttribute()
    {
        return $this->suggestion_read_only || $this->suggestion_read_write || $this->suggestion_read_delete || $this->suggestion_read_create || $this->suggestion_read_own_only;
    }

    public function getHasSuggestionCategoryAccessAttribute()
    {
        return $this->suggestion_category_read_only || $this->suggestion_category_read_write || $this->suggestion_category_read_delete || $this->suggestion_category_read_create;
    }
}
