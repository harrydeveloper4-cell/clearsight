<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CareHomeDashboardController;
use App\Http\Controllers\CareHomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;

// ─── Public Routes (Guest Only) ──────────────────────────────────────────────

Route::middleware('guest')->group(function () {
    
    // Route::get('/terms-of-use', function () {
    //     return view('terms-use');
    // })->name('conditions-use');
    
    Route::get('/terms-use',function () {
        return view('terms-use');
    })->name('register');

    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    // Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
    Route::get('/password/request/reset',    [AuthController::class, 'showPasswordResetReset'])->name('password.request.reset');
    Route::post('/password/request/reset',    [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::get('/password/request/new/{token}', [AuthController::class, 'showNewPasswordForm'])->name('password.new');
    Route::post('/password/update', [AuthController::class, 'updatePassword'])->name('password.update');
    
});
    
// ─── Authenticated Routes ─────────────────────────────────────────────────────

Route::middleware('auth')->group(function () {

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profile routes (available to all authenticated users)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Legal routes
    Route::get('/privacy-policy', [LegalController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('/terms-of-use', [LegalController::class, 'termsOfUse'])->name('terms-of-use');

    // ─── Admin Routes ─────────────────────────────────────────────

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Care Homes (full CRUD)
        Route::resource('care-homes', CareHomeController::class);

        // User management
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create',   [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users',         [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}/delete', [AdminUserController::class, 'deleteUser'])->name('users.deleteUser');
        
        // Residents (admin sees all)
        Route::get('/residents',          [ResidentController::class, 'index'])->name('residents.index');
        Route::get('/residents/create/{id?}',   [ResidentController::class, 'create'])->name('residents.create');
        Route::post('/residents',         [ResidentController::class, 'store'])->name('residents.store');
        Route::get('/residents/{resident}',        [ResidentController::class, 'show'])->name('residents.show');
        Route::get('/residents/{resident}/edit',   [ResidentController::class, 'edit'])->name('residents.edit');
        Route::put('/residents/{resident}',        [ResidentController::class, 'update'])->name('residents.update');
        Route::patch('/residents/{resident}/deactivate', [ResidentController::class, 'deactivate'])->name('residents.deactivate');
        Route::post('/residents/{resident}/document', [ResidentController::class, 'uploadDocument'])->name('residents.document.upload');
        Route::delete('/residents/{resident}/destroy', [ResidentController::class, 'destroy'])->name('residents.destroy');
        Route::delete('/documents/{document}/destroy', [ResidentController::class, 'deleteDocument'])->name('documents.delete');
        Route::get('/documents/{document}/download', [ResidentController::class, 'downloadDocument'])->name('documents.download');
        Route::get('/documents/{document}/view', [ResidentController::class, 'viewDocument'])->name('documents.view');
        
        // Route::get('/residents/{resident}/document/download', [ResidentController::class, 'downloadDocument'])->name('residents.document.download');

        // Service Requests
        Route::get('/requests',  [ServiceRequestController::class, 'index'])->name('requests.index');
        Route::patch('/requests/{serviceRequest}/status', [ServiceRequestController::class, 'updateStatus'])->name('requests.updateStatus');
        Route::post('/requests/report-form', [ResidentController::class, 'report_form'])->name('requests.report-form');
        Route::get('/requests/{serviceRequest}/reports', [ServiceRequestController::class, 'reports'])->name('requests.reports');
        
        Route::post('/requests/{serviceRequest}/reports', [ServiceRequestController::class, 'storeReport'])->name('requests.reports.store');
        Route::get('/reports/{report}/download', [ServiceRequestController::class, 'downloadReport'])->name('reports.download');
        Route::get('/reports/{report}/view', [ServiceRequestController::class, 'viewReport'])->name('reports.view');
        Route::delete('/reports/{report}/destroy', [ServiceRequestController::class, 'deleteReport'])->name('reports.delete');

        // Messages
        Route::get('/messages',  [MessageController::class, 'index'])->name('messages.index');
        Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
        
        // Exports
        Route::get('/export/residents', [ExportController::class, 'exportResidents'])->name('export.residents');
        Route::get('/export/users', [ExportController::class, 'exportUsers'])->name('export.users');
        
        // Activity Logs
        Route::get('/activity-logs', [AdminDashboardController::class, 'activityLogs'])->name('activity-logs');
    });

    Route::get('/requests/{serviceRequest}/reports', [ServiceRequestController::class, 'reports'])->name('requests.reports');
    // ─── Care Home Routes ─────────────────────────────────────────

    Route::middleware('role:carehome')->prefix('portal')->name('carehome.')->group(function () {

        // Dashboard
        Route::get('/dashboard', [CareHomeDashboardController::class, 'index'])->name('dashboard');

        // Residents (own home only)
        Route::get('/residents',          [ResidentController::class, 'index'])->name('residents.index');
        Route::get('/residents/create',   [ResidentController::class, 'create'])->name('residents.create');
        Route::post('/residents',         [ResidentController::class, 'store'])->name('residents.store');
        Route::get('/residents/{resident}',      [ResidentController::class, 'show'])->name('residents.show');
        Route::get('/residents/{resident}/edit', [ResidentController::class, 'edit'])->name('residents.edit');
        Route::put('/residents/{resident}',      [ResidentController::class, 'update'])->name('residents.update');
        Route::patch('/residents/{resident}/deactivate', [ResidentController::class, 'deactivate'])->name('residents.deactivate');
        Route::post('/residents/{resident}/document', [ResidentController::class, 'uploadDocument'])->name('residents.document.upload');
        Route::delete('/residents/{resident}/destroy', [ResidentController::class, 'destroy'])->name('residents.destroy');
        Route::delete('/documents/{document}/destroy', [ResidentController::class, 'deleteDocument'])->name('documents.delete');
        Route::get('/documents/{document}/download', [ResidentController::class, 'downloadDocument'])->name('documents.download');
        Route::get('/documents/{document}/view', [ResidentController::class, 'viewDocument'])->name('documents.view');
        
        // Service Requests
        Route::get('/requests',  [ServiceRequestController::class, 'index'])->name('requests.index');
        Route::post('/requests', [ServiceRequestController::class, 'store'])->name('requests.store');
        Route::get('/requests/{serviceRequest}/reports', [ServiceRequestController::class, 'reports'])->name('requests.reports');
        Route::get('/reports/{report}/download', [ServiceRequestController::class, 'downloadReport'])->name('reports.download');
        Route::get('/reports/{report}/view', [ServiceRequestController::class, 'viewReport'])->name('reports.view');

        // Messages
        Route::get('/messages',  [MessageController::class, 'index'])->name('messages.index');
        Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    });

    // ─── Root Redirect ────────────────────────────────────────────

    Route::get('/', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('carehome.dashboard');
    });
});
