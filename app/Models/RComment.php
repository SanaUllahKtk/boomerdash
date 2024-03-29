<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RComment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'user_id', 'description'];

    public function post()
    {
        return $this->belongsTo(RPost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rPost()
    {
        return $this->belongsTo(RPost::class, 'post_id');
    }
}
