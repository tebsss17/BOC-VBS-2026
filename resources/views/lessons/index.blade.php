<x-layouts::app :title="__('Lessons')">

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl px-3 sm:px-0">

        <!-- HEADER -->
        <x-reusables.header>
            Lessons
        </x-reusables.header>

        <!-- ACTION BAR -->
        <div class="bg-white border border-amber-100 shadow-sm rounded-xl
                    p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <h2 class="text-sm font-semibold uppercase tracking-widest text-amber-900/70">
                Course Outline
            </h2>

            @if (Auth::user()->role === 'admin')
                <a href="/lessons/create"
                class="flex items-center justify-center gap-2 px-4 py-2
                        rounded-lg bg-amber-600 hover:bg-amber-700
                        text-white shadow-sm transition whitespace-nowrap">

                    <i data-lucide="book-plus" class="w-5 h-5"></i>
                    Add Lesson

                </a>
            @endif
        </div>

        <!-- LESSONS GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

            @foreach ($lessons as $lesson)
                <a href="/lessons/{{ $lesson->id }}/edit"
                   class="group bg-white border border-amber-100 rounded-xl shadow-sm
                          p-5 hover:shadow-md hover:-translate-y-1 transition">

                    <!-- HEADER -->
                    <div class="flex items-center justify-between mb-3 pb-3 border-b border-amber-100">

                        <div>
                            <h3 class="text-lg font-bold text-amber-900 group-hover:text-amber-700 uppercase">
                                Day {{ $lesson->day }}
                            </h3>
                        </div>

                        <i data-lucide="book-open" class="w-5 h-5 text-amber-600"></i>

                    </div>

                    <!-- TITLE -->
                    <h2 class="text-base font-bold text-gray-800 mb-2">
                        {{ $lesson->title }}
                    </h2>

                    <!-- DESCRIPTION -->
                    <p class="text-sm text-gray-600 line-clamp-2 mb-4">
                        {{ $lesson->description }}
                    </p>

                    <!-- MEMORY VERSE -->
                    <div class="bg-amber-50 border border-amber-100 rounded-lg p-3">

                        <p class="text-[10px] uppercase font-bold text-amber-700 mb-1">
                            Memory Verse
                        </p>

                        <p class="text-sm font-medium text-gray-700">
                            {{ $lesson->memory_verse }}
                        </p>

                    </div>

                </a>
            @endforeach

        </div>

        @if($lessons->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-gray-400">
                <i data-lucide="book-open" class="w-14 h-14 mb-3"></i>
                <p class="font-semibold uppercase tracking-widest text-sm">
                    No lessons found
                </p>
            </div>
        @endif

    </div>

</x-layouts::app>
