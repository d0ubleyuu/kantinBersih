<x-layout.admin page-title="Edit Menu - Kantin Bersih">
    <div class="container grid px-6 mx-auto">
        <!-- Main section -->
        <div class="grid gap-6 mb-8 xl:grid-cols-2">
            <div class="row-span-1 px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h4 class="mb-4 text-lg font-semibold text-gray-600">
                    Detail Menu
                </h4>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700">ID Menu</span>
                    <input disabled type="text" name="id" value="{{ $menu->id }}"
                        class="block w-full mt-1 placeholder-gray-400 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-gray focus-within:text-primary-600 dark:focus-within:text-primary-400 dark:placeholder-gray-500 dark:focus:placeholder-gray-600 focus:placeholder-gray-300"
                        placeholder="Menu ID">
                </label>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700">Nama Menu</span>
                    <input type="text" name="menu_name" value="{{ $menu->menu_name }}"
                        class="block w-full mt-1 placeholder-gray-400 border-gray-300 rounded-md shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50 focus-within:text-orange-600 focus:placeholder-gray-300"
                        placeholder="Menu Name">
                </label>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700">Harga Menu</span>
                    <!-- focus-within sets the color for the icon when input is focused -->
                    <div class="relative text-gray-700">
                        <input type="number" name="selling_price" value="{{ $menu->selling_price }}"
                            class="block w-full pl-10 mt-1 placeholder-gray-400 border-gray-300 rounded-md shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50 focus-within:text-orange-600 focus:placeholder-gray-300"
                            placeholder="Selling Price">
                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                            <span>Rp.</span>
                        </div>
                    </div>
                </label>

                <div class="mb-4 flex justify-end">
                    <button @click="$store.updateMenu.submit()"
                        class="w-auto h-10 px-4 text-base font-medium text-white transition-colors duration-150 border border-transparent rounded-lg bg-orange-600 active:bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring">
                        <i class="mr-2 pointer-events-none fas fa-floppy-disk"></i> <span>Simpan</span>
                    </button>
                </div>
            </div>
            <div class="row-span-2 px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h4 class="mb-4 text-lg font-semibold text-gray-600">
                    Bahan Menu
                </h4>

                <div class="mb-4">
                    <button @click="$store.modalBahanMenu.wrapOpenModal($event)" data-action="new"
                        class="w-auto h-10 px-4 text-base font-medium text-white transition-colors duration-150 border border-transparent rounded-lg bg-orange-600 active:bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring">
                        <i class="mr-2 pointer-events-none fas fa-plus"></i> <span>Tambah</span>
                    </button>
                </div>

                <div class="w-full overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                                    <th class="px-4 py-3">Nama Bahan</th>
                                    <th class="px-4 py-3">Jumlah</th>
                                    <th class="px-4 py-3">Takaran</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y">
                                @php
                                    $bahanBahan = $menu->ingredients;
                                @endphp
                                @foreach ($bahanBahan as $bahan)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3">
                                            <p class="font-semibold">{{ $bahan->name }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $bahan->pivot->quantity }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $bahan->measurement->short_name }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-4 text-sm">
                                                <button data-bahan-menu="{{ json_encode($bahan) }}"
                                                    @click="$store.modalBahanMenu.wrapOpenModal($event)"
                                                    data-action="update"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg text-orange-600 focus:outline-none focus:ring-gray"
                                                    aria-label="Edit">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <button data-bahan-menu-id="{{ $bahan->id }}"
                                                    @click="$store.deleteBahanMenu"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg text-orange-600 focus:outline-none focus:ring-gray"
                                                    aria-label="Delete">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                        <span class="flex items-center col-span-3">
                            Total Bahan: {{ $menu->ingredients->count() }}
                        </span>
                        <span class="col-span-2"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot:afterWrapper>
        <!-- Modal backdrop. This what you want to place close to the closing body tag -->
        <div x-data="$store.modalBahanMenu" x-cloak x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
            <!-- Modal -->
            <div x-cloak x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="wrapCloseModal"
                @keydown.escape="wrapCloseModal"
                class="w-full px-6 py-4 overflow-hidden bg-[#f3f2fa] rounded-t-lg sm:rounded-lg sm:m-4 sm:max-w-xl"
                role="dialog" id="modal-bahan-menu">
                <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                <header class="flex justify-end">
                    <button
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded hover: "
                        aria-label="close" @click="wrapCloseModal">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img"
                            aria-hidden="true">
                            <path
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </header>
                <!-- Modal body -->
                <div class="mt-4 mb-6">
                    <!-- Modal title -->
                    <p class="mb-2 text-xl font-semibold text-gray-700 ">
                        Add Ingredient
                    </p>
                    <!-- Modal description -->
                    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="ingredient_id">
                                Bahan
                            </label>
                            <select data-available="{{ $ingredients->toJson() }}" id="ingredient_id"
                                name="ingredient_id"
                                class="block w-full text-sm form-select shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                                <option>Select an Option</option>
                                {{-- @foreach ($measurements as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->short_name }}</option>
                                @endforeach --}}
                            </select>
                            <span x-cloak x-show="!formValid.ingredient_id"
                                class="text-xs text-red-600 dark:text-red-400">
                                Pesan validasi bahan
                            </span>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                                Jumlah Bahan
                            </label>
                            <input id="quantity" name="quantity"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 text-sm leading-tight focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50 focus:placeholder-gray-300"
                                type="number" placeholder="Enter Ingredient quantity">
                            <span x-cloak x-show="!formValid.quantity" class="text-xs text-red-600 dark:text-red-400">
                                Pesan validasi jumlah bahan
                            </span>
                        </div>

                    </div>
                    <footer
                        class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row">
                        <button @click="wrapCloseModal"
                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray shadow-md">
                            Cancel
                        </button>
                        <button @click="submit"
                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-orange-400 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-orang-500 hover:bg-orange-400 focus:outline-none focus:shadow-outline-yellow shadow-md">
                            Process
                        </button>
                    </footer>
                </div>
            </div>
        </div>
        <!-- End of modal backdrop -->
    </x-slot:afterWrapper>
</x-layout.admin>
