
{{-- To jest komentarz --}}

@if(is_null($name))
    <p>Brak imienia</p>
@else
    <p>Hello, {{ $name }}</p>
    @if (str_starts_with($name, 'B'))
        <p>Imię zaczyna się na B.</p>
    @else
        <p>Imię zaczyna się na B*,</p>
    @endif
@endif

@if(empty($arr))
    <p>Tablica arr nie zawiera żadnego elementu</p>
@else
    @foreach($arr as $key => $value)
        @if ($loop->first)
            <p>{{ $value }}</p>
            <p>This is the first iteration.</p>
        @elseif ($loop->last)
            <p>{{ $value }}</p>
            <p>This is the last iteration.</p>
        @else
            <p>{{ $value }}</p>
        @endif
    @endforeach
@endif


{{-- To jest komentarz Blade'a --}}
@if (isset($name))
    Hello, {{$name}}!<br>

    @if ($name[0]=="B")
        Zaczyna się na B.<br>
    @else
        Nie zaczyna się na B.
    @endif

@else
    Brak imienia!
@endif

@forelse ($arr as $num)
    <p>{{ $num }}
        @if ($num=="a")
            To jest pierwszy element
        @elseif ($num=="e")
            To jest ostatni element
        @endif
    </p>

@empty
    <p>Brak elementów w tablicy</p>
@endforelse
