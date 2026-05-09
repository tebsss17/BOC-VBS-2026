<x-layouts::app :title="__('Create Lesson')">

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl px-3 sm:px-0">

        <!-- HEADER -->
        <x-reusables.header>
            Create Lesson
        </x-reusables.header>

        <!-- FORM CARD -->
        <form action="/lessons" method="POST">
            @csrf

            <div class="bg-white border border-amber-100 shadow-sm rounded-xl p-6 flex flex-col gap-5">

                <!-- DAY -->
                <div>
                    <label class="block text-sm font-medium text-amber-900 mb-1">Day</label>
                    <x-reusables.input
                        required
                        type="number"
                        name="day"
                        value="{{ old('day') }}"
                        class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white
                               focus:ring-2 focus:ring-amber-300 outline-none"
                    />
                </div>

                <!-- TITLE -->
                <div>
                    <label class="block text-sm font-medium text-amber-900 mb-1">Title</label>
                    <x-reusables.input
                        required
                        type="text"
                        name="title"
                        placeholder="Enter lesson title..."
                        value="{{ old('title') }}"
                        class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white
                               focus:ring-2 focus:ring-amber-300 outline-none"
                    />
                </div>

                <!-- DESCRIPTION -->
                <div>
                    <label class="block text-sm font-medium text-amber-900 mb-1">Description</label>
                    <textarea
                        name="description"
                        required
                        placeholder="Enter description..."
                        class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white
                               focus:ring-2 focus:ring-amber-300 outline-none min-h-[120px]"
                    >{{ old('description') }}</textarea>
                </div>

                <!-- MEMORY VERSE -->
                <div>
                    <label class="block text-sm font-medium text-amber-900 mb-1">Memory Verse</label>
                    <x-reusables.input
                        required
                        type="text"
                        name="memory_verse"
                        placeholder="Enter memory verse..."
                        value="{{ old('memory_verse') }}"
                        class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white
                               focus:ring-2 focus:ring-amber-300 outline-none"
                    />
                </div>

                <!-- ERRORS -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 rounded-lg p-3 text-sm">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <!-- ACTIONS -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-2">

                    <a href="/lessons"
                       class="px-5 py-2 rounded-lg bg-zinc-100 hover:bg-zinc-200
                              text-zinc-700 font-medium text-center transition">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-5 py-2 rounded-lg bg-amber-600 hover:bg-amber-700
                               text-white font-medium shadow-sm transition flex items-center justify-center gap-2">

                        <i data-lucide="book-plus" class="w-5 h-5"></i>
                        Create Lesson

                    </button>

                </div>

            </div>

        </form>

    </div>

</x-layouts::app>
