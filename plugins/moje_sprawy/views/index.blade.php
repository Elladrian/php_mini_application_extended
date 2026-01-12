<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Moje Sprawy') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Lista spraw do załatwienia</h3>

                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4">#</th>
                            <th scope="col" class="px-6 py-4">Temat</th>
                            <th scope="col" class="px-6 py-4">Status</th>
                            <th scope="col" class="px-6 py-4">Data</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b dark:border-neutral-500">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">1</td>
                            <td class="whitespace-nowrap px-6 py-4">Złożenie wniosku urlopowego</td>
                            <td class="whitespace-nowrap px-6 py-4 text-green-600">Zakończone</td>
                            <td class="whitespace-nowrap px-6 py-4">2024-01-10</td>
                        </tr>
                        <tr class="border-b dark:border-neutral-500">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">2</td>
                            <td class="whitespace-nowrap px-6 py-4">Rozliczenie delegacji</td>
                            <td class="whitespace-nowrap px-6 py-4 text-yellow-600">W toku</td>
                            <td class="whitespace-nowrap px-6 py-4">2024-01-12</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>