<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <!-- Main Sidebar -->
        <flux:sidebar sticky collapsible="mobile" class="border-e border-zinc-200 bg-[#415474] dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.header>
                <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>

            <!-- Main navbar -->
            <div class="space-y-5">
                <!-- <flux:sidebar.group :heading="__('Platform')" class="grid"> -->
                    <a href="/dashboard"
                    :current="request()->routeIs('/dashboard')"
                    wire:navigate
                    class="flex items-center gap-2 duration-300 rounded-lg font-medium py-2 px-2 text-white hover:bg-white hover:text-[#2d4166]"
                    >
                        <i data-lucide="layout-grid" class="w-5 h-5"></i>
                            Home
                    </a>
                <!-- </flux:sidebar.group> -->

                @if (auth()->user()->role === 'admin')
                    <a href="/users"
                    :current="request()->routeIs('/users')"
                    wire:navigate
                    class="flex items-center gap-2 duration-300 rounded-lg font-medium py-2 px-2 text-white hover:bg-white hover:text-[#2d4166]"
                    >
                        <i data-lucide="user-cog" class="w-5 h-5"></i>
                            Users
                    </a>

                @endif

                    <a href="/students"
                    :current="request()->routeIs('/students')"
                    wire:navigate
                    class="flex items-center gap-2 duration-300 rounded-lg font-medium py-2 px-2 text-white hover:bg-white hover:text-[#2d4166]"
                    >
                        <i data-lucide="user" class="w-5 h-5"></i>
                            Students
                    </a>

                    <a href="/lessons"
                    :current="request()->routeIs('/lessons')"
                    wire:navigate
                    class="flex items-center gap-2 duration-300 rounded-lg font-medium py-2 px-2 text-white hover:bg-white hover:text-[#2d4166]"
                    >
                        <i data-lucide="book-check" class="w-5 h-5"></i>
                            Lessons
                    </a>

                    <a href="/attendance"
                    :current="request()->routeIs('/attendances')"
                    wire:navigate
                    class="flex items-center gap-2 duration-300 rounded-lg font-medium py-2 px-2 text-white hover:bg-white hover:text-[#2d4166]"
                    >
                        <i data-lucide="calendar-check" class="w-5 h-5"></i>
                            Attendance
                    </a>

                    <a href="/reports"
                    :current="request()->routeIs('/reports')"
                    wire:navigate
                    class="flex items-center gap-2 duration-300 rounded-lg font-medium py-2 px-2 text-white hover:bg-white hover:text-[#2d4166]"
                    >
                        <i data-lucide="chart-column-increasing" class="w-5 h-5"></i>
                            Reports
                    </a>
            </div>

            <flux:spacer />

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Log out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
