<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Data Karyawan') }}
            </h2>
            <button class="border border-blue-500 hover:bg-blue-500 hover:text-white px-4 py-2 rounded-md">
                <a href="{{ route('karyawans.create') }}" class="text-white">Tambah Karyawan</a>
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white-900">
                    <form action="{{ route('karyawans.index') }}" method="GET" class="mb-4 flex">
                        <div class="relative flex w-full">
                            <input type="text" name="search" placeholder="Cari Karyawan"
                                value="{{ request()->query('search') }}"
                                class="dark:bg-gray-800 border rounded-l px-4 py-2 text-white w-full">
                            <x-primary-button type="submit"
                                class="absolute inset-y-0 right-0 px-4 py-2 bg--500 text-white rounded-r rounded-l">
                                <svg class="w-4 h-4 text-black dark:text-black" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </x-primary-button>
                        </div>
                    </form>

                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                            <tr class="dark:bg-gray-800">
                                <th class="border-b font-medium p-4 text-left text-white">
                                    <a href="{{ route('karyawans.index', array_merge(request()->query(), ['sortField' => 'nama', 'sortOrder' => $sortField === 'nama' && $sortOrder === 'asc' ? 'desc' : 'asc'])) }}">
                                        Nama
                                        @if ($sortField === 'nama')
                                            @if ($sortOrder === 'asc')
                                                &uarr;
                                            @else
                                                &darr;
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th class="border-b font-medium p-4 text-left text-white">
                                    <a href="{{ route('karyawans.index', array_merge(request()->query(), ['sortField' => 'jabatan', 'sortOrder' => $sortField === 'jabatan' && $sortOrder === 'asc' ? 'desc' : 'asc'])) }}">
                                        Jabatan
                                        @if ($sortField === 'jabatan')
                                            @if ($sortOrder === 'asc')
                                                &uarr;
                                            @else
                                                &darr;
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th class="border-b font-medium p-4 text-left text-white">
                                    <a href="{{ route('karyawans.index', array_merge(request()->query(), ['sortField' => 'gaji', 'sortOrder' => $sortField === 'gaji' && $sortOrder === 'asc' ? 'desc' : 'asc'])) }}">
                                        Gaji
                                        @if ($sortField === 'gaji')
                                            @if ($sortOrder === 'asc')
                                                &uarr;
                                            @else
                                                &darr;
                                            @endif
                                        @endif
                                    </a>
                                </th>
                                <th class="border-b font-medium p-4 text-left text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
                            @foreach ($karyawans as $karyawan)
                                <tr>
                                    <td class="border-b border-slate-100 p-4 text-white">{{ $karyawan->nama }}</td>
                                    <td class="border-b border-slate-100 p-4 text-white">{{ $karyawan->jabatan }}</td>
                                    <td class="border-b border-slate-100 p-4 text-white">{{ $karyawan->gaji }}</td>
                                    <td class="border-b border-slate-100 p-4 text-white">
                                        <div class="flex gap-4">
                                            <form action="{{ route('karyawans.edit', $karyawan->id) }}" method="GET" class="inline">
                                                @csrf
                                                <button type="submit" class="border border-yellow-500 hover:bg-yellow-500 hover:text-white px-4 py-2 rounded-md">Edit</button>
                                            </form>
                                            <form action="{{ route('karyawans.destroy', $karyawan->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border border-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-md">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $karyawans->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
