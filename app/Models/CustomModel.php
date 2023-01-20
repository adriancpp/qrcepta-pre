<?php namespace  App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CustomModel
{

    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db;
    }

    function all($pesel)
    {
        return $this->db->table('prescription')
            ->select('*, prescription.created_at, prescription.id')
            ->join('user', 'prescription.patient_id = user.id')
            ->where('user.pesel ', $pesel)
            ->orderBy('prescription.created_at', 'DESC')
            ->get()->getResult();
    }

    function allUserPrescriptions($id)
    {
        return $this->db->table('prescription')
            ->select('*, prescription.created_at, prescription.id')
            ->join('user', 'prescription.patient_id = user.id')
            ->where('prescription.patient_id ', $id)
            ->orderBy('prescription.created_at', 'DESC')
            ->get()->getResult();
    }
}