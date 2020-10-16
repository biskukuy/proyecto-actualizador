<?php
require_once('../../../config.php');
error_reporting(0);

global $DB, $CFG, $PAGE;
include('../../../conexion/conexion.php');
include('../error.php');
include("../funciones.php");


if(!empty($_POST['curso'])){ $id_curso = $_POST['curso'];}
if(!empty($_POST['rut'])){ $usuarios = $_POST['rut'];}
if(!empty($_POST['accion1'])){ $accion1 = $_POST['accion1'];} else $accion1=0;
if(!empty($_POST['accion2'])){ $accion2 = $_POST['accion2'];}else $accion2=0;
if(!empty($_POST['accion3'])){ $accion3 = $_POST['accion3'];}else $accion3=0;
if(!empty($_POST['accion4'])){ $accion4 = $_POST['accion4'];}else $accion4=0;
if(!empty($_POST['accion5'])){ $accion5 = $_POST['accion5'];}else $accion5=0;
if(!empty($_POST['accion6'])){ $accion6 = $_POST['accion6'];}else $accion6=0;
if(!empty($_POST['accion7'])){ $accion7 = $_POST['accion7'];}else $accion7=0;
if(!empty($_POST['accion8'])){ $accion8 = $_POST['accion8'];}else $accion8=0;
if(!empty($_POST['accion9'])){ $accion9 = $_POST['accion9'];}else $accion9=0;
if(!empty($_POST['accion10'])){ $accion10 = $_POST['accion10'];}else $accion10=0;
if(!empty($_POST['accion11'])){ $accion11 = $_POST['accion11'];}else $accion11=0;
if(!empty($_POST['accion12'])){ $accion12 = $_POST['accion12'];}else $accion12=0;

if(!empty($_POST['accion666'])){ $accion666 = $_POST['accion666'];}else $accion666=0;
if(!empty($_POST['fechainicio'])){ $xfechainicio = $_POST['fechainicio'];}else $xfechainicio=0;
if(!empty($_POST['fechafin'])){ $xfechafin = $_POST['fechafin'];}else $xfechafin=0;

//echo "  $id_curso   ($usuarios) [ $accion1 $accion2 $accion3 $accion4 ] ";


//sql para devolver los id de LOS ESTUDIANTES SEGUN LOS USERNAME
$sql = "SELECT  id, username from mdl_user   where username in ($usuarios)";

//SQL PARA BORRAR LOS INTENTOS DE REALIZAR UNA ENCUESTA
$sql1 = "SELECT intento.id campo1, usuario.id campo2, usuario.username campo3 from mdl_questionnaire_attempts intento, mdl_user usuario, mdl_questionnaire cuestionario
where usuario.id = intento.userid and cuestionario.id = intento.qid and
cuestionario.course = '$id_curso' and  usuario.username in ($usuarios)";

//SQL PARA BORRAR LA VISUALIZACION DE VIDEOS

$sql2 = "SELECT r.time campo2, r.id  campo1
    FROM mdl_richmedia_track r , mdl_user u,  mdl_richmedia c
    where c.course='$id_curso' and r.richmediaid = c.id and r.userid = u.id and
 u.username in ($usuarios)";

//SQL PARA BORRAR los modulos completados

$sql3 = "select mdl_course_modules_completion.id campo1, mdl_course_modules_completion.coursemoduleid  campo2
from mdl_course_modules_completion, mdl_course_modules,  mdl_user
where
 mdl_course_modules.course = '$id_curso' and
 mdl_course_modules.id = mdl_course_modules_completion.coursemoduleid and
mdl_course_modules_completion.userid = mdl_user.id and
mdl_user.username in ($usuarios)";

//SQL PARA VER LAS FECHAS DE MATRICULACION DE ESTUDIANTES DE UN CURSO EN ESPECIFICO
$sql4 = "SELECT mue.id,
from_unixtime(mue.timestart) fechainicio,
from_unixtime(mue.timeend) fechafin,
usuario.username,
mue.timestart d1
FROM
mdl_user_enrolments mue,
mdl_user usuario,
mdl_enrol enrol,
mdl_course curso
WHERE
usuario.id = mue.userid AND
enrol.id = mue.enrolid and
enrol.courseid = curso.id AND
curso.id = '$id_curso' AND
usuario.username in ($usuarios)";
   // and usuario.firstname like ('%antonio%' ) ANDusuario.lastname like ('%ponte%')

//SQL PARA AVANZAR TODO  LA VISUALIZACION DE VIDEOS

