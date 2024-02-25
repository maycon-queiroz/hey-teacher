@props(['question'])

<div
    class="
        dark:text-gray-400 p-4 w-full dark:bg-gray-800/50 my-1 rounded
        border-b-2 border-blue-400/50 flex justify-between items-center"
>
    <span>{{$question->question}}</span>
    <div>
        <x-form :action="route('question.like', $question)" id="form-like-{{$question->id}}">
            <button class="flex items-center space-x-1" form="form-like-{{$question->id}}">
                <x-icons.thumb-up class="w-6 h-6 text-green-500 hover:text-green-400 cursor-pointer"/>
                <span class="text-green-400">{{$question->votes_sum_like ?: 0}}</span>
            </button>
        </x-form>
        <x-form :action="route('question.unlike', $question)" id="form-unlike-{{$question->id}}">
            <button class="flex items-center space-x-1" id="form-unlike-{{$question->id}}">
                <x-icons.thumb-down class="w-6 h-6 text-yellow-400 hover:text-yellow-300 cursor-pointer"/>
                <span class="text-red-500">{{$question->votes_sum_unlike ?: 0}}</span>
            </button>
        </x-form>
    </div>
</div>
