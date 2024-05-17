@props(['messages'])

@if ($messages)
        @foreach ((array) $messages as $message)
        <span class="help-block">
                {{ $message }}
            </span>
        @endforeach
@endif
