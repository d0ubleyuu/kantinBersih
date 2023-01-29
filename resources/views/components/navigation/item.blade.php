<li class="relative px-6 py-3">
    @if ($hasChild)
        <button
            class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-slate-50"
            @click="togglePagesMenu" aria-haspopup="true">
            <span class="inline-flex items-center">
                @if ($active)
                    <span class="absolute inset-y-0 left-0 w-2 bg-[#FAAF40] rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <i class="w-5 h-5 {{ $icon }}"></i>
                <span class="ml-4">{{ $slot }}</span>
            </span>
            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <div>
            <ul x-cloak x-show="isPagesMenuOpen" x-transition:enter="transition-all ease-in-out duration-300"
                x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                x-transition:leave="transition-all ease-in-out duration-300"
                x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50"
                aria-label="submenu">
                @isset($child)
                    {{ $child }}
                @endisset
            </ul>
        </div>
    @else
        <a class="inline-flex items-center w-full text-sm font-semibold text-slate-50 transition-colors duration-150 hover:text-slate-100"
            href="{{ $href }}">
            @if ($active)
                <span class="absolute inset-y-0 left-0 w-2 bg-[#FAAF40] rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
            @endif
            <i class="w-5 h-5 {{ $icon }}"></i>
            <span class="ml-4">{{ $slot }}</span>
        </a>
    @endif
</li>
