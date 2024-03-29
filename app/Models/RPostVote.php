<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RPostVote extends Model
{
    use HasFactory;

    protected $fillable = ['r_post_id', 'r_user_id', 'vote'];

    public function post()
    {
        return $this->belongsTo(RPost::class, 'r_post_id');
    }
}
