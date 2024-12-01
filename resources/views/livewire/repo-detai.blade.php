<div class="mt-6 mt-lg-0 px-32">
    <div class="card">
        <div class="px-6 py-3 border-b border-gray-300">
            <h4 class=""><a class="text-blue-400 cursor-pointer hover:underline" wire:click="restartPath()">{{ \Illuminate\Support\Str::slug($repo->name) }}</a> {!! $breadcrumb !!}</h4>
        </div>
        <div>
            <div class="relative overflow-x-auto table-card border border-gray-300">
                <table class="text-left w-full whitespace-nowrap">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Last Modified</th>
                            <th class="px-6 py-3">Size</th>
                            <th class="px-6 py-3">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($folders as $folder)
                            <tr class="border-gray-300 border-b">
                                <td class="px-6 py-3"><svg aria-hidden="true" focusable="false"
                                        class="icon-directory" viewBox="0 0 16 16" width="16" height="16"
                                        fill="currentColor"
                                        style="display:inline-block;user-select:none;vertical-align:center;overflow:visible;color:#9198a1;">
                                        <path
                                            d="M1.75 1A1.75 1.75 0 0 0 0 2.75v10.5C0 14.216.784 15 1.75 15h12.5A1.75 1.75 0 0 0 16 13.25v-8.5A1.75 1.75 0 0 0 14.25 3H7.5a.25.25 0 0 1-.2-.1l-.9-1.2C6.07 1.26 5.55 1 5 1H1.75Z">
                                        </path>
                                    </svg> <a class="cursor-pointer hover:underline" wire:click="setPath('{{$folder->name}}')">{{ $folder->name }}</a></td>
                                <td class="px-6 py-3">
                                    {{ date_format(date_create($repo->created_at), 'M d, Y, H:m A') }}</td>
                                <td class="px-6 py-3">-</td>
                                <td class="px-6 py-3">-</td>
                            </tr>
                        @endforeach
                        @foreach ($files as $file)
                            <tr class="border-gray-300 border-b">
                                <td class="px-6 py-3"><svg aria-hidden="true" focusable="false"
                                        class="color-fg-muted" viewBox="0 0 16 16" width="16" height="16"
                                        fill="currentColor"
                                        style="display: inline-block; user-select: none; vertical-align: text-bottom; overflow: visible;">
                                        <path
                                            d="M2 1.75C2 .784 2.784 0 3.75 0h6.586c.464 0 .909.184 1.237.513l2.914 2.914c.329.328.513.773.513 1.237v9.586A1.75 1.75 0 0 1 13.25 16h-9.5A1.75 1.75 0 0 1 2 14.25Zm1.75-.25a.25.25 0 0 0-.25.25v12.5c0 .138.112.25.25.25h9.5a.25.25 0 0 0 .25-.25V6h-2.75A1.75 1.75 0 0 1 9 4.25V1.5Zm6.75.062V4.25c0 .138.112.25.25.25h2.688l-.011-.013-2.914-2.914-.013-.011Z">
                                        </path>
                                    </svg> {{ $file->name }}</td>
                                <td class="px-6 py-3">
                                    {{ date_format(date_create($repo->created_at), 'M d, Y, H:m A') }}</td>
                                <td class="px-6 py-3">{{ $file->filesize }}</td>
                                <td class="px-6 py-3 text-center">
                                    <a href="{{ route('download', ['code' => $file->code]) }}"
                                        class="btn rounded-full h-8 w-8 flex items-center gap-x-2 bg-transparent text-gray-600 border-transparent border disabled:opacity-50 disabled:pointer-events-none hover:text-gray-800 hover:bg-gray-300 hover:border-gray-300 active:bg-gray-300 active:border-gray-300 active:text-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 btn-sm"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg aria-hidden="true" focusable="false"
                                            class="octicon octicon-download text-center" viewBox="0 0 16 16"
                                            width="16" height="16" fill="currentColor"
                                            style="display: inline-block; user-select: none; vertical-align: text-bottom; overflow: visible;">
                                            <path
                                                d="M2.75 14A1.75 1.75 0 0 1 1 12.25v-2.5a.75.75 0 0 1 1.5 0v2.5c0 .138.112.25.25.25h10.5a.25.25 0 0 0 .25-.25v-2.5a.75.75 0 0 1 1.5 0v2.5A1.75 1.75 0 0 1 13.25 14Z">
                                            </path>
                                            <path
                                                d="M7.25 7.689V2a.75.75 0 0 1 1.5 0v5.689l1.97-1.969a.749.749 0 1 1 1.06 1.06l-3.25 3.25a.749.749 0 0 1-1.06 0L4.22 6.78a.749.749 0 1 1 1.06-1.06l1.97 1.969Z">
                                            </path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>