<x-layout.admin page-title="Admin Dashboard - Kantin Bersih">
    <div class="container px-6 mx-auto grid">
        <div class="h-48 bg-gradient-to-r from-[#EE4036] to-[#ee6e36] rounded-lg">
            <h3 class="my-6 text-center text-2xl font-semibold text-white">
                Dashboard
            </h3>

            <h2 class="my-6 text-center text-3xl font-semibold text-white">
                SELAMAT PAGI, {{ Auth::user()->name }}!
            </h2>
        </div>
        <div class="w-11/12 mx-auto grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4 -mt-8">
            <x-admin.dashboard.card icon="fa-solid fa-users" icon-color="orange-500" icon-bg="orange-100">
                <x-slot:name>Daily Income</x-slot:name>
                Rp. 2.585.500
            </x-admin.dashboard.card>

            <x-admin.dashboard.card icon="fa-solid fa-money-bill-1-wave" icon-color="green-500" icon-bg="green-100">
                <x-slot:name>Daily Sales</x-slot:name>
                142
            </x-admin.dashboard.card>

            <x-admin.dashboard.card icon="fa-solid fa-money-bills" icon-color="blue-500" icon-bg="blue-100">
                <x-slot:name>Total Income</x-slot:name>
                Rp. 442.853.000
            </x-admin.dashboard.card>

            <x-admin.dashboard.card icon="fa-solid fa-people-group" icon-color="teal-500" icon-bg="teal-100">
                <x-slot:name>Total Sales</x-slot:name>
                1824
            </x-admin.dashboard.card>
        </div>
    </div>
</x-layout.admin>
