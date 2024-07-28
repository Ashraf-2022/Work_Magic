<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = [
        'id',
        'title',
        'image',
        'description',
        'category',
        'user_id',
        'username',
        'created_at',
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
