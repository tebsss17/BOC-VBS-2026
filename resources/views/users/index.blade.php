<x-layouts::app :title="__('Users')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <x-reusables.box class="bg-main shadow-xl text-white border rounded-xl py-4 px-2 font-extrabold text-2xl text-center md:text-4xl tracking-wide">
            Users
        </x-reusables.box>

        <!-- Navigation Section -->
        <div class="py-4 px-2 shadow-lg rounded-lg flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-5">
            <!-- Left side: search + dropdown -->
            <div class="flex flex-col sm:flex-row gap-3 flex-1">
                <!-- Search input -->
                <input type="text"
                       class="bg-[#fefefe] rounded-lg py-1 px-3 border-[#2d4163] border-2 shadow-lg w-fit"
                       placeholder="Search...">

                <!-- Roles Dropdown -->
                <select class="bg-[#fefefe] rounded-lg py-1 px-3 border-[#2d4163] border-2 shadow-lg font-medium">
                    <option value="">All Roles</option>
                    <option value="admin">Admin</option>
                    <option value="teacher">Teacher</option>
                </select>
            </div>

            <!-- Right side: Add User button -->
            <a href="/users/create"
               class="py-2 px-3 flex items-center shadow-lg rounded-lg bg-[#415474] hover:bg-[#546582] duration-300 text-white">
                <i data-lucide="user-round-plus" class="w-5 h-5 mr-1"></i>
                Add User
            </a>
        </div>

        <!-- Main Section -->
        <div class="py-4 px-2 shadow-lg rounded-lg">
            @foreach ($users as $user )
                <div class="block rounded-lg bg-blue-100 px-2 py-3 gap-2 w-fit">
                    <p>Name: {{ $user->name }}</p>
                    <p>Email: {{ $user->email }}</p>
                    <p>Role: {{ $user->role }}</p>
                </div>
            @endforeach
            <!-- Card Section -->
            <div>

            </div>
        </div>
    </div>
</x-layouts::app>
