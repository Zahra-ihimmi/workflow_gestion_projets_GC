<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LigneBudgetaireController;
use App\Http\Controllers\DemandeAchatController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DecompteController;
use App\Http\Controllers\PrixController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\RapportTravauxController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\NonConformiteController;
use App\Http\Controllers\PlanActionController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\HabilitationController;
use App\Http\Controllers\PointageController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\AssuranceController;
use App\Http\Controllers\Dashboard\StrategicDashboardController;
use App\Http\Controllers\Dashboard\AnalytiqueDashboardController;
use App\Http\Controllers\Dashboard\OperationalDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
Route::resource('ligne-budgetaires', LigneBudgetaireController::class);

Route::resource('demande-achats', DemandeAchatController::class);


Route::resource('commandes', CommandeController::class);

Route::resource('decomptes', DecompteController::class);

Route::resource('prix', PrixController::class);

Route::resource('plannings', PlanningController::class);

Route::resource('rapport-travaux', RapportTravauxController::class);

Route::resource('factures', FactureController::class);

Route::resource('non-conformites', NonConformiteController::class);

Route::resource('plan-actions', PlanActionController::class);

Route::resource('fournisseurs', FournisseurController::class);


Route::resource('personnels', PersonnelController::class);


Route::resource('formations', FormationController::class);


Route::resource('habilitations', HabilitationController::class);


Route::resource('pointages', PointageController::class);

Route::resource('vehicules', VehiculeController::class);

Route::resource('assurances', AssuranceController::class);

Route::get('/dashboard/strategique',
    [StrategicDashboardController::class,'index'])
    ->name('dashboard.strategique');

Route::get(
    '/dashboard/analytique',
    [AnalytiqueDashboardController::class, 'index']
)->name('dashboard.analytique');

Route::get(
    '/dashboard/operationnel',
    [OperationalDashboardController::class, 'index']
)->name('dashboard.operationnel');

});

// Authentification
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

    /*
|--------------------------------------------------------------------------
| Mot de passe oublié
|--------------------------------------------------------------------------
*/

Route::get('/forgot-password', [
    ForgotPasswordController::class,
    'showForgotPassword'
])->name('password.request');

Route::post('/forgot-password', [
    ForgotPasswordController::class,
    'sendResetLink'
])->name('password.email');

Route::get('/reset-password/{token}', [
    ForgotPasswordController::class,
    'showResetPassword'
])->name('password.reset');

Route::post('/reset-password', [
    ForgotPasswordController::class,
    'resetPassword'
])->name('password.update');