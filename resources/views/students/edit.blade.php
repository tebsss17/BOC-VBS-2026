    <x-layouts::app :title="__('Create User')">
        <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
            <x-reusables.header class="bg-main shadow-xl text-white border rounded-xl py-4 px-2 font-extrabold text-2xl text-center md:text-4xl tracking-wide">
                Create Student
            </x-reusables.header>

            <!-- Modern form card -->
            <form action="/students/{{ $student->id }}" method="POST">
                @csrf
                @method('PATCH')
                    <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col gap-4">
                        <!-- Name + Email -->
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <x-reusables.input required type="text" name="name" placeholder="Full Name" value="{{ $student->name }}"/>
                            </div>
                        </div>

                        <!-- Role dropdown -->
                        <div>
                            <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                            <x-reusables.input required type="number" name="age" value="{{ $student->age }}"/>
                        </div>

                        <!-- Address -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <select required class="w-full bg-[#fefefe] rounded-md py-2 px-3 border-[#2d4163] border-2 shadow-lg" id="address" name="address">
                                <option disabled value="">Select Address</option>
                                <option value="acapulco" {{ $student->address == 'acapulco' ? 'selected' : '' }}>Acapulco</option>
                                <option value="parca 2" {{ $student->address == 'parca 2' ? 'selected' : '' }}>Parca 2</option>
                                <option value="lower parca" {{ $student->address == 'lower parca' ? 'selected' : '' }}>Lower Parca</option>
                                <option value="zone 6" {{ $student->address == 'zone 6' ? 'selected' : '' }}>Zone 6</option>
                            </select>
                        </div>

                        <!-- Group dropdown -->
                        <div>
                            <label for="group" class="block text-sm font-medium text-gray-700">Group</label>
                            <select required class="w-full bg-[#fefefe] rounded-md py-2 px-3 border-[#2d4163] border-2 shadow-lg" id="group" name="group">
                                <option disabled value="">Group Name</option>
                                <option value="tourists" {{ $student->group == 'tourists' ? 'selected' : '' }}>Tourists</option>
                                <option value="site seers" {{ $student->group == 'site seers' ? 'selected' : '' }}>Site Seers</option>
                                <option value="way farers" {{ $student->group == 'way farers' ? 'selected' : '' }}>Way Farers</option>
                            </select>
                        </div>

                        @if ($errors->any())
                            <div class="bg-red-100 text-red-500 border-red-700 border rounded-lg py-2 px-3">
                                @foreach ($errors->all() as $error )
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row justify-end gap-4">
                            <a href="/students" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 shadow-lg text-center font-semibold duration-300">
                                Cancel
                            </a>

                            <button type="submit" form="del" class="px-4 py-2 rounded-lg bg-[#415474] text-white font-semibold shadow-lg hover:bg-[#546582] duration-300">
                                <i data-lucide="user-round-X" class="inline w-5 h-5 mr-1"></i>
                                Delete Student
                            </button>

                            <button type="submit" class="px-4 py-2 rounded-lg bg-[#415474] text-white font-semibold shadow-lg hover:bg-[#546582] duration-300">
                                <i data-lucide="user-round-pen" class="inline w-5 h-5 mr-1"></i>
                                Save Student
                            </button>
                        </div>
                    </div>
            </form>

            <form action="/students/{{ $student->id }}" method="post" id="del">
                @csrf
                @method('delete')
            </form>

        </div>
    </x-layouts::app>
