<x-app-layout>
    <x-slot name="header">
        <x-header>
                {{ __('My Questions') }}
        </x-header>
    </x-slot>

    <x-container>
        <x-form post :action="route('question.store')">
            <x-textarea name="question" label="Question"/>

            <x-btn.primary>Create Question</x-btn.primary>
            <x-btn.reset>Cancel</x-btn.reset>
        </x-form>

        <hr class="border-gray-700 my-4">

        <div class="dark:text-gray-200 font-bold mt-4 space-y-4 uppercase ml-1.5">Drafts</div>
        <x-table>
            <x-table.thead>
                <tr>
                    <x-table.th>Question</x-table.th>
                    <x-table.th>Actions</x-table.th>
                </tr>
            </x-table.thead>

            <tbody>
                @foreach($questions->where('draft', true) as $question)
                    <x-table.tr>
                        <x-table.td>{{$question->question}}</x-table.td>
                        <x-table.td>
                            <x-form put :action="route('question.publish', $question->id)">
                                <x-btn.primary>Publish</x-btn.primary>
                            </x-form>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </tbody>
        </x-table>

        <hr class="border-gray-700 my-4">

        <div class="dark:text-gray-200 font-bold mt-4 space-y-4 uppercase ml-1.5">List Questions</div>

        <x-table>
            <x-table.thead>
                <tr>
                    <x-table.th>Question</x-table.th>
                    <x-table.th>Actions</x-table.th>
                </tr>
            </x-table.thead>

            <tbody>
                @foreach($questions->where('draft', false) as $question)
                    <x-table.tr>
                        <x-table.td>{{$question->question}}</x-table.td>
                        <x-table.td>
                            <x-form delete :action="route('question.destroy', $question->id)">
                                <x-btn.primary>Delete</x-btn.primary>
                            </x-form>
                        </x-table.td>
                    </x-table.tr>
                @endforeach
            </tbody>
        </x-table>

    </x-container>
</x-app-layout>
