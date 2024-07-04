<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mod extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'author_id', 'name', 'info', 'date_add'];

    public function game(): BelongsTo{
        return $this->belongsTo(Game::class);
    }

    public function author(): BelongsTo{
        return $this->belongsTo(Author::class);
    }

    public function user(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }
}
