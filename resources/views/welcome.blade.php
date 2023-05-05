<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Prova Técnica – Back-End - Unicampo</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="mt-2 bg-white p-6 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                        <div>
                            <div class="flex justify-between">
                                <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>

                                <button type="button" onclick="window.location.href='{{ url('/api/doc') }}'" class="justify-center rounded-md bg-green-600 px-3 mt-5 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Acessar Swagger</button>
                            </div>

                            <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Formulário de cadastro</h2>

                            <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Formulário de cadastro utilizando autocomplete e diretiva de busca de endereços Google (pelo CEP).
                            </p>

                            <form class="mt-4 space-y-6" action="/api/pessoa/cadastrar" method="POST">
                                @csrf
                               <div>
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Nome completo</label>
                                    <div class="mt-0">
                                        <input id="nome" name="nome" type="nome" autocomplete="nome" required class="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                               </div>

                                <div>
                                    <label for="data_nascimento" class="block text-sm font-medium leading-6 text-gray-900">Data de nascimento</label>
                                    <div class="mt-0">
                                        <input id="data_nascimento" name="data_nascimento" type="data_nascimento" autocomplete="data_nascimento" required class="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div class="grid grid-cols-4 gap-4">
                                    <div >
                                    <label for="Tipo" class="block text-sm font-medium leading-6 text-gray-900">Tipo</label>
                                        <div class="flex ">
                                            <div class="flex items-center gap-x-3 mr-4">
                                                <input id="cpf" name="tipo" value="F" type="radio" required class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                <label for="cpf" class="block text-sm font-medium leading-6 text-gray-900">CPF</label>
                                            </div>
                                            <div class="flex items-center gap-x-3">
                                                <input id="cnpj" name="tipo" value="J" type="radio" required class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                <label for="cnpj" class="block text-sm font-medium leading-6 text-gray-900">CNPJ</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-3">
                                        <label for="cpf_cnpj" class="block text-sm font-medium leading-6 text-gray-900">Documento</label>
                                        <div class="mt-0">
                                            <input id="cpf_cnpj" name="cpf_cnpj" type="cpf_cnpj" autocomplete="cpf_cnpj" required disabled class="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                                    <div class="mt-0">
                                        <input id="email" name="email" type="email" autocomplete="email" required class="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div>
                                    <label for="endereco" class="block text-sm font-medium leading-6 text-gray-900">Endereço</label>
                                    <div class="mt-0">
                                        <input id="endereco" name="endereco" type="endereco" autocomplete="endereco" required class="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div>
                                    <label for="latitude" class="block text-sm font-medium leading-6 text-gray-900">Latitude</label>
                                    <div class="mt-0">
                                        <input id="latitude" name="latitude" type="latitude" autocomplete="latitude" required class="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div>
                                    <label for="longitude" class="block text-sm font-medium leading-6 text-gray-900">Longitude</label>
                                    <div class="mt-0">
                                        <input id="longitude" name="longitude" type="longitude" autocomplete="longitude" required class="block p-2 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 mt-5 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                        <div class="flex items-center gap-4">
                            <a href="https://github.com/carlospessin/unicampo-backend" target="_blank" class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                By Carlos Pessin
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ config('app.key_google_api') }}&libraries=places"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                var autocomplete;
                autocomplete = new google.maps.places.Autocomplete((document.getElementById('endereco')), {
                    types: ['geocode'],
                });
                
                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var near_place = autocomplete.getPlace();
                });

                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    $('#latitude').val(place.geometry['location'].lat());
                    $('#longitude').val(place.geometry['location'].lng());
                })
            });
        </script>

        <script>
        $(document).ready(function() {
            var cpf_cnpj = $('#cpf_cnpj');
            var cpf = $('#cpf');
            var cnpj = $('#cnpj');

            cpf.click(function() {
                $(cpf_cnpj).removeAttr('disabled');
                cpf_cnpj.inputmask('999.999.999-99');
            });

            cnpj.click(function() {
                $(cpf_cnpj).removeAttr('disabled');
                cpf_cnpj.inputmask('99.999.999/9999-99');
            });

            $('#data_nascimento').inputmask('99/99/9999');
        });
        </script>

    </body>
</html>
