<div>
    <div class="flex justify-between items-center bg-white p-4 shadow-md border-b px-10">
        <div class="flex items-center">
            <img src="{{ asset('imgs/drive.png') }}" alt="Spreadsheet Icon" class="w-6 h-6 mr-2">
            <span class="text-lg font-bold text-gray-800">My Drive</span>
        </div>
    
        <div class="mx-4 flex-grow">
            <input type="text"
                wire:model.lazy="search"
                class="w-full max-w-md px-4 py-2 bg-gray-100 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Telusuri">
        </div>
    
        <div class="flex items-center space-x-4">
            <select class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700" wire:model.live="sortBy">
                <option value="name">Sort by name</option>
                <option value="created_at">Sort by date</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700" wire:model.live="groupBy">
                <option value="category">Group by category</option>
                <option value="created_at">Group by date</option>
                <option value="score">Group by score</option>
            </select>
        </div>
    </div>
    
    <div class="container mx-auto p-6 space-y-6">
        <div class="space-y-2">
            @foreach ($repositories as $key => $value)
                <h1 class="text-lg font-bold ">{{ $key }}</h1>
                @foreach ($value as $repo)
                    <div class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center hover:bg-slate-100">
                        <a href="{{ route('repo.detail', ['code' => $repo->code]) }}" class="text-gray-800 font-semibold cursor-pointer">{{ $repo->name }}</a>
                        <div>
                            <a href="{{ route('download', ['code' => $repo->DownloadCode()]) }}" class="mx-2 cursor-pointer" title="download"><svg aria-hidden="true" focusable="false"
                                class="octicon octicon-download text-center" viewBox="0 0 16 16"
                                width="16" height="16" fill="currentColor"
                                style="display: inline-block; user-select: none; vertical-align: text-bottom; overflow: visible;">
                                <path
                                    d="M2.75 14A1.75 1.75 0 0 1 1 12.25v-2.5a.75.75 0 0 1 1.5 0v2.5c0 .138.112.25.25.25h10.5a.25.25 0 0 0 .25-.25v-2.5a.75.75 0 0 1 1.5 0v2.5A1.75 1.75 0 0 1 13.25 14Z">
                                </path>
                                <path
                                    d="M7.25 7.689V2a.75.75 0 0 1 1.5 0v5.689l1.97-1.969a.749.749 0 1 1 1.06 1.06l-3.25 3.25a.749.749 0 0 1-1.06 0L4.22 6.78a.749.749 0 1 1 1.06-1.06l1.97 1.969Z">
                                </path>
                            </svg></a>
                            <span class="text-gray-600 text-sm">{{ \Carbon\Carbon::parse($repo->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
