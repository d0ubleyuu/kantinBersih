<x-layout.admin page-title="Kasir - Kantin Bersih">
    <div class="container px-6 mx-auto grid">

        <div class=" focus-within:text-orange-400 text-gray-400 mb-6 mt-2">
            <div class="relative focus-within:text-Orange-400 shadow appearance-none border rounded-lg">
                <input x-model="$store.kasir.search"
                    class=" block pl-10 mt-1shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50 focus:placeholder-gray-300"
                    id="search" type="text" placeholder="Search">
                <div class="absolute inset-y-0 flex items-center ml-3 mb-1 pointer-events-none">
                    <span class="w-5 h-5">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div id="daftar-menu" data-menus="{{ json_encode($menus) }}"
        class="w-11/12 mx-auto grid gap-6 mb-8 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-4">

        <!-- Menu -->
        <template x-for="menu in $store.kasir.filteredMenus">
            <button x-bind:data-menu="JSON.stringify(menu)" @click="$store.kasir.selectMenu($event)"
                class="hover:bg-orange-400 active:bg-[#262261] hover:text-white text-zinc-700 bg-white rounded-lg px-6 py-4 transition-colors shadow-md duration-300 ease-in-out"
                id="1">
                <div>
                    <Strong id="title" class="block text-left text-xl" x-text="menu.menu_name">
                    </Strong>
                    {{-- <p class="block text-left text-sm">
                        Dessert
                    </p> --}}
                    <Strong id="harga" class="block text-right text-xl" x-text="menu.selling_price">
                        18.000
                    </Strong>
                </div>
            </button>
        </template>
    </div>

    <!-- Footer -->
    <div class="absolute z-20 bottom-0 right-0 bg-orange-500 m-3 shadow-lg rounded-lg xl:w-4/5 md:w-3/5 lg:4/5 w-11/12">
        <div class="relative container items-center justify-between h-full">
            <div class="flex mx-auto text-slate-50 ">
                <div class="ml-8 py-4 font-bold">Total Rp.</div>
                <div class="ml-1 py-4 font-bold" id="total"x-text="$store.kasir.total">18000</div>
                <div class="absolute inset-y-0 right-0">
                    <button @click="$store.kasir.modal.openModal()"
                        class="rounded-r-lg bg-[#262261] p-4 hover:bg-orange-400 active:bg-orange-600 transition-colors duration-300">
                        <i class="fa-solid fa-cart-shopping mr-1"></i>Checkout
                    </button>
                </div>
            </div>
        </div>

    </div>

    <x-slot:afterWrapper>
        <!-- Modal backdrop. This what you want to place close to the closing body tag -->
        <div x-data="$store.kasir.modal" x-cloak x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
            <!-- Modal -->
            <div x-cloak x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeModal"
                @keydown.escape="closeModal"
                class="w-full xl:h-5/6 md:h-5/6 h-full overflow-y-auto xl:w-4/5 px-6 py-4 overflow-hidden bg-[#f3f2fa] rounded-t-lg sm:rounded-lg sm:m-4"
                role="dialog" id="modal-kasir">
                <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                <header class="flex justify-end">
                    <button
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded hover: "
                        aria-label="close" @click="closeModal">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                            <path
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </header>
                <!-- Modal body -->
                <div class="mt-4 mb-6">
                    <!-- Modal title -->
                    <div class="grid xl:grid-cols-3 md:grid-cols-3 grid-cols-1 gap-6">
                        <div class="xl:col-span-3 md:col-span-3 col-span-1">
                            <h1 class="font-bold text-3xl text-orange-400 text-center mb-4"
                                style="text-shadow: 1px 1px 5px rgba(194, 65, 12,1);">Checkout <i
                                    class="fa-solid fa-cart-shopping"></i>
                            </h1>
                        </div>
                        <div class="xl:col-span-2 md:col-span-2 flex justify-center bg-white rounded-lg shadow-lg">
                            <div class="overflow-auto w-full h-96">
                                <table class="w-full whitespace-no-wrap rounded-t-lg">
                                    <thead>
                                        <tr
                                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50 rounded-t-lg">
                                            <th class="px-4 py-3">Nama</th>
                                            <th class="px-4 py-3">Harga</th>
                                            <th class="px-4 py-3">Jumlah</th>
                                            <th class="px-4 py-3">Sub-Total</th>
                                            <th class="px-4 py-3">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y">
                                        <template x-for="menu in $store.kasir.selectedMenus">
                                            <tr class="text-gray-700">
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center text-sm">
                                                        <div>
                                                            <p class="font-semibold" x-text="menu.data.menu_name"></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm font-semibold"
                                                    x-text="'Rp. ' + menu.data.selling_price">
                                                </td>
                                                <td class="py-3 text-xs">
                                                    <div class="w-[200px] grid grid-cols-3 gap-0 text-center">
                                                        <div class="col-span-1">
                                                            <button @click="menu.decrement()" value="Increase"
                                                                class="bg-[#262261] w-8 h-8 py-auto text-white rounded-l-lg hover:bg-orange-500 transition-colors duration-300">
                                                                <i class="fa-solid fa-minus"></i>
                                                            </button>
                                                        </div>
                                                        <div class="col-span-1">
                                                            <input type="number" name="restoknum"
                                                                class="w-full text-center border-0 focus:ring-0"
                                                                id="number" x-model="menu.quantity" />
                                                        </div>
                                                        <div class="col-span-1">
                                                            <button @click="menu.increment()" value="Increase"
                                                                class="bg-[#262261] w-8 h-8 py-auto text-white rounded-r-lg hover:bg-orange-500 transition-colors duration-300">
                                                                <i class="fa-solid fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm font-semibold"
                                                    x-text="'Rp. ' + (menu.data.selling_price * menu.quantity)">
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center space-x-4 text-sm">
                                                        <button x-bind:data-menu-id="menu.data.id"
                                                            @click="$store.kasir.removeMenu($event)"
                                                            class="flex items-center justify-center w-8 h-8 font-medium leading-5 text-[#262261] rounded-lg focus:outline-none focus:shadow-outline-gray hover:bg-orange-500 hover:text-white duration-300 transition-colors"
                                                            aria-label="cancel">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="flex justify-center bg-white rounded-lg shadow-lg">
                            <div class="w-full px-4 py-6">

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Bayar
                                    </label>
                                    <input x-model="$store.kasir.payment"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-orange-400 focus:outline-none focus:shadow-outline-yellow"
                                        id="nama" name="payment" type="number" placeholder="Bayar">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Kembalian
                                    </label>
                                    <input disabled x-model="$store.kasir.change"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:border-orange-400 focus:outline-none focus:shadow-outline-yellow"
                                        id="jumlah" name="change" type="number" placeholder="Kembalian">
                                </div>

                                <div class="mb-8">
                                    <div class="grid grid-cols-4 text-white">
                                        <div class="col-span-3 bg-orange-500 rounded-l-lg py-1 pl-4">
                                            <p class="text-sm">
                                                Total
                                            </p>
                                            <p class="text-lg font-semibold" x-text="$store.kasir.total">36000</p>
                                        </div>
                                        <div class="col-span-1 ">
                                            <button @click="$store.kasir.submit()"
                                                class="bg-[#262261] rounded-r-lg w-full h-full hover:bg-orange-400 active:bg-orange-600 transition-colors duration-300">Proses</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End of modal backdrop -->
    </x-slot:afterWrapper>
</x-layout.admin>
