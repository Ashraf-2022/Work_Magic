<?php

namespace App\Models\Certificates;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'path'];
}
