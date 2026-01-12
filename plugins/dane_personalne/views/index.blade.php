<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Moje Dane Personalne') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Karta Pracownika</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-lg border">
                            <span class="text-gray-500 text-sm block">Imię i Nazwisko</span>
                            <span class="text-xl font-bold">{{ Auth::user()->name }}</span>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border">
                            <span class="text-gray-500 text-sm block">Adres E-mail</span>
                            <span class="text-lg">{{ Auth::user()->email }}</span>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border">
                            <span class="text-gray-500 text-sm block">Data dołączenia</span>
                            <span class="text-lg">{{ Auth::user()->created_at->format('d.m.Y') }}</span>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border">
                            <span class="text-gray-500 text-sm block">Status konta</span>
                            <span class="text-green-600 font-bold">Aktywne</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>