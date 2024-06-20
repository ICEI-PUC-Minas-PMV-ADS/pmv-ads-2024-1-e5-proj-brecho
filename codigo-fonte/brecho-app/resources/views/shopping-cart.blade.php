<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Brechó</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased bg-gray-100 h-screen">
<x-navbar/>

<main class="grid gap-6 p-4 lg:gap-10 lg:p-12">
    <div class="grid gap-4">
        <h1 class="text-3xl font-semibold tracking-tighter lg:text-5xl">Carrinho de Compras</h1>
        <p class="text-zinc-500 md:w-2/3 lg:w-1/2 xl:w-1/3 md:text-base/relaxed lg:text-xl/relaxed">
            Confira os produtos que você adicionou ao carrinho.
        </p>
    </div>

    @if (session('success'))
    <div class="flex items-center justify-center w-full">
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-lg text-teal-900 px-4 py-3 shadow-md w-1/3" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                    <p class="font-bold">
                        Sucesso!
                    </p>
                    <p class="text-sm font-bold">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="flex flex-row w-full items-start justify-evenly flex-wrap gap-4">
        <div class="flex flex-col lg:w-1/2 md:w-full">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Produto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Preço
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantidade
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ações
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(empty($products))
                        <tr>
                            <td colspan="6" class="text-center text-2xl py-6">
                                <h1>Nenhum produto adicionado :(</h1>

                                <a href="/" class="inline-flex bg-zinc-900 text-white font-bold items-center justify-center whitespace-nowrap rounded-md text-sm ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 mt-4">Voltar</a>
                            </td>
                        </tr>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 w-1/2 mx-auto mb-2 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <h5 class="text-red-500">{{ session('error') }}</h5>
                        </div>
                    @endif

                    @foreach($products as $product)
                        <tr class="odd:bg-white even:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <img src="/storage/{{ $product->image }}" alt="Imagem do produto" class="h-10 w-10 rounded-full">
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $product->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $product->price }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <form action="{{ route('decrease-quantity', ['product_id' => $product->id]) }}" method="POST" class="mr-2">
                                        @csrf
                                        <button type="submit" class="text-white bg-red-400 px-2 rounded-full hover:text-gray-900">-</button>
                                    </form>
                                    {{ $product->quantity }}
                                    <form action="{{ route('increase-quantity', ['product_id' => $product->id]) }}" method="POST" class="ml-2">
                                        @csrf
                                        <button type="submit" class="text-white bg-blue-400 px-2 rounded-full hover:text-gray-900">+</button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->price * $product->quantity }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('remove-from-cart', ['product_id' => $product->id]) }}" class="font-medium text-red-600">Remover</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                @if(!empty($products))
                    <div class="py-4 text-center text-xl font-bold text-green-600">Total: R$ {{ $total }}</div>
                @endif
            </div>
        </div>


        @if(!empty($products))
            <div class="flex flex-col rounded-lg border bg-white text-card-foreground shadow-sm w-full max-w-lg">
                <div class="p-6 flex flex-col items-center space-y-2">
                    <div class="text-center">
                        <h1 class="text-xl font-bold">Preencha os dados</h1>
                        <p class="text-sm leading-none font-medium text-gray-500 dark:text-gray-400">
                            Insira as informações abaixo para finalizar a compra.
                        </p>
                    </div>
                </div>
                <div class="p-6 flex flex-col space-y-4">
                    <form method="POST" action="/checkout">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <div class="grid grid-cols-1 gap-2">
                                <label for="address" class="block text-sm font-medium leading-5 peer">
                                    Logradouro
                                </label>
                                <input
                                    class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 h-10"
                                    id="address" name="address" required="">
                            </div>

                            <div class="grid grid-cols-1 gap-2">
                                <label for="number" class="block text-sm font-medium leading-5 peer">
                                    Número
                                </label>
                                <input
                                    type="number"
                                    min="0"
                                    class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 h-10"
                                    id="number" name="number">
                            </div>

                            <div class="grid grid-cols-1 gap-2">
                                <label for="complement" class="block text-sm font-medium leading-5 peer">
                                    Complemento
                                </label>
                                <input
                                    class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 h-10"
                                    id="complement" name="complement">
                            </div>

                            <div class="grid grid-cols-1 gap-2">
                                <label for="bairro" class="block text-sm font-medium leading-5 peer">
                                    Bairro
                                </label>
                                <input
                                    class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 h-10"
                                    id="bairro" name="bairro">
                            </div>

                            <div class="grid grid-cols-1 gap-2">
                                <label for="cep" class="block text-sm font-medium leading-5 peer">
                                    CEP
                                </label>
                                <input
                                    class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 h-10"
                                    id="cep" name="cep">
                            </div>

                            <div class="grid grid-cols-1 gap-2">
                                <label for="city" class="block text-sm font-medium leading-5 peer">
                                    Cidade
                                </label>
                                <input
                                    class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 h-10"
                                    id="city" name="city">
                            </div>

                            <div class="grid grid-cols-1 gap-2">
                                <label for="state" class="block text-sm font-medium leading-5 peer">
                                    Estado
                                </label>

                                <select name="state" id="state" class="flex w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 h-10">
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>

                            <button
                                class="inline-flex bg-zinc-900 text-white font-bold items-center justify-center whitespace-nowrap rounded-md text-sm ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full"
                                type="submit">
                                Checkout
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>

</main>
<script>
    $(document).ready(function(){
        $('[name=cep]').mask('00000-000');
    });
</script>
</body>

</html>
