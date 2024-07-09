<?php
class nienkhoa
{
    function getNienKhoa()
    {
        $db = new connect();
        $select = "SELECT * FROM nienkhoa";
        $result = $db->getList($select);
        return $result;
    }

    public function getNienKhoaById($idnk)
    {
        $db = new connect();
        $select = "SELECT * FROM nienkhoa WHERE idnk = $idnk";
        $result = $db->getList($select);
        return $result->fetch();
    }

    function insertNienKhoa($nienkhoa)
    {
        $db = new connect();
        $select = "INSERT INTO nienkhoa (nienkhoa) VALUES ('$nienkhoa')";
        $result = $db->exec($select);
        return $result;
    }

    function deleteNienKhoa($idnk)
    {
        $db = new connect();
        $query = "DELETE FROM nienkhoa WHERE idnk = $idnk";
        $result = $db->exec($query);
        return $result;
    }

    function updateNienKhoa($idnk, $nienkhoa)
    {
        $db = new Connect();

        $update_query = "UPDATE nienkhoa SET nienkhoa='$nienkhoa' WHERE idnk=$idnk";
        $result = $db->exec($update_query);
        return $result;
    }

    public function countNienKhoa()
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM nienkhoa";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
}
?>