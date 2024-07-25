<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'review_date',
        'max_level',
        'user_id',
        'level',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function themes()
    {
        return $belongsToMany(Theme::class);
    }

    public function cards()
    {
        return $belongsToMany(Card::class);
    }
}