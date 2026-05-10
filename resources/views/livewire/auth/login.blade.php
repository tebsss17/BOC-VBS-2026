<x-layouts::auth :title="__('Log in')">

    <!-- BACKGROUND IMAGE (ONLY ADDITION) -->
    <div class="fixed inset-0 -z-10">
        <div class="w-full h-full bg-cover bg-center"
             style="background-image: url('{{ asset('images/journey.jpg') }}');">
        </div>
    </div>

    <div class="flex flex-col gap-6">

        <!-- HEADER -->
        <div class="text-center space-y-1">
            <h3 class="text-2xl font-extrabold text-amber-900 tracking-wide">
                BOC - VBS2026
            </h3>
            <h1 class="text-sm text-gray-600">
                Login to your account
            </h1>
        </div>

        <!-- SESSION STATUS -->
        <x-auth-session-status class="text-center text-sm text-amber-700" :status="session('status')" />

        <!-- FORM -->
        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- EMAIL -->
            <div>
                <label class="block text-sm font-medium text-amber-900 mb-1">
                    Email
                </label>

                <input
                    name="email"
                    value="{{ old('email') }}"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="email@boc.com"
                    class="w-full rounded-lg px-3 py-2
                           border border-amber-200
                           bg-amber-50/30
                           text-gray-800
                           focus:outline-none focus:ring-2 focus:ring-amber-400"
                />
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-sm font-medium text-amber-900 mb-1">
                    Password
                </label>

                <input
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Password"
                    class="w-full rounded-lg px-3 py-2
                           border border-amber-200
                           bg-amber-50/30
                           text-gray-800
                           focus:outline-none focus:ring-2 focus:ring-amber-400"
                />
            </div>

            <!-- ERRORS -->
            @if ($errors->any())
                <div class="bg-red-50 text-red-600 border border-red-200 rounded-lg py-2 px-3 text-sm">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full bg-amber-600 hover:bg-amber-700
                       text-white font-semibold py-2.5 rounded-lg
                       shadow-sm transition duration-200"
            >
                Log in
            </button>

        </form>
    </div>

</x-layouts::auth>
