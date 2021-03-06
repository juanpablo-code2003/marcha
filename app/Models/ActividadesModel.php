<?php

namespace App\Models;
use CodeIgniter\Model;

class ActividadesModel extends Model{
    protected $table      = 'actividad';
    protected $primaryKey = 'id_actividad';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'descripcion', 'estado', 'finca'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at'; 
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function insertarActividad($nombre, $descripcion, $finca) {
        $data = array(
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'finca' => $finca
        );
        $respuesta = $this->insert($data);
        if($respuesta) {
            return $this->insertID;
        } else {
            return false;
        }
    }

    public function get_Actividad($finca) {
        $sql = "SELECT id_actividad, nombre, descripcion FROM actividad WHERE finca = ? ORDER BY id_actividad DESC";

        $registros = $this->db->query($sql, [$finca]); 

        return $registros->getResultArray();
    }

    public function editarActividad($id_actividad, $nombre, $descripcion, $finca) {
        $data = array(
            'id_actividad'=>$id_actividad,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'finca' => $finca
        );
        $respuesta = $this->update($id_actividad, $data);
        return $respuesta;
        
    }

    public function eliminarActividad($id_actividad){
        $act = $this->escapeString($id_actividad);
        $sql = "DELETE FROM actividad WHERE id_actividad = ?;";

        $actividades = $this->db->query($sql, [$act]);
        return $actividades;
    }

    public function validarActividad($id_actividad) {
        $sql = "SELECT COUNT(lote_actividad.actividad) AS repeticiones FROM lote_actividad INNER JOIN actividad ON lote_actividad.actividad = actividad.id_actividad WHERE actividad.id_actividad = ?";

        $registros = $this->db->query($sql, [$id_actividad]); 

        return $registros->getResultArray()[0]['repeticiones']; 
    }

}