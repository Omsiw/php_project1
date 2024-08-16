<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = ['login', 'name', 'password', 'email'];

    public function order(): HasMany{
        return $this->hasMany(Order::class);
    }

    public function orderHistory(): HasMany{
        return $this->hasMany(OrderHistory::class);
    }
    
    public function wishGame(): HasMany{
        return $this->hasMany(WishGame::class);
    }

    public function revie(): HasMany{
        return $this->hasMany(Revie::class);
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
