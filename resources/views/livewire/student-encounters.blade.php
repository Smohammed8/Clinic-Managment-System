<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div>
        <h2>Encounters for {{ $student->first_name . ' ' . $student->middle_name }} </h2>

        <ul>
            @foreach ($student->encounter as $encounter)
                <li>{{ $encounter->check_in_time }}</li>
            @endforeach
        </ul>
    </div>

</div>
