<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'date_start', 'date_end', 'percent'];

    public function game():BelongsTo{
        return $this->belongsTo(Game::class);
    }
}
