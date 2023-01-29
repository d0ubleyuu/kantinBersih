<x-layout.admin page-title="Data Karyawan - Kantin Bersih">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700">
            Daftar Transaksi
        </h2>
        <div class="w-full overflow-hidden rounded-lg shadow-2xl">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Nama Karyawan</th>
                            <th class="px-4 py-3">Jumlah Menu</th>
                            <th class="px-4 py-3">Total Transaksi</th>
                            <th class="px-4 py-3">Total Bayar</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($transactions as $transaction)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3">
                                    {{ $transaction->created_at }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $transaction->employee->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $transaction->menus->count() }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $transaction->transaction_total }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $transaction->payment_total }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('admin.detail-transaksi', $transaction->id) }}">
                                            <button
                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-[#262261] rounded-lg focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Detail">
                                                Detail
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="pagination"
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 sm:grid-cols-9">
                <span class="flex items-center col-span-3">
                    Showing {{ $transactions->firstItem() }}-{{ $transactions->lastItem() }} of
                    {{ $transactions->total() }}
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                @if ($transactions->hasPages())
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                        <nav aria-label="Table navigation">
                            <ul class="inline-flex items-center">
                                @if (!is_null($transactions->previousPageUrl()))
                                    <li>
                                        <a href="{{ $transactions->url(1) }}">
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
                                        <a href="{{ $transactions->previousPageUrl() }}">
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
                                    $currPage = $transactions->currentPage();
                                @endphp
                                {{-- @dump($transactions->getUrlRange($currPage, $currPage + 6)) --}}
                                @if ($currPage + 5 <= $transactions->lastPage())
                                    @php
                                        $urlRanges = $transactions->getUrlRange($currPage, $currPage + 5);
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
                                        $first = $transactions->lastPage() - 6 + 1;
                                        $urlRanges = $transactions->getUrlRange($first, $first + 5);
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
                                @if (!is_null($transactions->nextPageUrl()))
                                    <li>
                                        <a href="{{ $transactions->nextPageUrl() }}">
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
                                        <a href="{{ $transactions->url($transactions->lastPage()) }}">
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
    </div>
</x-layout.admin>
