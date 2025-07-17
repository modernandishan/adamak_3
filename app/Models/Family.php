<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Family extends Model
{
    protected $table = 'families';

    protected $fillable = [
        'user_id',
        'title',
        'father_name',
        'mother_name',
        'members',
        'is_father_gone',
        'is_mother_gone',
    ];

    protected $casts = [
        'members' => 'array',
        'is_father_gone' => 'boolean',
        'is_mother_gone' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * آیا پدر فوت کرده است؟
     */
    public function isFatherGone(): bool
    {
        return $this->is_father_gone;
    }

    /**
     * آیا مادر فوت کرده است؟
     */
    public function isMotherGone(): bool
    {
        return $this->is_mother_gone;
    }
}
