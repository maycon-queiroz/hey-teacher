@props([
    'action',
    'post'=>'',
    'put'=>'',
    'delete'=>'',
])
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <form method="post" action="{{$action}}">
            @csrf

            @if($post)
                @method('POST')
            @endif
            @if($put)
                @method('PUT')
            @endif
            @if($delete)
                @method('DELETE')
            @endif

            {{$slot}}
        </form>
    </div>
</div>
