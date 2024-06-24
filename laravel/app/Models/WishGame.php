<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WishGame extends Model
{
    use HasFactory;

    protected $fillable = ['name','user_id','game_id'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function game(): BelongsTo{
        return $this->belongsTo(Game::class);
    }
}
