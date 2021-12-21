<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Category extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_name'
    ];

    // this function will not be necessary for => query builder
    public function user(){
        return $this->hasOne(User::class,'id', 'user_id');
    }
}
