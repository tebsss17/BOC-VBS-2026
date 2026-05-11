<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" type="image/jpg">
</head>

<body class="min-h-screen bg-white ">

@php
    $base = 'flex items-center gap-2 rounded-lg px-3 py-2 font-medium transition duration-200';
    $inactive = 'text-gray-700 hover:bg-amber-50 hover:text-amber-900';
    $active = 'bg-amber-50 text-amber-900';
@endphp

<!-- MAIN SIDEBAR -->
<flux:sidebar sticky collapsible="mobile"
    class="h-screen overflow-hidden border-e border-amber-100 bg-white ">

    <flux:sidebar.header class="flex items-center gap-3 px-3 py-4 border-b border-amber-100">

    <a href="{{ route('dashboard') }}" wire:navigate class="shrink-0">
        <img src="{{ asset('images/logo.jpg') }}"
             alt="Logo"
             class="h-12 w-12 rounded-full object-cover border border-amber-200 shadow-sm">
    </a>

    <div class="leading-tight">
        <h1 class="text-sm font-extrabold text-amber-900">
            BOC Mariveles
        </h1>
        <p class="text-xs text-gray-500">
            VBS 2026
        </p>
    </div>

    <flux:sidebar.collapse class="ml-auto lg:hidden" />

</flux:sidebar.header>

    <!-- NAVIGATION -->
    <div class="space-y-2 px-2">

        <!-- HOME -->
        <a href="/dashboard"
           wire:navigate
           class="{{ $base }} {{ request()->is('dashboard') ? $active : $inactive }}">
            <i data-lucide="layout-grid" class="w-5 h-5"></i>
            Home
        </a>

        <!-- USERS -->
        @if (auth()->user()->role === 'Admin')
        <a href="/users"
           wire:navigate
           class="{{ $base }} {{ request()->is('users*') ? $active : $inactive }}">
            <i data-lucide="user-cog" class="w-5 h-5"></i>
            Users
        </a>
        @endif

        <!-- STUDENTS -->
        <a href="/students"
           wire:navigate
           class="{{ $base }} {{ request()->is('students*') ? $active : $inactive }}">
            <i data-lucide="user" class="w-5 h-5"></i>
            Students
        </a>

        <!-- LESSONS -->
        <a href="/lessons"
           wire:navigate
           class="{{ $base }} {{ request()->is('lessons*') ? $active : $inactive }}">
            <i data-lucide="book-check" class="w-5 h-5"></i>
            Lessons
        </a>

        <!-- ATTENDANCE -->
        <a href="/attendances"
           wire:navigate
           class="{{ $base }} {{ request()->is('attendances*') ? $active : $inactive }}">
            <i data-lucide="calendar-check" class="w-5 h-5"></i>
            Attendance
        </a>

        <!-- REPORTS -->
        <a href="/reports"
           wire:navigate
           class="{{ $base }} {{ request()->is('reports*') ? $active : $inactive }}">
            <i data-lucide="chart-column-increasing" class="w-5 h-5"></i>
            Reports
        </a>

    </div>

    <flux:spacer />

    <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />

</flux:sidebar>

<!-- MOBILE HEADER -->
<flux:header class="lg:hidden">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

    <flux:spacer />

    <flux:dropdown position="top" align="end">
        <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

        <flux:menu>
            <flux:menu.radio.group>
                <div class="flex items-center gap-2 px-2 py-2">
                    <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />
                    <div>
                        <div class="font-medium">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                    </div>
                </div>
            </flux:menu.radio.group>

            <flux:menu.separator />

            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                Settings
            </flux:menu.item>

            <flux:menu.separator />

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle">
                    Log out
                </flux:menu.item>
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:header>

<!-- CONTENT -->
{{ $slot }}

@persist('toast')
    <flux:toast.group>
        <flux:toast />
    </flux:toast.group>
@endpersist

@fluxScripts

</body>
</html>
