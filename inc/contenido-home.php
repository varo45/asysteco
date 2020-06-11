<div class="container" style="margin-top:50px">
  <h3>Contenido de la Página de inicio</h3>
  <p>Podemos morstrar una tabla que muestre las clases de hoy del profesor que haya iniciado sesión.</p>
  <a href="<?php echo $_SERVER['PHP_SELF'] . '?ACTION=fichar'; ?>"><span  class="glyphicon glyphicon-ok"></span> Fichar Entrada</a><br>
  <a href="<?php echo $_SERVER['PHP_SELF'] . '?ACTION=fichar_salida'; ?>"><span  class="glyphicon glyphicon-ok"></span> Fichar Salida</a>
</div>
<?php


function tooLateEntrada()
{
    $bd->bdConex();
    $conex = $bd->conex;
    $id = $bd->getID();
    if($bd->conex_status == 1)
    {
        date_default_timezone_set('Europe/Madrid');
        $fecha = date('Y-m-d');
        $horaactual = mktime(date('H'),date('i'),date('s'),date('m'),date('d'),date('Y'));
        $hora_salida = $bd->getHoraSalida($bd->getDiaSemana());
        return $hora_salida;

        return true;
    }
    else
    {
        return false;
    }
}



if(isset($ERR_BD))
{
  echo <<< EOL
  <script>
  window.onload = function() {
    $('#ERR_BD_MODAL').modal('show')
  };
  </script>
  <!-- Modal -->
  <div class="modal fade" id="ERR_BD_MODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p style="color: red;">
            $ERR_BD
          </p>
        </div>
      </div>
    </div>
  </div>
EOL;
}
elseif(isset($MSG_BD))
{
  echo <<< EOL
  <script>
  window.onload = function() {
    $('#MSG_BD_MODAL').modal('show')
  };
  </script>
  <!-- Modal -->
  <div class="modal fade" id="MSG_BD_MODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p style="color: red;">
            $MSG_BD
          </p>
        </div>
      </div>
    </div>
  </div>
EOL;
}
?>