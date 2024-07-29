<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['name','cost','date_add','info'];
    
    public function order(): HasMany{
        return $this->hasMany(Order::class);
    }

    public function discount(): HasMany{
        return $this->hasMany(Discount::class);
    }
    
    public function wishGame(): HasMany{
        return $this->hasMany(WishGame::class);
    }

    public function dls(): HasMany{
        return $this->hasMany(DLS::class);
    }

    public function mod(): HasMany{
        return $this->hasMany(Mod::class);
    }

    public function user(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }

    public function publisher(): BelongsToMany{
        return $this->belongsToMany(Publisher::class);
    }

    public function author(): BelongsToMany{
        return $this->belongsToMany(Author::class);
    }

    public function tag(): BelongsToMany{
        return $this->belongsToMany(Tag::class);
    }
    
    public function OS(): BelongsToMany{
        return $this->belongsToMany(OS::class);
    }
}
