<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];
    protected $table = 'options';


    public function userOption()
    {
        return $this->belongsToMany(User::class, 'user_options', 'option_id', 'user_id');
    }
}
