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
            @if($alreadyMarked)
                <div class="text-center py-10 bg-white/20 rounded-2xl border-2 border-dashed border-white/50">
                    <div class="flex flex-col items-center gap-2">
                        <i data-lucide="check-circle" class="w-12 h-12 text-green-300"></i>
                        <h1 class="text-white text-2xl font-black tracking-widest uppercase">Attendance Recorded</h1>
                        <p class="text-red-100 font-bold">Student is already marked for today.</p>
                    </div>
                </div>
            @else
                <div class="mb-10 flex justify-center">
                    <h1 class="text-white md:text-4xl text-3xl font-bold text-center uppercase">Mark Attendance</h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <form action="{{ route('attendance.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                        <input type="hidden" name="present" value="1">
                        <button type="submit" class="bg-green-300 rounded-2xl px-3 py-4 font-bold items-center flex w-full justify-center text-xl duration-300 hover:bg-green-500 hover:scale-105">
                            <i data-lucide="user-check" class="mr-1"></i> PRESENT
                        </button>
                    </form>

                    <form action="{{ route('attendance.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                        <input type="hidden" name="present" value="0">
                        <button type="submit" class="bg-red-300 rounded-2xl px-3 py-4 font-bold items-center flex w-full justify-center text-xl duration-300 hover:bg-red-500 hover:scale-105">
                            <i data-lucide="user-x" class="mr-1"></i> ABSENT
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <!-- History Page -->
       <div class="space-y-4">
    @forelse ($attendanceHistory as $history)
        <div class="p-4 border border-black/10 rounded-xl bg-amber-50 flex justify-between items-center">
            <div>
                <p class="text-slate-500 font-bold text-sm">{{ date('M d, Y', strtotime($history->date)) }}</p>
                <p class="text-slate-400 text-xs uppercase">Marked by: {{ $history->user->name }}</p>
                <span class="font-black {{ $history->present ? 'text-green-500' : 'text-red-500' }} tracking-tighter text-sm">
                    {{ $history->present ? 'PRESENT' : 'ABSENT' }}
                </span>
            </div>

            <!-- DELETE BUTTON PARA SA PAGKAMALI -->
            <form action="{{ route('attendance.destroy', $history->id) }}" method="POST" onsubmit="return confirm('Sigurado ka bang buburahin ito?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                </button>
            </form>
        </div>
    @empty
        <!-- No records found message -->
    @endforelse
</div>
</x-layouts::app>
