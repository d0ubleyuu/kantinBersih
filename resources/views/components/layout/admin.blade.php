<!DOCTYPE html>
<html x-data="data" lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">

    <title>{{ $pageTitle }}</title>

    <link rel="icon" type="image/x-icon" href="{{ Vite::asset('resources/images/logo-warna.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-inter">
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" ::class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <aside
            class="z-20 hidden w-64 overflow-y-auto bg-[#262261] md:block flex-shrink-0 m-3 rounded-md drop-shadow-lg">
            <div class="py-4 text-slate-300">
                <a class="ml-6 flex mt-4" href="kasir.php">
                    <img src="{{ Vite::asset('resources/images/logo-white.png') }}" alt="Kantin Bersih" class="w-7 h-7">
                    <span class="text-lg font-bold text-slate-50 ml-3">Kantin Bersih </span>
                </a>
                <ul class="mt-6">
                    <x-navigation.item class="mt-6" :active="$isDashboard()" :has-child="false" :href="route('home')"
                        icon="bi bi-house-fill">
                        Dashboard
                    </x-navigation.item>
                    <x-navigation.item :active="$isEmployee()" :has-child="false" :href="route('admin.employee-page')"
                        icon="bi bi-person-vcard-fill">
                        Employees
                    </x-navigation.item>
                    <x-navigation.item :active="$isKasir()" :has-child="false" :href="route('admin.kasir-page')"
                        icon="bi bi-calculator-fill">
                        Kasir
                    </x-navigation.item>
                    <x-navigation.item :active="$isIngredient()" has-child="true" href="#" icon="bi bi-person-vcard-fill">
                        Material
                        <x-slot:child>
                            <x-navigation.item-child :href="route('admin.ingredient-page')">
                                Manage Material
                            </x-navigation.item-child>
                            <x-navigation.item-child :href="route('admin.restock-page')">
                                Restock
                            </x-navigation.item-child>
                        </x-slot:child>
                    </x-navigation.item>
                    <x-navigation.item :active="$isMenu()" :has-child="false" :href="route('admin.menu-page')"
                        icon="bi bi-menu-button-wide-fill">
                        Menu
                    </x-navigation.item>
                    <x-navigation.item :active="false" :has-child="false" :href="route('admin.transaction-page')"
                        icon="bi bi-clipboard-data-fill">
                        Laporan Transaksi
                    </x-navigation.item>
                </ul>
                <div class="px-6 my-6">
                    <a href="{{ route('logout') }}">
                        <button
                            class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition ease-in-out duration-500 bg-gradient-to-r from-[#EE4036] to-[#FAAF40]  border border-transparent rounded-lg active:from-[#FAAF40] active:to-[#EE4036] hover:shadow-lg hover:shadow-yellow-500/50 focus:outline-none focus:shadow-outline-purple">
                            Log Out
                            <span class="ml-2" aria-hidden="true">
                                <i class="bi bi-box-arrow-right"></i>
                            </span>
                        </button>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        <div x-cloak x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
        <aside
            class="ml-3 fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-24 overflow-y-auto bg-[#262261] md:hidden rounded-lg drop-shadow-lg"
            x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
            @keydown.escape="closeSideMenu">
            <div class="py-4 text-slate-300">
                <a class="ml-6 text-lg font-bold text-slate-50" href="{{ route('home') }}">
                    Kantin Bersih
                </a>
                <ul class="mt-6">
                    <x-navigation.item class="mt-6" active="true" has-child="false" :href="route('home')"
                        icon="bi bi-house-fill">
                        Dashboard
                    </x-navigation.item>
                    <x-navigation.item active="false" has-child="false" :href="route('admin.employee-page')"
                        icon="bi bi-person-vcard-fill">
                        Employees
                    </x-navigation.item>
                    <x-navigation.item active="false" has-child="true" href="#" icon="bi bi-person-vcard-fill">
                        Material
                        <x-slot:child>
                            <x-navigation.item-child :href="route('home')">
                                Manage Material
                            </x-navigation.item-child>
                            <x-navigation.item-child :href="route('home')">
                                Restock
                            </x-navigation.item-child>
                        </x-slot:child>
                    </x-navigation.item>
                    <x-navigation.item active="false" has-child="false" :href="route('home')"
                        icon="bi bi-menu-button-wide-fill">
                        Menu
                    </x-navigation.item>
                    <x-navigation.item active="false" has-child="false" :href="route('home')"
                        icon="bi bi-clipboard-data-fill">
                        Reports
                    </x-navigation.item>
                </ul>
                <div class="px-6 my-6">
                    <a href="{{ route('logout') }}">
                        <button
                            class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition ease-in-out duration-500 bg-gradient-to-r from-[#EE4036] to-[#FAAF40]  border border-transparent rounded-lg active:from-[#FAAF40] active:to-[#EE4036] hover:shadow-lg hover:shadow-yellow-500/50 focus:outline-none focus:shadow-outline-purple">
                            Log Out
                            <span class="ml-2" aria-hidden="true">
                                <i class="bi bi-box-arrow-right"></i>
                            </span>
                        </button>
                    </a>
                </div>
            </div>
        </aside>

        <div class="flex flex-col flex-1 w-full">
            <header class="z-10 py-4 bg-[#262261] m-3 shadow-lg rounded-lg">
                <div class="container flex items-center justify-between h-full px-6 mx-auto text-slate-50 ">
                    <!-- Mobile hamburger -->
                    <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                        @click="toggleSideMenu" aria-label="Menu">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="flex justify-center flex-1 lg:mr-32">

                    </div>
                    <ul class="flex items-center flex-shrink-0 space-x-6">
                        <!-- Notifications menu -->
                        <li class="relative">
                            <button
                                class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                                @click="toggleNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                                aria-label="Notifications" aria-haspopup="true">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                                    </path>
                                </svg>
                                <!-- Notification badge -->
                                <span aria-hidden="true"
                                    class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full"></span>
                            </button>
                            <div>
                                <ul x-cloak x-show="isNotificationsMenuOpen"
                                    x-transition:enter="transition ease-in duration-150"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click.away="closeNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md">
                                    <li class="flex">
                                        <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800"
                                            href="#">
                                            <span>Messages</span>
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full">
                                                13
                                            </span>
                                        </a>
                                    </li>
                                    <li class="flex">
                                        <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 "
                                            href="#">
                                            <span>Sales</span>
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full ">
                                                2
                                            </span>
                                        </a>
                                    </li>
                                    <li class="flex">
                                        <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800"
                                            href="#">
                                            <span>Alerts</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- Profile menu -->
                        <li class="relative">
                            <button class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                                @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                                aria-haspopup="true">
                                <img class="object-cover w-8 h-8 rounded-full"
                                    src="{{ Vite::asset('resources/images/blank-profile.png') }}"
                                    alt="Profile Picture" aria-hidden="true" />
                            </button>
                            <div>
                                <ul x-cloak x-show="isProfileMenuOpen"
                                    x-transition:enter="transition ease-in duration-150"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu"
                                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md "
                                    aria-label="submenu">
                                    <li class="flex">
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 "
                                            href="{{ route('logout') }}">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path
                                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            <span>Log out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>

            <main class="h-full pb-16 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
    @isset($afterWrapper)
        {{ $afterWrapper }}
    @endisset
    {{-- <script src="{{ asset('js/init-alpine.js') }}"></script> --}}
    @isset($additionalScripts)
        {{ $additionalScripts }}
    @endisset
</body>

</html>
