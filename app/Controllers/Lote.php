<?php

namespace App\Controllers;
use App\Models\LoteModel;

class Lote extends BaseController
{

	public function __construct(){
		$session = \Config\Services::session();
		if ($session->has('session-marcha') == true && $session->has('session-finca') == true) {
			return false;
		}else{
			header('Location: '.base_url('inicioAdmin'));
			die();
		}
	}

	public function vista_lote(){
		$lotes_db = new LoteModel();

		$data = [
					'titulo' => 'Lote',
					'archivo_js' => 'lote.js'
				];
		$data['lotes'] = $lotes_db->obtenerListaLotebyFinca($this->session->get('session-finca')['id_finca']);

		$data_encabezado['session_finca'] = $this->session->get('session-finca');
		echo view('encabezado',$data_encabezado);;
		echo view('lote/lote',$data);
		echo view('footer');
		echo view('lote/modal_lote',$data);
		echo view('scripts',$data);
	}

	public function vista_asig_categoria(){

		$data = [
					'titulo' => 'Categoria-Lote',
					'archivo_js' => 'lote.js'
				];

		$data_encabezado['session_finca'] = $this->session->get('session-finca');
		echo view('encabezado',$data_encabezado);;
		echo view('lote/asignar_categoria',$data);
		echo view('footer');
		echo view('scripts');
	}

	public function vista_asig_actividad(){

		$data = [
					'titulo' => 'Categoria-Actividad',
					'archivo_js' => 'lote.js'
				];

		$data_encabezado['session_finca'] = $this->session->get('session-finca');
		echo view('encabezado',$data_encabezado);;
		echo view('lote/asignar_actividad',$data);
		echo view('footer');
		echo view('scripts');
	}
	public function agregarLote(){

		$nombre = $this->request->getPost('nom_lot'); 
		$extencion = $this->request->getPost('tam_lote');
		$finca = $this->session->get('session-finca')['id_finca'];  

		if ($nombre != '' && $extencion != '') {

			$lotes_db = new LoteModel();
			$respuesta = $lotes_db->insertarLote($nombre, $finca, $extencion);

			if($respuesta != false) {
				$data = array(
					'estado' => 'ok',
					'mensaje' => 'Se agrego el Lote exitosamente',
					'id' => $respuesta
				);
			} else {
				$data = array(
					'estado' => 'error',
					'mensaje' => 'Ocurrió un error al editar el Lote'
				);
			}
		}else{
			$data = array(
				'estado' => 'error',
				'mensaje' => 'Debe llenar Todos los campos'
			);

		}
		return json_encode($data);

	}
	public function editarLote(){
		$id_lote = $this->request->getPost('id_lote'); 
		$nombre = $this->request->getPost('edit_nom_lot'); 
		$extencion = $this->request->getPost('edit_tam_lote');
		$finca = $this->session->get('session-finca')['id_finca'];  

		if ($nombre != '' && $extencion != '') {

			$lotes_db = new LoteModel();
			$respuesta = $lotes_db->editarLote($id_lote, $nombre, $finca ,$extencion);

			if($respuesta) {
				$data = array(
					'estado' => 'ok',
					'mensaje' => 'Se edito el Lote exitosamente'
				);
			} else {
				$data = array(
					'estado' => 'error',
					'mensaje' => 'Ocurrió un error al editar el Lote'
				);
			}
		}else{
			$data = array(
				'estado' => 'error',
				'mensaje' => '2Debe llenar Todos los campos'
			);

		}
		return json_encode($data);

	}
	public function eliminarLote(){
		$id_lote = $this->request->getPost('id_lote');

		$lotes_db = new LoteModel();
		$respuesta = $lotes_db->eliminarLote($id_lote);

		if ($respuesta) {
					$data = [
						'estado'=>true,
						'datos'=>$respuesta
					];
		}else{
					$data = [
						'estado'=>"ERROR"
					];
		}
		echo json_encode($data);
	}
}
