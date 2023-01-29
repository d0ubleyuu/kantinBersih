<x-layout.admin page-title="Data Bahan - Kantin Bersih">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700">
            Ingredients
        </h2>
        <div class="grid grid-cols-2 w-48">
            <div>
                <button data-action="new" @click="$store.modalIngredient.wrapOpenModal($event)"
                    class="mt-3 mb-4 flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition ease-in-out duration-500 bg-gradient-to-r from-[#EE4036] to-[#FAAF40]  border border-transparent rounded-lg active:from-[#FAAF40] active:to-[#EE4036] hover:shadow-lg hover:shadow-yellow-500/50">
                    <span>Add</span>
                    <i class="ml-1 fa-solid fa-basket-shopping"></i>
                </button>
            </div>
        </div>
        <!-- Tabel Ingredient -->
        <div class="w-full overflow-hidden rounded-lg shadow-2xl">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Nama Bahan</th>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Stock</th>
                            <th class="px-4 py-3">Harga Modal</th>
                            <th class="px-4 py-3">Satuan</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($ingredients as $bahan)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="font-semibold">{{ $bahan->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $bahan->id }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $bahan->stock }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @php
                                        $cptLen = Str::length($bahan->capital_price);
                                        $section = intdiv($cptLen, 3);
                                        $remain = $cptLen % 3;
                                        $formatted = 'Rp. ';

                                        if ($remain != 0) {
                                            $formatted .= Str::substr($bahan->capital_price, 0, $remain) . ',';

                                            for ($i = 1; $i <= $section; $i++) {
                                                $formatted .= Str::substr($bahan->capital_price, 3 * $i - (3 - $remain), 3);
                                                if ($i != $section) {
                                                    $formatted .= ',';
                                                } else {
                                                    $formatted .= '.00';
                                                }
                                            }
                                        } else {
                                            for ($i = 0; $i < $section; $i++) {
                                                $formatted .= Str::substr($bahan->capital_price, 3 * $i, 3);
                                                if ($i != $section - 1) {
                                                    $formatted .= ',';
                                                } else {
                                                    $formatted .= '.00';
                                                }
                                            }
                                        }
                                    @endphp
                                    {{ $formatted }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $bahan->measurement->long_name }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <button data-ingredient="{{ json_encode($bahan) }}" data-action="update"
                                            @click="$store.modalIngredient.wrapOpenModal($event)"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-[#262261] rounded-lg focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button data-ingredient-id="{{ $bahan->id }}"
                                            @click="$store.deleteIngredient"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-[#262261] rounded-lg focus:outline-none focus:shadow-outline-gray"
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
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 sm:grid-cols-9">
                <span class="flex items-center col-span-3">
                    Showing {{ $ingredients->firstItem() }}-{{ $ingredients->lastItem() }} of
                    {{ $ingredients->total() }}
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                @if ($ingredients->hasPages())
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                        <nav aria-label="Table navigation">
                            <ul class="inline-flex items-center">
                                @if (!is_null($ingredients->previousPageUrl()))
                                    <li>
                                        <a href="{{ $ingredients->url(1) }}">
                                            <button
                                                class="px-1 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                                aria-label="Previous">
                                                <svg class="w-4 h-4 fill-current" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414zm-6 0a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L5.414 10l4.293 4.293a1 1 0 010 1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $ingredients->previousPageUrl() }}">
                                            <button
                                                class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                                aria-label="Previous">
                                                <svg class="w-4 h-4 fill-current" aria-hidden="true"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </a>
                                    </li>
                                @endif
                                @php
                                    $currPage = $ingredients->currentPage();
                                @endphp
                                {{-- @dump($ingredients->getUrlRange($currPage, $currPage + 6)) --}}
                                @if ($currPage + 5 <= $ingredients->lastPage())
                                    @php
                                        $urlRanges = $ingredients->getUrlRange($currPage, $currPage + 5);
                                    @endphp
                                    @foreach ($urlRanges as $page => $url)
                                        @if ($page == $currPage)
                                            <li>
                                                <button
                                                    class="px-3 py-1 rounded-md text-white transition-colors duration-150 bg-gradient-to-r from-primary to-yellow-400 focus:outline-none focus:shadow-outline-purple">
                                                    {{ $page }}
                                                </button>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ $url }}">
                                                    <button
                                                        class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                                        {{ $page }}
                                                    </button>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @else
                                    @php
                                        $first = $ingredients->lastPage() - 6 + 1;
                                        $urlRanges = $ingredients->getUrlRange($first, $first + 5);
                                    @endphp
                                    @foreach ($urlRanges as $page => $url)
                                        @if ($page == $currPage)
                                            <li>
                                                <button
                                                    class="px-3 py-1 rounded-md text-white transition-colors duration-150 bg-gradient-to-r from-primary to-yellow-400 focus:outline-none focus:shadow-outline-purple">
                                                    {{ $page }}
                                                </button>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ $url }}">
                                                    <button
                                                        class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                                        {{ $page }}
                                                    </button>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                                @if (!is_null($ingredients->nextPageUrl()))
                                    <li>
                                        <a href="{{ $ingredients->nextPageUrl() }}">
                                            <button
                                                class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                                aria-label="Next">
                                                <svg class="w-4 h-4 fill-current" aria-hidden="true"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $ingredients->url($ingredients->lastPage()) }}">
                                            <button
                                                class="px-1 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                                aria-label="Previous">
                                                <svg class="w-4 h-4 fill-current" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z"
                                                        clip-rule="evenodd"></path>
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </span>
                @endif
            </div>
        </div>

        <div class="container mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700">
                Measurements
            </h2>
            <div>
                <button @click="$store.modalMeasurement.wrapOpenModal($event)" data-action="new"
                    class="mt-3 mb-4 flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition ease-in-out duration-500 bg-gradient-to-r from-[#EE4036] to-[#FAAF40]  border border-transparent rounded-lg active:from-[#FAAF40] active:to-[#EE4036] hover:shadow-lg hover:shadow-yellow-500/50">
                    <span>Add</span>
                    <i class="ml-1 fa-solid fa-basket-shopping"></i>
                </button>
            </div>
        </div>
        <!-- Tabel Measurement -->
        <div class="w-full overflow-hidden rounded-lg shadow-2xl">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Nama Takaran</th>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Nama Pendek</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($measurements as $unit)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="font-semibold">{{ $unit->long_name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $unit->id }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $unit->short_name }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <button data-measurement="{{ json_encode($unit) }}" data-action="update"
                                            @click="$store.modalMeasurement.wrapOpenModal($event)"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-[#262261] rounded-lg focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button data-measurement-id="{{ $unit->id }}"
                                            @click="$store.deleteMeasurement"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-[#262261] rounded-lg focus:outline-none focus:shadow-outline-gray"
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
                        {{-- <tr class="text-gray-700">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->

                                    <div>
                                        <p class="font-semibold">Kilo Gram</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                0000
                            </td>
                            <td class="px-4 py-3 text-sm">
                                Kg
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button @click="openModal"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-[#262261] rounded-lg focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-[#262261] rounded-lg focus:outline-none focus:shadow-outline-gray"
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

                        <tr class="text-gray-700">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->

                                    <div>
                                        <p class="font-semibold">Liter</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                0001
                            </td>
                            <td class="px-4 py-3 text-sm">
                                l
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <button @click="openModal"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-[#262261] rounded-lg focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-[#262261] rounded-lg focus:outline-none focus:shadow-outline-gray"
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
                        </tr> --}}

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-slot:afterWrapper>
        <!-- Modal backdrop. This what you want to place close to the closing body tag -->
        <div x-data="$store.modalIngredient" x-cloak x-show="isModalOpen"
            x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
            <!-- Modal -->
            <div x-cloak x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="wrapCloseModal"
                @keydown.escape="wrapCloseModal"
                class="w-full px-6 py-4 overflow-hidden bg-[#f3f2fa] rounded-t-lg sm:rounded-lg sm:m-4 sm:max-w-xl"
                role="dialog" id="modal-ingredient">
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
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Nama Bahan
                            </label>
                            <input id="name" name="name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 text-sm leading-tight focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50 focus:placeholder-gray-300"
                                type="text" placeholder="Enter Ingredient Name">
                            <span x-cloak x-show="!formValid.name" class="text-xs text-red-600 dark:text-red-400">
                                Pesan validasi nama bahan
                            </span>
                        </div>

                        <div class="mb-4 focus-within:text-orange-400 text-gray-400">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="capital_price">
                                Harga Modal
                            </label>
                            <div class="relative focus-within:text-Orange-400 appearance-none rounded">
                                <div class="relative">
                                    <input
                                        class="w-full pl-10 text-sm shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:border-orange-400 focus:ring-orange-200 focus:ring-opacity-50 focus:placeholder-gray-300"
                                        id="capital_price" name="capital_price" type="number" min="0"
                                        placeholder="0">
                                    <span x-cloak x-show="!formValid.capital_price"
                                        class="relative text-xs text-red-600 dark:text-red-400">
                                        Pesan validasi nama bahan
                                    </span>
                                    <div class="absolute inset-y-0 flex items-center ml-3 mb-1 pointer-events-none">
                                        <span class="">
                                            Rp.
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="measurement_id">
                                Satuan
                            </label>
                            <select id="measurement_id" name="measurement_id"
                                class="block w-full text-sm form-select shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50">
                                <option>Select an Option</option>
                                @foreach ($measurements as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->short_name }}</option>
                                @endforeach
                            </select>
                            <span x-cloak x-show="!formValid.measurement_id"
                                class="text-xs text-red-600 dark:text-red-400">
                                Pesan validasi takaran
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

        <!-- Measurements modal -->
        <!-- Modal backdrop. This what you want to place close to the closing body tag -->
        <div x-data="$store.modalMeasurement" x-cloak x-show="isModalOpen"
            x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
            <!-- Modal -->
            <div x-cloak x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="wrapCloseModal"
                @keydown.escape="wrapCloseModal"
                class="w-full px-6 py-4 overflow-hidden bg-[#f3f2fa] rounded-t-lg sm:rounded-lg sm:m-4 sm:max-w-xl"
                role="dialog" id="modal-measurement">
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
                    <p class="mb-2 text-lg font-semibold text-gray-700 ">
                        Add Measurement
                    </p>
                    <!-- Modal description -->
                    <div class="px-5 py-5 mb-8 bg-white rounded-lg shadow-md">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="long_name">
                                Nama Takaran
                            </label>
                            <input id="long_name" name="long_name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 text-sm leading-tight focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50 focus:placeholder-gray-300"
                                type="text" placeholder="Enter Measurement Name">
                            <span x-cloak x-show="!formValid.long_name"
                                class="text-xs text-red-600 dark:text-red-400">
                                Pesan validasi nama takaran
                            </span>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="short_name">
                                Nama Pendek
                            </label>
                            <input id="short_name" name="short_name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 text-sm leading-tight focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50 focus:placeholder-gray-300"
                                type="text" placeholder="Enter Short Name">
                            <span x-cloak x-show="!formValid.short_name"
                                class="text-xs text-red-600 dark:text-red-400">
                                Pesan validasi nama pendek
                            </span>
                        </div>
                    </div>
                </div>
                <footer
                    class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50">
                    <button @click="wrapCloseModal"
                        class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray shadow-md">
                        Cancel
                    </button>
                    <button @click="submit"
                        class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-orange-400 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-orange-500 hover:bg-orange-400 focus:outline-none focus:shadow-outline-yellow shadow-md">
                        Submit
                    </button>
                </footer>
            </div>
        </div>
        <!-- End of modal backdrop -->
    </x-slot:afterWrapper>
</x-layout.admin>
