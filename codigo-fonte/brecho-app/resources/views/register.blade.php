<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brechó</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased bg-gray-100 h-screen">
<x-navbar />

<section class="mt-5">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Registre-se
                </h1>
                <form class="space-y-4 md:space-y-6" method="POST" action="/auth/register">
                    @csrf

                    @error('email')
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <h5 class="text-red-500">{{ $message }}</h5>
                    </div>
                    @enderror

                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900">Nome</label>
                        <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>

                    <div>
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900">Sobrenome</label>
                        <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>

                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Telefone</label>
                        <input type="tel" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Senha</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required="">
                    </div>

                    <button type="submit" class="w-full text-white font-bold bg-blue-600 hover:bg-primary-700 focus:ring-2 focus:outline-none focus:ring-primary-300 rounded-lg text-sm px-5 py-2.5 text-center">Registrar</button>
                    <p class="text-sm text-gray-500">
                        Já possui conta? <a href="/auth" class="font-medium text-blue-600 hover:underline">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $('[name=phone]').mask('(00) 00000-0000');
    });
</script>

</body>
</html>
