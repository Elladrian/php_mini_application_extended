<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zarządzanie Pluginami') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">Instaluj nowy plugin</h2>
                    <p class="mt-1 text-sm text-gray-600">Wybierz plik .zip zawierający strukturę pluginu.</p>
                </header>

                <form action="{{ route('plugins.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Plik ZIP</label>
                        <input name="plugin_file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="file_input" type="file" accept=".zip" required>
                    </div>
                    <x-primary-button>{{ __('Zainstaluj') }}</x-primary-button>
                </form>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header class="mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Zainstalowane Rozszerzenia</h2>
                </header>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nazwa</th>
                            <th scope="col" class="px-6 py-3">Wersja</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Akcje</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($plugins as $plugin)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $plugin->display_name }}
                                    <div class="text-xs text-gray-500 font-normal">({{ $plugin->name }})</div>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $plugin->version }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($plugin->is_active)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Aktywny</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Wyłączony</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 flex items-center space-x-4">
                                    <form action="{{ route('plugins.toggle', $plugin->id) }}" method="POST">
                                        @csrf
                                        @if($plugin->is_active)
                                            <button type="submit" class="font-medium text-yellow-600 hover:underline">Wyłącz</button>
                                        @else
                                            <button type="submit" class="font-medium text-green-600 hover:underline">Włącz</button>
                                        @endif
                                    </form>

                                    <form action="{{ route('plugins.destroy', $plugin->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten plugin? Tej operacji nie można cofnąć.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:underline">Usuń</button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center">Brak zainstalowanych pluginów.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
