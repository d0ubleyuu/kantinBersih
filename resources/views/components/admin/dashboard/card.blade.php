<!-- Card -->
<div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
    <div class="p-3 mr-4 text-{{ $iconColor }} bg-{{ $iconBg }} rounded-full ">
        <i class="w-6 h-5 {{ $icon }}"></i>
    </div>
    <div>
        <p class="mb-2 text-sm font-medium text-gray-600 ">
            {{ $name }}
        </p>
        <p class="text-lg font-semibold text-gray-700 ">
            {{ $slot }}
        </p>
    </div>
</div>
