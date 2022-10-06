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

    // fields to be filled from the form and from the loggedIn user.
    protected $fillable = [
        'user_id',
        'category_name'
    ];

    // this function will not be necessary for => query builder
    // this is a hasOne relation ... a category has only one user... which means it is created by only one user.
    public function user(){
        return $this->hasOne(User::class,'id', 'user_id'); // the 'id' is the 'id' from the 'user' table & the 'user_id' is from the categories table.
    }
}
