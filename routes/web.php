<?php
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', App\Livewire\Landing\Index::class)->name('landing');
Route::get('/details/{id}', [LandingController::class, 'details'])->name('details');
Route::get('/roomdetails/{id}', [LandingController::class, 'rooms'])->name('rooms.detail');
Route::get('/payment', App\Livewire\PaymentUser\Index::class)->name('payment');
Route::get('/package/{id}', [LandingController::class, 'package'])->name('package.details');

// autentikasi
# ==================== SOCIALITE AUTH ================================
Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');
Route::get('/booking', [CustomerController::class, 'booking']);
# ================End Facebook Auth================================

// ==================== EMAIL VERIFICATION ====================
Route::middleware(['auth', 'signed'])->group(function() {
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        $id = $request->user()->id;
        // Dispatch the UserVerified event
        event(new \App\Events\UserVerified($id));
        session()->flash('message', 'Your account is now verified, enjoy full experience from The Cajuput Spa!');
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
        return redirect()->back();
    })->middleware('throttle:6,1')->name('verification.send');

    Route::get('/logout', [App\Http\Controllers\Authentication::class, 'logout']);

});

Route::middleware('guest')->group(function() {

    // ==================== AUTHENTICATION ====================
    Route::post('/login', [App\Http\Controllers\Authentication::class, 'login'])->name('login');
    Route::get('/login', App\Livewire\Auth\Login::class);

    Route::post('/register', [App\Http\Controllers\Authentication::class, 'register']);
    Route::get('/register', App\Livewire\Auth\Register::class);

    // ==================== Reset & Forgor Password ====================
    Route::get('/forgot', App\Livewire\Auth\Forgot::class);

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
        Route::get('/transaction', App\Livewire\Customer\Index::class);
    });
    Route::middleware('userAccess:customer')->group(function() {
        Route::controller(CustomerController::class)->group(function() {
            Route::post('/booking', 'booking')->name('customer.booking');
            Route::get('/dashboard')->name('dashboard');
            Route::get('/reschedule', 'viewReschedule');
            Route::put('/reschedule', 'reschedule')->name('customer.reschedule');
            Route::put('/cancel', 'cancel');
            // Route::get('/transaction', 'transaction')->name('customer.transaction');
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
            Route::put('/staff/updatetransaction/{id}', [StaffController::class, 'updateTransaction'])->name('updateTransaction');
            Route::post('/staff/updatetransaction/{id}', 'updateTransaction')->name('updateTransaction');
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
            Route::get('/admin', 'index')->name('admin');
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
            Route::get('/service-transaction', 'getServiceTransaction')->name('service.transaction');
            Route::get('/package-transaction', 'getPackageTransaction')->name('package.transaction');
            Route::post('/filter-transaction', 'filterTransaction')->name('filter.transaction');
            Route::get('/service-export', 'exportServiceTransaction')->name('service.export');
            Route::get('/package-export', 'exportPackageTransaction')->name('package.export');
            Route::get('/cash-flow', 'getCashFlow')->name('cash.flow');
            // Route::get('/cash-flow', 'getCashFlowPack')->name('cash.flow');
            // Route::get('/cash-flow-test', 'getCashFlow')->name('cash.flow');

        });
        // ==================== END ADMIN ================
    });
});