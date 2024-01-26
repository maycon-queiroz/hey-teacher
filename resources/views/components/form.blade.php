@props([
    'action',
    'post'=>'',
    'put'=>'',
    'delete'=>'',
])

<form method="post" action="{{$action}}" {{$attributes}}>
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

