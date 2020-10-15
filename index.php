<?php
require_once('../../../config.php');
global $DB, $CFG, $PAGE;
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
// CONFIGURAR EL NOMBRE DEL CAMPUS A CUAL PERTENECERA EL ACTUALIZADOR
$PAGE->set_title('CAMPUS CONSORCIO: ACTUALIZAR ');
$PAGE->set_heading('CAMPUS CONSORCIO: ACTUALIZAR');
echo $OUTPUT->header();


//include('../estilointerior.php');
include('../../../conexion/conexion.php');
//include('../error.php');
include("../funciones.php");

?>

<?php $id_usuario=$USER->id;?>

<!-- Demo images from behance.net
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
-->


<link href="../assets/estilo2.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../vendor/plugins/datepicker/datepicker.css" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<style>



/*  forma del select - > option  */
	.form-control {
		background-color: transparent;

		border-color:   rgba(255,0,255,.1);
		height: 30px;
    width: 150px;
		border-radius: 0;
		box-shadow: none;
		border: solid 1px #e2e6e7 !important;
		width: 98%;

	}
  .Cuadro {
    background-color: white;
    height:120px;
    width: 150px;
    border: 1px solid #000000;
    scrollbar-arrow-color: #000066;
    scrollbar-base-color: #000033;
    scrollbar-track-color: #666633;
    scrollbar-face-color: #cc9933;
    scrollbar-shadow-color: #DDDDDD;
    scrollbar-highlight-color: #CCCCCC;
    font-family: Garamond,verdana;
    font-size: 14pt;
    font-weight: bold;
    letter-spacing: 1px;
  }

	.padre {
  background: rgba(255,255,255,0);
  display: flex;
  justify-content: left;
  border: solid 1px #e2e6e7;
  margin: 2px;
  padding: 5px

}
	.panel-body{
  	background:  rgba(200,255,255,0);
    width: 300px;
    padding: 15px  ;
    margin: 15px ;
	}
	.cuadro
{
   border: solid 1px #e2e6e7;
   background: rgba(255,245,255,0.4);;
   justify-content: rigth;
}

.leyenda {
  font-size:14px;
  color:#00f;
}

.tFecha{
            height:30px;
            width: 130px;
            font-size:11px;
            color:#fff;

            padding: 5px  ;
            background-color: blue;
            align-content: center;
            justify-content: center;
            margin: 0px 0px 0 10px;

        }
  .caja-1{display:none;}
  .caja-2{display:none;}
  .caja-3{display:none;}
   .caja-4{display:none;}
   .caja-5{display:none;}
