<x-layouts::app :title="__('Student Profile')">

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl px-3 sm:px-0">

        <!-- HEADER -->
        <x-reusables.header>
            Profile - {{ $student->name }}
        </x-reusables.header>

        <!-- BACK BUTTON -->
        <div>
            <a href="{{ route('attendance.index') }}"
               class="inline-flex items-center gap-2 text-sm font-medium
                      text-amber-700 hover:text-amber-900 transition">

                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Attendance

            </a>
        </div>

        <!-- PROFILE CARD -->
        <div class="bg-white border border-amber-100 shadow-sm rounded-xl p-6">

            <div class="flex flex-col md:flex-row items-center gap-6">

                <!-- AVATAR -->
                <div class="h-24 w-24 rounded-full bg-amber-100 text-amber-800
                            flex items-center justify-center text-3xl font-black uppercase">
                    {{ substr($student->name, 0, 1) }}
                </div>

                <!-- INFO -->
                <div class="text-center md:text-left space-y-2">

                    <h1 class="text-2xl font-black text-amber-900 uppercase">
                        {{ $student->name }}
                    </h1>

                    <div class="flex flex-wrap justify-center md:justify-start gap-2">

                        <span class="px-3 py-1 text-xs rounded-full bg-amber-100 text-amber-800 font-semibold">
                            {{ $student->group }}
                        </span>

                        <span class="px-3 py-1 text-xs rounded-full bg-orange-100 text-orange-800 font-semibold">
                            {{ $student->age }} Years Old
                        </span>

                        <span class="px-3 py-1 text-xs rounded-full bg-zinc-100 text-zinc-700 font-semibold">
                            {{ $student->address }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

        <!-- ATTENDANCE ACTION -->
        <div class="bg-white border border-amber-100 shadow-sm rounded-xl p-6">

            @if($alreadyMarked)

                <div class="text-center py-10">
                    <i data-lucide="check-circle" class="w-12 h-12 text-green-500 mx-auto mb-2"></i>

                    <h1 class="text-xl font-black text-amber-900 uppercase">
                        Attendance Recorded
                    </h1>

                    <p class="text-sm text-gray-500 mt-1">
                        This student is already marked for today.
                    </p>
                </div>

            @else

                <h2 class="text-center text-lg font-bold text-amber-900 mb-6 uppercase">
                    Mark Attendance
                </h2>

                <!-- SINGLE FORM -->
                <form action="{{ route('attendance.store') }}" method="POST"
                      class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    @csrf

                    <input type="hidden" name="student_id" value="{{ $student->id }}">

                    <!-- PRESENT -->
                    <button type="submit" name="present" value="1"
                        class="w-full py-3 rounded-lg bg-green-500 hover:bg-green-600
                               text-white font-bold flex items-center justify-center gap-2 transition">

                        <i data-lucide="user-check" class="w-5 h-5"></i>
                        PRESENT

                    </button>

                    <!-- ABSENT -->
                    <button type="submit" name="present" value="0"
                        class="w-full py-3 rounded-lg bg-red-500 hover:bg-red-600
                               text-white font-bold flex items-center justify-center gap-2 transition">

                        <i data-lucide="user-x" class="w-5 h-5"></i>
                        ABSENT

                    </button>

                </form>

            @endif

        </div>

        <!-- HISTORY -->
        <div class="bg-white border border-amber-100 shadow-sm rounded-xl p-6 space-y-4">

            <h2 class="text-sm font-bold uppercase tracking-widest text-amber-900">
                Attendance History
            </h2>

            @forelse ($attendanceHistory as $history)

                <div class="flex justify-between items-center p-4 rounded-lg
                            bg-amber-50/40 border border-amber-100
                            hover:bg-amber-50 transition">

                    <!-- LEFT SIDE -->
                    <div class="space-y-1">

                        <!-- DATE (more visible now) -->
                        <p class="text-sm font-semibold text-amber-900">
                            {{ date('M d, Y', strtotime($history->date)) }}
                        </p>

                        <!-- MARKED BY -->
                        <p class="text-xs text-amber-700">
                            Marked by: <span class="font-medium text-gray-700">
                                {{ $history->user?->name ?? 'System' }}
                            </span>
                        </p>

                    </div>

                    <!-- RIGHT SIDE STATUS -->
                    <div class="flex items-center gap-2">

                        @if($history->present)
                            <span class="px-3 py-1 text-xs font-bold rounded-full
                                        bg-green-100 text-green-700 border border-green-200">
                                PRESENT
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs font-bold rounded-full
                                        bg-red-100 text-red-700 border border-red-200">
                                ABSENT
                            </span>
                        @endif

                        <!-- DELETE -->
                        <form action="{{ route('attendance.destroy', $history->id) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this record?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition">

                                <i data-lucide="trash-2" class="w-4 h-4"></i>

                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="text-center text-sm text-gray-400 py-6">
                    No attendance records yet.
                </div>

            @endforelse

        </div>


        </div>

    </div>

</x-layouts::app>
