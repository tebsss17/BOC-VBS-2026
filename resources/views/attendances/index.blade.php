<x-layouts::app :title="__('Students')">

    <div x-data="{ search: '', address: '' }"
         class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl px-3 sm:px-0">

        <!-- HEADER -->
        <x-reusables.header>
            Students
        </x-reusables.header>

        <!-- FILTER BAR -->
        <div class="bg-white border border-amber-100 shadow-sm rounded-xl
                    p-4 sm:p-5 flex flex-col lg:flex-row gap-4 lg:items-center lg:justify-between">

            <div class="flex flex-col md:flex-row gap-4 items-start md:items-center flex-1">

                <input type="text"
                       x-model="search"
                       placeholder="Search student..."
                       class="w-full sm:flex-1 lg:w-64 px-4 py-2 rounded-lg border border-amber-200
                              focus:ring-2 focus:ring-amber-300 outline-none bg-white">

                <select x-model="address"
                        class="w-full sm:w-56 px-4 py-2 rounded-lg border border-amber-200 bg-white">
                    <option value="">All Address</option>
                    <option value="Acapulco">Acapulco</option>
                    <option value="Zone 6">Zone 6</option>
                    <option value="Parca 2">Parca 2</option>
                    <option value="Lower Parca">Lower Parca</option>
                </select>

            </div>

            <!-- ADD -->
            <a href="/students/create"
               class="flex items-center justify-center gap-2 px-4 py-2 rounded-lg
                      bg-amber-600 hover:bg-amber-700 text-white shadow-sm transition">

                <i data-lucide="user-round-plus" class="w-5 h-5"></i>
                Add Student

            </a>

        </div>

        @php
            $groups = ['Tourists', 'Sightseers', 'Wayfarers'];
        @endphp

        <!-- GROUP CONTAINERS -->
        @foreach ($groups as $grp)

            <div class="bg-white border border-amber-100 shadow-sm rounded-xl p-5 space-y-4">

                <!-- GROUP HEADER -->
                <div class="flex items-center justify-between border-b border-amber-100 pb-3">

                    <h2 class="text-sm font-bold uppercase tracking-widest text-amber-900">
                        {{ $grp }} Group
                    </h2>

                    <span class="text-xs bg-amber-100 text-amber-800 px-3 py-1 rounded-full">
                        {{ $students->where('group', $grp)->count() }} Students
                    </span>

                </div>

                <!-- GRID INSIDE CONTAINER -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

                    @foreach ($students->where('group', $grp) as $student)

                        <a href="{{ route('attendance.show', $student->id) }}"
                           x-show="
                                (search === '' ||
                                '{{ strtolower($student->name) }}'.includes(search.toLowerCase())) &&
                                (address === '' || address === '{{ $student->address }}')
                           "
                           class="group bg-white border border-gray-100 rounded-xl shadow-sm p-5
                                  hover:shadow-md hover:-translate-y-1 transition">

                            <!-- NAME -->
                            <div class="flex items-center gap-3 mb-3 pb-3 border-b border-gray-100">

                                <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-800
                                            font-bold flex items-center justify-center">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>

                                <div>
                                    <h3 class="font-bold text-[#415474] group-hover:text-[#546582]">
                                        {{ $student->name }}
                                    </h3>

                                    <p class="text-xs text-gray-500">
                                        Age: {{ $student->age }}
                                    </p>
                                </div>

                            </div>

                            <!-- TAGS -->
                            <div class="flex flex-wrap gap-2 text-xs">

                                <span class="px-2 py-1 rounded-full bg-amber-100 text-amber-800">
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

                    @if($students->where('group', $grp)->isEmpty())
                        <div class="text-sm text-gray-400 italic">
                            No students in this group
                        </div>
                    @endif

                </div>

            </div>

        @endforeach

    </div>

</x-layouts::app>
