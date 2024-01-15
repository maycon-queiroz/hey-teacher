<x-app-layout>
    <x-slot name="header">
        <x-header>
                {{ __('Dashboard') }}
        </x-header>
    </x-slot>

    <x-container>
        <x-form post :action="route('question.store')">
            <x-textarea name="question" label="Question"/>

            <x-btn.primary>Create Question</x-btn.primary>
            <x-btn.reset>Cancel</x-btn.reset>
        </x-form>

        <hr class="border-gray-700 my-4">

        <div class="dark:text-gray-200 font-bold mt-4 space-y-4 uppercase ml-1.5">List Questions</div>
        @foreach($questions as $item)
            <x-question :question="$item" />
        @endforeach

    </x-container>
</x-app-layout>
