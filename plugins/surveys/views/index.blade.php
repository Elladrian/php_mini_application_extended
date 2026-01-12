<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ankiety i Ewaluacje') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h3 class="text-lg font-bold">Dostępne ewaluacje okresowe</h3>
                        <p class="text-sm text-gray-500">Wypełnij poniższe ankiety przed upływem terminu.</p>
                    </div>

                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b bg-gray-100 font-medium">
                        <tr>
                            <th scope="col" class="px-6 py-4">Nazwa Ankiety</th>
                            <th scope="col" class="px-6 py-4">Termin</th>
                            <th scope="col" class="px-6 py-4">Status</th>
                            <th scope="col" class="px-6 py-4">Akcja</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">Ocena satysfakcji pracownika 2024</td>
                            <td class="whitespace-nowrap px-6 py-4">2024-02-28</td>
                            <td class="whitespace-nowrap px-6 py-4 text-red-600 font-bold">Wymagana</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <button class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-700">Wypełnij</button>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">Ewaluacja szkolenia BHP</td>
                            <td class="whitespace-nowrap px-6 py-4">Bezterminowo</td>
                            <td class="whitespace-nowrap px-6 py-4 text-green-600">Ukończono</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="text-gray-400">Brak akcji</span>
                            </td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">Ankieta preferencji żywieniowych</td>
                            <td class="whitespace-nowrap px-6 py-4">2024-03-15</td>
                            <td class="whitespace-nowrap px-6 py-4 text-yellow-600">W toku</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <button class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-700">Kontynuuj</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>