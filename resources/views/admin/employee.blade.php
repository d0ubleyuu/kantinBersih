<x-layout.admin page-title="Data Karyawan - Kantin Bersih">
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700">
            Employees
        </h2>
        <div>
            <button @click="$store.modalEmployee.wrapOpenModal($event)" data-action="new"
                class="mt-3 mb-4 flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition ease-in-out duration-500 bg-gradient-to-r from-[#EE4036] to-[#FAAF40]  border border-transparent rounded-lg active:from-[#FAAF40] active:to-[#EE4036] hover:shadow-lg hover:shadow-yellow-500/50">
                <span>Add Emp</span>
                <i class="ml-1 bi bi-person-fill-add"></i>
            </button>
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-2xl">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3">Username</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($employees as $employee)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <p class="font-semibold">{{ $employee->name }}</p>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $employee->id }}
                                </td>
                                <td class="px-4 py-3 text-xs">
                                    @if ($employee->role == 'staff')
                                        <span
                                            class="px-4 py-1 font-semibold leading-tight text-sky-700 bg-sky-200 rounded-full">
                                            Staff
                                        </span>
                                    @else
                                        <span
                                            class="px-4 py-1 font-semibold leading-tight text-rose-700 bg-rose-200 rounded-full">
                                            Admin
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $employee->username }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <button data-employee="{{ json_encode($employee) }}" data-action="update"
                                            @click="$store.modalEmployee.wrapOpenModal($event)"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-[#262261] rounded-lg focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </button>
                                        <button data-employee-id="{{ $employee->id }}" @click="$store.deleteEmployee"
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
            <div id="pagination"
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 sm:grid-cols-9">
                <span class="flex items-center col-span-3">
                    Showing {{ $employees->firstItem() }}-{{ $employees->lastItem() }} of {{ $employees->total() }}
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                @if ($employees->hasPages())
                    <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                        <nav aria-label="Table navigation">
                            <ul class="inline-flex items-center">
                                @if (!is_null($employees->previousPageUrl()))
                                    <li>
                                        <a href="{{ $employees->url(1) }}">
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
                                        <a href="{{ $employees->previousPageUrl() }}">
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
                                    $currPage = $employees->currentPage();
                                @endphp
                                {{-- @dump($employees->getUrlRange($currPage, $currPage + 6)) --}}
                                @if ($currPage + 5 <= $employees->lastPage())
                                    @php
                                        $urlRanges = $employees->getUrlRange($currPage, $currPage + 5);
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
                                        $first = $employees->lastPage() - 6 + 1;
                                        $urlRanges = $employees->getUrlRange($first, $first + 5);
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
                                @if (!is_null($employees->nextPageUrl()))
                                    <li>
                                        <a href="{{ $employees->nextPageUrl() }}">
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
                                        <a href="{{ $employees->url($employees->lastPage()) }}">
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

    <x-slot:afterWrapper>
        <!-- Modal backdrop. This what you want to place close to the closing body tag -->
        <div x-data="$store.modalEmployee" x-cloak x-show="isModalOpen"
            x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
            <!-- Modal -->
            <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="wrapCloseModal"
                @keydown.escape="wrapCloseModal"
                class="w-full px-6 py-4 overflow-hidden bg-[#f3f2fa] rounded-t-lg sm:rounded-lg sm:m-4 sm:max-w-xl"
                role="dialog" id="modal-employee">
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
                        Add Employee
                    </p>
                    <!-- Modal description -->
                    <div class="px-5 py-5 mb-8 bg-white rounded-lg shadow-md">
                        <label class="block text-sm mb-2">
                            <span class="text-gray-700">Name</span>
                            <input name="name" type="text"
                                class="block w-full mt-1 rounded-md text-sm focus:border-yellow-400 focus:ring focus:ring-yellow-200 focus:ring-opacity-50 focus:placeholder-gray-300"
                                placeholder="Your name">
                            {{-- Validation text --}}
                            {{-- @if (false)
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    Your password is too short.
                                </span>
                            @endif --}}
                            <span x-cloak x-show="!formValid.name" class="text-xs text-red-600 dark:text-red-400">
                                Pesan validasi nama
                            </span>
                        </label>

                        <label class="block text-sm mb-2">
                            <span class="text-gray-700">Username</span>
                            <input name="username" type="text"
                                class="block w-full mt-1 rounded-md text-sm focus:border-yellow-400 focus:ring focus:ring-yellow-200 focus:ring-opacity-50 focus:placeholder-gray-300"
                                placeholder="Your Username">
                            <span x-cloak x-show="!formValid.username" class="text-xs text-red-600 dark:text-red-400">
                                Pesan validasi username
                            </span>
                        </label>

                        <label class="block text-sm mb-2">
                            <span class="text-gray-700">Password</span>
                            <input name="password" type="password"
                                class="block w-full mt-1 rounded-md text-sm focus:border-yellow-400 focus:ring focus:ring-yellow-200 focus:ring-opacity-50 focus:placeholder-gray-300"
                                placeholder="Your Password">
                            <span x-cloak x-show="!formValid.password" class="text-xs text-red-600 dark:text-red-400">
                                Pesan validasi password
                            </span>
                        </label>

                        <label class="block text-sm mb-2">
                            <span class="text-gray-700">Confirm Password</span>
                            <input name="password_confirmation" type="password"
                                class="block w-full mt-1 rounded-md text-sm focus:border-yellow-400 focus:ring focus:ring-yellow-200 focus:ring-opacity-50 focus:placeholder-gray-300"
                                placeholder="Confirm Your Password">
                            <span x-cloak x-show="!formValid.passwordConfirm"
                                class="text-xs text-red-600 dark:text-red-400">
                                Pesan validasi konfirmasi password
                            </span>
                        </label>

                        <label class="block text-sm">
                            <span class="text-gray-700">
                                Role
                            </span>
                            <select name="role"
                                class="block w-full mt-1 rounded-md text-sm form-select focus:border-yellow-400 focus:ring focus:ring-yellow-200 focus:ring-opacity-50">
                                <option>Select an Option</option>
                                <option>Admin</option>
                                <option>Staff</option>
                            </select>
                            <span x-cloak x-show="!formValid.role" class="text-xs text-red-600 dark:text-red-400">
                                Pesan validasi role
                            </span>
                        </label>
                    </div>
                </div>
                <footer
                    class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50">
                    <button @click="wrapCloseModal"
                        class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                        Cancel
                    </button>
                    <button @click="submit"
                        class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-yellow-300 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-yellow-500 hover:bg-yellow-400 focus:outline-none focus:shadow-outline-yellow">
                        Submit
                    </button>
                </footer>
            </div>
        </div>
        <!-- End of modal backdrop -->
    </x-slot:afterWrapper>

    <x-slot:additionalScripts>
        {{-- <script src="{{ asset('js/modal.js') }}"></scrip> --}}
        {{-- <script src="{{ asset('js/focus-trap.js') }}"></script> --}}
        {{-- <script src="{{ asset('js/employee-submit.js') }}"></script> --}}
    </x-slot:additionalScripts>
</x-layout.admin>
