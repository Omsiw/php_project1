<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;
    
    protected $fillable = ['name','password'];

    public function order(): HasMany{
        return $this->hasMany(Order::class);
    }

    public function orderHistory(): HasMany{
        return $this->hasMany(OrderHistory::class);
    }
    
    public function wishGame(): HasMany{
        return $this->hasMany(WishGame::class);
    }

    public function game(): BelongsToMany{
        return $this->belongsToMany(Game::class);
    }

    public function dls(): BelongsToMany{
        return $this->belongsToMany(DLS::class);
    }

    public function mod(): BelongsToMany{
        return $this->belongsToMany(Mod::class);
    }
}
