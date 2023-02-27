<?php
	//print_r($_POST);

	require('seguridad.php');

	/*
	if ($_SESSION["id_rol"]!="1")
	{
		header("Location: acceso_denegado.php");
		exit();	
	}
	*/

	if(session_id() == '') 
	{
		session_start();
	}
	
	if (isset($_POST['submit']))
	{
		
		$fec_ini_contrato=$_POST["fec_ini_contrato"];
		$fec_fin_contrato=$_POST["fec_fin_contrato"];
		if ($fec_fin_contrato=='')
		{
			registrar_contrato();
		}
		else
		{
			if ($fec_ini_contrato > $fec_fin_contrato)
			{
				$_SESSION["mensaje_error"]="La fecha de finalización del contrato no puede ser inferior a la fecha de inicio del contrato.";
				$_SESSION["enviar_formulario"]=true;
				enviar_formulario();
				header("Location: ./registro_contrato.php");
				//echo $_SESSION["mensaje_error"];
				exit();
			}
			else
			{
				registrar_contrato();
			}
		}
	}						
	else
	{
		$_SESSION["mensaje_error"]="Error al acceder al recurso.";
		$_SESSION["enviar_formulario"]=false;
		header("Location: ./empleados.php");
		exit();
	}

	function registrar_contrato()
	{
		global 
		$id_empleado,$fec_ini_contrato,$fec_afilia_ss,$fec_fin_contrato,$id_eps,$id_afp,$id_obra,$id_cargo,$id_transaccion,$fec_actual;
	
		$id_empleado=$_POST["id_empleado"];
		$fec_ini_contrato=$_POST["fec_ini_contrato"];
		$fec_afilia_ss=$_POST["fec_afilia_ss"];
		$fec_fin_contrato=$_POST["fec_fin_contrato"];
		$id_eps=$_POST["id_eps"];
		$id_afp=$_POST["id_afp"];	
		$id_cargo=$_POST["id_cargo"];
		$id_obra=$_POST["id_obra"];
				
		include('conexion.php');
		include 'fecha_actual.php';
		
		//Crear id de transaccion de registro
		$caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   		$longitud = 12;
   		$id_transaccion=substr(str_shuffle($caracteres_permitidos), 0, $longitud);
				
		$query1 = "insert into contrato (fec_ini_contrato, fec_afilia_ss, fec_fin_contrato, id_eps, id_afp, id_obra, id_cargo, id_transaccion, fecha_cre_contrato) values ('$fec_ini_contrato','$fec_afilia_ss','$fec_fin_contrato','$id_eps','$id_afp','$id_obra','$id_cargo','$id_transaccion','$fec_actual')"; 

		/*echo $query;*/
		$result1=mysqli_query($conexion,$query1);

		if($result1==1)
		{
			$query2="select id_contrato from contrato where id_transaccion='$id_transaccion'";
			
			$result2 = mysqli_query($conexion,$query2);
			if (mysqli_num_rows($result2)=='1')
			{
				$linea=mysqli_fetch_array($result2);
				$id_contrato=$linea[0];
				
				$query3 = "insert into contrato_empleado (id_empleado,id_contrato) values ('$id_empleado','$id_contrato')"; 

				/*echo $query3;*/
				$result3=mysqli_query($conexion,$query3);

				if($result3==1)
				{
					$query4="update contrato set id_transaccion='' where id_contrato='$id_contrato'";

					$result4 = mysqli_query($conexion,$query4);
					if ($result4==0)
					{
						$_SESSION["mensaje_error"]="Error en la actualización del id de transacción, intente nuevamente.";
						$_SESSION["enviar_formulario"]=false;
						enviar_formulario();
						header("Location: ./contratos.php");
						exit();
					}
					else
					{
						$_SESSION["mensaje_exitoso"]="El contrato se ha registrado correctamente.";
						$_SESSION["enviar_formulario"]=false;
						header("Location: ./contratos.php");
						exit();
					}	
				}
				else
				{	
					$_SESSION["mensaje_error"]="El contrato no se ha registrado completamente (tabla contrato_empleado), intente nuevamente.";
					$_SESSION["enviar_formulario"]=true;
					enviar_formulario();
					header("Location: ./registro_contrato.php");
					exit();
				}
			}
			else
			{
				$_SESSION["mensaje_error"]="Error al consultar los datos del contrato para registro, intente nuevamente.";
				$_SESSION["enviar_formulario"]=true;
				header("Location: registro_contrato.php");
				exit();
			}
		}
		else
		{	
			$_SESSION["mensaje_error"]="El contrato no se registro correctamente (tabla contrato), intente nuevamente.";
			$_SESSION["enviar_formulario"]=true;
			enviar_formulario();
			header("Location: ./registro_contrato.php");
			exit();
		}
		mysqli_close($conexion);
	}

	function enviar_formulario()
	{
		$_SESSION["id_empleado"]=$_POST["id_empleado"];
		$_SESSION["fec_ini_contrato"]=$_POST["fec_ini_contrato"];
		$_SESSION["fec_afilia_ss"]=$_POST["fec_afilia_ss"];
		$_SESSION["fec_fin_contrato"]=$_POST["fec_fin_contrato"];
		$_SESSION["id_eps"]=$_POST["id_eps"];
		$_SESSION["id_afp"]=$_POST["id_afp"];
		$_SESSION["id_cargo"]=$_POST["id_cargo"];
		$_SESSION["id_obra"]=$_POST["id_obra"];
		
		
	}
?>