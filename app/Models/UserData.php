<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'address',
        'address2',
        'city',
        'state',
        'zip',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
