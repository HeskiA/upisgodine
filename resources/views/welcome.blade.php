<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Upis godine</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite('resources/css/app.css')
    </head>
    <body class="antialiased">
        <div class="bg-gray-400/50 bg-gradient-to-bl from-gray-700/50 relative sm:flex sm:justify-center sm:items-center min-h-screen selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="bg-gray-500 mx-2 my-2 rounded sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        <a class="bg-white hover:bg-yellow-400">{{ auth()->user()->email}}</a>

                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-white hover:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Prijava</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-white hover:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registracija</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-left">
                    <h1 class="text-5xl bg-gray-500 p-5 rounded text-white">Upis godine</h1>
                </div>

                <div class="mt-16 bg-gray-500 px-5 py-5 rounded">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        <a href="#" class="scale-100 p-6 bg-gray-800/50 bg-gradient-to-bl from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <h2 class="mt-6 text-xl font-semibold text-white underline">O projektu</h2>
                                <p class="mt-4 text-white text-sm leading-relaxed">
                                    Upis godine je web aplikacija razvijena s ciljem olakšavanja i automatiziranja procesa upisa treće godine preddiplomskog studija na Fakultetu informatike i digitalnih tehnologija Sveučilišta u Rijeci.
                                </p>
                            </div>
                        </a>

                        <a href="#" class="scale-100 p-6 bg-gray-800/50 bg-gradient-to-bl from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <h2 class="mt-6 text-xl font-semibold text-white underline">Upis treće godine preddiplomskog studija</h2>
                                <p class="mt-4 text-white text-sm leading-relaxed">
                                    Studenti biraju jedan od tri ponuđena modula koji se izvode u akademskoj godini. Odabrani modul sadrži pet predmeta, a pet predmeta studenti imaju pravo izabrati iz drugih modula, iz grupe izbornih predmeta i iz <i>communis</i> predmeta.
                                </p>
                            </div>
                        </a>

                        <a href="#" class="scale-100 p-6 bg-gray-800/50 bg-gradient-to-bl from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <h2 class="mt-6 text-xl font-semibold text-white underline">Upute za studente</h2>
                                <p class="mt-4 text-white text-sm leading-relaxed">
                                    Prijavite se u aplikaciju i sortirajte predmete po prioritetu kako ih želite upisati. Nakon zaključavanja mogućnosti odabira i isteka roka za prigovore, bit će vam dostupan popis predmeta i modul u koji ste upisani.
                                </p>
                            </div>
                        </a>

                        <a href="#" class="scale-100 p-6 bg-gray-800/50 bg-gradient-to-bl from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <h2 class="mt-6 text-xl font-semibold text-white underline">Korištene tehnologije</h2>
                                <p class="mt-4 text-white text-sm leading-relaxed">
                                    Za izradu aplikacije korišten je Laravel framework i biblioteka Livewire. Korisničko sučelje je napravljeno koristeći Tailwind CSS biblioteku.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                        <div class="flex items-center gap-4">

                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                        Antonio Heski, 2023.
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
