<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Email - MiniApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

<nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <a href="{{ route('dashboard') }}" class="font-bold text-xl text-red-500">MiniApp</a>

                <a href="{{ route('offer') }}" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition">Oferta</a>
                <a href="{{ route('contact') }}" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition">Kontakt</a>
                <a href="{{ route('email.test') }}" class="text-gray-900 bg-gray-100 px-3 py-2 rounded-md text-sm font-medium border border-gray-300">Test Email</a>
            </div>

            <div class="flex items-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">Panel (Dashboard)</a>
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
            <div class="p-8 text-center">

                <div class="mb-6">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full {{ $status == 'success' ? 'bg-green-100' : 'bg-red-100' }}">
                        @if($status == 'success')
                            <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        @else
                            <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        @endif
                    </div>
                </div>

                <h2 class="text-2xl font-bold mb-4 text-gray-900">Status biblioteki PHPMailer</h2>

                <div class="p-4 rounded-md {{ $status == 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' }}">
                    {{ $message }}
                </div>

                <div class="mt-8">
                    <p class="text-gray-500 text-sm mb-4">
                        Ten widok potwierdza, że <strong>Composer</strong> poprawnie zainstalował zależności i plik <code>autoload.php</code> działa.
                    </p>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Wróć do Panelu
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
