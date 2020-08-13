<?php  

    if($response = $class->selectFrom("SELECT * FROM Mensajes WHERE (ID_PROFESOR='$_SESSION[ID]' AND Borrado_Profesor=0) OR (ID_DESTINATARIO='$_SESSION[ID]' AND Borrado_Destinatario=0) ORDER BY ID DESC"))
    {
        echo "<div class='col-xs-12 col-md-8'>";
        echo "<h2>Mensajes</h2>";
        echo"
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th>EMISOR</th>
                        <th>RECEPTOR</th>
                        <th>ASUNTO</th>
                        <th>MENSAJE</th>
                        <th>Fecha</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
        ";
        if ($response->num_rows > 0)
        {
            while($datos = $response->fetch_assoc())
            {
                if($nombre1 = $class->query("SELECT Nombre FROM Profesores WHERE ID='$datos[ID_PROFESOR]'"))
                {
                    $emisor = $nombre1->fetch_assoc();
                    $emisor = $emisor['Nombre'];
                }
                else
                {
                    $ERR_MSG = $class->ERR_NETASYS;
                }

                if($nombre2 = $class->query("SELECT Nombre FROM Profesores WHERE ID='$datos[ID_DESTINATARIO]'"))
                {
                    $receptor = $nombre2->fetch_assoc();
                    $receptor = $receptor['Nombre'];
                }
                else
                {
                    $ERR_MSG = $class->ERR_NETASYS;
                }
                $sep = preg_split('/[ -]/', $datos['Fecha']);
                $dia = $sep[2];
                $m = $sep[1];
                $Y = $sep[0];
                $h = $sep[3];
                echo "  
                    <tr id='$datos[ID]'>
                        <td>$emisor</td>
                        <td>$receptor</td>
                        <td>$datos[Asunto]</td>
                        <td>$datos[Mensaje]</td>
                        <td>$dia/$m/$Y $h</td>
                        <td><a onclick=\"return confirm('¿Estas seguro de borrar el registro?')\" href='index.php?ACTION=eliminar_mensaje&ID=$datos[ID]'><span class='glyphicon glyphicon-trash'></span></a></td>
                    </tr> 
                ";
            }
        }
        else
        {
            $MSG = "No tienes mensajes.";
        }
        echo "
                    </tbody>
                </table>
        ";
    }
    else
    {
        $ERR_MSG = $class->ERR_NETASYS;
    }
            echo "</div>";
        echo "</div>";
    echo "</div>";