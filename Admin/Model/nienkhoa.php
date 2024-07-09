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
    function getNienKhoaPage($start,$limit)
    {
        $db = new connect();
        $select = "SELECT * FROM nienkhoa limit ". $start . "," . $limit;
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

    function insertNienKhoa($nienkhoa,$loai)
    {
        $db = new connect();
        $select = "INSERT INTO nienkhoa (nienkhoa,loai) VALUES ('$nienkhoa','$loai')";
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

    function updateNienKhoa($idnk, $nienkhoa,$loai)
    {
        $db = new Connect();

        $update_query = "UPDATE nienkhoa SET nienkhoa='$nienkhoa', loai= '$loai' WHERE idnk=$idnk";
        $result = $db->exec($update_query);
        return $result;
    }

    function countNienKhoa()
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM nienkhoa";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    function getnienkhoabyhdt($idhdt){
        $db = new connect();
        $select = "SELECT nk.idnk, nk.nienkhoa, nk.loai
        FROM nienkhoa nk
        JOIN hedaotao hdt ON nk.loai = hdt.loai_nk
        WHERE hdt.idhdt = $idhdt
        ";
        $result = $db->getList($select);
        return $result;
    }
}
?>