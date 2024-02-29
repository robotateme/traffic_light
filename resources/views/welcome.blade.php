<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body>
<div class="flex flex-col">
    <div class="grid grid-cols-2 gap-2 justify-center">
        <div class="">
            <div class="traffic_light">
                <span class="red_light active"></span>
                <span class="yellow_light"></span>
                <span class="green_light"></span>
            </div>
        </div>
        <div class="">
            <div id="button_start">
                <a href="#"
                   class="bg-blue-900 / 0 scale-100 p-6 from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <h2 class="text-center text-white">Вперёд!</h2>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         class="self-center shrink-0 stroke-white w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                    </svg>
                </a>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table id="log_table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            </table>
        </div>
    </div>
</div>
</body>
</html>
