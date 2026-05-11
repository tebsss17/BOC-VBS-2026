<x-layouts::app :title="__('Attendance')">

    <div x-data="{ search: '', group: '' }"
         class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl px-3 sm:px-0">

        <!-- HEADER -->
        <x-reusables.header>
            Attendance
        </x-reusables.header>

        <!-- DATE SELECTOR (ADMIN ONLY) -->
        @if(auth()->user()->role === 'Admin')
        <form method="GET"
              class="bg-white border border-amber-100 shadow-sm rounded-xl p-4
                     flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">

            <label class="text-sm font-medium text-amber-900">
                Select Date:
            </label>

            <input type="date"
                   name="date"
                   value="{{ $date ?? now()->toDateString() }}"
                   class="w-full sm:w-auto px-4 py-2 border border-amber-200 rounded-lg">

            <button class="w-full sm:w-auto px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition">
                Load
            </button>

        </form>
        @endif

        <!-- SEARCH + GROUP FILTER -->
        <div class="bg-white border border-amber-100 shadow-sm rounded-xl p-4
                    flex flex-col md:flex-row gap-4 md:items-center">

            <!-- SEARCH -->
            <input type="text"
                   x-model="search"
                   placeholder="Search student..."
                   class="w-full md:flex-1 px-4 py-2 border border-amber-200 rounded-lg
                          focus:ring-2 focus:ring-amber-300 outline-none">

            <!-- GROUP DROPDOWN -->
            <select x-model="group"
                    class="w-full md:w-60 px-4 py-2 border border-amber-200 rounded-lg">
                <option value="">All Groups</option>
                <option value="Tourists">Tourists</option>
                <option value="Sightseers">Sightseers</option>
                <option value="Wayfarers">Wayfarers</option>
            </select>

        </div>

        @php
            $groups = ['Tourists', 'Sightseers', 'Wayfarers'];
        @endphp

        @foreach ($groups as $grp)

            <div x-show="group === '' || group === '{{ $grp }}'"
                 class="bg-white border border-amber-100 shadow-sm rounded-xl p-5 space-y-4">

                <!-- GROUP HEADER -->
                <div class="flex items-center justify-between border-b border-amber-100 pb-3">

                    <h2 class="text-sm font-bold uppercase tracking-widest text-amber-900">
                        {{ $grp }} Group
                    </h2>

                    <span class="text-xs bg-amber-100 text-amber-800 px-3 py-1 rounded-full">
                        {{ $students->where('group', $grp)->count() }} Students
                    </span>

                </div>

                <!-- GRID -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

                    @foreach ($students->where('group', $grp) as $student)

                        @php
                            $marked = $student->attendances()
                                ->whereDate('date', $date ?? now()->toDateString())
                                ->exists();
                        @endphp

                        <div x-show="search === '' || '{{ strtolower($student->name) }}'.includes(search.toLowerCase())"
                             class="bg-white border border-amber-100 rounded-xl shadow-sm p-5 relative">

                            <!-- MARKED BADGE -->
                            @if($marked)
                                <div class="absolute top-3 right-3 flex items-center gap-1
                                            bg-green-50 border border-green-200
                                            px-2 py-1 rounded-full">

                                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                    <span class="text-xs text-green-700 hidden sm:inline">
                                        Marked
                                    </span>

                                </div>
                            @endif

                            <!-- NAME -->
                            <a href="{{ route('attendance.show', $student->id) }}"
                               class="flex items-center gap-3 mb-4 p-2 rounded-lg hover:bg-amber-50 transition">

                                <div class="w-10 h-10 bg-amber-100 text-amber-800
                                            rounded-full flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>

                                <div>
                                    <h3 class="font-bold text-amber-900">
                                        {{ $student->name }}
                                    </h3>

                                    <p class="text-xs text-gray-500">
                                        {{ $student->group }}
                                    </p>
                                </div>

                            </a>

                            <!-- ACTIONS -->
                            @if(!$marked)

                                <form action="{{ route('attendance.store') }}" method="POST"
                                      class="grid grid-cols-2 gap-2">

                                    @csrf

                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                    <input type="hidden" name="date" value="{{ $date ?? now()->toDateString() }}">

                                    <button name="present" value="1"
                                            class="bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">
                                        Present
                                    </button>

                                    <button name="present" value="0"
                                            class="bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition">
                                        Absent
                                    </button>

                                </form>

                            @else

                                <p class="text-sm text-green-600 font-semibold text-center">
                                    Already marked for this date
                                </p>

                            @endif

                        </div>

                    @endforeach

                </div>

            </div>

        @endforeach

    </div>

</x-layouts::app>