$sql6 = "SELECT r.time, r.id
    FROM mdl_richmedia_track r , mdl_user u,  mdl_richmedia c
    where c.course='$id_curso' and r.richmediaid = c.id and r.userid = u.id and
 u.username in ($usuarios)";


$sql666 = "SELECT mue.id,  mue.timeend
FROM mdl_user_enrolments mue, mdl_user usuario, mdl_enrol enrol, mdl_course curso
WHERE usuario.id = mue.userid AND enrol.id = mue.enrolid and enrol.courseid = curso.id AND curso.id = '148'";

// mdl_bcn_usuarios_sence
// idusence, userid,courseid, cursosence, fechafin

$sql7 = "SELECT  sence.idusence
FROM mdl_user             usuarios,
  mdl_bcn_usuarios_sence   sence

  WHERE
        usuarios.id = sence.userid  and
       sence.courseid = '$id_curso'  and
       usuarios.username in ($usuarios)
";

$i=0;
//----- prueba PARA DESMATRICULAR ----
$Sql8 = "SELECT mue.id,
from_unixtime(mue.timestart) fechainicio,
from_unixtime(mue.timeend) fechafin,
usuario.username,
mue.timestart d1
FROM
mdl_user_enrolments mue,
mdl_user usuario,
mdl_enrol enrol,
mdl_course curso
WHERE
usuario.id = mue.userid AND
enrol.id = mue.enrolid and
enrol.courseid = curso.id AND
curso.id = '$id_curso' AND
usuario.username in ($usuarios)";

//----- prueba PARA DESHABILITAR DEL CAMPUS ----
$Sql9 = "SELECT usuario.id, usuario.username

FROM
mdl_user usuario

WHERE

usuario.username in ($usuarios)";


//----- prueba PARA  BORRAR PRUEBAS  DEL CAMPUS ----

$Sql12 ="SELECT mqa.id, mqa.quiz, mqa.attempt,  usuario.username
FROM mdl_quiz_attempts as mqa, mdl_quiz as mq, mdl_user as usuario
where mqa.userid = usuario.id and mq.course =  '$id_curso' and mqa.quiz = mq.id and usuario.username in ($usuarios)";

$Sql13 = "SELECT usuario.id, usuario.username  FROM mdl_user usuario WHERE usuario.username in ($usuarios)";



    if ($accion1 == 1 ){


  echo "<span class='label label-info'> Borrando Encuestas: <br> <br> </span> <br>  ";
     //  $res = mysql_query($sql1, $conexion);
      // $res2 = $DB->get_recordset_sql($sql1);
       $res = $DB->get_recordset_sql($sql1);


   //while($rs=mysql_fetch_array($res))
       foreach ($res as $rs)
    {
        $i++;
        //   $id=$rs["campo1"];
           $id = $rs->campo1;
       //Caso de borrar LAS ENCUESTAS
 // $DB->delete_records('mdl_questionnaire_attempts', array('id' => $id) );

      $sql22 =  "delete from mdl_questionnaire_attempts  where id=$id";
    //  $res2 = mysql_query($sql22, $conexion);
    //   $DB->execute($sql22);
        }

    }
  // echo "<br>";
if ($accion2 == 1 ){
       // echo "Sentencia: <br> $sql2  <br>";
         echo "<span class='label label-info'>Borrando el tiempo  de reproduccion de los videos</span> <br> ";
        // $res = mysql_query($sql2, $conexion);
           $res = $DB->get_recordset_sql($sql2);

   // while($rs=mysql_fetch_array($res))
      foreach ($res as $rs)
    {
            $i++;
        // $id=$rs["campo1"];
            $id=$rs->campo1;

       //Caso de borrar el tiempo a cero de los videos
      $sql22 =  " UPDATE mdl_richmedia_track SET time = 0 WHERE mdl_richmedia_track.id = '$id'";
    //  $res2 = mysql_query($sql22, $conexion);
       $DB->execute($sql22);
        }
       // printf("Registros actualizados: %d\n", mysql_affected_rows());
    }
     echo "<br>";
