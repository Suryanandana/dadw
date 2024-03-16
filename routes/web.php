<?php

use App\Models\Chat;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Authentication;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CustomerController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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

Route::get('/', [LandingController::class, 'landing']);

Route::get('seed/chat', function(){
    Chat::create([
        'message' => 'Hello, how are you?',
        'sender_id' => auth()->id(),
        'receiver_id' => 2,
        'is_read' => 0
    ]);
});

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
 
Route::get('/reschedule', [App\Http\Controllers\CustomerController::class, 'viewReschedule']);
Route::put('/reschedule', [App\Http\Controllers\CustomerController::class, 'reschedule'])->name('customer.reschedule');
Route::put('/cancel', [App\Http\Controllers\CustomerController::class, 'cancel']);

Route::get('/transaction', [App\Http\Controllers\CustomerController::class, 'transaction']);

Route::post('/feedback', [App\Http\Controllers\CustomerController::class, 'feedback'])->name('customer.feedback');

Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.landing')->middleware('auth');

// ==================== STAFF ====================

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
Route::get('/staff', [StaffController::class, 'dashboard'])->middleware('auth');
Route::get('/staff/transaction', [StaffController::class, 'getTransaction'])->middleware('auth');
Route::post('/staff/updatetransaction/{id}', [StaffController::class, 'updateTransaction'])->middleware('auth');
Route::post('/staff/donetransaction/{id}', [StaffController::class, 'doneTransaction'])->middleware('auth');


Route::middleware(['auth'])->group(function() 
{
    Route::get('/dashboard')->middleware('userAccess:customer')->name('dashboard');
    
    // ==================== CUSTOMER ====================
    
    Route::get('/booking', function () {
        // get data from database
        $services = DB::table('services')->get();
        $rooms = DB::table('rooms')->get();
        return view('customer.booking', ['services' => $services, 'rooms' => $rooms]);
    })->middleware('userAccess:customer');

    Route::post('/booking', [CustomerController::class, 'booking'])->name('customer.booking')->middleware('userAccess:customer');
    
    Route::get('/reschedule', [CustomerController::class, 'viewReschedule'])->middleware('userAccess:customer');
    Route::put('/reschedule', [CustomerController::class, 'reschedule'])->name('customer.reschedule')->middleware('userAccess:customer');
    Route::put('/cancel', [CustomerController::class, 'cancel'])->middleware('userAccess:customer');

    Route::get('/transaction', [CustomerController::class, 'transaction'])->name('customer.transaction')->middleware('userAccess:customer');

    Route::post('/feedback', [CustomerController::class, 'feedback'])->name('customer.feedback')->middleware('userAccess:customer');

    Route::get('/customer', [CustomerController::class, 'transaction'])->middleware('userAccess:customer');
    
    // ==================== STAFF ====================

    Route::get('/staff', [StaffController::class, 'getTransaction'])->middleware('userAccess:staff')->name('staff');
    Route::get('/staff/transaction', [StaffController::class, 'getTransaction'])->middleware('userAccess:staff');
    Route::post('/staff/updatetransaction/{id}', [StaffController::class, 'updateTransaction'])->middleware('userAccess:staff');
    Route::post('/staff/donetransaction/{id}', [StaffController::class, 'doneTransaction'])->middleware('userAccess:staff');
    
    Route::post('/staff/service', [StaffController::class, 'getService'])->middleware('userAccess:staff');
    Route::get('/staff/service', [StaffController::class, 'getService'])->name('search')->middleware('userAccess:staff');
    Route::post('/staff/addservice', [StaffController::class, 'addService'])->middleware('userAccess:staff');
    Route::put('/staff/updateservice/{id}', [StaffController::class, 'updateService'])->name('update.service')->middleware('userAccess:staff');
    Route::delete('/staff/deleteservice/{id}', [StaffController::class, 'deleteService'])->name('delete.service')->middleware('userAccess:staff');

    // ==================== ADMIN ====================
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('userAccess:admin')->name('admin');
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('userAccess:admin');

    Route::get('/admin-account', [AdminController::class, 'getAdmin'])->name('admin.account')->middleware('userAccess:admin');
    Route::post('/add-admin', [AdminController::class, 'addAdmin'])->name('add.admin')->middleware('userAccess:admin');
    Route::put('/update-admin/{id}', [AdminController::class, 'updateAdmin'])->name('update.admin')->middleware('userAccess:admin');
    Route::delete('/delete-admin/{id}', [AdminController::class, 'deleteAdmin'])->name('delete.admin')->middleware('userAccess:admin');

    Route::get('/staff-account', [AdminController::class, 'getStaff'])->name('staff.account')->middleware('userAccess:admin');
    Route::post('/add-staff', [AdminController::class, 'addStaff'])->name('add.staff')->middleware('userAccess:admin');
    Route::put('/update-staff/{id}', [AdminController::class, 'updateStaff'])->name('update.staff')->middleware('userAccess:admin');
    Route::delete('/delete-staff/{id}', [AdminController::class, 'deleteStaff'])->name('delete.staff')->middleware('userAccess:admin');

    Route::get('/customer-account', [AdminController::class, 'getCustomer'])->name('customer.account')->middleware('userAccess:admin');
    Route::post('/add-customer', [AdminController::class, 'addCustomer'])->name('add.customer')->middleware('userAccess:admin');
    Route::put('/update-customer/{id}', [AdminController::class, 'updateCustomer'])->name('update.customer')->middleware('userAccess:admin');
    Route::delete('/delete-customer/{id}', [AdminController::class, 'deleteCustomer'])->name('delete.customer')->middleware('userAccess:admin');

    Route::get('/all-transaction', [AdminController::class, 'getAllTransaction'])->name('all.transaction')->middleware('userAccess:admin');
    Route::post('/filter-transaction', [AdminController::class, 'filterTransaction'])->name('filter.transaction')->middleware('userAccess:admin');
    Route::get('/transaction-export', [AdminController::class, 'exportTransaction'])->name('transaction.export')->middleware('userAccess:admin');
    Route::get('/cash-flow', [AdminController::class, 'getCashFlow'])->name('cash.flow')->middleware('userAccess:admin');
    // ==================== END ADMIN ================

});