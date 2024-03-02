@props([
    'action',
    'post'=>'',
    'put'=>'',
    'patch'=>'',
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

    @if($patch)
        @method('PATCH')
    @endif
    @if($delete)
        @method('DELETE')
    @endif

    {{$slot}}
</form>

