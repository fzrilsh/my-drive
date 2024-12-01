<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = ['repository_id', 'path', 'name', 'code'];
    public $timestamps = false;

    public function Repository(){
        return $this->belongsTo(Repository::class);
    }
}
