<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DLS extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'name', 'info', 'image_path', 'cost'];

    public function game(): BelongsTo{
        return $this->belongsTo(Game::class);
    }

    public function user(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }
}
