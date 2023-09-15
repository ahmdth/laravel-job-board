<x-app-layout>
    <x-hero />
    <section class="container px-5 py-12 mx-auto">
        <div class="mb-12">
            <div class="flex-justify-center">
                @foreach ($tags as $tag)
                    <a href="/?tag={{ $tag->slug }}"
                        class="inline-block ml-2 tracking-wide text-xs font-medium title-font py-0.5 px-1.5 border border-indigo-500 uppercase {{ $tag->slug === request()->get('tag') ? 'bg-indigo-500 text-white' : 'bg-white text-indigo-500' }}">{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="mb-12">
            <h2 class="text-2xl font-medium text-gray-900 dark:text-gray-200 title-font px-4">All jobs
                ({{ $listings->count() }})</h2>
        </div>
        <div class="-my-6">
            @foreach ($listings as $listing)
                <a href="{{ route('listings.show', $listing->slug) }}"
                    class="py-6 px-4 flex flex-wrap md:flex-nowrap border-b border-gray-100 dark:border-gray-700 {{ $listing->is_highlighted ? 'bg-yellow-100 dark:bg-yellow-200 text-gray-700 hover:bg-yellow-200 dark:hover:bg-yellow-300' : 'bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <div class="md:w-16 md:mb-0 mb-6 mr-4 flex-shrink-0 flex flex-col">
                        <img src="/storage/{{ $listing->logo }}" alt="{{ $listing->company }} logo"
                            class="w-16 h-16 rounded-full object-cover">
                    </div>
                    <div class="md:w-1/2 mr-8 flex flex-col items-start justify-center">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-300 title-font mb-1">
                            {{ $listing->title }}</h2>
                        <p class="leading-relaxed text-gray-900 dark:text-gray-200">
                            {{ $listing->company }} &mdash; <span
                                class="text-gray-600 dark:text-gray-400">{{ $listing->location }}</span>
                        </p>
                    </div>
                    <div class="md:flex-grow mr-8 flex items-center justify-start">
                        @foreach ($listing->tags as $tag)
                            <span
                                class="inline-block ml-2 tracking-wide text-xs font-medium title-font py-0.5 px-1.5 border border-indigo-500 uppercase {{ $tag->slug === request()->get('tag') ? 'bg-indigo-500 text-white' : 'bg-white text-indigo-500' }}">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                    <span class="md:flex-grow flex items-center justify-end dark:text-gray-400">
                        <span>{{ $listing->created_at->diffForHumans() }}</span>
                    </span>
                </a>
            @endforeach
        </div>
    </section>
</x-app-layout>
