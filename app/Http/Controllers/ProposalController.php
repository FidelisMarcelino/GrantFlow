<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proposal = Proposal::where('user_id', Auth::id())->get();
        return view('proposal.index', compact('proposal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proposal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'amount' => 'required|numeric|min:100000|max:50000000',
            'start_date' => 'required|date|after:today',
        ]);

        Proposal::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'start_date' => $request->start_date,
            'status' => 'draft',
        ]);

        return redirect()->route('proposal.index')->with('success', 'Proposal berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proposal $proposal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proposal $proposal)
    {
        if ($proposal->user_id !== Auth::id()) {
            abort(403);
        }

        // hanya draft boleh diedit
        if ($proposal->status !== 'draft') {
            return redirect()
                ->route('proposal.show', $proposal)
                ->with('error', 'Proposal yang sudah disubmit tidak dapat diedit.');
        }

        return view('proposal.edit', compact('proposal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proposal $proposal)
    {
        $request->validate([
            'title' => 'required |string | max:255',
            'description' => 'required | string | min:50',
            'amount' => 'required | numeric | min:100000 | max:50000000',
            'start_date' => 'required | date | after:today',
        ]);

        $proposal->update([
            'status' => $request->status,
            'reviewer_note' => $request->review_note,
            'reviewed_by' => Auth::id(),
        ]);

        return redirect()->route('proposals.index')->with('success', 'Proposal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proposal $proposal)
    {
        $proposal->delete();

        return redirect()->route('proposal.index')->with('success', 'Proposal berhasil dihapus.');
    }

    /**
     * Submit proposal to reviewer.
     */
    public function submit(Proposal $proposal)
    {
        if ($proposal->user_id !== Auth::id()) {
            abort(403);
        }

        $proposal->update(['status' => 'submitted']);

        return redirect()->route('proposal.index')->with('success', 'Proposal berhasil disubmit untuk direview.');
    }

    public function view()
    {
        $proposal = Proposal::where('user_id', Auth::id())->latest()->first();
        return view('proposal.view', compact('proposal'));
    }
}
