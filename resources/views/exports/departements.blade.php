<table>
    <thead>
    <tr>
        <th>Code de Departement</th>
        <th>Nome de Departement</th>
        <th>Superieure</th>
    </tr>
    </thead>
    <tbody>
    @foreach($departements as $dpt)
        <tr>
            <td>{{ $dpt->dept_code }}</td>
            <td>{{ $dpt->dept_name }}</td>
            <td>
                @if ($dpt->parent)
                {{$dpt->parent->dept_name}}
                @else
                    -
                @endif
               </td>
        </tr>
    @endforeach
    </tbody>
</table>