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
     function getGiangVienAcc($magv,$pass)
    {
        $db = new connect();
        $select = "SELECT gv.*, trinhdo.tentd,khoa.tenkhoa,nganh.tennganh
               FROM giangvien gv
               INNER JOIN trinhdo ON gv.trinhdo = trinhdo.idtd
               INNER JOIN khoa ON gv.khoa = khoa.idkhoa
               INNER JOIN nganh ON gv.nganh = nganh.idnganh
               where magv='$magv' and password='$pass'";
        $result = $db->getInstance($select);
        return $result;
    }
    function countGV() {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM giangvien";
        $result = $db->getInstance($query);
        $total = $result['total'];
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
                   WHERE gv.tengv LIKE '%$search_query'";
        $result = $db->getList($search_query);
        return $result;
    }

    function countGVByName($search_query) {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM giangvien WHERE tengv LIKE '%$search_query'";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    
    function changePassGV($msgv,$new_pass) {
        $db = new connect();
        $query="UPDATE giangvien SET password='$new_pass' WHERE magv='$msgv'";
        $result = $db->exec($query);
        return $result;
    }
    function checkPassword($idgv,$pass)
    {
        $db = new connect();
        $select = "select * from giangvien where idgv='$idgv'And password='$pass'";
        $result = $db->getList($select);
        return $result;
    }
}
?>