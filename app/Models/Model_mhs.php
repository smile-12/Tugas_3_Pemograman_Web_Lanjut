<?php
namespace Models;
use Libraries\Database;
use PDO;

class Model_mhs {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }


    // Soft delete mahasiswa
    public function deleteMahasiswa($id) {
        $query = "UPDATE mahasiswa SET deleted_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo()); // Mencetak error SQL
            exit;
        }
    
        return true;
    }
    

    function simpanData($nim,$nama)
        {
            $rs = $this->db->prepare("INSERT INTO mahasiswa (nim,nama) VALUES (?,?)");
            $rs->execute([$nim,$nama]);
        }

        function lihatData()
        {

            $rs = $this->db->query("SELECT * FROM mahasiswa");
            return $rs;
        }

        function lihatDataDetail($id)
        {

            $rs = $this->db->prepare("SELECT * FROM mahasiswa WHERE id=?");
            $rs->execute([$id]);
            return $rs->fetch();// kalau hasil query hanya satu, gunakan method fetch() bawaan PDO
        }
}
?>
