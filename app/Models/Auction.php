<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Auction extends Model
{
    use HasFactory;
    protected $fillable = [
        'name' ,
        'price',
        'image_path',
        'description'

    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }

    public function winner(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }



}
