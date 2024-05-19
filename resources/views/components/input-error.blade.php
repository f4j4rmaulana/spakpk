@props(['messages'])

@if ($messages)
        @foreach ((array) $messages as $message)
        <span class="help-block invalid-feedback">
                {{ $message }}
            </span>
        @endforeach
@endif
