<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DriveHub') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Outfit', sans-serif; }
            .glass-nav {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }
            .dark .glass-nav {
                background: rgba(0, 0, 0, 0.9);
            }
            .text-gradient {
                background: linear-gradient(to right, #f53003, #ff8c00);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            
            /* Force dark mode on all elements */
            :root.dark {
                color-scheme: dark;
            }
            
            :root.dark body {
                background-color: #000000 !important;
                color: #ffffff !important;
            }
        </style>
        <script>
            // Force dark mode always
            document.documentElement.classList.add('dark');
            document.documentElement.style.colorScheme = 'dark';
            localStorage.setItem('theme', 'dark');
        </script>
    </head>
    <body class="bg-black text-white antialiased selection:bg-[#f53003] selection:text-white">
        <!-- Header -->
        <header class="fixed top-0 z-50 w-full glass-nav border-b border-gray-200/50 dark:border-white/10 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 sm:h-20">
                    <a href="/" class="flex items-center gap-2 group cursor-pointer">
                        <div class="bg-[#f53003] text-white p-2 rounded-lg transform group-hover:rotate-12 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 sm:h-6 w-5 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-lg sm:text-2xl font-extrabold tracking-tight">Drive<span class="text-[#f53003]">Hub</span></span>
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-24 sm:pt-0 bg-black px-4">
            <div class="w-full sm:max-w-md mt-4 sm:mt-6 px-5 sm:px-8 py-6 sm:py-8 bg-[#1a1a1a] dark:bg-[#1a1a1a] shadow-2xl overflow-hidden sm:rounded-2xl border border-white/10 rounded-xl">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-black text-gray-400 py-8 border-t border-gray-800 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
                <p>&copy; 2024 DriveHub Indonesia. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
