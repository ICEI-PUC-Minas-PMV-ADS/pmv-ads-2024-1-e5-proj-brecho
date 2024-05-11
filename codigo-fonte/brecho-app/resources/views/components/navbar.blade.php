<nav class="sticky z-40 top-0 bg-gray/80 backdrop-blur-lg border-b border-border">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between">

            <div class="flex space-x-4">
                <div>
                    <a href="#" class="flex items-center py-5 px-2 text-gray-700 text-2xl hover:text-gray-900">
                        <span class="font-bold">Brechó</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-1 font-bold">
                    <a href="/" class="block py-2 px-4 text-sm rounded-lg hover:bg-gray-200">Produtos</a>

                    @if(Auth::user() && Auth::user()->is_admin)
                        <a href="/admin" class="block py-2 px-4 text-sm rounded-lg hover:bg-gray-200">Administração</a>
                    @endif

                </div>
            </div>

            <div class="hidden md:flex items-center space-x-4 font-bold">
                @auth

                    <h5>Olá, {{ Auth::user()->first_name }}!</h5>

                    <a id="shoppingCart" href="/shopping-cart">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-shopping-cart">
                            <circle cx="8" cy="21" r="1"/>
                            <circle cx="19" cy="21" r="1"/>
                            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                        </svg>
                    </a>

                <a id="bookmarks" class="mt-0.5" href="/user-bookmarks">
                    <svg fill="#000000" height="24  " width="24 " version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-21.74 -21.74 260.89 260.89" xml:space="preserve" stroke="#000000" stroke-width="8.478912"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M194.078,22.682c-10.747-8.193-22.606-12.348-35.248-12.348c-15.951,0-33.181,6.808-50.126,19.754 C91.759,17.142,74.529,10.334,58.578,10.334c-12.642,0-24.501,4.155-35.248,12.348C7.606,34.671-0.24,49.8,0.006,67.648 c0.846,61.117,100.093,133.233,104.317,136.273l4.381,3.153l4.381-3.153c4.225-3.04,103.472-75.156,104.317-136.273 C217.648,49.8,209.802,34.671,194.078,22.682z M153.833,149.017c-18.374,18.48-36.915,33.188-45.129,39.453 c-8.214-6.265-26.755-20.972-45.129-39.453c-31.479-31.661-48.274-59.873-48.57-81.585c-0.178-13.013,5.521-23.749,17.421-32.822 c8.073-6.156,16.872-9.277,26.152-9.277c17.563,0,34.338,10.936,45.317,20.11l4.809,4.018l4.809-4.018 c10.979-9.174,27.754-20.11,45.317-20.11c9.28,0,18.079,3.121,26.152,9.277c11.9,9.073,17.599,19.809,17.421,32.822 C202.107,89.145,185.311,117.356,153.833,149.017z"></path> </g></svg>
                </a>

                    <a href="/auth/logout"
                       class="py-2 px-3 bg-zinc-800 text-white hover:bg-zinc-950 rounded-lg">Sair</a>
                @endauth

                @guest
                    <a href="/auth" class="py-2 px-3 bg-blue-600 text-white hover:bg-blue-700 rounded-lg">Login</a>
                @endguest
            </div>

            <div class="md:hidden flex items-center">
                <button class="mobile-menu-button">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <div class="mobile-menu hidden md:hidden font-bold">

        <a href="/" class="block py-2 px-4 text-sm rounded-lg hover:bg-gray-200">Produtos</a>
        @if(Auth::user() && Auth::user()->is_admin)
            <a href="/admin" class="block py-2 px-4 text-sm rounded-lg hover:bg-gray-200">Administração</a>
        @endif

        <div class="flex items-center my-2 pl-2 space-x-4 font-bold w-full">
            @auth
                <h5 class="text-start w-1/2">Olá, {{ Auth::user()->first_name }}!</h5>
                <div class="flex justify-end w-full">
                    <a href="/auth/logout"
                       class="py-2 px-3 bg-zinc-800 text-white hover:bg-zinc-950 rounded-lg">Sair</a>
                </div>

            @endauth

            @guest
                <a href="/auth" class="py-2 px-3 bg-blue-600 text-white hover:bg-blue-700 rounded-lg">Login</a>
            @endguest
        </div>
    </div>
</nav>

<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>

<script>
    const btn = document.querySelector("button.mobile-menu-button");
    const menu = document.querySelector(".mobile-menu");

    btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });

    tippy('#bookmarks', {content: 'Favoritos'});
    tippy('#shoppingCart', {content: 'Carrinho de Compras'});
</script>
