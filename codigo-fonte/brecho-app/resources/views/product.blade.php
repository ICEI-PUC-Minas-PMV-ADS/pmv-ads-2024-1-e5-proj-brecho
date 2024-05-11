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

<main class="mt-5 p-4 flex flex-col justify-center w-full items-center">

    <div class="w-full">
            <div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow">
                <div class="flex flex-row p-4">
                    <img height="400" width="400"
                         class="m-5 rounded-lg aspect-[1/1] object-cover object-center pointer-events-none"
                         src="/storage/{{$product->image}}" alt="imagem-produto"/>

                    <div class="flex flex-col mx-auto justify-center">
                        <h5 class="mb-2 text-3xl font-bold text-center tracking-tight">{{$product->name}}</h5>


                        @if($average_rating)
                        <section class="flex flex-row justify-center">
                            <svg fill="#ffdd00" viewBox="0 0 1024 1024" width="24" height="24" xmlns="http://www.w3.org/2000/svg" class="icon"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M908.1 353.1l-253.9-36.9L540.7 86.1c-3.1-6.3-8.2-11.4-14.5-14.5-15.8-7.8-35-1.3-42.9 14.5L369.8 316.2l-253.9 36.9c-7 1-13.4 4.3-18.3 9.3a32.05 32.05 0 0 0 .6 45.3l183.7 179.1-43.4 252.9a31.95 31.95 0 0 0 46.4 33.7L512 754l227.1 119.4c6.2 3.3 13.4 4.4 20.3 3.2 17.4-3 29.1-19.5 26.1-36.9l-43.4-252.9 183.7-179.1c5-4.9 8.3-11.3 9.3-18.3 2.7-17.5-9.5-33.7-27-36.3z"></path> </g></svg>
                            <span class="text-yellow-500 font-bold">{{ $average_rating }}</span>
                        </section>
                        @endif

                        <p>Quantidade:
                            {{$product->quantity}}
                        </p>

                        <p>Categoria:
                            <span class="mb-3 w-1/2 text-white bg-blue-500 p-1 rounded-xl text-center font-bold">{{$product->category->name}}</span>
                        </p>

                        <p class="mb-3 font-normal text-gray-700">Descrição: {{$product->description}}</p>

                        <p class="mb-3 font-bold text-2xl text-center text-blue-400">R$ {{$product->price}}</p>

                        <div class="w-full">
                            @if(Auth::user())
                                <div class="flex flex-row justify-between items-center w-full gap-4">
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

                                    <button
                                        onclick="addBookmark('{{$product->id}}')"
                                        data-product-id="{{ $product->id }}"
                                        id="addBookmarks"
                                        class="flex w-fit justify-center items-center text-sm font-medium text-center text-white">
                                        <svg fill="#ff0000" height="24" width="24" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.131 512.131" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M511.489,167.372c-7.573-84.992-68.16-146.667-144.107-146.667c-44.395,0-85.483,20.928-112.427,55.488 c-26.475-34.923-66.155-55.488-110.037-55.488c-75.691,0-136.171,61.312-144.043,145.856c-0.811,5.483-2.795,25.045,4.395,55.68 C15.98,267.532,40.62,308.663,76.759,341.41l164.608,144.704c4.011,3.541,9.067,5.312,14.08,5.312 c4.992,0,10.005-1.749,14.016-5.248L436.865,340.13c24.704-25.771,58.859-66.048,70.251-118.251 C514.391,188.514,511.66,168.268,511.489,167.372z"></path> </g> </g> </g></svg>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="w-full">
            <div class="flex flex-row p-4">
                <div class="flex flex-col mx-auto justify-center">
                    <h5 class="mb-2 text-3xl font-bold text-center tracking-tight">Avaliações</h5>
                </div>
            </div>

        <form method="POST" action="{{ route('product.review', $product->id) }}">
            @csrf
            <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50">
                <div class="px-4 py-2 bg-white rounded-t-lg">
                    <textarea name="comment" rows="4" class="w-full px-2 text-sm text-gray-900 bg-white border-0 focus:ring-0" placeholder="Escreva um comentário..." required></textarea>
                </div>
                <div class="flex items-center justify-between px-3 py-2 border-t">
                    <label class="rating-label ml-auto">
                        <input
                            class="rating bg-gray-100 rounded-lg"
                            name="rating"
                            max="5"
                            oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)"
                            step="1"
                            style="--value:5"
                            type="range"
                            value="5">
                    </label>

                    <button type="submit" class="ml-auto inline-flex items-center py-2.5 px-4 text-xs font-bold text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-800">
                        Enviar
                    </button>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($reviews as $review)
                <div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow mt-5">
                    <div class="flex flex-row p-4">
                        <div class="flex flex-col justify-start text-left">
                            <p class="mb-3 font-normal text-gray-700">Usuário: {{$review->user->getFilamentName()}}</p>
                            <h5 class="mb-2 text-3xl font-bold tracking-tight">{{$review->title}}</h5>
                            <p class="mb-3 font-normal text-gray-700">Avaliação: {{$review->rating}}</p>
                            <p class="mb-3 font-normal text-gray-700 break-all text-wrap w-full">Comentário: {{$review->comment}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


            <div class="mt-2">
                {{ $reviews->links() }}
            </div>
        </div>
</main>

<script>
    tippy('#addBookmarks', {content: 'Adicionar aos favoritos', placement: 'right'});
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

    const addBookmark = async (product_id) => {
        const response = await fetch(`/add-bookmark`, {
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
                text: "Produto adicionado aos favoritos!",
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
</script>

</body>

<style>
    .rating {
        --dir: right;
        --fill: gold;
        --fillbg: #fff;
        --heart: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.328l-1.453-1.313q-2.484-2.25-3.609-3.328t-2.508-2.672-1.898-2.883-0.516-2.648q0-2.297 1.57-3.891t3.914-1.594q2.719 0 4.5 2.109 1.781-2.109 4.5-2.109 2.344 0 3.914 1.594t1.57 3.891q0 1.828-1.219 3.797t-2.648 3.422-4.664 4.359z"/></svg>');
        --star: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.25l-6.188 3.75 1.641-7.031-5.438-4.734 7.172-0.609 2.813-6.609 2.813 6.609 7.172 0.609-5.438 4.734 1.641 7.031z"/></svg>');
        --stars: 5;
        --starsize: 2rem;
        --symbol: var(--star);
        --value: 1;
        --w: calc(var(--stars) * var(--starsize));
        --x: calc(100% * (var(--value) / var(--stars)));
        block-size: var(--starsize);
        inline-size: var(--w);
        position: relative;
        touch-action: manipulation;
        -webkit-appearance: none;
    }
    [dir="rtl"] .rating {
        --dir: left;
    }
    .rating::-moz-range-track {
        background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
        block-size: 100%;
        mask: repeat left center/var(--starsize) var(--symbol);
    }
    .rating::-webkit-slider-runnable-track {
        background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
        block-size: 100%;
        mask: repeat left center/var(--starsize) var(--symbol);
        -webkit-mask: repeat left center/var(--starsize) var(--symbol);
    }
    .rating::-moz-range-thumb {
        height: var(--starsize);
        opacity: 0;
        width: var(--starsize);
    }
    .rating::-webkit-slider-thumb {
        height: var(--starsize);
        opacity: 0;
        width: var(--starsize);
        -webkit-appearance: none;
    }
    .rating, .rating-label {
        display: block;
        font-family: ui-sans-serif, system-ui, sans-serif;
    }
    .rating-label {
        margin-block-end: 1rem;
    }
</style>

</html>
