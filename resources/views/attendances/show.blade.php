<x-layouts::app :title="__('Students')">
    <div x-data="{search: '', address: '', group: '' }" class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <x-reusables.header class="bg-main shadow-xl text-white border rounded-xl py-4 px-2 font-extrabold text-2xl text-center md:text-4xl tracking-wide">
            Profile - {{ $student->name }}
        </x-reusables.header>

        <!-- Profile Card -->
        <div class="p-6 bg-red-400 flex rounded-xl flex-col ">
            <div class="md:p-12 flex flex-col md:flex-row items-center gap-8 rounded-lg">
                <!-- Avatar Circle -->
                <div class=" h-28 w-28 rounded-3xl bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center text-white text-5xl font-black shadow-lg shadow-emerald-200 capitalize">
                    {{ substr($student->name, 0, 1) }}
                </div>

                <!-- Info Section -->
                <div class="text-center md:text-left space-y-2">
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight leading-tight uppercase">{{ $student->name }}</h1>
                    <div class="flex flex-wrap justify-center md:justify-start gap-3">
                        <span class="px-3 py-1 rounded-lg bg-slate-100 text-slate-600 text-sm font-bold">{{ $student->group }}</span>
                        <span class="px-3 py-1 rounded-lg bg-slate-100 text-slate-600 text-sm font-bold">{{ $student->age }} Years Old</span>
                        <span class="px-3 py-1 rounded-lg bg-slate-100 text-slate-600 text-sm font-bold inline-flex items-center">
                            <i data-lucide="map-pin" class="w-3 h-3 mr-1 text-emerald-500"></i> {{ $student->address }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance forms -->
        <div class="p-6 bg-red-400 grid rounded-xl">
            <div class="mb-10 flex justify-center">
                <h1 class="text-white md:text-4xl text-3xl font-bold text-center">Attendance Status</h1>
            </div>
            <div class=" grid grid-cols-1 md:grid-cols-2 gap-5">
                <form action="/attendances" method="POST">
                    <p></p>
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <input type="hidden" name="present" value="1">
                    <button type="submit" class="bg-green-300 rounded-2xl px-3 py-4 font-bold items-center flex w-full justify-center text-xl duration-300 hover:bg-green-500 hover:scale-105">
                        <i data-lucide="user-check" class="mr-1"></i>
                        PRESENT
                    </button>
                </form>

                <form action="/attendances" method="POST">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <input type="hidden" name="present" value="0">
                    <button type="submit" class="bg-red-300 rounded-2xl px-3 py-4 font-bold items-center flex w-full justify-center text-xl duration-300 hover:bg-red-500 hover:scale-105">
                        <i data-lucide="user-x" class="mr-1"></i>
                        ABSENT
                    </button>
                </form>
            </div>
        </div>

        <!-- History Page -->
        <div class="p-6 bg-red-400 grid rounded-xl">
            <div class="mb-10 flex justify-center font-bold md:text-4xl text-3xl text-center">
                <p>Attendance History</p>
            </div>

            <div class="space-y-4">
                @forelse ($attendanceHistory as $history)
                    <div class="p-4 border border-black rounded-xl">
                        <p class="text-gray-300 text-sm">{{ date('M d, Y', strtotime($history->date)) }}</p>
                        <p class="text-gray-300 text-sm">Marked by: {{ $history->user->name }}</p>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </div>
</x-layouts::app>
