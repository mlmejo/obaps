<?php

use App\Http\Controllers\AwardBidController;
use App\Http\Controllers\CompanyCommitteeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectBidderController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectDocumentController;
use App\Http\Controllers\StartBiddingController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', WelcomeController::class)->middleware('guest');
Route::get('/home', HomeController::class)->middleware('auth');

Route::group(['middleware' => ['auth', 'role:admin|bidder']], function () {
    Route::get('/companies', [CompanyController::class, 'index'])
        ->name('companies.index');

    Route::get('/companies/{company}', [CompanyController::class, 'show'])
        ->name('companies.show');
});

Route::resource('companies', CompanyController::class)
    ->except(['index', 'show'])->middleware('auth');

Route::resource('companies.committee', CompanyCommitteeController::class)
    ->shallow()->middleware('auth');

Route::post('/projects/{project}/start-bid', StartBiddingController::class)
    ->name('projects.start-bid')->middleware(['auth', 'role:admin']);

Route::post('/projects/{project}/award-bid', AwardBidController::class)
    ->name('projects.award-bid')->middleware(['auth', 'role:admin']);

Route::middleware(['auth', 'role:admin|bidder'])->group(function () {
    Route::get('/projects', [ProjectController::class, 'index'])
        ->name('projects.index');

    Route::get('/companies/{company}/projects/{project}', [ProjectController::class, 'show'])
        ->name('companies.projects.show');
});

Route::resource('companies.projects', ProjectController::class)
    ->except(['index', 'show'])->middleware(['auth', 'role:admin']);

Route::post('/projects/{project}/bidders', [ProjectBidderController::class, 'store'])
    ->name('projects.bidders.store')->middleware('auth');

Route::resource('projects.documents', ProjectDocumentController::class)
    ->middleware('auth');

require __DIR__.'/auth.php';
