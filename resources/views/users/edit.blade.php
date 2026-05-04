<x-layouts::app :title="__('Create User')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <x-reusables.header class="bg-main shadow-xl text-white border rounded-xl py-4 px-2 font-extrabold text-2xl text-center md:text-4xl tracking-wide">
            Edit User - {{ $user->name }}
        </x-reusables.header>

        <!-- Modern form card -->
        <form action="/users/{{ $user->id }}" method="POST">
            @csrf
            @method('patch')
                <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col gap-4">
                    <!-- Name + Email -->
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <x-reusables.input required type="text" name="name" value="{{ $user->name }}" placeholder="Full Name"/>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <x-reusables.input required type="email" name="email" value="{{ $user->email }}" placeholder="Email Address"/>
                        </div>
                    </div>

                    <!-- Role dropdown -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                        <select required class="w-full bg-[#fefefe] rounded-md py-2 px-3 border-[#2d4163] border-2 shadow-lg" id="role" name="role">
                            <option value="">Select role</option>
                            <option value="admin">Admin</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>

                    <!-- Group dropdown -->
                    <div>
                        <label for="group" class="block text-sm font-medium text-gray-700">Group</label>
                        <select required class="w-full bg-[#fefefe] rounded-md py-2 px-3 border-[#2d4163] border-2 shadow-lg" id="group" name="group">
                            <option disabled value="">Group Name</option>
                            <option value="tourists">Tourists</option>
                            <option value="site seers">Site Seers</option>
                            <option value="way farers">Way Farers</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <x-reusables.input required type="password" name="password" placeholder="Password"/>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <x-reusables.input required type="password" name="password_confirmation" placeholder="Confirm Password"/>
                        </div>
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
                        <a href="/users" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 shadow-lg text-center font-semibold duration-300">
                            Cancel
                        </a>

                        <button type="submit" form="del" class="px-4 py-2 rounded-lg bg-[#415474] text-white font-semibold shadow-lg hover:bg-[#546582] duration-300">
                            <i data-lucide="user-round-X" class="inline w-5 h-5 mr-1"></i>
                            Delete User
                        </button>

                        <button type="submit" class="px-4 py-2 rounded-lg bg-[#415474] text-white font-semibold shadow-lg hover:bg-[#546582] duration-300">
                            <i data-lucide="user-round-pen" class="inline w-5 h-5 mr-1"></i>
                            Save User
                        </button>
                    </div>
                </div>
        </form>

        <form action="/users/{{ $user->id }}" method="post" id="del">
            @csrf
            @method('delete')

        </form>
    </div>
</x-layouts::app>
