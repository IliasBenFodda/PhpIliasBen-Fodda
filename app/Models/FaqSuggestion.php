<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FaqSuggestion extends Model
{
    protected $fillable = ['user_id', 'category_id', 'question', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
