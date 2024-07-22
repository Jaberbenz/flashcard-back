<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'front_text', 'front_image', 'front_video', 'front_audio', 'back', 'theme_id'
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
