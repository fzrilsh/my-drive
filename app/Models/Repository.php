<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Repository extends Model
{
    protected $fillable = ['name', 'code', 'category_id', 'score', 'created_at', 'updated_at'];
    public $timestamps = false;
    public $appends = ['category'];

    public function Folders(){
        return $this->hasMany(Folder::class);
    }

    public function Files(){
        return $this->hasMany(File::class);
    }

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function getCategoryAttribute(){
        return $this->Category()->first()->name;
    }

    public function DownloadCode(){
        return $this->Files()->getQuery()->where('name', Str::slug($this->name) . '.zip')->first()->code;
    }
}