if ($accion3 == 1 ){
     //   echo "Sentencia: <br> $sql3  <br>";

         echo "<span class='label label-info'>Borrar el check de modulos completados</span><br>  ";
         // $res = mysql_query($sql3, $conexion);
         $res = $DB->get_recordset_sql($sql3);

       // while($rs=mysql_fetch_array($res))
        foreach ($res as $rs)
        {
           $i++;
         // $id=$rs["campo1"];
         $id=$rs->campo1;

            echo "<br>";
       //Caso de borrar LOS MODULOS VISTOS  COMPLETOS
        $sql22= "DELETE FROM mdl_course_modules_completion  WHERE mdl_course_modules_completion.id = $id";
       // $res2 = mysql_query($sql22, $conexion);
         $DB->execute($sql22);
        }
        //printf("Registros borrados: %d\n", mysql_affected_rows());
    }

    if ($accion4 == 1 && $accion5 == 0){
   // echo "<br>Sentencia: <br> $sql4  <br>";
     // $res = mysql_query($sql4, $conexion);
       $res = $DB->get_recordset_sql($sql4);
      echo "<span class='label label-info'>Actualizando Fechas de Inicio</span><br>  ";

       // while($rs=mysql_fetch_array($res))
         foreach ($res as $rs)
        {
            echo " <br> $i :  ";$i++;

             $id=$rs->id;

              $d1=$rs->d1;
             $fx2 = date("Y-m-d",strtotime($xfechainicio));
             echo  "Actualizar de ".  $rs->fechainicio. " a ". $fx2  ;

            $xTiempo_nuevo = strtotime($fx2);

       //Caso de modificar las fechas de matriculacion de un curso
        $sql22 =  "  UPDATE mdl_user_enrolments SET timestart = $xTiempo_nuevo WHERE mdl_user_enrolments.id = '$id'";
          $DB->execute($sql22);

       // $res2 = mysql_query($sql22, $conexion);
        }
    }
    if ($accion5 == 1 && $accion4 == 0){
      // echo "<br>Sentencia: <br> $sql4  <br>";
       echo "<span class='label label-info'>Actualizando Fechas de Fin</span><br><span class='label'>  ";

         $res = $DB->get_recordset_sql($sql4);
         // NUEVA FECHA FIN DE LA MATRICULACION
         $fx2 = date("Y-m-d",strtotime($xfechafin));
          $xTiempo_nuevo = strtotime($fx2);
         foreach ($res as $rs)

           {
               echo " <br> $i :  ";$i++;
               echo $id=$rs->id;
               echo " - ";
               $d1=$rs->d1;
              echo  "Actualizar de ".  $rs->fechafin. " a ". $fx2  ;


          //Caso de modificar las fechas de matriculacion de un curso
           $sql22 =  "  UPDATE mdl_user_enrolments SET timeend = $xTiempo_nuevo WHERE mdl_user_enrolments.id = '$id'";
            $DB->execute($sql22);

                      //  $res2 = mysql_query($sql22, $conexion);
           }
           echo "</span>";
       }
       if ($accion5 == 1 && $accion4 == 1) {
               // echo "<br>Sentencia: <br> $sql4  <br>";

                $res = $DB->get_recordset_sql($sql4);
               echo "<span class='label label-info'>Actualizando Fechas de Inicio y Fecha Fin </span><br>  ";

              // while($rs=mysql_fetch_array($res))
               foreach ($res as $rs)
               {
                     echo " <br> $i :  ";$i++;
                       // $id=$rs["id"];
                        $id=$rs->id;

                     $fx1 = date("Y-m-d",strtotime($xfechainicio));
                     echo  "Actualizar de ".  $rs->fechainicio. " a ". $fx1  ;
                     $fx2 = date("Y-m-d",strtotime($xfechafin));
                     echo  " de ".  $rs->fechafin. " a ". $fx2  ;

                     $xTiempo_nuevo1 = strtotime($fx1)+60;
                     $xTiempo_nuevo2 = strtotime($fx2);

                  //Caso de modificar las fechas de matriculacion de un curso
               $sql22 =  "  UPDATE mdl_user_enrolments SET timestart = $xTiempo_nuevo1,timeend = $xTiempo_nuevo2 WHERE mdl_user_enrolments.id = '$id'";
              $DB->execute($sql22);
              // $res2 = mysql_query($sql22, $conexion);
               }

       }
       if ($accion666 ==  1) {
         echo "<br>Sentencia: <br> $sql666  <br>";
        $res = mysql_query($sql666, $conexion);
        echo "<span class='label label-info'>Actualizando FEcha y hora  </span><br>  ";

        while($rs=mysql_fetch_array($res)){
              echo " <br> $i :  ";$i++;
                 $id=$rs["id"];
              $xTiempo_nuevo1 = 1591707600;
           //Caso de modificar las fechas de matriculacion de un curso
        $sql22 =  "  UPDATE mdl_user_enrolments SET timeend = $xTiempo_nuevo1 WHERE mdl_user_enrolments.id = '$id'";

        $res2 = mysql_query($sql22, $conexion);
        //break;
        }

}

    if ($accion6 == 1 ){
       // echo "<br>Sentencia: <br> $sql6  <br>";
       echo "<span class='label label-info'>Actualizando  Avances de video </span><br>  ";
         // $res = mysql_query($sql6, $conexion);
           $res = $DB->get_recordset_sql($sql6);
           // while($rs=mysql_fetch_array($res))
               foreach ($res as $rs)
            {

                // echo $id=$rs["id"];
                echo $id=$rs->id;
                 echo "<br>";


                 //Caso de llenar tiempo A  LOS MODULOS
                 $sql22 =  " UPDATE mdl_richmedia_track SET time = 2000 WHERE mdl_richmedia_track.id = '$id'";
                  $DB->execute($sql22);
                // $res2 = mysql_query($sql22, $conexion);
            }
        }//fin si

 if ($accion7 == 1 ){
       //echo "<br>Sentencia: <br> $sql7  <br>";
       echo "<span class='label label-info'>Borrando Bloque sence </span><br>  ";
         // $res = mysql_query($sql7, $conexion);
           $res = $DB->get_recordset_sql($sql7);

           // while($rs=mysql_fetch_array($res))
            foreach ($res as $rs)
            {
              $i++;
              //$id=$rs["idusence"];
               $id=$rs->idusence;

              //borrar el id de la tabla SENCE
                  $sql22 =  "delete from  mdl_bcn_usuarios_sence WHERE idusence = $id";
                    $DB->execute($sql22);
                // $res2 = mysql_query($sql22, $conexion);
            }
        }//fin si


