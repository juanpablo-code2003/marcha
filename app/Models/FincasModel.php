<?php

namespace App\Models;
use CodeIgniter\Model;

class FincasModel extends Model{
    protected $table      = 'finca';
    protected $primaryKey = 'id_finca';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['nombre', 'usuario', 'extencion', 'departamento', 'municipio'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at'; 
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function insertarFinca($nombre, $usuario, $extension, $departamento, $municipio) {
        $data = array(
            'nombre' => $nombre,
            'usuario' => $usuario,
            'extencion' => $extension,
            'departamento' => $departamento,
            'municipio' => $municipio
        );
        $respuesta = $this->insert($data);
        if($respuesta) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function cantidad_fincas($usuario){
        $sql = "SELECT COUNT(id_finca) AS fincas FROM finca WHERE usuario = ?";

        $respuesta = $this->db->query($sql, [$usuario]);

        return $respuesta->getResultArray()[0]['fincas'];
    }

    public function obtenerListaFincasbyUser($usuario) {
        // $registros = $this->join('departamentos', 'finca.departamento = departamentos.id_departamento')->join('municipios', 'finca.municipio = municipios.id_municipio')->select(['finca.nombre', 'finca.extencion'])->select('departamentos.departamento')->select('municipios.municipio')->where(['finca.usuario'=>$usuario])->find();

        $sql = "SELECT finca.id_finca, finca.nombre, finca.extencion, departamentos.departamento, municipios.municipio FROM finca INNER JOIN departamentos ON finca.departamento = departamentos.id_departamento INNER JOIN municipios ON finca.municipio = municipios.id_municipio WHERE finca.usuario = ?";

        $registros = $this->db->query($sql, [$usuario]);

        return $registros->getResultArray();
    }

    public function getDatosSession($id_finca, $id_usuario) {
        $sql = "SELECT id_finca, nombre, extencion, departamento, municipio FROM finca WHERE id_finca = ? AND usuario = ?";
        $registros = $this->db->query($sql, [$id_finca, $id_usuario])->getResultArray();
        return $registros[0];
    }
    
    public function editarFinca($id_finca, $nombre, $extension) {
        $data = array(
            'id_finca'=> $id_finca,
            'nombre' => $nombre,
            'extencion' => $extension
        );
        $respuesta = $this->update($id_finca, $data);
        return $respuesta;
    }
} 