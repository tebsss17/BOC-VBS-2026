<x-layouts::app :title="__('Students')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <x-reusables.header class="bg-main shadow-xl text-white border rounded-xl py-4 px-2 font-extrabold text-2xl text-center md:text-4xl tracking-wide">
            Lessons
        </x-reusables.header>

        <!-- Main Section -->
        <div class="py-4 px-3 bg-red-100 shadow-lg rounded-lg grid grid-cols-1 items-center justify-center gap-4">
            <div class="flex justify-end">
                <a href="/lessons/create"
                class="py-2 px-3 flex  shadow-lg rounded-lg bg-[#415474] hover:bg-[#546582] duration-300 text-white w-fit">
                    <i data-lucide="book-plus" class="w-5 h-5 mr-1"></i>
                    Add Lesson
                </a>
            </div>
            @foreach ($lessons as $lesson)
                <a href="/lessons/{{ $lesson->id }}/edit"
                   class="block rounded-lg bg-blue-100 px-2 py-3 gap-2 w-full hover:scale-105 duration-300 uppercase">
                    <p>Day : <span class="font-bold">{{ $lesson->day }}</span></p>
                    <br>
                    <p>Title: <span class="font-bold">{{ $lesson->title }}</span></p>
                    <br>
                    <p>Description: <span class="font-bold">{{ $lesson->description }}</span></p>
                    <br>
                    <p>Memory Verse: <span class="font-bold">{{ $lesson->memory_verse }}</span></p>
                </a>
            @endforeach
            <div>

            </div>
        </div>
    </div>
</x-layouts::app>
