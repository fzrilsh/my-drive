<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Repository;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

#[Layout('components.layouts.upload')]
#[Title('My Drive - Upload')]
class Upload extends Component
{
    use WithFileUploads;

    public $categories;

    public $name;
    public $category;
    public $file;

    protected function rules()
    {
        return [
            'name' => 'required|unique:repositories,name',
            'category' => 'required',
            'file' => 'required|file|mimes:zip|max:61440'
        ];
    }

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.upload');
    }

    public function updatedCategory($value)
    {
        if (!$value) $this->categories = Category::all();
        else $this->categories = Category::query()->where('name', 'LIKE', "%{$value}%")->get();
    }

    public function selectCategory($category)
    {
        $this->category = $category;
        $this->categories = [];
    }

    public function randomCode()
    {
        $code = Str::random(30);

        if (Repository::query()->where('code', $code)->first()) return $this->randomCode();
        return $code;
    }

    public function submit()
    {
        $this->validate();

        $code = $this->randomCode();
        $slug = Str::slug($this->name);

        $path = storage_path('app/private/' . $this->file->storeAs('repositories/' . $slug, $slug . '.zip'));
        $zipFolder = storage_path('app/private/repositories/' . $slug);

        $zip = new ZipArchive;
        if ($zip->open($path) === TRUE) {
            $zip->extractTo($zipFolder);
            $zip->close();

            $this->file->delete();
            // Storage::delete('/repositories/' . $slug . '/' . $slug . '.zip');

            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($zipFolder, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            );

            $category = Category::query()->where('slug', Str::slug($this->category))->firstOrCreate([
                'name' => $this->category,
                'slug' => Str::slug($this->category)
            ]);

            $repo = $category->Repositories()->create([
                'name' => $this->name,
                'code' => $code,
                'created_at' => now()
            ]);

            foreach ($iterator as $item) {
                $realPath = str_replace(storage_path('app/private/repositories/' . $slug), '', $item->getPath());
                $code = $this->randomCode();

                if ($item->isDir()) {
                    $repo->Folders()->create([
                        'path' => $realPath,
                        'name' => $item->getFilename(),
                        'code' => $code
                    ]);
                } else {
                    $sizeInBytes = $item->getSize();
                    if ($sizeInBytes < 1024) {
                        $size = $sizeInBytes;
                        $unit = "Bytes";
                    } elseif ($sizeInBytes < 1024 * 1024) {
                        $size = $sizeInBytes / 1024;
                        $unit = "KB";
                    } else {
                        $size = $sizeInBytes / (1024 * 1024);
                        $unit = "MB";
                    }

                    $data = [
                        'path' => $realPath,
                        'name' => $item->getFileName(),
                        'code' => $code,
                        'filesize' => round($size, 2) . " $unit"
                    ];

                    $folder = explode('/', $realPath); 
                    $hasFolder = $repo->Folders()->getQuery()->where('name', end($folder))->first();

                    if ($hasFolder) $data['folder_id'] = $hasFolder->id;
                    $repo->Files()->create($data);
                }
            }
        } else {
            Storage::delete('/repositories/' . $slug . '/' . $slug . '.zip');
            $this->file->delete();

            return back()->withErrors(['error' => 'Unknown error while unzip your project.']);
        }

        return redirect()->route('dashboard');
    }
}
