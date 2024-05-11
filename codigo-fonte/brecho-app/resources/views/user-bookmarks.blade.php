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
        <h1 class="text-3xl font-semibold tracking-tighter lg:text-5xl">Produtos Favoritados</h1>
        <p class="text-zinc-500 md:w-2/3 lg:w-1/2 xl:w-1/3 md:text-base/relaxed lg:text-xl/relaxed">
            Lista de produtos que você favoritou.
        </p>
    </div>

    @if(empty($products))
        <h2 class="text-center text-3xl">Nenhum produto favoritado :(</h2>
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
                        <div class="flex flex-col justify-between items-center w-full gap-0">
                            <button
                                onclick="addToCart('{{$product->id}}')"
                                data-product-id="{{ $product->id }}"
                                id="add-cart-btn-{{ $product->id }}"
                                class="flex w-fit justify-center items-center mx-auto px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-500 gap-2">
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

                            <div class="w-full flex justify-end">
                                <a
                                    id="show"
                                    href="/product/{{$product->id}}"
                                    class="flex w-fit justify-center items-center mr-1 text-sm font-medium text-center text-white">
                                    <svg height="24" width="24" fill="#000000" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9.75 12C9.75 10.7574 10.7574 9.75 12 9.75C13.2426 9.75 14.25 10.7574 14.25 12C14.25 13.2426 13.2426 14.25 12 14.25C10.7574 14.25 9.75 13.2426 9.75 12Z" fill="#1C274C"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 13.6394 2.42496 14.1915 3.27489 15.2957C4.97196 17.5004 7.81811 20 12 20C16.1819 20 19.028 17.5004 20.7251 15.2957C21.575 14.1915 22 13.6394 22 12C22 10.3606 21.575 9.80853 20.7251 8.70433C19.028 6.49956 16.1819 4 12 4C7.81811 4 4.97196 6.49956 3.27489 8.70433C2.42496 9.80853 2 10.3606 2 12ZM12 8.25C9.92893 8.25 8.25 9.92893 8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25Z" fill="#1C274C"></path> </g></svg>
                                </a>

                                <button
                                    onclick="removeBookmark('{{$product->id}}')"
                                    data-product-id="{{ $product->id }}"
                                    id="removeBookmarks"
                                    class="flex w-fit justify-center items-center text-sm font-medium text-center text-white">
                                    <svg fill="#454545" height="24" width="24" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.131 512.131" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M511.489,167.372c-7.573-84.992-68.16-146.667-144.107-146.667c-44.395,0-85.483,20.928-112.427,55.488 c-26.475-34.923-66.155-55.488-110.037-55.488c-75.691,0-136.171,61.312-144.043,145.856c-0.811,5.483-2.795,25.045,4.395,55.68 C15.98,267.532,40.62,308.663,76.759,341.41l164.608,144.704c4.011,3.541,9.067,5.312,14.08,5.312 c4.992,0,10.005-1.749,14.016-5.248L436.865,340.13c24.704-25.771,58.859-66.048,70.251-118.251 C514.391,188.514,511.66,168.268,511.489,167.372z"></path> </g> </g> </g></svg>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</main>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script>
    tippy('#removeBookmarks', {content: 'Remover dos favoritos', placement: 'right'});
    tippy('#show', {content: 'Visualizar detalhes', placement: 'right'});

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
                    color: "hsl(140, 100%, 27%)",
                    fontWeight: "bold"
                },
            }).showToast();
        }
    }

    const removeBookmark = async (product_id) => {
        const response = await fetch(`/remove-bookmark`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id,
            })
        });

        if (response.ok) {
            Toastify({
                text: "Produto removido dos favoritos!",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "hsl(143, 85%, 96%)",
                    borderRadius: "10px",
                    color: "hsl(140, 100%, 27%)",
                    fontWeight: "bold"
                },
            }).showToast();

            location.reload();
        }
    }
</script>

</body>

</html>
