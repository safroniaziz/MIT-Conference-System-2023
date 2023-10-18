<?php

use App\Http\Controllers\AbstrakController;
use App\Http\Controllers\AllPaperController;
use App\Http\Controllers\AwaitingController;
use App\Http\Controllers\PaperPresentationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PendingPaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VerifiedController;
use App\Http\Controllers\VerifiedPaymentController;
use App\Models\Abstrak;
use App\Models\User;
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
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboardAdmin', function () {
    $underReview = Abstrak::count();
    $pending = Abstrak::pending()->count();
    $accepted = Abstrak::accepted()->count();
    $rejected = Abstrak::rejected()->count();
    $participant = User::participant()->count();
    $presenter = User::presenter()->count();
    return view('dashboardAdmin',[
        'underReview'   =>  $underReview,
        'pending'   =>  $pending,
        'accepted'   =>  $accepted,
        'rejected'   =>  $rejected,
        'participant'   =>  $participant,
        'presenter'   =>  $presenter,
    ]);
})->middleware(['auth', 'verified'])->name('dashboardAdmin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(AbstrakController::class)->middleware('auth')->prefix('/submission')->group(function () {
    Route::get('/', 'index')->name('abstrak');
    Route::post('/', 'post')->name('abstrak.post');
    Route::patch('/{abstrak}/edit', 'update')->name('abstrak.update');
    Route::delete('/{abstrak}/delete', 'destroy')->name('abstrak.destroy');
    Route::get('/{abstrak}/download/', 'download')->name('abstrak.download');
    Route::patch('/{abstrak}/submit', 'submit')->name('abstrak.submit');
});

Route::controller(PaymentController::class)->middleware('auth')->prefix('/upload_payment_proof')->group(function () {
    Route::get('/', 'index')->name('payment');
    Route::post('/', 'post')->name('payment.post');
    Route::patch('/{paymentProof}/edit', 'update')->name('payment.update');
    Route::delete('/{paymentProof}/delete', 'destroy')->name('payment.destroy');
    Route::get('/{paymentProof}/download/', 'download')->name('payment.download');
    Route::patch('/{paymentProof}/submit', 'submit')->name('payment.submit');
});

Route::controller(PaperPresentationController::class)->middleware('auth')->prefix('/upload_paper_and_presentation_file')->group(function () {
    Route::get('/', 'index')->name('paper');
    Route::post('/', 'post')->name('paper.post');
    Route::patch('/{paper}/edit', 'update')->name('paper.update');
    Route::delete('/{paper}/delete', 'destroy')->name('paper.destroy');
    Route::get('/{paper}/download_paper/', 'downloadPaper')->name('paper.downloadPaper');
    Route::get('/{paper}/download_presentation/', 'downloadPresentation')->name('paper.downloadPresentation');
    Route::patch('/{paper}/submit', 'submit')->name('paper.submit');
});

Route::controller(AwaitingController::class)->middleware('auth')->prefix('/submissions_awaiting_verification')->group(function () {
    Route::get('/', 'index')->name('awaiting');
    Route::get('/{abstrak}/read_more', 'readMore')->name('awaiting.readMore');
    Route::patch('/verify', 'verify')->name('awaiting.verify');
});

Route::controller(VerifiedController::class)->middleware('auth')->prefix('/verified_submissions')->group(function () {
    Route::get('/', 'index')->name('verified');
    Route::get('/{abstrak}/read_more', 'readMore')->name('verified.readMore');
});

Route::controller(PendingPaymentController::class)->middleware('auth')->prefix('/pending_payment_verification')->group(function () {
    Route::get('/', 'index')->name('pendingPayment');
    Route::patch('/verify', 'verify')->name('pendingPayment.verify');
});

Route::controller(VerifiedPaymentController::class)->middleware('auth')->prefix('/verified_payment_proof')->group(function () {
    Route::get('/', 'index')->name('verifiedPayment');
});

Route::controller(AllPaperController::class)->middleware('auth')->prefix('/all_papers_and_presentations')->group(function () {
    Route::get('/', 'index')->name('allPaper');
});

require __DIR__.'/auth.php';
