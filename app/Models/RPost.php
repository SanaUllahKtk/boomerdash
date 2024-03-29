<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RPost extends Model
{
    use HasFactory;

    protected $fillable = ['r_category_id', 'user_id', 'title', 'description', 'img', 'url', 'votes'];

    public function category()
    {
        return $this->belongsTo(RCategory::class, 'r_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->hasMany(RPostVote::class);
    }

    public function comments()
    {
        return $this->hasMany(RComment::class, 'post_id');
    }

    public function postsWithVotesThisWeek()
    {
        return $this->hasMany(RPost::class)
            ->join('r_post_votes', 'r_posts.id', '=', 'r_post_votes.r_post_id')
            ->where('r_post_votes.created_at', '>=', now()->subDays(7))
            ->select('r_posts.*')
            ->distinct();
    }

    public function postVotes()
    {
        return $this->hasMany(RPostVote::class);
    }

    public function r_categories()
    {
        return $this->belongsTo(RCategory::class);
    }
}
