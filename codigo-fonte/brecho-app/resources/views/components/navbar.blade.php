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

                    <a href="/shopping-cart">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-shopping-cart">
                            <circle cx="8" cy="21" r="1"/>
                            <circle cx="19" cy="21" r="1"/>
                            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                        </svg>
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

<script>
    const btn = document.querySelector("button.mobile-menu-button");
    const menu = document.querySelector(".mobile-menu");

    // add event listeners
    btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });

</script>
