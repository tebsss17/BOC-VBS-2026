<x-layouts::app :title="__('Users')">
    <div x-data="{ search: '', role: '', group: '' }" class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <x-reusables.header class="bg-main shadow-xl text-white border rounded-xl py-4 px-2 font-extrabold text-2xl text-center md:text-4xl tracking-wide">
            Users
        </x-reusables.header>

        <!-- Navigation Section -->
        <div class="py-4 px-3 shadow-lg rounded-lg flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-5">
            <!-- Left side: search + dropdown -->
            <div class="flex flex-col sm:flex-row gap-3 flex-1">
                <!-- Search input -->
                <input type="text"
                       x-model="search"
                       class="bg-[#fefefe] rounded-lg py-1 px-3 border-[#2d4163] border-2 shadow-lg w-fit"
                       placeholder="Search name or email...">

                <!-- Roles Dropdown -->
                <select x-model="role"
                        class="bg-[#fefefe] rounded-lg py-1 px-3 border-[#2d4163] border-2 shadow-lg font-medium">
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="teacher">Teacher</option>
                </select>

                <!-- Groups Dropdown -->
                <select x-model="group"
                        class="bg-[#fefefe] rounded-lg py-1 px-3 border-[#2d4163] border-2 shadow-lg font-medium">
                    <option value="">All Groups</option>
                    <option value="tourists">Tourists</option>
                    <option value="site seers">Site Seers</option>
                    <option value="way farers">Way Farers</option>
                </select>
            </div>

            <!-- Add User button -->
            <a href="/users/create"
               class="py-2 px-3 flex items-center shadow-lg rounded-lg bg-[#415474] hover:bg-[#546582] duration-300 text-white">
                <i data-lucide="user-round-plus" class="w-5 h-5 mr-1"></i>
                Add User
            </a>
        </div>

        <!-- Main Section -->
        <div class="py-4 px-3 shadow-lg rounded-lg grid md:grid-cols-2 xl:grid-cols-3 items-center justify-center gap-4">
            @foreach ($users as $user)
                <a href="/users/{{ $user->id }}/edit"
                   class="block rounded-lg bg-blue-100 px-2 py-3 gap-2 w-full hover:scale-105 duration-300"
                   x-show="

                       (search === '' || '{{ strtolower($user->name) }}'.includes(search.toLowerCase()) || '{{ strtolower($user->email) }}'.includes(search.toLowerCase())) &&
                       (role === '' || role === '{{ $user->role }}') &&
                       (group === '' || group === '{{ $user->group }}')
                   ">
                    <p>Name: {{ $user->name }}</p>
                    <br>
                    <p>Email: {{ $user->email }}</p>
                    <br>
                    <p>Role: {{ $user->role }}</p>
                    <br>
                    <p>Group: {{ $user->group }}</p>
                </a>
            @endforeach
        </div>
    </div>
</x-layouts::app>
