@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="flex flex-row px-6 py-4  bg-gray-100 dark:bg-gray-800">
        <div class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ $title }}
        </div>
    </div>
    <div class="flex flex-row w-full px-6 py-4  bg-gray-300 dark:bg-gray-600">
        <div class="w-full mt-4 text-sm text-gray-600  dark:text-gray-400">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 dark:bg-gray-800 text-end">
        {{ $footer }}
    </div>
</x-modal>
