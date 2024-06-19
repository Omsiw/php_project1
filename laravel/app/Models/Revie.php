<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Revie extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'user_id', 'rate'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function game(): BelongsTo{
        return $this->belongsTo(Game::class);
    }
}
