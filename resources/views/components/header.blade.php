<header class="text-gray-600 body-font border-b border-gray-100 dark:border-gray-800">
    <div class="container mx-auto flex justify-between items-center p-4">
        <a href="{{ route('listings.index') }}"
            class="flex title-font font-medium items-center text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full"
                viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
            <span class="hidden md:block ml-3 text-xl">Laravel Job Board</span>
        </a>
        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center space-x-4">
            <a href="{{ route('login') }}" class="hover:text-gray-900">Employers</a>
            <x-theme-switcher />
            <a href="{{ route('listings.create') }}"
                class="inline-flex items-center bg-indigo-500 text-white border-0 py-1 px-3 focus:outline-none hover:bg-indigo-600 rounded text-base">Post
                Job
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </a>
        </nav>
    </div>
</header>
