<?php
//include('../../../conexion/conexion.php');
require_once('../../../config.php');
global $DB, $CFG, $PAGE;
////////////////////////////////////////////////////
// Convierte fecha de español a mysql
////////////////////////////////////////////////////
function cambiaf_a_mysql($fecha){
    $mifecha = explode("-", $fecha);
    $lafecha=$mifecha[2]."-".$mifecha[1]."-".$mifecha[0];
    return $lafecha;
}



//var_dump($DB);
$html = "<label  class='label label-success'>Respuesta: </label> ";

    if(substr($_FILES['archivo']['name'],-3)=="csv")
    {

       // $fecha = date('y-m-d');
       // $ruta = "archivos_excel/";
       // $excel = $fecha."-".$_FILES['excel']['name'];

       // move_uploaded_file($_FILES['excel']['tmp_name'],"$ruta$excel");
        $row = 0;
       // echo $fp = fopen("$ruta$excel","r");
        $x= $_FILES['archivo']['tmp_name'];
        $fp = fopen("$x","r");
        //echo "<2>";
        $error= 0;
        while ($data = fgetcsv($fp,1000,";")){

            if($row!=0){
                $html.= $data[0]." ".$data[1]." ".$data[2]." ".$data[3]." <BR>";
                $sql = "SELECT id FROM mdl_user WHERE username = '$data[0]'";
				if($user = $DB->get_recordset_sql($sql)){
					foreach ($user as $rs) {
						$new_mat = new stdClass();
						 $new_mat->userid = $rs->id;
						 $new_mat->courseid = $data[1];
						$new_mat->cursosence = $data[2];
						 $new_mat->fechafin = cambiaf_a_mysql($data[3]);
						$DB->insert_record('bcn_usuarios_sence', $new_mat);
						 $row++;

					}
				}
				else {
					$error = 1;
				}

            }
            if($row==0){
/*
            	 $html.= "(".$data[0].")-(".$data[1].")(".$data[2].")(".$data[3].") <BR>";
            	 // $html.=
            	 	 $x= nl2br(trim($data[0]);
            	 	// $x= 	trim(preg_replace('/\s/', ' ', $x));

            	 	 $y= "username";
            	 	var_dump($x);
					var_dump($y);
            	  if (strcmp($x, $y) == 0){
    					echo "Los strings coinciden";
					}
                if($data[0]!="username" || $data[1]!="idcurso" || $data[2]!="idsence" || $data[3]!="fechafin"  ){
                    $error = 1;
                   // break;
                }*/
                 $row++;
            }


        }//fin del while
        if($error==1){
            $html .= " Algunos registros no se guardaron ";

        }else {
            $html .= "<br> cantidad de usuarios inscritos: $row";
        }

        fclose($fp);
       // unlink("$ruta$excel");


    }
echo $html;
?>



