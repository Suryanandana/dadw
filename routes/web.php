<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AdminController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    return view('landing.index');
});

// customer dashboard
Route::get('/customer-dashboard', [App\Http\Controllers\CustomerController::class, 'dashboard'])->name('customer.dashboard')->middleware('auth');

Route::get('/dashboard', function () {
    return view('landing.index');
})->middleware(['auth'])->name('dashboard');

// autentikasi
Route::get('/login', function () {
    return view('authentication.login');
});
Route::get('/register', function () {
    return view('authentication.register');
});
Route::post('/register', [App\Http\Controllers\Authentication::class, 'register']);
Route::post('/login', [App\Http\Controllers\Authentication::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\Authentication::class, 'logout']);
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); 
    return redirect('/');
})->name('verification.verify');

//reset & forgot password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

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
})->middleware('guest')->name('password.update');


// booking
Route::get('/booking', function () {
    // get data from database
    $services = DB::table('services')->get();
    $rooms = DB::table('rooms')->get();
    return view('customer.booking', ['services' => $services, 'rooms' => $rooms]);
})->middleware('auth');

Route::post('/booking', [App\Http\Controllers\CustomerController::class, 'booking'])->name('customer.booking');

Route::get('/reschedule', [App\Http\Controllers\CustomerController::class, 'viewReschedule'])->name('reschedule-form')->middleware('auth');
Route::put('/reschedule', [App\Http\Controllers\CustomerController::class, 'reschedule'])->name('customer.reschedule')->middleware('auth');
Route::delete('/cancellation/{{id}}', [App\Http\Controllers\CustomerController::class, 'cancellation'])->name('cancellation')->middleware('auth');

Route::get('/transaction', [App\Http\Controllers\CustomerController::class, 'transaction']);


// ==================== ADMIN ====================
Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth');

Route::get('/admin-account', [AdminController::class, 'getAdmin'])->name('admin.account')->middleware('auth');
Route::post('/add-admin', [AdminController::class, 'addAdmin'])->name('add.admin')->middleware('auth');
Route::put('/update-admin/{id}', [AdminController::class, 'updateAdmin'])->name('update.admin')->middleware('auth');
Route::delete('/delete-admin/{id}', [AdminController::class, 'deleteAdmin'])->name('delete.admin')->middleware('auth');

Route::get('/staff-account', [AdminController::class, 'getStaff'])->name('staff.account')->middleware('auth');
Route::post('/add-staff', [AdminController::class, 'addStaff'])->name('add.staff')->middleware('auth');
Route::put('/update-staff/{id}', [AdminController::class, 'updateStaff'])->name('update.staff')->middleware('auth');
Route::delete('/delete-staff/{id}', [AdminController::class, 'deleteStaff'])->name('delete.staff')->middleware('auth');

Route::get('/customer-account', [AdminController::class, 'getCustomer'])->name('customer.account')->middleware('auth');
Route::post('/add-customer', [AdminController::class, 'addCustomer'])->name('add.customer')->middleware('auth');
Route::put('/update-customer/{id}', [AdminController::class, 'updateCustomer'])->name('update.customer')->middleware('auth');
Route::delete('/delete-customer/{id}', [AdminController::class, 'deleteCustomer'])->name('delete.customer')->middleware('auth');
// ==================== END ADMIN ================

