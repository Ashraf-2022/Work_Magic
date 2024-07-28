<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected $table = 'comments';

    protected $fillable = [
        'id',
        'comment',
        'user_id',
        'username',
        'post_id',
        'created_at',
    ];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    protected $primaryKey = 'user_id';
}
