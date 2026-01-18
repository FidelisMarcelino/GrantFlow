<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ReviewController;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Localization
Route::middleware('locale')->group(function () {
    Route::get('locale/{locale}', function ($locale) {
        if (in_array(($locale), ['en', 'id'])) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }

        return redirect()->back();
    })->name('locale.switch');

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'dosen') {
            $totalProposals = Proposal::where('user_id', $user->id)->count();
            $draftProposals = Proposal::where('user_id', $user->id)->where('status', 'draft')->count();
            $submittedProposals = Proposal::where('user_id', $user->id)->where('status', 'submitted')->count();
            $recentProposals = Proposal::where('user_id', $user->id)->latest()->take(5)->get();

            return view('dashboards.dosen', compact('totalProposals', 'draftProposals', 'submittedProposals', 'recentProposals'));
        } elseif ($user->role === 'reviewer') {
            $pendingReviews = Proposal::where('status', 'submitted')->count();
            $approvedReviews = Proposal::where('status', 'approved')->count();
            $rejectedReviews = Proposal::where('status', 'rejected')->count();

            $pendingProposals = Proposal::where('status', 'submitted')->latest()->take(5)->get();
            $approvedProposals = Proposal::where('status', 'approved')->latest()->take(5)->get();
            $rejectedProposals = Proposal::where('status', 'rejected')->latest()->take(5)->get();

            return view('dashboards.reviewer', compact('pendingReviews', 'approvedReviews', 'rejectedReviews', 'pendingProposals', 'approvedProposals', 'rejectedProposals'));
        }

        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // DOSEN
    Route::middleware(['auth', 'role:dosen'])->group(function () {
        Route::get('/proposals', [ProposalController::class, 'index'])->name('proposal.index');
        Route::get('/proposals/create', [ProposalController::class, 'create'])->name('proposal.create');
        Route::get('/proposals/{proposal}', [ProposalController::class, 'view'])->name('proposal.view');
        Route::post('/proposals', [ProposalController::class, 'store'])->name('proposal.store');
        Route::get('/proposals/{proposal}/edit', [ProposalController::class, 'edit'])->name('proposal.edit');
        Route::put('/proposals/{proposal}', [ProposalController::class, 'update'])->name('proposal.update');
        Route::post('/proposals/{proposal}/submit', [ProposalController::class, 'submit'])->name('proposal.submit');
        Route::delete('/proposals/{proposal}', [ProposalController::class, 'destroy'])->name('proposal.destroy');
    });

    // REVIEWER
    Route::middleware(['auth', 'role:reviewer'])->group(function () {
        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::get('/reviews/{proposal}', [ReviewController::class, 'show'])->name('reviews.show');
        Route::post('/reviews/{proposal}', [ReviewController::class, 'review'])->name('reviews.review');
        Route::get('/reviewer/dashboard', [ReviewController::class, 'dashboard'])->name('reviewer.dashboard');
    });
});

require __DIR__ . '/auth.php';
