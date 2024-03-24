<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CustomerController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\File;

// ==================== IMAGE ROUTE ====================
Route::get('/img/{type}/{filename}', function ($type, $filename)
{
    $path = storage_path('app/public/img/'.$type.'/'. $filename);;
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = response($file, 200);
    $response->header('Content-Type', $type);
    return $response;
});

Route::get('/', [LandingController::class, 'landing']);
Route::get('/logout', [App\Http\Controllers\Authentication::class, 'logout']);

// ==================== EMAIL VERIFICATION ====================
Route::middleware(['auth', 'signed'])->group(function() {
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill(); 
        $request->session()->flash('message', 'Your account is now verified, enjoy full experience from The Cajuput Spa!');
        return redirect('/');
    })->name('verification.verify');
});

Route::middleware('auth')->group(function() {
    Route::get('/email/verify', function () {
        return redirect('/');
    })->name('verification.notice');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        $request->session()->put('message','Verification link has been sent to your email address, please check to verify your account');
        return redirect('/');
    })->middleware('throttle:6,1')->name('verification.send');
});

Route::middleware('guest')->group(function() {

    // ==================== AUTHENTICATION ====================
    Route::post('/login', [App\Http\Controllers\Authentication::class, 'login'])->name('login');
    Route::get('/login', function () {
        return view('authentication.login');
    });

    Route::post('/register', [App\Http\Controllers\Authentication::class, 'register']);
    Route::get('/register', function () {
        return view('authentication.register');
    });

    // ==================== Reset & Forgor Password ====================
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);
    
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->name('password.email');
    
    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');
    
    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    })->name('password.update');

});

Route::middleware(['auth', 'verified'])->group(function() 
{
    // ==================== CUSTOMER ====================
    Route::middleware('userAccess:customer')->group(function() {
        Route::get('/booking', function () {
            // get data from database
            $services = DB::table('services')->get();
            $rooms = DB::table('rooms')->get();
            return view('customer.booking', ['services' => $services, 'rooms' => $rooms]);
        });
        Route::controller(CustomerController::class)->group(function() {
            Route::get('/dashboard')->name('dashboard');
            Route::post('/booking', 'booking')->name('customer.booking');
            Route::get('/reschedule', 'viewReschedule');
            Route::put('/reschedule', 'reschedule')->name('customer.reschedule');
            Route::put('/cancel', 'cancel');
            Route::get('/transaction', 'transaction')->name('customer.transaction');
            Route::post('/feedback', 'feedback')->name('customer.feedback');
            Route::get('/customer', 'transaction');

        });
    });
    
    Route::middleware('userAccess:staff')->group(function() {  
        // ==================== STAFF ====================
        Route::controller(StaffController::class)->group(function() {
            Route::get('/staff', 'dashboard')->name('staff');
            Route::get('/staff/transaction', 'getTransaction');
            Route::get('/staff/chat', 'chat');
            Route::post('/staff/updatetransaction/{id}', 'updateTransaction');
            Route::post('/staff/donetransaction/{id}', 'doneTransaction');
            
            Route::post('/staff/service', 'getService');
            Route::get('/staff/service', 'getService')->name('search');
            Route::post('/staff/addservice', 'addService');
            Route::put('/staff/updateservice/{id}', 'updateService')->name('update.service');
            Route::delete('/staff/deleteservice/{id}', 'deleteService')->name('delete.service');
        });
    });

    Route::middleware('userAccess:admin')->group(function() {
        // ==================== ADMIN ====================
        Route::controller(AdminController::class)->group(function() {
            Route::get('/admin', 'index')->name('admin.dashboard')->name('admin');
            Route::get('/admin-dashboard', 'index')->name('admin.dashboard');
    
            Route::get('/admin-account', 'getAdmin')->name('admin.account');
            Route::post('/add-admin', 'addAdmin')->name('add.admin');
            Route::put('/update-admin/{id}', 'updateAdmin')->name('update.admin');
            Route::delete('/delete-admin/{id}', 'deleteAdmin')->name('delete.admin');
    
            Route::get('/staff-account', 'getStaff')->name('staff.account');
            Route::post('/add-staff', 'addStaff')->name('add.staff');
            Route::put('/update-staff/{id}', 'updateStaff')->name('update.staff');
            Route::delete('/delete-staff/{id}', 'deleteStaff')->name('delete.staff');
    
            Route::get('/customer-account', 'getCustomer')->name('customer.account');
            Route::post('/add-customer', 'addCustomer')->name('add.customer');
            Route::put('/update-customer/{id}', 'updateCustomer')->name('update.customer');
            Route::delete('/delete-customer/{id}', 'deleteCustomer')->name('delete.customer');
    
            Route::get('/all-transaction', 'getAllTransaction')->name('all.transaction');
            Route::post('/filter-transaction', 'filterTransaction')->name('filter.transaction');
            Route::get('/transaction-export', 'exportTransaction')->name('transaction.export');
            Route::get('/cash-flow', 'getCashFlow')->name('cash.flow');
        });
        // ==================== END ADMIN ================
    });
});