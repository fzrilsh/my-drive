<?php

use App\Livewire\Dashboard;
use App\Livewire\RepoDetai;
use App\Livewire\Upload;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', Dashboard::class)->name('dashboard');
Route::get('/repo/{code}', RepoDetai::class)->name('repo.detail');
Route::get('/upload', Upload::class)->name('upload');

Route::get('/download/{code}', function(Request $request){
    $file = File::query()->where('code', $request->code)->firstOrFail();
    $path = Str::slug($file->Repository()->first()->name) . $file->path . '/' . $file->name;

    return response()->download(storage_path("/app/private/repositories/$path"));
})->name('download');