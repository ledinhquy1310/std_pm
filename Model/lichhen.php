<?php
class lichhen
{
    function getlichhen()
    {
        $db = new connect();
        $select = "SELECT lichhen.*,sinhvien.tensv,giangvien.tengv,sinhvien.email
        FROM lichhen
        INNER JOIN sinhvien ON lichhen.idsv = sinhvien.idsv
        INNER JOIN giangvien ON lichhen.idgv = giangvien.idgv";
        $result = $db->getList($select);
        return $result;
    }
    function countlichhenbyid($id)
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM lichhen WHERE idgv=$id";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    function countlichhen_sended_byid($id)
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM lichhen_sended WHERE idgv=$id";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    function countlichhen_sended_byidsv($id)
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM lichhen_sended WHERE idsv=$id";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    function getlichhen_sended()
    {
        $db = new connect();
        $select = "SELECT lichhen_sended.*,sinhvien.tensv,giangvien.tengv,sinhvien.email
        FROM lichhen_sended
        INNER JOIN sinhvien ON lichhen_sended.idsv = sinhvien.idsv
        INNER JOIN giangvien ON lichhen_sended.idgv = giangvien.idgv";
        $result = $db->getList($select);
        return $result;
    }
    function getlichhenbyid($id)
    {
        $db = new connect();
        $select = "SELECT lichhen.*,sinhvien.tensv,giangvien.tengv,sinhvien.email,lop.idlop
        FROM lichhen
        INNER JOIN sinhvien ON lichhen.idsv = sinhvien.idsv
        INNER JOIN giangvien ON lichhen.idgv = giangvien.idgv
        INNER JOIN lop ON sinhvien.lop = lop.idlop

        WHERE lichhen.idlh=$id";
        $result = $db->getInstance($select);
        return $result;
    }
    function insertlichhen($idsv, $idgv, $ngayhen, $ghichu)
    {
        $db = new connect();
        $select = "INSERT INTO lichhen (idsv,idgv,ngayhen,ghichu) VALUES ('$idsv', '$idgv', '$ngayhen', '$ghichu')";
        $result = $db->exec($select);
        return $result;
    }
    function editlichhen($id, $idsv, $idgv, $ngayhen, $ghichu)
    {
        $db = new connect();
        $update = "UPDATE lichhen SET idsv='$idsv', idgv='$idgv', ngayhen='$ngayhen', ghichu='$ghichu' WHERE idlh='$id'";
        $result = $db->exec($update);
        return $result;
    }
    

    function deletelichhen($idlichhen)
    {
        $db = new connect();
        $query = "DELETE FROM lichhen WHERE idlh = $idlichhen";
        $result = $db->exec($query);
        return $result;
    }
    function deletelichhensended($idlichhen)
    {
        $db = new connect();
        $query = "DELETE FROM lichhen_sended WHERE idlh = $idlichhen";
        $result = $db->exec($query);
        return $result;
    }

    function moveToSended($idlh) {
        $db = new connect();
        $select = "INSERT INTO lichhen_sended SELECT * FROM lichhen WHERE idlh = '$idlh'";
        $result = $db->exec($select);
    
        if ($result) {
            $delete = "DELETE FROM lichhen WHERE idlh = '$idlh'";
            $result = $db->exec($delete);
            return $result ? true : false;
        } else {
            return false;
        }
    }
}
?>