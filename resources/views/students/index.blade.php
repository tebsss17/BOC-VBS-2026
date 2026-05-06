<x-layouts::app :title="__('Students')">
    <div x-data="{search: '', address: '', group: '' }" class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <x-reusables.header class="bg-main shadow-xl text-white border rounded-xl py-4 px-2 font-extrabold text-2xl text-center md:text-4xl tracking-wide">
            Students
        </x-reusables.header>

        <!-- Navigation Section -->
        <div class="p-6 shadow-lg rounded-lg flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-5">
            <!-- Left side: search + dropdown -->
            <div class="flex flex-col sm:flex-row gap-3 flex-1">
                <!-- Search input -->
                <input type="text"
                       x-model="search"
                       class="bg-[#fefefe] rounded-lg py-1 px-3 border-[#2d4163] border-2 shadow-lg w-fit"
                       placeholder="Search...">

                <!-- Roles Dropdown -->
                <select class="bg-[#fefefe] rounded-lg py-1 px-3 border-[#2d4163] border-2 shadow-lg font-medium"
                        x-model="address">
                    <option value="">All Address</option>
                    <option value="acapulco">Acapulco</option>
                    <option value="zone 6">Zone 6</option>
                    <option value="parca 2">Parca 2</option>
                    <option value="lower parca">Lower Parca</option>
                </select>

                <select class="bg-[#fefefe] rounded-lg py-1 px-3 border-[#2d4163] border-2 shadow-lg font-medium"
                        x-model="group">
                    <option value="">All Group</option>
                    <option value="tourists">Tourists</option>
                    <option value="site seers">Site Seers</option>
                    <option value="way farers">Way Farers</option>
                </select>
            </div>

            <!-- Add Student button -->
            <a href="/students/create"
               class="py-2 px-3 flex items-center shadow-lg rounded-lg bg-[#415474] hover:bg-[#546582] duration-300 text-white">
                <i data-lucide="user-round-plus" class="w-5 h-5 mr-1"></i>
                Add Student
            </a>
        </div>

        <!-- Main Section -->
        <div class="p-6 shadow-lg rounded-lg grid md:grid-cols-2 xl:grid-cols-3 items-center justify-center gap-4">
            @foreach ($students as $student)
                <a href="/students/{{ $student->id }}/edit"
                   class="block rounded-lg bg-blue-100 px-3 py-3 gap-2 w-full hover:scale-105 duration-300 uppercase"
                   x-show="
                       (search === '' || '{{ strtolower($student->name) }}'.includes(search.toLowerCase())) &&
                       (address === '' || address === '{{ $student->address }}') &&
                       (group === '' || group === '{{ $student->group }}')
                    ">
                    <p>Name: <span class="font-bold">{{ $student->name }}</span></p>
                    <br>
                    <p>Age: <span class="font-bold">{{ $student->age }}</span></p>
                    <br>
                    <p>Address: <span class="font-bold">{{ $student->address }}</span></p>
                    <br>
                    <p>Group: <span class="font-bold">{{ $student->group }}</span></p>
                </a>
            @endforeach
                <div>
            </div>
        </div>
    </div>
</x-layouts::app>
