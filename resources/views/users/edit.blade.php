<x-layouts::app :title="__('Edit User')">

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl px-3 sm:px-0">

        <!-- HEADER -->
        <x-reusables.header>
            Edit User - {{ $user->name }}
        </x-reusables.header>

        <!-- FORM CARD -->
        <form action="/users/{{ $user->id }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="bg-white border border-amber-100 shadow-sm rounded-xl p-6 flex flex-col gap-6">

                <!-- TOP IDENTITY CARD -->
                <div class="flex items-center gap-4 pb-4 border-b border-amber-100">

                    <!-- INITIAL -->
                    <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-800
                                font-bold flex items-center justify-center text-lg">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <!-- INFO -->
                    <div>
                        <h2 class="text-lg font-bold text-amber-900">
                            {{ $user->name }}
                        </h2>
                        <p class="text-sm text-gray-500">
                            {{ $user->email }}
                        </p>
                    </div>

                </div>

                <!-- NAME + EMAIL -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm font-medium text-amber-900">Name</label>
                        <x-reusables.input
                            type="text"
                            name="name"
                            value="{{ $user->name }}"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white focus:ring-2 focus:ring-amber-300"
                        />
                    </div>

                    <div>
                        <label class="text-sm font-medium text-amber-900">Email</label>
                        <x-reusables.input
                            type="email"
                            name="email"
                            value="{{ $user->email }}"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white focus:ring-2 focus:ring-amber-300"
                        />
                    </div>

                </div>

                <!-- ROLE + GROUP -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm font-medium text-amber-900">Role</label>
                        <select name="role"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white focus:ring-2 focus:ring-amber-300">

                            <option value="">Select role</option>
                            <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Teacher" {{ $user->role == 'Teacher' ? 'selected' : '' }}>Teacher</option>

                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-amber-900">Group</label>
                        <select name="group"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white focus:ring-2 focus:ring-amber-300">

                            <option value="">Select group</option>
                            <option value="Tourists" {{ $user->group == 'Tourists' ? 'selected' : '' }}>Tourists</option>
                            <option value="Sightseers" {{ $user->group == 'Sightseers' ? 'selected' : '' }}>Sightseers</option>
                            <option value="Wayfarers" {{ $user->group == 'Wayfarers' ? 'selected' : '' }}>Wayfarers</option>

                        </select>
                    </div>

                </div>

                <!-- PASSWORD -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm font-medium text-amber-900">Password</label>
                        <x-reusables.input
                            type="password"
                            name="password"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white focus:ring-2 focus:ring-amber-300"
                        />
                    </div>

                    <div>
                        <label class="text-sm font-medium text-amber-900">Confirm Password</label>
                        <x-reusables.input
                            type="password"
                            name="password_confirmation"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white focus:ring-2 focus:ring-amber-300"
                        />
                    </div>

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

                    <!-- LEFT -->
                    <a href="/users"
                       class="px-5 py-2 rounded-lg bg-zinc-100 hover:bg-zinc-200
                              text-zinc-700 font-medium text-center transition">
                        ← Back
                    </a>

                    <!-- RIGHT -->
                    <div class="flex flex-col sm:flex-row gap-3">

                        <!-- DELETE -->
                        <button type="submit" form="del"
                            onclick="return confirm('Are you sure you want to delete this user?')"
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
        <form action="/users/{{ $user->id }}" method="POST" id="del">
            @csrf
            @method('DELETE')
        </form>

    </div>

</x-layouts::app>
