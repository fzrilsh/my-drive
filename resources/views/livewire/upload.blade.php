<div class="container mx-auto p-6 mt-8">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Upload Repo</h2>

        <form wire:submit="submit" enctype="multipart/form-data">
            @error('error') <p class="p-2 my-2 text-sm bg-red-100 rounded-lg font-medium text-red-800">{{ $message }}</p> @enderror
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                <input type="text" id="name" name="name" wire:model.live.lazy="name"
                    class="w-full px-4 py-2 bg-gray-100 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="TO1 - LKSN 2024 - MODULE SERVER" required>
                @error('name') <span class="text-sm text-red-800 rounded-lg font-medium">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="category" class="block text-gray-700 font-medium mb-2">Category</label>
                <div class="relative">
                    <div class="h-10 bg-white flex border border-gray-200 rounded items-center">
                        <input placeholder="Select category" name="category" id="category" wire:model.live="category"
                            onfocus="document.querySelector('#show_more').click()" required
                            class="w-full px-4 py-2 bg-gray-100 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" checked />

                        <button type="button" class="cursor-pointer outline-none focus:outline-none transition-all text-gray-300 hover:text-gray-600" onclick="document.querySelector('#category').value = ''">
                            <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                        <label for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-gray-600">
                            <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="18 15 12 9 6 15"></polyline>
                            </svg>
                        </label>
                    </div>
                                    
                    <input type="checkbox" name="show_more" id="show_more" class="hidden peer" />
                    <div class="absolute rounded shadow bg-white overflow-hidden hidden peer-checked:flex flex-col w-full mt-1 border border-gray-200">
                        <div class="cursor-pointer group">
                            @foreach ($categories as $category)
                            <a class="block p-2 border-transparent border-l-4 group-hover:border-blue-600 group-hover:bg-gray-100" wire:click="selectCategory('{{ $category->name }}')">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    @error('category') <span class="text-sm text-red-800 rounded-lg font-medium">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="file" class="block text-gray-700 font-medium mb-2">File</label>
                <input type="file" id="file" name="file" wire:model="file"
                    class="w-full px-4 py-2 bg-gray-100 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    accept=".zip" required>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-sm">Catatan: Harap menghapus folder <code
                        class="bg-gray-200 p-1 rounded">vendor</code> dan <code
                        class="bg-gray-200 p-1 rounded">node_modules</code> sebelum diupload.</p>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    wire:loading.lazy>Upload</button>
            </div>

        </form>
    </div>
</div>
