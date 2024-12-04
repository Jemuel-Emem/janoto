<?php
use App\Http\Controllers\AuthController;
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

Route::view('/', 'welcome');
Route::middleware([

    ])->group(function () {
         Route::get('/dashboard', function () {
           if (auth()->user()->is_admin == 1) {
            return redirect()->route('Admindashboard');
           }else{
            return redirect()->route('user-dashboard');
           }
         })->name('userdashboard');

    });

    Route::prefix('admin')->middleware('admin')->group(function(){
        Route::get('/Admindashboard', function(){
            return view('admin.index');
        })->name('Admindashboard');

        Route::get('/admin.add-service', function(){
            return view('admin.add-service');
        })->name('admin.add-service');

        Route::get('/admin.appointment', function(){
            return view('admin.appointment');
        })->name('admin.appointment');

        Route::get('/admin.schedule', function(){
            return view('admin.schedule');
        })->name('admin.schedule');

        Route::get('/admin.faq', function(){
            return view('admin.faq');
        })->name('admin.faq');


     });

     Route::prefix('user')->middleware('user')->group(function(){
        Route::get('/dashboard', function(){
               return view('user.index');
           })->name('user-dashboard');

           Route::get('/user.services', function(){
            return view('user.services');
        })->name('user.services');

        Route::get('/user.appointment', function(){
            return view('user.appointment');
        })->name('user.appointment');

        Route::get('/user.faqs', function(){
            return view('user.faqs');
        })->name('user.faqs');

        Route::get('/user.profile', function(){
            return view('user.profile');
        })->name('user.profile');

        Route::get('/user.terms', function(){
            return view('user.terms');
        })->name('user.terms');


    });


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
require __DIR__.'/auth.php';
