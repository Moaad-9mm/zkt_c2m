<table>
    <thead>
        <tr >
            <th >Numéro d'employé</th>
            <th >Prénom</th>
            <th >Département</th>
            <th >Position</th>
            <th >Type d'emploi</th>
            <th >Date d'embauche</th>
            <th >Statut de l'application</th>
            <th >Zone</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employees as $emp)
        <tr>
            <th>{{$emp->emp_code}}</th>
            <td>
                @if ($emp->first_name)
                {{$emp->first_name}}
                @else                 
                -
                @endif
            </td>
            <td> @if ($emp->department)
                {{$emp->department->dept_name}}
            @else
                -
            @endif
            </td>
            <td>
                @if ($emp->position)
                {{$emp->position->position_name}}
            @else
                -
            @endif
                </td>
            <td>
                    @switch($emp->emp_type)
                        @case(1)
                            Permanant
                            @break
                        @case(2)
                            Temporaire
                            @break
                        @case(3)
                            Probation
                            @break
                        @default
                            -
                    @endswitch
            </td>
            <td>
                @if ($emp->hire_date)
                {{$emp->hire_date}}
                @else
                    -
                @endif
                
            </td>
            <td>
                @if ($emp->app_status == 1)
                Activer
                @else
                Desactiver
                @endif
            </td>
            <td>
                
               @if ($emp->area)
               {{$emp->area->first()->area_name}}
                @endif 
            </td>
        </tr>
        @endforeach
    </tbody>
</table>