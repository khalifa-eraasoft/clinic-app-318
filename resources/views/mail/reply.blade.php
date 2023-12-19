<x-mail::message>
    # Introduction

    {{ $data }}

    <x-mail::button :url="'{{ route('home.index') }}'">
        Button Text
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
