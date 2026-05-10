<x-layouts::app :title="__('Create User')">

    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl px-3 sm:px-0">

        <!-- HEADER -->
        <x-reusables.header>
            Create User
        </x-reusables.header>

        <!-- BACK BUTTON -->
        <div>
            <a href="/users"
               class="inline-flex items-center gap-2 text-sm text-amber-700 hover:text-amber-900 transition">

                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to Users

            </a>
        </div>

        <!-- FORM CARD -->
        <form action="/users" method="POST">
            @csrf

            <div class="bg-white border border-amber-100 shadow-sm rounded-xl p-6 flex flex-col gap-6">

                <!-- NAME + EMAIL -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">Name</label>
                        <x-reusables.input required type="text" name="name"
                            placeholder="Full Name"
                            value="{{ old('name') }}"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 focus:ring-2 focus:ring-amber-300 outline-none bg-white" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">Email</label>
                        <x-reusables.input required type="email" name="email"
                            placeholder="Email Address"
                            value="{{ old('email') }}"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 focus:ring-2 focus:ring-amber-300 outline-none bg-white" />
                    </div>

                </div>

                <!-- ROLE + GROUP -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">Role</label>
                        <select required
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white
                                   focus:ring-2 focus:ring-amber-300 outline-none"
                            name="role">

                            <option disabled selected>Select role</option>
                            <option value="Admin">Admin</option>
                            <option value="Teacher">Teacher</option>

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">Group</label>
                        <select required
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 bg-white
                                   focus:ring-2 focus:ring-amber-300 outline-none"
                            name="group">

                            <option disabled selected>Select group</option>
                            <option value="Tourists">Tourists</option>
                            <option value="Sightseers">Sightseers</option>
                            <option value="Wayfarers">Wayfarers</option>
                            <option value="Superadmin">Superadmin</option>

                        </select>
                    </div>

                </div>

                <!-- PASSWORD -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">Password</label>
                        <x-reusables.input required type="password" name="password"
                            placeholder="Password"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 focus:ring-2 focus:ring-amber-300 outline-none bg-white" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">Confirm Password</label>
                        <x-reusables.input required type="password" name="password_confirmation"
                            placeholder="Confirm Password"
                            class="w-full px-4 py-2 rounded-lg border border-amber-200 focus:ring-2 focus:ring-amber-300 outline-none bg-white" />
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
                <div class="flex flex-col sm:flex-row justify-end gap-3">

                    <a href="/users"
                       class="px-5 py-2 rounded-lg bg-zinc-100 hover:bg-zinc-200
                              text-zinc-700 font-medium text-center transition">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-5 py-2 rounded-lg bg-amber-600 hover:bg-amber-700
                               text-white font-medium shadow-sm transition flex items-center justify-center gap-2">

                        <i data-lucide="user-round-plus" class="w-5 h-5"></i>
                        Create User

                    </button>

                </div>

            </div>

        </form>

    </div>

</x-layouts::app>
