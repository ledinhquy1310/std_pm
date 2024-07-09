<?php
class sinhvien
{
    function getSinhVienList()
    {
        $db = new connect();
        $select = "SELECT sv.*, lop.tenlop, nganh.tennganh, khoa.tenkhoa,hedaotao.tenhdt
        FROM sinhvien sv
        INNER JOIN lop ON sv.lop = lop.idlop
        INNER JOIN nganh ON sv.nganh = nganh.idnganh
        INNER JOIN khoa ON nganh.khoa = khoa.idkhoa
        INNER JOIN hedaotao ON sv.hedaotao = hedaotao.idhdt";
        $result = $db->getList($select);
        return $result;
    }

    function getSinhVienListPage($start,$limit)
    {
        $db = new connect();
        $select = "SELECT sv.*, lop.tenlop, nganh.tennganh, khoa.tenkhoa,hedaotao.tenhdt
        FROM sinhvien sv
        INNER JOIN lop ON sv.lop = lop.idlop
        INNER JOIN nganh ON sv.nganh = nganh.idnganh
        INNER JOIN khoa ON nganh.khoa = khoa.idkhoa
        INNER JOIN hedaotao ON sv.hedaotao = hedaotao.idhdt limit ". $start . "," . $limit;
        $result = $db->getList($select);
        return $result;
    }
    public function getSinhVienByLop($lop_id)
    {
        $db = new connect();
        $select = "SELECT * From sinhvien
               WHERE sinhvien.lop = $lop_id";
        $result = $db->getList($select);
        return $result;
    }
    function searchSinhVienByNameClass($search_query,$lop_id)
    {
        if (!empty($lop_id)) {
        $db = new connect();
        $search_query = "SELECT sv.*, lop.tenlop, nganh.tennganh, khoa.tenkhoa,hedaotao.tenhdt
        FROM sinhvien sv
        INNER JOIN lop ON sv.lop = lop.idlop
        INNER JOIN nganh ON sv.nganh = nganh.idnganh
        INNER JOIN khoa ON nganh.khoa = khoa.idkhoa
        INNER JOIN hedaotao ON sv.hedaotao = hedaotao.idhdt
                   WHERE (sv.tensv LIKE '%$search_query%' OR sv.mssv LIKE '%$search_query%') AND sv.lop=$lop_id";
        $result = $db->getList($search_query);
        return $result;
    } else {
        $db = new connect();
        $search_query = "SELECT sv.*, lop.tenlop, nganh.tennganh, khoa.tenkhoa,hedaotao.tenhdt
        FROM sinhvien sv
        INNER JOIN lop ON sv.lop = lop.idlop
        INNER JOIN nganh ON sv.nganh = nganh.idnganh
        INNER JOIN khoa ON nganh.khoa = khoa.idkhoa
        INNER JOIN hedaotao ON sv.hedaotao = hedaotao.idhdt
                   WHERE sv.tensv LIKE '%$search_query%' OR sv.mssv LIKE '%$search_query%'";
        $result = $db->getList($search_query);
        return $result;
    }
    }

    function countSinhvien()
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM sinhvien";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    function countStudents($lopid) {
        $db = new connect();
        $select = "SELECT COUNT(*) as total_students
                   FROM sinhvien
                   WHERE lop = $lopid";
        $result = $db->getInstance($select);
        return $result['total_students'];
    }

    function countSinhvienSearch($search_query)
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM sinhvien sv
                WHERE sv.tensv LIKE '%$search_query%' OR sv.mssv LIKE '%$search_query%'";
        $result = $db->getInstance($query);
        return $result['total'];
    }
    function filterSinhVienByLop($class_id)
    {
        $db = new connect();
        $query = "SELECT sv.*, lop.tenlop, nganh.tennganh,hedaotao.tenhdt,khoa.tenkhoa 
        FROM sinhvien sv
        INNER JOIN lop ON sv.lop = lop.idlop
        INNER JOIN nganh ON sv.nganh = nganh.idnganh
        INNER JOIN hedaotao ON sv.hedaotao = hedaotao.idhdt
        INNER JOIN khoa ON nganh.khoa = khoa.idkhoa
              WHERE sv.lop = $class_id";
        $result = $db->getList($query);
        return $result;
    }
    function SelectSVLop($lopid)
    {
        $db = new connect();
        $select = "SELECT sv.*, lop.tenlop, nganh.tennganh, khoa.tenkhoa,hedaotao.tenhdt
        FROM sinhvien sv
        INNER JOIN lop ON sv.lop = lop.idlop
        INNER JOIN nganh ON sv.nganh = nganh.idnganh
        INNER JOIN khoa ON nganh.khoa = khoa.idkhoa
        INNER JOIN hedaotao ON sv.hedaotao = hedaotao.idhdt
        WHERE sv.lop = $lopid";
        $result = $db->getList($select);
        return $result;
    }
    function getSinhvien($mssv, $pass)
    {
        $db = new connect();
        $select = "SELECT sv.*, lop.tenlop, nganh.tennganh, khoa.tenkhoa,hedaotao.tenhdt
        FROM sinhvien sv
        INNER JOIN lop ON sv.lop = lop.idlop
        INNER JOIN nganh ON sv.nganh = nganh.idnganh
        INNER JOIN khoa ON nganh.khoa = khoa.idkhoa
        INNER JOIN hedaotao ON sv.hedaotao = hedaotao.idhdt
         where mssv='$mssv' and password='$pass'";
        $result = $db->getInstance($select);
        return $result;
    }

    function changePassSV($mssv,$new_pass) {
        $db = new connect();
        $query="UPDATE sinhvien SET password='$new_pass' WHERE mssv='$mssv'";
        $result = $db->exec($query);
        return $result;
    }
    function checkPassword($idsv,$pass)
    {
        $db = new connect();
        $select = "select * from sinhvien where idsv='$idsv'And password='$pass'";
        $result = $db->getList($select);
        return $result;
    }
    function checkEmail($email)
    {
        $db = new connect();
        $select = "select * from sinhvien a where a.email='$email'";
        $result = $db->getList($select);
        return $result;
    }
    
    function updatePass($email, $pass)
    {
        $db = new connect();
        $query = "UPDATE sinhvien set password ='$pass' where email='$email' ";
        $db->exec($query);
    }
}
?>