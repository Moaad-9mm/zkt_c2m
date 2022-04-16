<table>
    <thead>
    <tr>
        <th>Code de Zone</th>
        <th>Nome de Zone</th>
        <th>Superieure</th>
    </tr>
    </thead>
    <tbody>
    @foreach($zones as $zone)
        <tr>
            <td>{{ $zone->area_code }}</td>
            <td>{{ $zone->area_name }}</td>
            <td>
                @if ($zone->parent)
                {{$zone->parent->area_name}}
                @else
                     -
                @endif
               </td>
        </tr>
    @endforeach
    </tbody>
</table>