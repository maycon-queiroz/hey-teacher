<x-app-layout>
    <x-slot name="header">
        <x-header>
                {{ __('List of questions') }}
        </x-header>
    </x-slot>

    <x-container>
        <hr class="border-gray-700 my-4">

        <div class="dark:text-gray-200 font-bold mt-4 space-y-4 uppercase ml-1.5">List Questions</div>
        @foreach($questions as $item)
            <x-question :question="$item" />
        @endforeach

        <div class="mt-2.5">
        {{$questions->links()}}
        </div>
    </x-container>
</x-app-layout>
