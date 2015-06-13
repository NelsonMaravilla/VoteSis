<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="css/estilos.css" rel="stylesheet">
<link href="css/jquery.keypad.css" rel="stylesheet">

<title>SISTEMA DE VOTACIONES</title>
</head>
    <body>
        <!-- aqui va el jumbotron--><br>
        <div class="container">
        	<div class="jumbotron text-center">
            	<h1>Sistema de Votaci&oacute;n</h1>
        	</div>
            <div class="row">
            	<div class="col-md-4">&nbsp;</div>
            	<div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Datos del Votante</div>
                    <div class="panel-body">
                        <form action="" method="post" class="form-horizontal">
                          <div class="form-group">
                            <label for="user" class="col-sm-2 control-label">Usuario</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="dui" id="defaultKeypad" onChange="mascara(this,'-',patron3,true)" onKeyPress="return justNumbers(event);" maxlength="10" placeholder="escriba su DUI">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-default" name="iniciar">Ingresar</button>
                            </div>
                          </div>
                        </form>
						<?php
                        $msgbox="";
                            if(isset($_POST["iniciar"]))
                            {
                    
                                @$nom = $_POST["dui"];
                    
                                        $sesion = "SELECT * FROM persona WHERE DUI='$nom'";
                                        $verificar = mysql_query($sesion);
                                        
                                            $nombre_p = @mysql_result($verificar,0,'Nombres');
                                            $apellido_p = @mysql_result($verificar,0,'Apellidos');
                                            $dui_p = @mysql_result($verificar,0,'DUI');
                                            $depa = @mysql_result($verificar,0,'codigo_depto');
                                            $muni = @mysql_result($verificar,0,'codigo_muni');
											$img_p = @mysql_result($verificar,0,'imag_per');
                                            $id_user_sessio_p = @mysql_result($verificar,0,'id');
                                            $detalle_ok = @mysql_result($verificar,0,'estado');
                                            $_SESSION["log"]=$nombre_p;
                                            if ($nom == "")
                                                    {
                                                    $msgbox = "<div class='alert alert-danger'>TODOS LOS CAMPOS SON OBLIGATORIOS</div>";
                                                    }
														elseif($nom != $dui_p)
														{
															$msgbox = "<div class='alert alert-danger'>Usuario o Contraseña erroneos, Vuelvalo a intentar</div>";
															}
															elseif($detalle_ok == "SI")
															{
																$msgbox = "<div class='alert alert-danger'>USTED YA REALIZO SU RESPECTIVA VOTACION.</div>";
															}
																else
																{
																	if($nom == $dui_p)
																		{
																			$estado="OK";
																			@$_SESSION["VT_OK"]=$estado;
																			@$_SESSION["usernomp"]=$nombre_p;
																			@$_SESSION["userapep"]=$apellido_p;
																			@$_SESSION["userdep"]=$depa;
																			@$_SESSION["usermun"]=$muni;
																			@$_SESSION["userduip"]=$dui_p;
																			@$_SESSION["user_idep"]=$id_user_session_p;
																			@$_SESSION["user_detap"]=$detalle_ok;
																			?>
																				<SCRIPT LANGUAGE="javascript">location.href = "index.php";</SCRIPT>
																			<?php
																			exit;
																		}
																}
                                                    
                            }
                            ?>
                   		</div>
                    </div>
                </div>
            </div>
        <div class="container">
			<?php
             	echo $msgbox;
             ?>
        </div>
			<script src="../js/jquery.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/script.js"></script>
            <script src="js/min.js"></script>
			<script src="js/jquery.plugin.js"></script>
			<script src="js/jquery.keypad.js"></script>
			<script src="js/jquery.keypad-es.js"></script>
            <script>
$(function () {
	$('#defaultKeypad').keypad();
	$('#inlineKeypad').keypad({onClose: function() {
		alert($(this).val());
	}});
});
</script>
<script type="text/javascript">
function justNumbers(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
 
return /\d/.test(String.fromCharCode(keynum));
document.tree.miSelect.options[indice].text
}
var patron = new Array(2,2,4)
var patron2 = new Array(1,3,3,3,3)
var patron3 = new Array(8,1)
function mascara(d,sep,pat,nums){
if(d.valant != d.value){
	val = d.value
	largo = val.length
	val = val.split(sep)
	val2 = ''
	for(r=0;r<val.length;r++){
		val2 += val[r]	
	}
	if(nums){
		for(z=0;z<val2.length;z++){
			if(isNaN(val2.charAt(z))){
				letra = new RegExp(val2.charAt(z),"g")
				val2 = val2.replace(letra,"")
			}
		}
	}
	val = ''
	val3 = new Array()
	for(s=0; s<pat.length; s++){
		val3[s] = val2.substring(0,pat[s])
		val2 = val2.substr(pat[s])
	}
	for(q=0;q<val3.length; q++){
		if(q ==0){
			val = val3[q]
		}
		else{
			if(val3[q] != ""){
				val += sep + val3[q]
				}
		}
	}
	d.value = val
	d.valant = val
	}
}
</script>
    </body>
</html>