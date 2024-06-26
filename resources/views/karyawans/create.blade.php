<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('karyawans.store') }}" method="POST" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="nama" :value="__('Nama')" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full"
                                required autofocus />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="jabatan" :value="__('Jabatan')" />
                            <x-text-input id="jabatan" name="jabatan" type="text" class="mt-1 block w-full"
                                required />
                            <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="gaji" :value="__('Gaji')" />
                            <x-text-input id="gaji" name="gaji" type="number" class="mt-1 block w-full"
                                required />
                            <x-input-error :messages="$errors->get('gaji')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Submit') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
