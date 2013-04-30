<?
// iniciamos session
session_start ();

// iniciamos session
include 'conexion.php';
include 'funciones.php';

if($errorDbConexion == false){
  // MAnda a llamar la función para mostrar la lista de usuarios
	$proximosEventos = proximosEventos($con);
}
else
{
	// Regresa error en la base de datos
	$proximosEventos = '
		<tr id="sinDatos">
			<td colspan="5" class="centerTXT">ERROR AL CONECTAR CON LA BASE DE DATOS</td>
	   	</tr>
	';
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.css">
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
			.login-form{
				padding: 15px;
			}
			.usuario{
				font-size: 12px;
			}
			label.error {
				color: #B94A48;
				font-size: 0.9em;
			}
			.hero-unit{
				background:url(nightlife.jpeg);
				background-size:100% 100%;
				background-repeat:no-repeat;
			}
        </style>
        <link rel="stylesheet" href="css/bootstrap-responsive.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">Estas usando un navegador <strong>desfasado</strong>. Porfavor <a href="http://browsehappy.com/">actualizate</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activa el Frame de Google Chrome</a> para mejorar tu experiencia.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->
		<?php include 'barraNav.php'; ?>
		
		<header class="jumbotron subhead">
		</header>
        <div class="container">
			<div class="row-fluid" id="contenido">
				<div class="span9">
					<!-- Main hero unit for a primary marketing message or call to action -->
					<div class="hero-unit">
						<h1>Foto Noche</h1>
						<p>Bienvenido a Fotonoche.com tu web de ocio nocturno.</p>
						<p><a class="btn btn-primary btn-large">Saber mas &raquo;</a></p>
					</div>
					<?php if ($_SESSION['userAdmin'] == true){ ?>
					<div class="alert alert-success hide" id="alertaAdministrador">
					  <a class="close" data-dismiss="alert">×</a>  
					  <strong>Bienvenido Administrador!</strong>  
					</div>
					<?php } ?>
					<div class="row-fluid">
						<section id="albumes">
							<h2>Ultimos Albumes</h2>
							<p> Fotonoche nace con la vocacion de reunir el mejor ocio nocturno de Gran Canaria, poniendo a disposicion del visitante información sobre discotecas, locales, eventos, conciertos etc. Bienvenido a Fotonoche.com tu web de ocio nocturno. La meta principal de FOTONOCHE.COM, sin lugar a duda es poder satisfacer todas las necesidades de nuestros clientes. Le ofrecemos una amplia gama de productos a unos precios muy competitivos y de la máxima calidad, respaldados por un equipo que se caracteriza por su trato  y  espíritu de atención al cliente. Somos un equipo competente y eficaz, con una nueva perspectiva de la publicidad y convencidos de que encontrará lo que mejor se adapta a sus necesidades. </p>
						</section>
						<section id="eventos">
							<h2>Proximos Eventos</h2>
							<?php echo $proximosEventos ?>
						</section>
						<section id="locales">
							<h2>Locales</h2>
							<?php echo $listaLocales ?>
						</section>
					</div>
				</div>
				<div class="span3">
					<h2>Calendario</h2>
					<p> </p>
					<p><a class="btn" href="#">View details &raquo;</a></p>
				</div>
			</div>
            <hr>
            <?php include 'footer.php'; ?>
        </div> <!-- /container -->
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.js"></script>
		<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <script src="miScript.js"></script>
		<script type="text/javascript">
		$(function(){
			// creación de ventana con formulario con jquery ui
			$('#agregarUser').dialog({
				autoOpen: false,
				modal:true,
				width:305,
				height:'auto',
				resizable: false,
				close:function(){
					$('#formUsers fieldset > span').removeClass('error').empty();
					$('#formUsers input[type="text"]').val('');
					$('#formUsers select > option').removeAttr('selected');
				}
			});

			// funcionalidad del botón que abre el formulario
			$('#goNuevoUser').on('click',function(){
				$('#agregarUser').dialog('open');
			});

			// Validar Formulario
			$('#formUsers').validate({
				submitHandler: function(){
					
					var str = $('#formUsers').serialize();

					alert(str);

					return false;

				},
				errorPlacement: function(error, element) {
					error.appendTo(element.prev("span").append());
				}
			});


		});
	</script>
    </body>
</html>		
