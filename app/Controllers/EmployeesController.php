<?php namespace App\Controllers;

use App\Kernel\ControllerAbstract;

class EmployeesController extends ControllerAbstract
{

 /**
 * Listado de empleados.
 * Muestra el listado de los empleados.
 *
 * @category EmployeesController
 * @package index
 * @author Juan Julio Sandoval <juanjus98@gmail.com>
 * @since 2017-01-03
 * @version 0.1
 * @return render
 */
 public function index()
 {

 	$str = file_get_contents('./json_files/employees.json');
 	$json_employees = json_decode($str, true);

 	//Search
 	$email = trim($_POST['email']);
 	if(!empty($email)){
 		foreach ($json_employees as $key => $value) {
 			if($value['email'] == $email){
 				$data['employees'][$key] = $value;
 			}
 		}
 	}else{
 		$data['employees'] = $json_employees;
 	}

 	return $this->render('Employees/index.twig',$data);
 }

 /**
 * Detalles de empleado.
 * Muestra todos los detalles de un empleado.
 *
 * @category EmployeesController
 * @package employeDetail
 * @author Juan Julio Sandoval <juanjus98@gmail.com>
 * @since 2017-01-03
 * @version 0.1
 * @param string $id
 * @return render
 */
 public function employeDetail($id)
 {
 	$str = file_get_contents('./json_files/employees.json');
 	$json_employees = json_decode($str, true);
 	$data['employe'] = $json_employees[$id];

 	return $this->render('Employees/employeDetail.twig', $data);
 }

 /**
 * Api xml
 *
 * @category EmployeesController
 * @package xmlApi
 * @author Juan Julio Sandoval <juanjus98@gmail.com>
 * @since 2017-01-03
 * @version 0.1
 * @param string $min_max 
 * @return xmlformat
 */
 public function xmlApi($min_max){
 	$min_max = explode("_", $min_max);
 	$min = (float)$min_max[0];
 	$max = (float)$min_max[1];

 	$str = file_get_contents('./json_files/employees.json');
 	$json_employees = json_decode($str, true);
 	
 	foreach ($json_employees as $key => $value) {

 		$salary = (float) str_replace(array("$",","), array("",""), $value['salary']);

 		if($salary >= $min && $salary <= $max){
 			$data['employees'][$key] = $value;
 		}
 	}


 	return $this->render('Employees/xmlApi.xml', $data);
 }

}
