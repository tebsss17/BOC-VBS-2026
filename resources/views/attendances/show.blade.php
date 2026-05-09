<x-layouts::app :title="__('Student Profile')">

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl px-3 sm:px-0">

        <!-- HEADER -->
        <x-reusables.header>
            Profile - {{ $student->name }}
        </x-reusables.header>

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

                <!-- SINGLE FORM (cleaner logic) -->
                <form action="{{ route('attendance.store') }}" method="POST"
                      class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">

                    <button type="submit" name="present" value="1"
                        class="w-full py-3 rounded-lg bg-green-500 hover:bg-green-600
                               text-white font-bold flex items-center justify-center gap-2 transition">

                        <i data-lucide="user-check" class="w-5 h-5"></i>
                        PRESENT

                    </button>

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
        <div class="bg-white border border-amber-100 shadow-sm rounded-xl p-6 space-y-3">

            <h2 class="text-sm font-bold uppercase tracking-widest text-amber-900">
                Attendance History
            </h2>

            @forelse ($attendanceHistory as $history)

                <div class="flex justify-between items-center p-4 rounded-lg border border-amber-100">

                    <div class="space-y-1">

                        <p class="text-xs text-gray-500">
                            {{ date('M d, Y', strtotime($history->date)) }}
                        </p>

                        <p class="text-xs text-gray-400 uppercase">
                            Marked by: {{ $history->user?->name ?? 'System' }}
                        </p>

                        <p class="font-bold text-sm
                            {{ $history->present ? 'text-green-600' : 'text-red-500' }}">

                            {{ $history->present ? 'PRESENT' : 'ABSENT' }}

                        </p>

                    </div>

                    <!-- DELETE -->
                    <form action="{{ route('attendance.destroy', $history->id) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this record?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition">

                            <i data-lucide="trash-2" class="w-5 h-5"></i>

                        </button>

                    </form>

                </div>

            @empty

                <div class="text-center text-sm text-gray-400 py-6">
                    No attendance records yet.
                </div>

            @endforelse

        </div>

    </div>

</x-layouts::app>
