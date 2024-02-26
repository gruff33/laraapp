<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    @forelse($NodeList as $NL)
        <div class="flex w-full bg-blue-300 text-gray-800">
            <div class="w-1/12">
                {{ $NL-> id }}
            </div>
            <div class="w-1/6">
                {{ $NL->name }}
            </div>
            <div class="w-3/4">
                {{ $NL->description }}
            </div>
        </div>
    @empty
        <div class="w-full bg-green-500 text-gray-800">
        No Node definitions
        </div>
    @endforelse
</div>
