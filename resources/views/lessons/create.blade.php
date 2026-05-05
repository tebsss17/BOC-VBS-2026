<x-layouts::app :title="__('Create User')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <x-reusables.header class="bg-main shadow-xl text-white border rounded-xl py-4 px-2 font-extrabold text-2xl text-center md:text-4xl tracking-wide">
            Create Lesson
        </x-reusables.header>

        <!-- Modern form card -->
        <form action="/lessons" method="POST">
            @csrf
                <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col gap-4">

                    <!-- Text Fields -->
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="day" class="block text-sm font-medium text-gray-700">Day</label>
                            <x-reusables.input required type="number" name="day" value="{{ old('day') }}"/>
                        </div>
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <x-reusables.input required type="text" placeholder="Enter title..." name="title" value="{{ old('title') }}"/>
                    </div>

                     <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea required  name="description" class="w-full bg-[#fefefe] rounded-md py-2 px-3 border-[#2d4163] border-2 shadow-lg" placeholder="Enter description here...">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label for="memory_verse" class="block text-sm font-medium text-gray-700">Memory Verse</label>
                            <x-reusables.input required type="text" placeholder="Enter memory verse..." name="memory_verse"/>
                        </div>

                    @if ($errors->any())
                        <div class="bg-red-100 text-red-500 border-red-700 border rounded-lg py-2 px-3">
                            @foreach ($errors->all() as $error )
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row justify-end gap-4">
                        <a href="/lessons" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 shadow-lg font-extrabold text-center duration-300">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-[#415474] text-white font-semibold shadow-lg hover:bg-[#546582] duration-300">
                            <i data-lucide="user-round-plus" class="inline w-5 h-5 mr-1"></i>
                            Create Lesson
                        </button>
                    </div>
                </div>
        </form>
    </div>
</x-layouts::app>
