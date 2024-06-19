<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OS extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function game(): BelongsToMany{
        return $this->belongsToMany(Game::class);
    }
}
