<?php
class khoa
{
    function getKhoa()
    {
        $db = new connect();
        $select = "SELECT*FROM khoa  ";
        $result = $db->getList($select);
        return $result;
    }

    public function getKhoaById($idkhoa)
    {
        $db = new connect();
        $select = "SELECT * FROM khoa WHERE idkhoa = $idkhoa";
        $result = $db->getList($select);
        return $result->fetch();
    }

    function insertKhoa($tenkhoa, $makhoa, $ngaylap, $mota)
    {
        $db = new connect();
        $select = "INSERT INTO khoa (tenkhoa, makhoa, ngaylap, mota) VALUES ('$tenkhoa', '$makhoa', '$ngaylap', '$mota')";
        $result = $db->exec($select);
        return $result;
    }

    function deleteKhoa($idkhoa)
    {
        $db = new connect();
        $query = "DELETE FROM khoa WHERE idkhoa = $idkhoa";
        $result = $db->exec($query);
        return $result;
    }

    function updateKhoa($idkhoa, $tenkhoa, $makhoa, $ngaylap, $mota)
    {
        $db = new Connect();

        $update_query = "UPDATE khoa SET tenkhoa='$tenkhoa', makhoa='$makhoa', ngaylap='$ngaylap', mota='$mota' WHERE idkhoa=$idkhoa";
        $result = $db->exec($update_query);
        return $result;
    }

    function countKhoa()
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM khoa";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    function checkMaKhoa($makhoa)
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS count FROM khoa WHERE makhoa = '$makhoa'";
        $result = $db->getInstance($query);
        $total= $result['count'] ;
        return $total;
    }
}
?>