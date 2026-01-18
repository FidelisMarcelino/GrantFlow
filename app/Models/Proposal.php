<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'amount',
        'start_date',
        'status',
        'reviewer_note',
        'reviewed_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'start_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