</style>
<?php

    $admins = get_admins();
    $isadmin = false;
    foreach($admins as $admin) {
       if ($USER->id == $admin->id) {
            $isadmin = true;
            break;
        }
    }
    if ( !$isadmin){
      ?>
      <div class="alert alert-danger" ><i class="fa fa-info-circle fa-2x"></i> Debe  ser Administrador  para ver este contenido.</div>
      <?php }else{

?>


<div class="page-title-cont2 verde1 " style="background-image: url(<?php echo $CFG->wwwroot;?>/images/fondo.jpg); background-attachment:fixed; margin-top:-25px;background-size:cover">
	<div class="relative container align-left">
		<div class="col-md-8 section-title4">
			<h2 class="page-title "><strong>ACTUALIZACIONES</strong></h2>
			<div class="page-sub-title">BORRAR LAS ENCUESTAS REALIZADAS EN UN CURSO . </div>
		</div>
	</div>
</div>




<div class="container ">
	<div class="row ml-auto" >

		<!-- Inicio Panel Body-->
		<div class="col-lg-8  mr-auto">
			<form  id="create-account-form" method="post" action="" target="_blank" />

			  <div class="form-group ">

          <label for="curso" class="col-sm-2 label label-success">Curso:</label>
          <select class="form-control col-sm-10" id="curso" name="curso">
                <?php

                      $res = $DB->get_recordset_sql("SELECT id, fullname  FROM mdl_course order by fullname");

                      foreach ($res as $rs)
                      {
                              echo "<option value='".$rs->id."'>";
                              echo $rs->id." :".($rs->fullname);
                              echo "</option>";
                       }

                ?>
            </select>

        </div>
        <div class="form-group">
        		<label for="curso" class="col-sm-12 label label-success">Usuarios</label><br>
      			<textarea class="form-control col-sm-12 Cuadro" name="rut" rows="10" cols="30"  id="rut" placeholder= "RUT sin Digito Verificador"></textarea>
            <br>            <label for="curso" class=" label label-info">Deben ir separados por coma (,)</label>
        </div>
		      <div class="form-check ">
                    <input type="checkbox" class="form-check-input" id="accion1" name="accion1" value="1">
                    <label class="form-check-label" for="defaultCheck1">  Borrar Encuesta  </label>
          </div>
          <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="accion2" name="accion2" value="1">
                    <label class="form-check-label" for="defaultCheck1">
                        Borrar Rep. videos
                      </label>
          </div>
          <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="accion3" name="accion3" value="1">
                    <label class="form-check-label" for="defaultCheck1"> Borrar Avance          </label>
          </div>

          <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="accion4" name="accion4" value="1">
                    <label class="form-check-label" for="defaultCheck1"> Actualizar Fecha Inicio    </label>
          </div>
          <div class="caja-1">
                <input class= "tFecha" type="date" id="fechainicio"  name="fechainicio" step="1" min="2019-01-01"  value="<?php echo date("Y-m-d");?>">
          </div>
           <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="accion5" name="accion5" value="1">
                    <label class="form-check-label" for="defaultCheck1"> Actualizar Fecha Fin </label>
            </div>
          <div class="caja-2">
                      <input class= "tFecha" type="date" id="fechafin"  name="fechafin" step="1" min="2019-01-01"  value="<?php echo date("Y-m-d");?>">
          </div>
          <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="accion6" name="accion6" value="1">
                    <label class="form-check-label" for="defaultCheck1"> Colocar Avance Videos</label>
          </div>
          <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="accion7" name="accion7" value="1">
                    <label class="form-check-label" for="defaultCheck1"> Borrar Sence</label>
          </div>
          <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="accion8" name="accion8" value="1">
                    <label class="form-check-label" for="defaultCheck1"> Desmatricular</label>
          </div>
           <div class="caja-3">
                     <input type="checkbox" class="form-check-input" id="accion9" name="accion9" value="1">
                    <label class="form-check-label" for="defaultCheck1"> Seguro de Desmatricular? </label>
          </div>
           <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="accion10" name="accion10" value="1">
                    <label class="form-check-label" for="defaultCheck1"> Deshabilitar</label>
          </div>
           <div class="caja-4">
                     <input type="checkbox" class="form-check-input" id="accion11" name="accion11" value="1">
                    <label class="form-check-label" for="defaultCheck1"> Seguro de Deshabilitar? </label>
          </div>
           <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="accion12" name="accion12" value="1">
                    <label class="form-check-label" for="defaultCheck1"> Borrar Evaluaciones</label>
          </div>



      <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="accion13" name="accion13" value="1">
                    <label class="form-check-label" for="defaultCheck1"> Subir CSV SENCE (username,id curso,idsence,fecha)</label>

            </div>
          <div class="caja-5">
                    <input type="file" class="form-control" id="campoFichero" name="campoFichero" />
                     <button type="button" class="btn btn-success" id="btn_lote" name="btn_lote"  > Subir CSV SENCE </button>
          </div>



      </div>

          <br>
     			<p style="text-align: left;">

            <button type="submit" class="btn btn-success " id="create-account-button">Procesar </button>
            <button type="reset" class="btn btn-warning "  onclick="limpiarFiltros();">Limpiar </button>
            <a href="<?php echo $CFG->wwwroot;?>/admin/tool/uploaduser/index.php" target="_blank">

              <button type="button" class="btn btn-info "  > Subir usuarios por CSV </button>
              </a>
               <a href="<?php echo $CFG->wwwroot;?>/user/editadvanced.php?id=-1" target="_blank">

              <button type="button" class="btn btn-info "  > Crear nuevo usuario </button>
              </a>

              <a href="<?php echo $CFG->wwwroot;?>/local/pages/sence/inscribe.php" target="_blank">

              <button type="button" class="btn  btn-danger "  > Inscribir Sence </button>
              </a>


               <a href="<?php echo $CFG->wwwroot; ?>/local/pages/sence/reporte_sence1.php" target="_blank">

              <button type="button" class="btn btn-danger "  > Listado Sence </button>
              </a>
				</p>


		  </form>
  </div>

  <div class="col-lg-3 bg-info" id="result" ></div>
  </div>


	<!-- Fin Panel Body-->
</div>



<?php
echo $OUTPUT->footer();

//	<button name="btnActual" type="submit" class="btn btn-default btn_orange"  >BUSCAR</button>
/*
*/

?>

<script>
 let Oculto1 = true;
 let Oculto2 = true;
 let Oculto3 = true;
  let Oculto4 = true;
  let Oculto5 = true;
 function limpiarFiltros(){

         // $("#curso").val("");
         $('.caja-1').css('display', 'none');
          Oculto1 = true;
          $('.caja-2').css('display', 'none');
           Oculto2 = true;
        $('.caja-3').css('display', 'none');
         Oculto3 = true;
        $('.caja-4').css('display', 'none');
         Oculto4 = true;
          $('.caja-5').css('display', 'none');
         Oculto5 = true;
          $("#result").html("");
      }

 function fechaCorrecta(fecha1, fecha2){
      //Split de las fechas recibidas para separarlas
      var x = fecha1.split("-");
      var z = fecha2.split("-");
      //Cambiamos el orden al formato americano, de esto dd/mm/yyyy a esto mm/dd/yyyy
      fecha1 = x[1] + "-" + x[2] + "-" + x[0];
      fecha2 = z[1] + "-" + z[2] + "-" + z[0];
      //alert(fecha1+" "+fecha2)
      //Comparamos las fechas
      if (Date.parse(fecha1) >= Date.parse(fecha2)){
          return false;
      }else{
          return true;
      }
}

$(document).ready(function() {

  $( '#accion4' ).on( 'click', function(e) {
      //e.preventDefault();
        if( $(this).is(':checked') ){
            // Hacer algo si el checkbox ha sido seleccionado
            $('.caja-1').css('display', 'block');
            Oculto1 = false;
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            $('.caja-1').css('display', 'none');
            Oculto1 = true;
        }
      });
      $( '#accion5' ).on( 'click', function(e) {
      //e.preventDefault();
        if( $(this).is(':checked') ){
            // Hacer algo si el checkbox ha sido seleccionado
            $('.caja-2').css('display', 'block');
            Oculto2 = false;
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            $('.caja-2').css('display', 'none');
            Oculto2 = true;
        }
      });
 $( '#accion8' ).on( 'click', function(e) {
      //e.preventDefault();
        if( $(this).is(':checked') ){
            // Hacer algo si el checkbox ha sido seleccionado
            $('.caja-3').css('display', 'block');
            Oculto3 = false;
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            $('.caja-3').css('display', 'none');
            Oculto3 = true;
        }
      });

       $( '#accion10' ).on( 'click', function(e) {
      //e.preventDefault();
        if( $(this).is(':checked') ){
            // Hacer algo si el checkbox ha sido seleccionado
            $('.caja-4').css('display', 'block');
            Oculto4 = false;
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            $('.caja-4').css('display', 'none');
            Oculto4 = true;
        }
      });


        $( '#accion13' ).on( 'click', function(e) {
      //e.preventDefault();
        if( $(this).is(':checked') ){
            // Hacer algo si el checkbox ha sido seleccionado
            $('.caja-5').css('display', 'block');
            Oculto5 = false;
        } else {
            // Hacer algo si el checkbox ha sido deseleccionado
            $('.caja-5').css('display', 'none');
            Oculto5 = true;
        }
      });
//---------------- procesar archivo por lote
$(function(){
        $('#btn_lote').on('click', function (e){
          e.preventDefault(); // Evitamos que salte el enlace.
          /* Creamos un nuevo objeto FormData. Este sustituye al
          atributo enctype = "multipart/form-data" que, tradicionalmente, se
          incluía en los formularios (y que aún se incluye, cuando son enviados
          desde HTML. */
          var paqueteDeDatos = new FormData();
          /* Todos los campos deben ser añadidos al objeto FormData. Para ello
          usamos el método append. Los argumentos son el nombre con el que se mandará el
          dato al script que lo reciba, y el valor del dato.
          Presta especial atención a la forma en que agregamos el contenido
          del campo de fichero, con el nombre 'archivo'. */
          paqueteDeDatos.append('archivo', $('#campoFichero')[0].files[0]);

          var destino = "guardar_sence.php"; // El script que va a recibir los campos de formulario.
          /* Se envia el paquete de datos por ajax. */
          $.ajax({
            url: destino,
            type: 'POST', // Siempre que se envíen ficheros, por POST, no por GET.
            contentType: false,
            data: paqueteDeDatos, // Al atributo data se le asigna el objeto FormData.
            processData: false,
            cache: false,
            success: function(resultado){ // En caso de que todo salga bien.
              console.log(resultado);
               $("#result").html(resultado);
            },
            error: function (){ // Si hay algún error.
              alert("Algo ha fallado.");
            }
          });
        });
      });
////----------
    let xFecha1 = $('#accion4').is(':checked');
    let xFecha2 = $('#accion5').is(':checked');

    $('#create-account-button').on('click', function(e) {
        e.preventDefault();
        var datos = $('#create-account-form').serialize();
       if ($("#curso").val()!=""){ vcurso = $("#curso").val(); } else { vcurso = ""; }
        if ($("#rut").val()!=""){ vrut = $("#rut").val(); } else { vrut = "0"; }
        if ($('#accion1').prop('checked') ) { vaccion1 = 1 }else { vaccion1 = "0";}
        if ($('#accion2').prop('checked') ) { vaccion2 = 1 }else { vaccion2 = "0";}
        if ($('#accion3').prop('checked') ) { vaccion3 = 1 }else { vaccion3 = "0";}
        if ($('#accion4').prop('checked') ) { vaccion4 = 1 }else { vaccion4 = "0";}
        if ($('#accion5').prop('checked') ) { vaccion5 = 1 }else { vaccion5 = "0";}
        if ($('#accion6').prop('checked') ) { vaccion6 = 1 }else { vaccion6 = "0";}
        if ($('#accion7').prop('checked') ) { vaccion7 = 1 }else { vaccion7 = "0";}
       if ($('#accion8').prop('checked') ) { vaccion8 = 1 }else { vaccion8 = "0";}
        if ($('#accion9').prop('checked') ) { vaccion9 = 1 }else { vaccion9 = "0";}
        if ($('#accion10').prop('checked') ) { vaccion10 = 1 }else { vaccion10 = "0";}
        if ($('#accion11').prop('checked') ) { vaccion11 = 1 }else { vaccion11 = "0";}
  if ($('#accion12').prop('checked') ) { vaccion12 = 1 }else { vaccion12 = "0";}
       // if ($('#accion666').prop('checked') ) { vaccion666 = 1 }else { vaccion666 = "0";}
        if ($("#fechainicio").val()!=""){ vfechainicio = $("#fechainicio").val(); } else { vfechainicio = "0"; }
        if ($("#fechafin").val()!=""){ vfechafin = $("#fechafin").val(); } else { vfechafin = "0"; }

        if(!Oculto1 && !Oculto2){

            if(!fechaCorrecta(vfechainicio, vfechafin)){
                alert("Fecha de inicio no puede ser mayor o igual  que fecha fin")
                return
            }
          }
          vrut= vrut.trim();
           vrut = vrut.replace(/\n|\r/g, "");
vrut = vrut.replace(/,/g,"','");
vrut ="'"+vrut+"'"
      // alert(vaccion1+" "+vaccion2+" "+vaccion3+" "+vcurso + " " + vrut);
  $.post("procesar_usuarios.php",  {
    /* datos */
    curso:vcurso,
    rut:vrut,
    accion1 : vaccion1,
    accion2 : vaccion2,
    accion3 : vaccion3,
    accion4 : vaccion4,
    accion5 : vaccion5,
    accion6 : vaccion6,
    accion7 : vaccion7,
    accion8 : vaccion8,
    accion9 : vaccion9,
    accion10 : vaccion10,
    accion11 : vaccion11,
     accion12 : vaccion12,
  //  accion666 : vaccion666,
    fechainicio : vfechainicio,
    fechafin : vfechafin,

    },
       function(data){
           $("#result").html(data);
      });
        //alert('Datos serializados: '+datos);
    });
});


</script>
<?php
    } ?>

