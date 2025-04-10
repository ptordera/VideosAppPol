<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    protected $table = 'videos';
    protected $fillable = [
        'title',
        'description',
        'video',
        'url',
        'published_at',
        'previous',
        'next',
        'series_id',
        'user_id',
    ];

    public function serie()
    {
        return $this->belongsTo(Serie::class, 'series_id');
    }

    function getFormattedPublishedAtAttribute()
    {
        // Verificar si la fecha es null antes de formatear
        if ($this->published_at === null) {
            return null;
        }

        // Si no es null, formatear la fecha
        return Carbon::parse($this->published_at)->format('d M Y');
    }


    function getFormattedForHumansPublishedAtAttribute()
    {
        return Carbon::parse($this->published_at)->diffForHumans();
    }

    function getPublishedAtTimestampAttribute()
    {
        return Carbon::parse($this->published_at)->timestamp;
    }
}