// EN CASO DE ESTAR marcado LA OPCION PARA DESMATRICULAR ENTONCES SE HACE LA FUNCION
 if ($accion8 == 1 && $accion9 == 1 ){
       //echo "<br>Sentencia: <br> $sql7  <br>";
       echo "<span class='label label-info'>Desmatriculando </span><br>  ";
          $res = $DB->get_recordset_sql($Sql8);
            foreach ($res as $rs)
            {
              $i++;
              $id= $rs->id;

              //borrar el id de la tabla
              $SQL = "DELETE FROM mdl_user_enrolments WHERE id = $id";
       $DB->execute($SQL);
            }
        }//fin si


// EN CASO DE ESTAR marcado  LA OPCION PARA DESHABILITAR  ENTONCES SE HACE LA FUNCION
 if ($accion10 == 1 && $accion11 == 1 ){

       echo "<span class='label label-info'>DesHABILITANDO:  </span><br>  ";
          $res = $DB->get_recordset_sql($Sql9);
            foreach ($res as $rs)
            {
              $i++;
              echo  $id= $rs->id;
              echo  " ".$rs->username."  Deshabilitado <br>";

              //borrar el id de la tabla
              //$SQL = "DELETE FROM mdl_user_enrolments WHERE id = $id";
                 $SQL =  "  UPDATE mdl_user SET suspended = 1 WHERE mdl_user.id = '$id'";
       $DB->execute($SQL);
            }
        }//fin si
//  $DB->execute($sql, array $params=null)
//  $this->database->delete_records('sessions', array('id' => $session->id));
 //$DB->delete_records('mdl_user_enrolments', array('id'=>$id));
/*
LEFT OUTER JOIN mdl_grade_items AS gi ON gi.courseid = cur.id and gi.itemtype = 'course'
        LEFT OUTER JOIN mdl_grade_grades AS gg ON gg.userid = user.id and gi.id = gg.itemid

select * from mdl_course AS cur, mdl_grade_items AS gi, mdl_grade_grades AS gg
where gg.userid = 1799 and gi.id = gg.itemid and gi.courseid = 5 and gi.itemtype = 'course'


SELECT mqa.id, mqa.quiz, mqa.attempt
FROM mdl_quiz_attempts as mqa, mdl_quiz as mq
where mqa.userid = 1799 and mq.course = 5 and mqa.quiz = mq.id





*/

// EN CASO DE ESTAR marcado  LA OPCION PARA BORRAR PRUEBAS  ENTONCES SE HACE LA FUNCION
 if ($accion12 == 1  ){

       echo "<span class='label label-info'>BORRANDO  </span><br>  ";
          $res = $DB->get_recordset_sql($Sql12);
            foreach ($res as $rs)
            {
              $i++;
              echo  $id= $rs->id;
              echo  " ".$rs->username."  <br>";

              //borrar el id de la tabla
              $SQL = "DELETE FROM mdl_quiz_attempts  WHERE id = $id";
              //   $SQL =  "  UPDATE mdl_user SET suspended = 1 WHERE mdl_user.id = '$id'";
       $DB->execute($SQL);
            }
        }//fin si






echo "<br> ";
echo "<span class='label label-success'>$i  Registros Actualizados</span><br>  ";



   ?>

