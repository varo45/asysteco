<?php
if($response = $class->selectFrom("SELECT $class->horarios.* FROM $class->horarios INNER JOIN $class->profesores ON $class->horarios.ID_PROFESOR=$class->profesores.ID WHERE $class->profesores.ID='$_GET[profesor]' ORDER BY $class->horarios.HORA_TIPO"))
{
    if ($response->num_rows > 0)
    {
        if(! $nombre = $class->selectFrom("SELECT Nombre FROM $class->profesores WHERE ID='$_GET[profesor]'"))
        {
            $ERR_MSG = $class->ERR_NETASYS;
        }
        else
        {
            $n = $nombre->fetch_assoc();
        }
        echo "<h2>Horario: $n[Nombre]</h2>";
        echo "</br><table class='table table-striped'>";
        echo "<thead>";
            echo "<tr>";
                echo "<th>Horas</th>";
                echo "<th>Lunes</th>";
                echo "<th>Martes</th>";
                echo "<th>Miercoles</th>";
                echo "<th>Jueves</th>";
                echo "<th>Viernes</th>";
                echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            while ($fila = $response->fetch_assoc())
                {
                    if ($fila['Dia'] == 'Lunes')
                    {
                        $lunes[] = $fila;
                    }
                    elseif ($fila['Dia'] == 'Martes')
                    {
                        $martes[] = $fila;
                    }                   
                        elseif ($fila['Dia'] == 'Miercoles')
                    {
                        $miercoles[] = $fila;
                    }
                    elseif ($fila['Dia'] == 'Jueves')
                    {
                        $jueves[] = $fila;
                    }
                    elseif ($fila['Dia'] == 'Viernes')
                    {
                        $viernes[] = $fila;
                    }
                }
            for ($i = 0; $i < 6; $i++)
            {
                $count=$i+1;
                $horas = $count . 'M';
                echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    if ($lunes[$i]['HORA_TIPO'] == $horas && $lunes[$i]['Edificio'] && $lunes[$i]['Aula'] != null && $lunes[$i]['Grupo'] != null)
                    {
                        strlen($lunes[$i]['Aula']) == 1 ? $lunes[$i]['Aula'] = 0 . $lunes[$i]['Aula'] : $lunes[$i]['Aula'];
                        echo "<td>" . "Aula: " . $lunes[$i]['Edificio'] . $lunes[$i]['Aula'] . "<br>" . "Grupo: " . $lunes[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }                 
                    if ($martes[$i]['HORA_TIPO'] == $horas && $martes[$i]['Edificio'] && $martes[$i]['Aula'] != null && $martes[$i]['Grupo'] != null)
                    {
                        strlen($martes[$i]['Aula']) == 1 ? $martes[$i]['Aula'] = 0 . $martes[$i]['Aula'] : $martes[$i]['Aula'];
                        echo "<td>" . "Aula: " . $martes[$i]['Edificio'] . $martes[$i]['Aula'] . "<br>" . "Grupo: " . $martes[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }   
                    if ($miercoles[$i]['HORA_TIPO'] == $horas && $miercoles[$i]['Edificio'] && $miercoles[$i]['Aula'] != null && $miercoles[$i]['Grupo'] != null)
                    {
                        strlen($miercoles[$i]['Aula']) == 1 ? $miercoles[$i]['Aula'] = 0 . $miercoles[$i]['Aula'] : $miercoles[$i]['Aula'];
                        echo "<td>" . "Aula: " . $miercoles[$i]['Edificio'] . $miercoles[$i]['Aula'] . "<br>" . "Grupo: " . $miercoles[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }   
                    if ($jueves[$i]['HORA_TIPO'] == $horas && $jueves[$i]['Edificio'] && $jueves[$i]['Aula'] != null && $jueves[$i]['Grupo'] != null)
                    {
                        strlen($jueves[$i]['Aula']) == 1 ? $jueves[$i]['Aula'] = 0 . $jueves[$i]['Aula'] : $jueves[$i]['Aula'];
                        echo "<td>" . "Aula: " . $jueves[$i]['Edificio'] . $jueves[$i]['Aula'] . "<br>" . "Grupo: " . $jueves[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }   
                    if ($viernes[$i]['HORA_TIPO'] == $horas && $viernes[$i]['Edificio'] && $viernes[$i]['Aula'] != null && $viernes[$i]['Grupo'] != null)
                    {
                        strlen($viernes[$i]['Aula']) == 1 ? $viernes[$i]['Aula'] = 0 . $viernes[$i]['Aula'] : $viernes[$i]['Aula'];
                        echo "<td>" . "Aula: " . $viernes[$i]['Edificio'] . $viernes[$i]['Aula'] . "<br>" . "Grupo: " . $viernes[$i]['Grupo'] . "</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }
                echo "</tr>";
            }
        echo "</tbody>";
        echo "</table>";
    }
    else
    {
        $ERR_MSG = $class->ERR_NETASYS;
    }
}
else
{
    $ERR_MSG = $class->ERR_NETASYS;
}