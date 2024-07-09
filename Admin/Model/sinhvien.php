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
    
    public function getSinhVienById($idsv)
    {
        $db = new connect();
        $select = "SELECT sv.*, lop.tenlop, nganh.tennganh, khoa.tenkhoa,hedaotao.tenhdt
        FROM sinhvien sv
        INNER JOIN lop ON sv.lop = lop.idlop
        INNER JOIN nganh ON sv.nganh = nganh.idnganh
        INNER JOIN khoa ON nganh.khoa = khoa.idkhoa
        INNER JOIN hedaotao ON sv.hedaotao = hedaotao.idhdt
               WHERE sv.idsv = $idsv";
        $result = $db->getInstance($select);
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


    function insertSinhVien($mssv, $tensv, $email,$password, $ngaysinh, $sodienthoai, $gioitinh, $diachi, $cccd, $lop, $nganh, $hedaotao)
    {
        $db = new connect();
        $select = "INSERT INTO sinhvien (mssv, tensv,email, password, ngaysinh, sodienthoai,gioitinh,diachi,cccd, lop,nganh,hedaotao) 
        VALUES ('$mssv', '$tensv','$email','$password', '$ngaysinh', '$sodienthoai', '$gioitinh', '$diachi', '$cccd', '$lop','$nganh','$hedaotao')";
        $result = $db->exec($select);
        return $result;
    }

    function deleteSinhVien($idsv)
    {
        $db = new connect();
        $query = "DELETE FROM sinhvien WHERE idsv = $idsv";
        $result = $db->exec($query);
        return $result;
    }

    function updateSinhVien($idsv, $mssv, $tensv, $email,$password, $ngaysinh, $sodienthoai, $gioitinh, $diachi, $cccd, $lop, $nganh, $hedaotao)
    {
        $db = new Connect();

        $update_query = "UPDATE sinhvien SET mssv='$mssv', tensv='$tensv',email='$email',password='$password', ngaysinh='$ngaysinh',hedaotao='$hedaotao', sodienthoai='$sodienthoai',gioitinh='$gioitinh',diachi='$diachi',cccd='$cccd', lop='$lop',nganh='$nganh' WHERE idsv=$idsv";
        $result = $db->exec($update_query);
        return $result;
    }
    function countSinhvien()
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM sinhvien";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    function countSinhvienSearch($search_query)
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM sinhvien sv
                WHERE sv.tensv LIKE '%$search_query%' OR sv.mssv LIKE '%$search_query%'";
        $result = $db->getInstance($query);
        return $result['total'];
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
    function TrungbinhdiemSV()
    {
        $db = new connect();
        $query = "SELECT lop.nienkhoa, nienkhoa.nienkhoa, AVG(doan.diem) AS tbd
        FROM doan
        INNER JOIN sinhvien ON doan.idsv = sinhvien.idsv
        INNER JOIN lop ON sinhvien.lop = lop.idlop
        INNER JOIN nienkhoa ON lop.nienkhoa = nienkhoa.idnk
        GROUP BY lop.nienkhoa, nienkhoa.nienkhoa;
        ";
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
    function countStudents($lopid) {
        $db = new connect();
        $select = "SELECT COUNT(*) as total_students
                   FROM sinhvien
                   WHERE lop = $lopid";
        $result = $db->getInstance($select);
        return $result['total_students'];
    }
    

    function checkEmail($email)
    {
        $db = new connect();
        $select = "SELECT * from sinhvien a where a.email='$email'";
        $result = $db->getList($select);
        return $result;
    }
    function checkEmail_edit($email,$email_now)
    {
        $db = new connect();
        $select = "SELECT * from sinhvien a where a.email='$email' and a.email <> '$email_now'";
        $result = $db->getList($select);
        return $result;
    }
    function checkMSSVadd($mssv)  {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total From sinhvien where mssv='$mssv'";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    function checkMSSVedit($mssv,$mssv_now)  {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total From sinhvien where mssv='$mssv' and mssv <> '$mssv_now'";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
}
?>