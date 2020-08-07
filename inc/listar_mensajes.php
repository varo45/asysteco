<?php  
    if($response = $class->selectFrom("SELECT * FROM Mensajes WHERE (ID_PROFESOR='$_SESSION[ID]' AND Borrado_Profesor=0) OR (ID_DESTINATARIO='$_SESSION[ID]' AND Borrado_Destinatario=0) ORDER BY ID DESC"))
    {
        echo "<div class='container' style='margin-top:50px'>";
        echo "<h2>Mensajes</h2>";
        echo"
            <div class='row'>
                <div class='col-xs-12'>
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
        ";
        if ($response->num_rows > 0)
        {
            while($datos = $response->fetch_assoc())
            {
                echo "  
                <tbody>
                    <tr id='$datos[ID]'>
                        <td>$datos[ID_PROFESOR]</td>
                        <td>$datos[ID_DESTINATARIO]</td>
                        <td>$datos[Asunto]</td>
                        <td>$datos[Mensaje]</td>
                        <td>$datos[Fecha]</td>
                        <td><a href='index.php?ACTION=eliminar_mensaje&ID=$datos[ID]'><span class='glyphicon glyphicon-trash'></span></a></td>
                    </tr> 
                </tbody>
                ";
            }
        }
        else
        {
            $MSG = "No existe ningun mensajes para listar.";
            include_once($dirs['inc'] . 'msg_modal.php');
        }
        echo "
                </table>
                </div>
            </div>
        </div>
        ";
    }
    else
    {
        $ERR_MSG = $class->ERR_NETASYS;
    }