<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Baza wiedzy (FAQ)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-xl font-bold mb-6 text-center">Najczęściej zadawane pytania</h3>

                <div class="space-y-4">
                    <details class="group [&_summary::-webkit-details-marker]:hidden border rounded-lg overflow-hidden">
                        <summary class="flex cursor-pointer items-center justify-between gap-1.5 bg-gray-50 p-4 text-gray-900 font-medium">
                            <span>Jak zresetować hasło?</span>
                            <svg class="h-5 w-5 shrink-0 transition duration-300 group-open:-rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>
                        <p class="mt-4 px-4 pb-4 leading-relaxed text-gray-700">
                            Aby zresetować hasło, wyloguj się i kliknij "Forgot your password?" na ekranie logowania. Link resetujący zostanie wysłany na Twój e-mail.
                        </p>
                    </details>

                    <details class="group [&_summary::-webkit-details-marker]:hidden border rounded-lg overflow-hidden">
                        <summary class="flex cursor-pointer items-center justify-between gap-1.5 bg-gray-50 p-4 text-gray-900 font-medium">
                            <span>Jak zgłosić urlop?</span>
                            <svg class="h-5 w-5 shrink-0 transition duration-300 group-open:-rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>
                        <p class="mt-4 px-4 pb-4 leading-relaxed text-gray-700">
                            Wnioski urlopowe składamy poprzez moduł "Moje Sprawy". Kliknij "Nowa sprawa" i wybierz typ "Wniosek urlopowy".
                        </p>
                    </details>

                    <details class="group [&_summary::-webkit-details-marker]:hidden border rounded-lg overflow-hidden">
                        <summary class="flex cursor-pointer items-center justify-between gap-1.5 bg-gray-50 p-4 text-gray-900 font-medium">
                            <span>Gdzie znajdę pasek wynagrodzeń?</span>
                            <svg class="h-5 w-5 shrink-0 transition duration-300 group-open:-rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>
                        <p class="mt-4 px-4 pb-4 leading-relaxed text-gray-700">
                            Paski wynagrodzeń są dostępne w module "Dane Personalne" w sekcji Dokumenty Finansowe (wymagane dodatkowe uprawnienia).
                        </p>
                    </details>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>