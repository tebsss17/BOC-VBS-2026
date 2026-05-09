<x-layouts::app :title="__('Create Student')">

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl px-3 sm:px-0">

        <!-- HEADER -->
        <x-reusables.header>
            Create Student
        </x-reusables.header>

        <!-- BACK LINK (adds navigation consistency) -->
        <div>
            <a href="/students"
               class="inline-flex items-center gap-2 text-sm text-amber-700 hover:text-amber-900 transition">

                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Students

            </a>
        </div>

        <!-- FORM CARD -->
        <form action="/students" method="POST">
            @csrf

            <div class="bg-white border border-amber-100 shadow-sm rounded-xl p-6 flex flex-col gap-6">

                <!-- GRID TOP INFO (better structure vs stacked inputs) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- NAME -->
                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">Name</label>
                        <x-reusables.input
                            required
                            type="text"
                            name="name"
                            placeholder="Full Name"
                            value="{{ old('name') }}"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white
                                   focus:ring-2 focus:ring-amber-300 outline-none"
                        />
                    </div>

                    <!-- AGE -->
                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">Age</label>
                        <x-reusables.input
                            required
                            type="number"
                            name="age"
                            value="{{ old('age') }}"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white
                                   focus:ring-2 focus:ring-amber-300 outline-none"
                        />
                    </div>

                </div>

                <!-- ADDRESS + GROUP -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">Address</label>
                        <select
                            required
                            name="address"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white
                                   focus:ring-2 focus:ring-amber-300 outline-none">

                            <option disabled selected>Select Address</option>
                            <option>Acapulco</option>
                            <option>Parca 2</option>
                            <option>Lower Parca</option>
                            <option>Zone 6</option>

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">Group</label>
                        <select
                            required
                            name="group"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white
                                   focus:ring-2 focus:ring-amber-300 outline-none">

                            <option disabled selected>Select Group</option>
                            <option>Tourists</option>
                            <option>Sightseers</option>
                            <option>Wayfarers</option>

                        </select>
                    </div>

                </div>

                <!-- GENDER -->
                <div>
                    <label class="block text-sm font-medium text-amber-900 mb-1">Gender</label>
                    <select
                        required
                        name="gender"
                        class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white
                               focus:ring-2 focus:ring-amber-300 outline-none">

                        <option disabled selected>Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>

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
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-2">

                    <a href="/students"
                       class="px-5 py-2 rounded-lg bg-zinc-100 hover:bg-zinc-200
                              text-zinc-700 font-medium transition text-center">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-5 py-2 rounded-lg bg-amber-600 hover:bg-amber-700
                               text-white font-medium shadow-sm transition flex items-center gap-2 justify-center">

                        <i data-lucide="user-round-plus" class="w-5 h-5"></i>
                        Create Student

                    </button>

                </div>

            </div>

        </form>

    </div>

</x-layouts::app>
