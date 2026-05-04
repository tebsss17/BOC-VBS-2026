<x-layouts::auth :title="__('Log in')" class="border-2">
    <div class="flex flex-col gap-6">
        <div>
        <h3 class="text-2xl text-main text-center font-extrabold">BOC - VBS2026</h3>
        <h1 class="text-center text-main">Login to your account</h1>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email Address -->
            <div>
            <label for="email" class="block sm:text-sm md:text-lg font-medium text-main">Email</label>
            <input
                name="email"
                value="{{ old('email') }}"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@boc.com"
                class="w-full bg-[#fefefe] rounded-md py-2 px-3 border-[#2d4163] border-2 shadow-lg"
            />
            </div>

            <!-- Password -->
            <div>
            <label for="email" class="block sm:text-sm md:text-lg font-medium text-main">Password</label>
                <input
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Password"
                    class="w-full bg-[#fefefe] rounded-md py-2 px-3 border-[#2d4163] border-2 shadow-lg"
                />
            </div>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-500 border-red-700 border rounded-lg py-2 px-3">
                        @foreach ($errors->all() as $error )
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

            <div class="flex items-center justify-center">
                <button type="submit" class="bg-[#e8b72a] px-3 py-2 rounded-lg shadow-xl text-lg font-bold text-white hover:bg-[#d1a526] duration-300 cursor-pointer w-full" data-test="login-button">
                    Log in
                </button>
            </div>
        </form>
    </div>
</x-layouts::auth>
