<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oferty - MiniApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

<nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <a href="{{ url('/') }}" class="font-bold text-xl text-red-500">MiniApp</a>
                <a href="{{ url('/oferta') }}" class="text-gray-900 border-b-2 border-red-500 px-1 pt-1 text-sm font-medium h-full flex items-center">Oferta</a>
                <a href="{{ url('/kontakt') }}" class="text-gray-500 hover:text-gray-700 hover:border-gray-300 border-b-2 border-transparent px-1 pt-1 text-sm font-medium h-full flex items-center transition">Kontakt</a>
            </div>

            <div class="flex items-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">Twój Profil</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 mr-4">Logowanie</a>
                    <a href="{{ route('register') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium transition">Rejestracja</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @auth
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 border border-gray-200">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">➕ Dodaj nową ofertę</h2>

                    <form action="{{ url('/oferta/dodaj') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        <div class="md:col-span-2">
                            <label class="block font-medium text-sm text-gray-700">Tytuł oferty</label>
                            <input type="text" name="title" required class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 shadow-sm">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block font-medium text-sm text-gray-700">Opis szczegółowy</label>
                            <textarea name="description" rows="3" required class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 shadow-sm"></textarea>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Cena (PLN)</label>
                            <input type="number" step="0.01" name="price" required class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500 shadow-sm">
                        </div>

                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-gray-800 hover:bg-black text-white font-bold py-2 px-4 rounded shadow-md transition transform hover:scale-105">
                                Opublikuj ofertę
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mb-8 rounded shadow" role="alert">
                <p class="font-bold">Chcesz sprzedawać?</p>
                <p>Zaloguj się, aby dodać własną ofertę. <a href="{{ route('login') }}" class="underline hover:text-blue-900">Przejdź do logowania</a></p>
            </div>
        @endauth

        <h2 class="text-3xl font-extrabold text-gray-900 mb-6">Aktualne ogłoszenia</h2>

        @if($offers->isEmpty())
            <div class="text-center py-10 bg-white rounded-lg shadow">
                <p class="text-gray-500 text-lg">Brak ofert w bazie.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($offers as $offer)
                    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg hover:shadow-xl transition duration-300 flex flex-col h-full border border-gray-100">
                        <div class="p-6 flex-grow">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $offer->title }}</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit($offer->description, 100) }}</p>
                        </div>
                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-xs text-gray-500">Dodano: {{ $offer->created_at->format('Y-m-d') }}</span>
                            <span class="text-xl font-bold text-green-600">{{ $offer->price }} zł</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>

</body>
</html>
