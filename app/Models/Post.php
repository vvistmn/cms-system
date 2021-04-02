<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        $date = Carbon::now();
        $value = Carbon::create($value);

        if ($date->format('F d, Y') == $value->format('F d, Y')) {
            return $value->diffForHumans();
        }
        return $value->format('F d, Y');
    }
}
