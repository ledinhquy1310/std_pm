<?php
class giangvien
{
    function getGiangVien()
    {
        $db = new connect();
        $select = "SELECT gv.*, trinhdo.tentd,khoa.tenkhoa,nganh.tennganh
               FROM giangvien gv
               INNER JOIN trinhdo ON gv.trinhdo = trinhdo.idtd
               INNER JOIN khoa ON gv.khoa = khoa.idkhoa
               INNER JOIN nganh ON gv.nganh = nganh.idnganh";
        $result = $db->getList($select);
        return $result;
    }
    function countGV() {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM giangvien";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    
    function checkMagv($magv)
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS count FROM giangvien WHERE magv = '$magv'";
        $result = $db->getInstance($query);
        $total= $result['count'] ;
        return $total;
    }
    function checkMagv_edit($magv,$magv_now)
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS count FROM giangvien WHERE magv = '$magv' and magv <> '$magv_now'";
        $result = $db->getInstance($query);
        $total= $result['count'] ;
        return $total;
    }
    function getGiangVienPage($start,$limit)
    {
        $db = new connect();
        $select = "SELECT gv.*, trinhdo.tentd,khoa.tenkhoa,nganh.tennganh
               FROM giangvien gv
               INNER JOIN trinhdo ON gv.trinhdo = trinhdo.idtd
               INNER JOIN khoa ON gv.khoa = khoa.idkhoa
               INNER JOIN nganh ON gv.nganh = nganh.idnganh limit ". $start . "," . $limit;
        $result = $db->getList($select);
        return $result;
    }
    function getTrinhdo()
    {
        $db = new connect();
        $select = "SELECT *FROM trinhdo";
        $result = $db->getList($select);

        return $result;
    }

    public function getGiangVienById($idgv)
    {
        $db = new connect();
        $select = "SELECT gv.*, trinhdo.tentd,khoa.tenkhoa,nganh.tennganh,khoa.idkhoa,nganh.idnganh
        FROM giangvien gv
        INNER JOIN trinhdo ON gv.trinhdo = trinhdo.idtd
        INNER JOIN khoa ON gv.khoa = khoa.idkhoa
        INNER JOIN nganh ON gv.nganh = nganh.idnganh
               WHERE gv.idgv = $idgv";
        $result = $db->getInstance($select);
        return $result;
    }

    function insertGiangVien($magv,$pass, $tengv,$email, $trinhdo, $sodienthoai, $khoa, $nganh)
    {
        $db = new connect();
        $select = "INSERT INTO giangvien (magv,password, tengv,email_gv, trinhdo, sodienthoai, khoa, nganh) VALUES ('$magv','$pass', '$tengv','$email', '$trinhdo', '$sodienthoai', '$khoa', '$nganh')";
        $result = $db->exec($select);
        return $result;
    }

    function updateGiangVien($idgv, $magv,$pass, $tengv,$email, $trinhdo, $sodienthoai, $khoa, $nganh)
    {
        $db = new Connect();
        $update_query = "UPDATE giangvien SET magv='$magv',password='$pass', tengv='$tengv',email_gv='$email', trinhdo='$trinhdo', sodienthoai='$sodienthoai', khoa='$khoa', nganh='$nganh' WHERE idgv=$idgv";
        $result = $db->exec($update_query);
        return $result;
    }

    function deleteGiangVien($idgv)
    {
        $db = new connect();
        $query = "DELETE FROM giangvien WHERE idgv = $idgv";
        $result = $db->exec($query);
        return $result;
    }



    function countGiangVien()
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM giangvien";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }

    function searchGiangVienByName($search_query)
    {
        $db = new connect();
        $search_query = "SELECT gv.*, trinhdo.tentd,khoa.tenkhoa,nganh.tennganh,khoa.idkhoa,nganh.idnganh
        FROM giangvien gv
        INNER JOIN trinhdo ON gv.trinhdo = trinhdo.idtd
        INNER JOIN khoa ON gv.khoa = khoa.idkhoa
        INNER JOIN nganh ON gv.nganh = nganh.idnganh
                   WHERE gv.tengv LIKE '%$search_query%'";
        $result = $db->getList($search_query);
        return $result;
    }

    function countGVByName($search_query) {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM giangvien WHERE tengv LIKE '%$search_query%'";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }

 
}
?>