<x-layout.admin page-title="Edit Menu - Kantin Bersih">
    <div class="container grid px-6 mx-auto">
        <!-- Main section -->
        <div class="grid gap-6 mb-8 xl:grid-cols-2">
            <div class="row-span-1 px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h4 class="mb-4 text-lg font-semibold text-gray-600">
                    Detail Transaksi
                </h4>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700">ID Transaksi</span>
                    <input disabled type="text" name="id" value="{{ $transaction->id }}"
                        class="block w-full mt-1 placeholder-gray-400 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-gray focus-within:text-primary-600 dark:focus-within:text-primary-400 dark:placeholder-gray-500 dark:focus:placeholder-gray-600 focus:placeholder-gray-300"
                        placeholder="Menu ID">
                </label>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700">Nama Karyawan</span>
                    <input disabled type="text" name="menu_name" value="{{ $transaction->employee->name }}"
                        class="block w-full mt-1 placeholder-gray-400 border-gray-300 rounded-md shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50 focus-within:text-orange-600 focus:placeholder-gray-300"
                        placeholder="Menu Name">
                </label>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700">Total Belanja</span>
                    <!-- focus-within sets the color for the icon when input is focused -->
                    <div class="relative text-gray-700">
                        <input disabled type="number" name="selling_price"
                            value="{{ $transaction->transaction_total }}"
                            class="block w-full pl-10 mt-1 placeholder-gray-400 border-gray-300 rounded-md shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50 focus-within:text-orange-600 focus:placeholder-gray-300"
                            placeholder="Selling Price">
                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                            <span>Rp.</span>
                        </div>
                    </div>
                </label>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700">Total Bayar</span>
                    <!-- focus-within sets the color for the icon when input is focused -->
                    <div class="relative text-gray-700">
                        <input disabled type="number" name="selling_price" value="{{ $transaction->payment_total }}"
                            class="block w-full pl-10 mt-1 placeholder-gray-400 border-gray-300 rounded-md shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50 focus-within:text-orange-600 focus:placeholder-gray-300"
                            placeholder="Selling Price">
                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                            <span>Rp.</span>
                        </div>
                    </div>
                </label>

                <label class="block mb-4 text-sm">
                    <span class="text-gray-700">Total Kembalian</span>
                    <!-- focus-within sets the color for the icon when input is focused -->
                    <div class="relative text-gray-700">
                        <input disabled type="number" name="selling_price" value="{{ $transaction->change }}"
                            class="block w-full pl-10 mt-1 placeholder-gray-400 border-gray-300 rounded-md shadow-sm focus:border-orange-300 focus:ring focus:ring-orange-200 focus:ring-opacity-50 focus-within:text-orange-600 focus:placeholder-gray-300"
                            placeholder="Selling Price">
                        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
                            <span>Rp.</span>
                        </div>
                    </div>
                </label>
            </div>
            <div class="row-span-2 px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h4 class="mb-4 text-lg font-semibold text-gray-600">
                    Daftar Menu
                </h4>

                <div class="w-full overflow-hidden rounded-lg ring-1 ring-black ring-opacity-5">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                                    <th class="px-4 py-3">Nama Menu</th>
                                    <th class="px-4 py-3">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y">
                                @foreach ($transaction->menus as $menu)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3">
                                            <p class="font-semibold">{{ $menu->menu_name }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            {{ $menu->pivot->amount }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                        <span class="flex items-center col-span-3">
                            Total Menu: {{ $transaction->menus->count() }}
                        </span>
                        <span class="col-span-2"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>
