<?php
    $dsn = 'mysql:dbname=prueba;host=127.0.0.1';
    $usuario = 'root';
    $clave = '';   
        try {
            $con = new PDO($dsn,$usuario, $clave);
        } catch (PDOException $e) {
            print "<div id='dialogo' title='Error Salida' style='display: none;'>";
            print '<p>Error Generado:</p>';
            print '<p><span class="label label-warning glyphicon glyphicon-remove">Codigo: </span></p>';
            print $e->getCode();
            print '<p><span class="label label-warning glyphicon glyphicon-remove">Mensage de Error: </span></p>';
            print $e->getMessage();
            print "</div>";
        }  

              
    function consultaA($coneccion, $sql){
      $ejecutor = $coneccion;
      $msgok = NULL;
      $msgerror = NULL;
      try {
          $condicion = strstr(trim($sql)," ", TRUE);
          switch ($condicion) 
          {
              case "INSERT":
                  $msgerror = "No se ha Podido Insertar los Datos";
                  $msgok = "Datos Insertados";
                  
                  break;
              case "DELETE":
                  $msgerror = "No se ha Podido Eliminar los Datos";                  
                  $msgok = "Datos Eliminados";
                  break;
              case "UPDATE":
                  $msgerror = "No se ha Podido Actualizar los Datos";                  
                  $msgok = "Datos Actualizados";
                  break;
              default:
                  $msgerror = "Es posible que no use un estandar de consulta SQL";
                  break;
          }
          
          $ejecutor->beginTransaction();
          $fila = $ejecutor->exec($sql);
          $ejecutor->commit();
          
          if($fila == 0){
              $msgok = $msgerror."<br> No existe coincidencia para realizar la "
                      . "accion sobre los registros ";
          }
          
          return $msgok. " Filas Afectadas ".$fila ;
          
          
      } catch (Exception $exc) {
          $ejecutor->rollBack();
          return $msgerror. ":(<br>".$exc->getMessage(); 
      }
    }
    
    function consultaD($coneccion, $sql,$modo=2,$presentacion=FALSE)
    {
        $ejecutor = $coneccion;
        $manejador = trim($sql);
        $devolucion = "";
        try {       
            $datos = $ejecutor->query($manejador);
            $datos->setFetchMode($modo);
            if($presentacion == TRUE){
                $devolucion .="<table border=1>";
                foreach ($datos->fetchAll() as $registros) {
                    $devolucion.="<tr>";
                    foreach ($registros as $valor) {
                        $devolucion.="<td>".$valor."</td>";
                    }
                    $devolucion.="</tr>";
                }
                $devolucion .="</table>";
            }else{
                $contenedor = $datos->fetchAll(); 
                $devolucion=$contenedor;
                
                
            }
       
        } catch (Exception $exc) {
            return  "No se pudieron Consultar los Datos<br />".$exc->getMessage();  
        }        
        return $devolucion;
        
    }
        
       
function imprimetabla($objeto,$form,$estilo="table",$editar=0){
  if ($objeto != NULL) {
    if (is_array($objeto)) {
      $tabla = "<table class=\"$estilo\">";
      $tabla .= "<tr class='info'>";
      foreach (array_keys($objeto[0]) as $value) {
        $tabla .= "<th>";
        $tabla .= $value;
        $tabla .= "</th>";
      }
      if($editar != "0"){
        $tabla .= "<td>Modificar</td><td>Eliminar></td>";
      }
      $tabla .= "</tr><tr>";
      foreach ($objeto as $datos) {
        foreach ($datos as $registro) {
          $tabla .= "<td>";
          $tabla .= $registro;
          $tabla .="</td>";
        }
        
        if ($editar !="0") {
       $tabla.="<td><a href=".$form."Buscar.php?id=".$datos['id'].">Modificar</a></td>";
       $tabla.="<td><a href=".$form."Borrar.php?id=".$datos['id'].">Eliminar</a></td>";
      }
      
        $tabla .="</tr>";
      }


        $tabla .="</table>";
    } else {
      $tabla = "No hay registros que mostrar ";
    }
    
  } else {
    $tabla = "No hay datos en esta tabla ";
  }
  
return $tabla;
}
?>