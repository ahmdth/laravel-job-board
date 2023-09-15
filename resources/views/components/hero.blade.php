<section class="text-gray-600 body-font border-b border-gray-100 dark:border-gray-800">
    <div class="container mx-auto flex flex-col px-5 pt-16 pb-8 justify-center items-center">
        <div class="w-full md:w-2/3 flex flex-col items-center text-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-bold text-gray-900 dark:text-gray-100">Top jobs in the industry</h1>
            <p class="mb-8 dark:text-gray-200 leading-relaxed">Whether you're looking to move to a new role or just seeing what's available, we've gathered this comprehensive list of open positions from a variety of companies and locations for you to choose from.</p>
            <form class="flex w-full justify-center items-end" action="/" method="get">
                @if(request('tag'))
                <input hidden type="text" name="tag" value="{{ request('tag') }}" />
                @endif
                <div class="relative mr-4 w-full lg:w-1/2 text-left">
                    <input type="text" id="s" name="s" value="{{ request()->get('s') }}" class="w-full bg-gray-white dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
                <button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Search</button>
            </form>
            <p class="text-sm mt-2 text-gray-500 dark:text-gray-200 mb-8 w-full">Full stack php, Vue.js, Node.js and React native</p>
        </div>
    </div>
</section>
