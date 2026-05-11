<x-layouts::app :title="__('Students')">

    <div x-data="{ search: '', address: '', group: '' }"
         class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl px-3 sm:px-0">

        <!-- HEADER -->
        <x-reusables.header>
            Students
        </x-reusables.header>

                <!-- FILTER SECTION -->
        <div class="bg-white border border-amber-100 shadow-sm rounded-xl
                    p-4 sm:p-5 flex flex-col xl:flex-row gap-4 xl:items-center xl:justify-between">

            <!-- SEARCH + FILTERS -->
            <div class="flex flex-col md:flex-row gap-3 w-full xl:w-auto">

                <!-- SEARCH -->
                <input type="text"
                       x-model="search"
                       placeholder="Search student..."
                       class="w-full md:flex-1 xl:w-72 px-4 py-2 rounded-lg
                              border border-amber-200 bg-white
                              focus:ring-2 focus:ring-amber-300 outline-none">

                <!-- ADDRESS -->
                <select x-model="address"
                        class="w-full md:w-52 px-4 py-2 rounded-lg
                               border border-amber-200 bg-white">
                    <option value="">All Address</option>
                    <option value="Acapulco">Acapulco</option>
                    <option value="Zone 6">Zone 6</option>
                    <option value="Parca 2">Parca 2</option>
                    <option value="Lower Parca">Lower Parca</option>
                </select>

                <!-- GROUP -->
                <select x-model="group"
                        class="w-full md:w-52 px-4 py-2 rounded-lg
                               border border-amber-200 bg-white">
                    <option value="">All Group</option>
                    <option value="Tourists">Tourists</option>
                    <option value="Sightseers">Sightseers</option>
                    <option value="Wayfarers">Wayfarers</option>
                </select>

            </div>

            <!-- ADD BUTTON -->
            <a href="/students/create"
               class="w-full md:w-auto flex items-center justify-center gap-2
                      px-4 py-2 rounded-lg bg-amber-600 hover:bg-amber-700
                      text-white shadow-sm transition">

                <i data-lucide="user-round-plus" class="w-5 h-5"></i>
                Add Student

            </a>

        </div>


        <!-- GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

            @foreach ($students as $student)
                <a href="/students/{{ $student->id }}/edit"
                   x-show="
                        (search === '' ||
                        '{{ strtolower($student->name) }}'.includes(search.toLowerCase())) &&
                        (address === '' || address === '{{ $student->address }}') &&
                        (group === '' || group === '{{ $student->group }}')
                   "
                   class="group bg-white border border-amber-100 rounded-xl shadow-sm
                          p-5 hover:shadow-md hover:-translate-y-1 transition">

                    <!-- INITIAL + NAME -->
                    <div class="flex items-center gap-3 mb-3 pb-3 border-b border-amber-100 capitalize">

                        <div class="w-10 h-10 rounded-full bg-amber-100
                                    text-amber-800 font-bold flex items-center justify-center">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>

                        <div>
                            <h2 class="font-bold text-amber-900 group-hover:text-amber-700">
                                {{ $student->name }}
                            </h2>

                            <p class="text-xs text-gray-500">
                                Age: {{ $student->age }}
                            </p>
                        </div>

                    </div>

                    <!-- TAGS -->
                    <div class="flex flex-wrap gap-2">

                        <span class="text-xs px-2 py-1 rounded-full bg-amber-100 text-amber-800">
                            {{ $student->address }}
                        </span>

                        <span class="text-xs px-2 py-1 rounded-full bg-orange-100 text-orange-800">
                            {{ $student->group }}
                        </span>

                        <span class="text-xs px-2 py-1 rounded-full bg-zinc-100 text-zinc-700">
                            {{ $student->gender }}
                        </span>

                    </div>

                </a>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $students->links() }}
        </div>
    </div>

</x-layouts::app>
