<?php

namespace App\Models;
use CodeIgniter\Model;

class LoteModel extends Model{
    protected $table      = 'lote';
    protected $primaryKey = 'id_lote';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'finca', 'extencion'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at'; 
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function insertarLote($nombre, $finca, $extencion) {
        $data = array(
            'nombre' => $nombre,
            'finca' => $finca,
            'extencion' => $extencion
        );
        $respuesta = $this->insert($data);
        if($respuesta) {
            return $this->insertID;
        } else {
            return false;
        }
    }

    public function obtenerListaLotebyFinca($finca) {
        $sql = "SELECT * FROM lote WHERE finca = ? ";

        $registros = $this->db->query($sql, [$finca]);

        return $registros->getResultArray();
    }

    public function editarLote($id_lote, $nombre, $finca, $extencion) {
        $data = array(
            'id_lote'=> $id_lote,
            'nombre' => $nombre,
            'finca' => $finca,
            'extencion' => $extencion
        );
        $respuesta = $this->update($id_lote, $data);
        return $respuesta;
    }

    public function eliminarLote($id_lote){
        $lote = $this->escapeString($id_lote);
        $sql = "DELETE FROM lote WHERE id_lote = ?;";

        $lotes = $this->db->query($sql, [$lote]);
        return $lotes->getResult();
    }
}