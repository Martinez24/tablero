<?php

class selects extends MySQL
{
	var $code = "";
	
	function cargarEstados()
	{
		$consulta = parent::consulta("SELECT estado,id_estado FROM estado ORDER BY estado ASC");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$estados = array();
			while($estado = parent::fetch_assoc($consulta))
			{
				$code = $estado["id_estado"];
				$name = $estado["estado"];				
				$estados[$code]=$name;
			}
			return $estados;
		}
		else
		{
			return false;
		}
	}
	function cargarMunicipios()
	{
		$consulta = parent::consulta("SELECT nombre_municipio FROM municipios WHERE estado = '".$this->code."'");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$municipios = array();
			while($municipio = parent::fetch_assoc($consulta))
			{
				$name = $municipio["nombre_municipio"];				
				$municipios[$name]=$name;
			}
			return $municipios;
		}
		else
		{
			return false;
		}
	}
//Funciones para el modulo de proyectos 

	function cargarDepartamentos()
	{
		$consulta = parent::consulta("SELECT nombre,id_departamento FROM departamento ORDER BY nombre ASC");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$departamentos = array();
			while($departamento = parent::fetch_assoc($consulta))
			{
				$code = $departamento["id_departamento"];
				$name = $departamento["nombre"];				
				$departamentos[$code]=$name;
			}
			return $departamentos;
		}
		else
		{
			return false;
		}
	}
	function cargarPersonal()
	{
		$consulta = parent::consulta("SELECT id_personal, Nombre FROM personal WHERE departamento = '".$this->code."'");
		$num_total_registros = parent::num_rows($consulta);
		if($num_total_registros>0)
		{
			$persona = array();
			while($persona = parent::fetch_assoc($consulta))
			{
				$code = $persona['id_personal'];
				$name = $persona["Nombre"];				
				$personal[$name]=$name;  
			}
			return $personal;
		}
		else
		{
			return false;
		}
	}			
}
?>