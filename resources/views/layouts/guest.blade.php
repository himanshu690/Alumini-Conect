<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AlmaConnect') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50 dark:bg-gray-950">
        <div class="min-h-screen flex">
            
            <!-- Left Side: Visual Brand Panel (Visible on md and up) -->
            <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-tr from-slate-900 via-indigo-950 to-blue-900 text-white overflow-hidden items-center justify-center p-12">
                <!-- Abstract glowing backgrounds -->
                <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-blue-500/20 blur-3xl"></div>
                <div class="absolute -bottom-40 -right-40 w-96 h-96 rounded-full bg-purple-500/20 blur-3xl"></div>
                
                <div class="relative z-10 max-w-lg space-y-8">
                    <!-- Brand Logo / Name -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/20 shadow-md">
                            <span class="font-extrabold text-xl text-blue-400">A</span>
                        </div>
                        <span class="font-bold text-2xl tracking-tight bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">AlmaConnect</span>
                    </div>

                    <!-- Large Slogan -->
                    <div class="space-y-4">
                        <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight">
                            Bridging generations of <span class="bg-gradient-to-r from-blue-400 to-indigo-300 bg-clip-text text-transparent">excellence</span>.
                        </h1>
                        <p class="text-gray-350 dark:text-gray-300 text-base leading-relaxed">
                            Reconnect with fellow graduates, explore professional mentorship opportunities, and participate in community interactions and campus-wide events.
                        </p>
                    </div>

                    <!-- Visual Stats cards -->
                    <div class="grid grid-cols-2 gap-4 pt-6">
                        <!-- Stat Card 1 -->
                        <div class="p-4 bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 shadow-sm space-y-1">
                            <span class="text-xs text-gray-400 font-medium">Active Alumni</span>
                            <h4 class="text-2xl font-bold text-blue-400">5,000+</h4>
                        </div>
                        <!-- Stat Card 2 -->
                        <div class="p-4 bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 shadow-sm space-y-1">
                            <span class="text-xs text-gray-400 font-medium">Expert Mentors</span>
                            <h4 class="text-2xl font-bold text-indigo-350">240+</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Auth Form Panel -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-6 sm:p-12 bg-white dark:bg-gray-900">
                <div class="w-full max-w-md space-y-8">
                    
                    <!-- Top header -->
                    <div class="text-center lg:text-left space-y-2">
                        <!-- Tiny logo for mobile -->
                        <div class="lg:hidden flex justify-center mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-600/30">
                                <span class="font-extrabold text-xl text-white">A</span>
                            </div>
                        </div>
                    </div>

                    <!-- Auth Box Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700/50 p-6 sm:p-8 shadow-sm">
                        {{ $slot }}
                    </div>

                    <!-- Footer disclaimer -->
                    <p class="text-center text-xs text-gray-400">
                        &copy; {{ date('Y') }} AlmaConnect. All rights reserved.
                    </p>
                </div>
            </div>

        </div>
    </body>
</html>
