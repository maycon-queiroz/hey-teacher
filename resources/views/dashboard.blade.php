<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{route('question.store')}}">
                        @csrf
                        <div class="mb-4">
                        <label
                            for="question"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Question
                        </label>
                        <textarea
                            id="question" rows="4" name="question"
                            class="
                                block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
                                focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600
                                dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                                dark:focus:border-blue-500"
                            placeholder="Write your thoughts here..."
                        >{{old('question')}}</textarea>
                        @error('question')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                <span class="font-medium">Oh, snapp!</span> {{$message}}.
                            </p>
                        @enderror
                        </div>
                        <button
                            type="submit"
                            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center
                            text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200
                            dark:focus:ring-blue-900 hover:bg-blue-800 mt-4"
                        >
                            Criar Question
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
