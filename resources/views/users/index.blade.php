<x-layouts::app :title="__('Users')">

    <div x-data="{ search: '', role: '', group: '' }"
         class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl px-3 sm:px-0">

        <!-- HEADER (MATCH YOUR WARM SYSTEM) -->
        <x-reusables.header>
            Users
        </x-reusables.header>

        <!-- FILTER SECTION (WARM CLEAN SAAS) -->
        <div class="bg-gradient-to-r from-white via-amber-50 to-orange-50
                    border border-amber-100 shadow-sm rounded-xl p-4 sm:p-5
                    flex flex-col lg:flex-row gap-4 lg:items-center lg:justify-between">

            <!-- SEARCH + FILTERS -->
            <div class="flex flex-col md:flex-row gap-4 items-start md:items-center">

                <!-- Search -->
                <input type="text"
                       x-model="search"
                       placeholder="Search name or email..."
                       class="w-full sm:flex-1 lg:w-100 px-4 py-2 rounded-lg
                              border border-amber-200 bg-white
                              focus:outline-none focus:ring-2 focus:ring-amber-300">

                <!-- Role -->
                <select x-model="role"
                        class="w-full sm:w-auto lg:w-48 px-4 py-2 rounded-lg
                               border border-amber-200 bg-white">
                    <option value="">All Roles</option>
                    <option value="Teacher">Admin</option>
                    <option value="Teahcer">Teacher</option>
                    <option value="Superadmin">Superadmin</option>
                </select>

                <!-- Group -->
                <select x-model="group"
                        class="w-full sm:w-auto lg:w-48 px-4 py-2 rounded-lg
                               border border-amber-200 bg-white">
                    <option value="">All Groups</option>
                    <option value="Tourists">Tourists</option>
                    <option value="Sightseers">Sightseers</option>
                    <option value="Wayfarers">Wayfarers</option>
                </select>

            </div>

            <!-- ADD USER BUTTON (WARM ACCENT) -->
            <a href="/users/create"
               class="w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2
                      rounded-lg bg-amber-600 hover:bg-amber-700
                      text-white shadow-sm transition">

                <i data-lucide="user-round-plus" class="w-5 h-5"></i>
                Add User

            </a>

        </div>

        <!-- USERS GRID (CLEAN WARM CARDS) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-5 px-1 sm:px-0">

            @foreach ($users as $user)
                <a href="/users/{{ $user->id }}/edit"
                   x-show="
                        (search === '' ||
                        '{{ strtolower($user->name) }}'.includes(search.toLowerCase()) ||
                        '{{ strtolower($user->email) }}'.includes(search.toLowerCase())) &&
                        (role === '' || role === '{{ $user->role }}') &&
                        (group === '' || group === '{{ $user->group }}')
                   "
                   class="group bg-white border border-amber-100 rounded-xl shadow-sm
                          p-4 sm:p-5 hover:shadow-md hover:-translate-y-1 transition">

                    <!-- INITIAL AVATAR -->
                    <div class="flex items-center gap-3 mb-3 pb-3 border-b border-amber-100">

                        <div class="w-10 h-10 rounded-full bg-amber-100
                                    text-amber-800 font-bold flex items-center justify-center">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div>
                            <h2 class="text-base sm:text-lg font-bold text-amber-900 group-hover:text-amber-700">
                                {{ $user->name }}
                            </h2>

                            <p class="text-xs text-gray-500">
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>

                    <!-- TAGS -->
                    <div class="flex flex-wrap gap-2 mt-2">

                        <span class="text-xs px-2 py-1 rounded-full bg-amber-100 text-amber-800 capitalize">
                            {{ $user->role }}
                        </span>

                        <span class="text-xs px-2 py-1 rounded-full bg-orange-100 text-orange-800 capitalize">
                            {{ $user->group }}
                        </span>

                    </div>

                </a>
            @endforeach

        </div>

    </div>

</x-layouts::app>
