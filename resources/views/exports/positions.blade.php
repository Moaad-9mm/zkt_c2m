<table>
    <thead>
    <tr>
        <th>Code de Position</th>
        <th>Nome de Position</th>
        <th>Superieure</th>
    </tr>
    </thead>
    <tbody>
    @foreach($positions as $pos)
        <tr>
            <td>{{ $pos->position_code }}</td>
            <td>{{ $pos->position_name }}</td>
            <td>
                @if ($pos->parent)
                {{$pos->parent->position_name}}
                @else
                    -
                @endif
               </td>
        </tr>
    @endforeach
    </tbody>
</table>