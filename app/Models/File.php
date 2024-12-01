<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['repository_id', 'folder_id', 'path', 'name', 'code', 'filesize'];
    public $timestamps = false;

    public function Repository(){
        return $this->belongsTo(Repository::class);
    }

    public function Folder(){
        return $this->belongsTo(Folder::class);
    }
}
