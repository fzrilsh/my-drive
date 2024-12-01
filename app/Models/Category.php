<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];
    public $timestamps = false;

    public function Repositories(){
        return $this->hasMany(Repository::class);
    }
}