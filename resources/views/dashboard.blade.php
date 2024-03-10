<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('List of questions') }}
        </x-header>
    </x-slot>

    <x-container>
        <hr class="border-gray-700 my-4">

        <div class="dark:text-gray-200 font-bold mt-4 space-y-4 uppercase ml-1.5">
            <form action="{{route('dashboard')}}" method="get" class="flex  space-x-2">
                @csrf
                <x-text-input name="search" class="w-full" value="{{request()->get('search')}}"/>
                <x-btn.primary class="mt-0">Pesquisar</x-btn.primary>
            </form>
        </div>
        @forelse($questions as $item)
            <x-question :question="$item"/>
        @empty
            <div class="dark:text-gray-200 font-bold mt-4 space-y-4  ml-1.5 flex flex-col justify-center items-center">
                <x-draw.search class="w-80 h-80"/>
                <h2 class="mt-2 font-bold text-2xl">Question Not Found</h2>
            </div>
        @endforelse

        <div class="mt-2.5">
            {{$questions->withQueryString()->links()}}
        </div>
    </x-container>
</x-app-layout>
