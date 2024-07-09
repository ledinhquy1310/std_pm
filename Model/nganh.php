<?php
class nganh
{
    function getnganh()
    {
        $db = new connect();
        $select = "SELECT nganh.*,khoa.tenkhoa
        FROM nganh nganh
        INNER JOIN khoa ON nganh.khoa = khoa.idkhoa ";
        $result = $db->getList($select);
        return $result;
    }
    function getnganhbykhoa($id)
    {
        $db = new connect();
        $select = "SELECT nganh.*,khoa.tenkhoa
        FROM nganh nganh
        INNER JOIN khoa ON nganh.khoa = khoa.idkhoa 
        Where nganh.khoa=$id";
        $result = $db->getList($select);
        return $result;
    }
    // Trong class nganh
    public function getnganhById($idnganh)
    {
        $db = new connect();
        $select = "SELECT * FROM nganh WHERE idnganh = $idnganh";
        $result = $db->getList($select);
        return $result->fetch();
    }

    function insertnganh($tennganh, $manganh, $khoa)
    {
        $db = new connect();
        $select = "INSERT INTO nganh (tennganh, manganh,khoa) VALUES ('$tennganh', '$manganh','$khoa')";
        $result = $db->exec($select);
        return $result;
    }
    function deletenganh($idnganh)
    {
        $db = new connect();
        $query = "DELETE FROM nganh WHERE idnganh = $idnganh";
        $result = $db->exec($query);
        return $result;
    }

    function updatenganh($idnganh, $tennganh, $manganh, $khoa)
    {
        $db = new Connect();

        $update_query = "UPDATE nganh SET tennganh='$tennganh', manganh='$manganh',khoa='$khoa' WHERE idnganh=$idnganh";
        $result = $db->exec($update_query);
        return $result;
    }
    // Trong class nganh
    public function countnganh()
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM nganh";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    function filterNganhbyKhoa($khoa)
    {
        $db = new connect();
        $select = "SELECT nganh.*,khoa.tenkhoa
        FROM nganh nganh
        INNER JOIN khoa ON nganh.khoa = khoa.idkhoa  WHERE khoa = '$khoa'";
        $result = $db->getList($select);
        return $result;
    }



}
?>