<x-layouts::app :title="__('Create User')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <x-reusables.header class="bg-main shadow-xl text-white border rounded-xl py-4 px-2 font-extrabold text-2xl text-center md:text-4xl tracking-wide">
            User - {{ $user->name }}
        </x-reusables.header>

        <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col gap-4">
            <p class="block text-xl">Name: <span class="font-bold">{{ $user->name }}</span></p>
        </div>


    </div>
</x-layouts::app>
