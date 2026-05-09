<x-layouts::app :title="__('Edit Student')">

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl px-3 sm:px-0">

        <!-- HEADER -->
        <x-reusables.header>
            Edit Student - {{ $student->name }}
        </x-reusables.header>

        <!-- FORM CARD -->
        <form action="/students/{{ $student->id }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="bg-white border border-amber-100 shadow-sm rounded-xl p-6 flex flex-col gap-6">

                <!-- TOP INFO -->
                <div class="flex items-center gap-4 pb-4 border-b border-amber-100">

                    <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-800
                                font-bold flex items-center justify-center text-lg">
                        {{ strtoupper(substr($student->name, 0, 1)) }}
                    </div>

                    <div>
                        <h2 class="text-lg font-bold text-amber-900">
                            {{ $student->name }}
                        </h2>
                        <p class="text-sm text-gray-500">
                            Student Profile
                        </p>
                    </div>

                </div>

                <!-- NAME + AGE -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm font-medium text-amber-900">Name</label>
                        <x-reusables.input
                            type="text"
                            name="name"
                            value="{{ $student->name }}"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white focus:ring-2 focus:ring-amber-300"
                        />
                    </div>

                    <div>
                        <label class="text-sm font-medium text-amber-900">Age</label>
                        <x-reusables.input
                            type="number"
                            name="age"
                            value="{{ $student->age }}"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white focus:ring-2 focus:ring-amber-300"
                        />
                    </div>

                </div>

                <!-- ADDRESS + GROUP -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm font-medium text-amber-900">Address</label>
                        <select name="address"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white focus:ring-2 focus:ring-amber-300">

                            <option value="">Select address</option>
                            <option value="Acapulco" {{ $student->address == 'Acapulco' ? 'selected' : '' }}>Acapulco</option>
                            <option value="Parca 2" {{ $student->address == 'Parca 2' ? 'selected' : '' }}>Parca 2</option>
                            <option value="Lower Parca" {{ $student->address == 'Lower Parca' ? 'selected' : '' }}>Lower Parca</option>
                            <option value="Zone 6" {{ $student->address == 'Zone 6' ? 'selected' : '' }}>Zone 6</option>

                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-amber-900">Group</label>
                        <select name="group"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white focus:ring-2 focus:ring-amber-300">

                            <option value="">Select group</option>
                            <option value="Tourists" {{ $student->group == 'Tourists' ? 'selected' : '' }}>Tourists</option>
                            <option value="Sightseers" {{ $student->group == 'Sightseers' ? 'selected' : '' }}>Sightseers</option>
                            <option value="Wayfarers" {{ $student->group == 'Wayfarers' ? 'selected' : '' }}>Wayfarers</option>

                        </select>
                    </div>

                </div>

                <!-- GENDER -->
                <div>
                    <label class="text-sm font-medium text-amber-900">Gender</label>
                    <select name="gender"
                        class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white focus:ring-2 focus:ring-amber-300">

                        <option value="">Select gender</option>
                        <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>

                    </select>
                </div>

                <!-- ERRORS -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 rounded-lg p-3 text-sm">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <!-- ACTIONS -->
                <div class="flex flex-col sm:flex-row justify-between gap-3 pt-2">

                    <!-- BACK -->
                    <a href="/students"
                       class="px-5 py-2 rounded-lg bg-zinc-100 hover:bg-zinc-200
                              text-zinc-700 font-medium text-center transition">
                        ← Back
                    </a>

                    <div class="flex flex-col sm:flex-row gap-3">

                        <!-- DELETE -->
                        <button type="submit" form="del"
                            onclick="return confirm('Delete this student?')"
                            class="px-5 py-2 rounded-lg bg-red-500 hover:bg-red-600
                                   text-white font-medium transition">
                            Delete
                        </button>

                        <!-- SAVE -->
                        <button type="submit"
                            class="px-5 py-2 rounded-lg bg-amber-600 hover:bg-amber-700
                                   text-white font-medium shadow-sm transition">
                            Save Changes
                        </button>

                    </div>

                </div>

            </div>

        </form>

        <!-- DELETE FORM -->
        <form action="/students/{{ $student->id }}" method="POST" id="del">
            @csrf
            @method('DELETE')
        </form>

    </div>

</x-layouts::app>
