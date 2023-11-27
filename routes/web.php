<?php

use App\Http\Controllers\AnnouncementCategoryController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\GrievanceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuggestionCategoryController;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route("login"));
});

Route::get('/login', 'App\Http\Controllers\LoginController@login')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@authenticate')->name('authenticate');
Route::post('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');
Route::get('/register', 'App\Http\Controllers\LoginController@register')->name('register');
Route::post('/register', 'App\Http\Controllers\LoginController@store')->name('register.store');


Route::prefix("/backend")->middleware('auth')->group(function () {
    Route::resource('committees', CommitteeController::class);
    Route::resource('students', StudentController::class);
    Route::resource('emails', EmailController::class);
    Route::resource('announcement_categories', AnnouncementCategoryController::class);
    Route::resource('announcements', AnnouncementController::class);

    Route::get('/profile', 'App\Http\Controllers\ProfileController@profile')->name('profile');
    Route::get('/profile/edit', 'App\Http\Controllers\ProfileController@editProfile')->name('profile.edit');
    Route::post('/profile', 'App\Http\Controllers\ProfileController@update')->name('profile.update');

    Route::get('/change-password', 'App\Http\Controllers\ProfileController@changePassword')->name('change-password');
    Route::post('/change-password', 'App\Http\Controllers\ProfileController@updatePassword')->name('change-password.update');

    Route::resource('suggestion_categories', SuggestionCategoryController::class);
    Route::resource('suggestions', 'App\Http\Controllers\SuggestionController');

    Route::get('/suggestions/{suggestion}/approve', 'App\Http\Controllers\SuggestionController@approve')->name('suggestions.approve');
    Route::get('/suggestions/{suggestion}/reject', 'App\Http\Controllers\SuggestionController@reject')->name('suggestions.reject');
    Route::get('/suggestions/{suggestion}/upvote', 'App\Http\Controllers\SuggestionController@upvote')->name('suggestions.upvote');
    Route::get('/suggestions/{suggestion}/downvote', 'App\Http\Controllers\SuggestionController@downvote')->name('suggestions.downvote');

    Route::get('/stats', 'App\Http\Controllers\StatsController@index')->name('stats.index');


    Route::resource('grievances', GrievanceController::class);
    Route::get('/grievances/print', 'App\Http\Controllers\GrievanceController@printReport')->name('grievances.print');
    Route::resource('roles', RoleController::class);
    Route::get('/registration-request/approve/{id}', 'App\Http\Controllers\ContactController@approve')->name('registration-request.approve');
    Route::get('/registration-request/reject/{id}', 'App\Http\Controllers\ContactController@reject')->name('registration-request.reject');
    Route::get('/contacts', 'App\Http\Controllers\ContactController@index')->name('contacts.index');
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});
