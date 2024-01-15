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
    </x-container>
</x-app-layout>
