<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script
            src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
            crossorigin="anonymous"></script>
        <title>{{ config('app.name', 'Taskui - Gerenciamento de tempo') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/funcs.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>
        <style>
            /***** LOADING *****/
            .loading-dialog {
                position: fixed;
                background-color: rgba(60, 60, 60, 0.75);
                bottom: 0;
                cursor: default;
                display: none;
                overflow: hidden;
                padding: 0 0;
                text-align: center;
                width: 100%;
                height: 100%;
                z-index: 9999999;
            }

            .loading-dialog .loading-dialog-content .ui-dialog-content {
                font-size: 12px;
                font-weight: lighter;
                margin: auto;
                height: 50px;
            }

            .loading-dialog .loading-dialog-content {
                padding: 10px;
                margin-left: auto;
                margin-right: auto;
                margin-top: 14%;
                vertical-align: middle;
                width: 400px;
            }

            .loading-dialog .loading-dialog-content span {
                color: #fff;
                float: left;
                margin-left: 20px;
                text-align: left;
                line-height: 18px;
                font-weight: bold;
            }

            .loading-dialog .loading-dialog-content img {
                float: left;
                vertical-align: middle;
                margin-left: 24px;
                width: 24px;
            }

            .loading-dialog .loading-dialog-content .loading-progress {
                display: none;
                width: 100%;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
    <div class="loading-dialog">
        <div class="loading-dialog-content">
            <div class="ui-dialog-content">
                <img src="<?php echo asset('/img/loading.gif') ?>" />
                <span>
                        O sistema está processando as informações. <br />
                        Por favor aguarde um momento...
                    </span>
                <progress class="loading-progress"></progress>
            </div>
        </div>
    </div>
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-dropdown')


            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

                    {{ $header }}
                </div>
            </header>
            <div id="messageFlash" class="grid grid-cols-5 gap-2">
                </div>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
