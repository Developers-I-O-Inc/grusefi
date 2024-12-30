<?php
use App\Http\Controllers\Auth\NewPasswordController;
use App\Models\Admin\UsersStandards;
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
    return view('auth/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $users_standards = UsersStandards::user_standards_date(auth()->user()->id);
        return view('dashboard', compact('users_standards'));
    })->name('dashboard');
});

Route::get('/password/expired', function () {
    return view('auth.password-expired'); // Crea una vista personalizada para esto
})->name('password.expired');

Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
