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
        <h1 class="text-3xl font-semibold tracking-tighter lg:text-5xl">Produtos Disponíveis</h1>
        <p class="text-zinc-500 md:w-2/3 lg:w-1/2 xl:w-1/3 md:text-base/relaxed lg:text-xl/relaxed">
            Aqui você encontra produtos de qualidade e com preços acessíveis. Aproveite!
        </p>
    </div>


    <form class="flex w-full items-center justify-center space-x-2" method="GET">
        <input
            class="flex h-10 w-1/2 rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
            placeholder="Pesquisar"
            type="search"
            name="search"
            value="{{ request('search') }}"
        />
        <button
            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-zinc-800 text-primary-foreground hover:bg-zinc-900/90 h-10 px-4 py-2"
            type="submit"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="w-4 h-4"
            >
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
            </svg>
        </button>
    </form>

    @if($products->isEmpty())
        <h2 class="text-center text-3xl">Nenhum produto encontrado :(</h2>
    @endif

    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($products as $product)
            <div class="max-w-md bg-white border border-gray-200 rounded-lg shadow">
                <img height="300" width="300"
                     class="mx-auto mt-4 rounded-lg aspect-[1/1] object-cover object-center pointer-events-none"
                     src="/storage/{{$product->image}}" alt="imagem-produto"/>
                <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold text-center tracking-tight">{{$product->name}}</h5>

                    <p>Quantidade:
                        {{$product->quantity}}
                    </p>
                    <p>Categoria:
                        <span class="mb-3 w-1/2 text-white bg-blue-500 p-1 rounded-xl text-center font-bold">{{$product->category->name}}
                                            </span>
                    </p>

                    <p class="mb-3 font-normal text-gray-700">{{$product->description}}</p>

                    <p class="mb-3 font-bold text-center text-gray-700">R$ {{$product->price}}</p>
                    @if(Auth::user())
                        <button
                            onclick="addToCart('{{$product->id}}')"
                            data-product-id="{{ $product->id }}"
                            id="add-cart-btn-{{ $product->id }}"
                            class="flex w-fit justify-center mx-auto items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="lucide lucide-shopping-cart">
                                <circle cx="8" cy="21" r="1"/>
                                <circle cx="19" cy="21" r="1"/>
                                <path
                                    d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                            </svg>
                            Adicionar ao carrinho
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{ $products->links() }}
</main>

<script>

    const addToCart = async (product_id) => {
        const response = await fetch(`/add-to-cart`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id,
                quantity: 1
            })
        });

        if (response.ok) {
            Toastify({
                text: "Produto adicionado ao carrinho!",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "hsl(143, 85%, 96%)",
                    borderRadius: "10px",
                    color: "hsl(140, 100%, 27%)"
                },
            }).showToast();
        }
    }

</script>

</body>

</html>
