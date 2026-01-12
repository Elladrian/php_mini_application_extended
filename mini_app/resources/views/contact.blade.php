<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt - MiniApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

<nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <a href="{{ url('/') }}" class="font-bold text-xl text-red-500">MiniApp</a>
                <a href="{{ url('/oferta') }}" class="text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 border-transparent px-1 pt-1 text-sm font-medium h-full flex items-center transition">Oferta</a>
                <a href="{{ url('/kontakt') }}" class="text-gray-900 border-b-2 border-red-500 px-1 pt-1 text-sm font-medium h-full flex items-center">Kontakt</a>
            </div>

            <div class="flex items-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">Twój Profil</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 mr-4">Logowanie</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
            <div class="p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6 border-b pb-4">Skontaktuj się z nami</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Dane teleadresowe</h3>
                        <p class="text-gray-600 mb-1">📍 ul. Programistów 10</p>
                        <p class="text-gray-600 mb-1">00-001 Warszawa</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Infolinia</h3>
                        <p class="text-green-600 font-bold text-xl">📞 +48 123 456 789</p>
                        <p class="text-gray-500 text-sm">Czynne pn-pt: 8:00 - 16:00</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <h3 class="text-lg font-bold mb-3">Napisz do nas</h3>
                    <p class="mb-4 text-gray-600">Masz pytania dotyczące oferty? Wyślij nam wiadomość e-mail.</p>
                    <a href="mailto:kontakt@miniapp.pl" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 transition">
                        ✉️ Wyślij Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
