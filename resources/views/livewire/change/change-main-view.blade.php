<div>
    {{-- In work, do what you enjoy. --}}

    <x-dialog-modal wire:model='AddChangeModal'>
        <x-slot:title>
            New Change Details - {{{ $NewChange_Id }}}
        </x-slot>
        <x-slot:content>
            <div class="flex w-full">
                <x-label class="w-1/3 p-2">Title</x-label>
                <x-input class="w-full text-gray-200 my-2" wire:model='NewTitle'>
                </x-input>
            </div>
            <textarea class="w-full bg-indigo-900 text-gray-200 my-2" wire:model='NewDescription'>
            </textarea>
        </x-slot>
        <x-slot:footer>
            <div class="flex w-full mx-auto justify-between">
                <div class="right-0">
                    <x-button class="dark:bg-green-500 mx-2" wire:click="CancelNewChange()">
                        Cancel
                    </x-button>
                    <x-button wire:click="SubmitChangeMain()">
                        OK
                    </x-button>
                </div>
            </div>
        </x-slot>
    </x-dialog-modal>

    <x-listmenubar>
        <x-input wire:model="ChangeSearch">Search</x-input>
        <x-button class="mx-auto align-right" wire:click="OpenNewChangeDialog()">+
        </x-button>
    </x-listmenubar>
    <div class="w-full">
        @forelse( $ChangeList as $CL )
            <div class="flex w-full text-gray-100">
                <div class="mx-2 my-1 w-1/4">
                    {{ $CL->change_id }}
                </div>
                <div class="mx-2 my-1 w-1/2">
                    {{ $CL->title }}
                </div>
                <div class="mx-2 my-1 w-1/4">
                    <x-button wire:click='DeleteChange({{ $CL->id }})' >Delete</x-button>
                </div>
            </div>
        @empty
            <div class="w-full text-centre bg-blue-300 text-gray-900">
            No Changes to list
            </div>
        @endforelse
    </div>
</div>
