<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(){
        $proposals = Proposal::get();
        return view('reviews.index', compact('proposals'));
    }

    public function show(Proposal $proposal){
        return view('reviews.show', compact('proposal'));
    }

    public function review(Request $request, Proposal $proposal){
        // Hanya proposal dengan status submitted yang bisa di-review
        if($proposal->status != 'submitted'){
            abort(403);
        }

        $request->validate([
            'status' => 'required | in:approved,rejected',
            'reviewer_note' => 'required | string | min:10',
        ]);

        $proposal->update([
            'status' => $request->status,
            'reviewer_note' => $request->reviewer_note,
            'reviewed_by' => Auth::id(),
        ]);

        return redirect()->route('reviews.index')->with('success', 'Proposal reviewed successfully.');
    }
}
