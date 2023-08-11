<?php

namespace Src\Users\Infrastructure\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'users';

    protected $fillable = [
        'document',
        'fullName',
        'email',
        'phone',
    ];

}
