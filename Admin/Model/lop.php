<?php
class lop
{
    function getLop()
    {
        $db = new connect();
        $select = "SELECT lop.*, nganh.tennganh,nienkhoa.nienkhoa,hedaotao.tenhdt
        FROM lop 
        INNER JOIN nienkhoa ON lop.nienkhoa = nienkhoa.idnk
        INNER JOIN hedaotao ON lop.hdt =hedaotao.idhdt
        INNER JOIN nganh ON lop.nganh = nganh.idnganh";
        $result = $db->getList($select);
        return $result;
    }
    function getLopPage($start,$limit)
    {
        $db = new connect();
        $select = "SELECT lop.*, nganh.tennganh,nienkhoa.nienkhoa,hedaotao.tenhdt
        FROM lop 
        INNER JOIN nienkhoa ON lop.nienkhoa = nienkhoa.idnk
        INNER JOIN hedaotao ON lop.hdt =hedaotao.idhdt
        INNER JOIN nganh ON lop.nganh = nganh.idnganh limit ". $start . "," . $limit;
        $result = $db->getList($select);
        return $result;
    }
    function getLopByNganh($id)
    {
        $db = new connect();
        $select = "SELECT lop.*, nganh.tennganh,nienkhoa.nienkhoa,hedaotao.tenhdt
        FROM lop 
        INNER JOIN nienkhoa ON lop.nienkhoa = nienkhoa.idnk
        INNER JOIN hedaotao ON lop.hdt =hedaotao.idhdt
        INNER JOIN nganh ON lop.nganh = nganh.idnganh
        WHERE lop.nganh = $id";
        $result = $db->getList($select);
        return $result;
    }
    function getLopByNganhHdt($nganh_id, $hdt_id)
    {
        $db = new connect();
        $select = "SELECT lop.*, nganh.tennganh,nienkhoa.nienkhoa,hedaotao.tenhdt
        FROM lop 
        INNER JOIN nienkhoa ON lop.nienkhoa = nienkhoa.idnk
        INNER JOIN hedaotao ON lop.hdt =hedaotao.idhdt
        INNER JOIN nganh ON lop.nganh = nganh.idnganh
        WHERE lop.nganh = $nganh_id AND lop.hdt=$hdt_id";
        $result = $db->getList($select);
        return $result;
    }
    public function getLopById($idlop)
    {
        $db = new connect();
        $select = "SELECT lop.*, nganh.tennganh, nienkhoa.nienkhoa, hedaotao.tenhdt, nienkhoa.idnk, khoa.tenkhoa ,khoa.idkhoa
        FROM lop 
        INNER JOIN nienkhoa ON lop.nienkhoa = nienkhoa.idnk 
        INNER JOIN nganh ON lop.nganh = nganh.idnganh 
        INNER JOIN khoa ON nganh.khoa = khoa.idkhoa 
        INNER JOIN hedaotao ON lop.hdt = hedaotao.idhdt
        WHERE idlop = $idlop";
        $result = $db->getInstance($select);
        return $result;
    }

    function insertLop($tenlop, $malop, $nganh, $nienkhoa, $hdt)
    {
        $db = new connect();
        $select = "INSERT INTO lop (tenlop, malop,nganh,nienkhoa,hdt) VALUES ('$tenlop', '$malop','$nganh','$nienkhoa','$hdt')";
        $result = $db->exec($select);
        return $result;
    }

    function deleteLop($idlop)
    {
        $db = new connect();
        $query = "DELETE FROM lop WHERE idlop = $idlop";
        $result = $db->exec($query);
        return $result;
    }

    function updateLop($idlop, $tenlop, $malop, $nganh, $nienkhoa, $hdt)
    {
        $db = new Connect();

        $update_query = "UPDATE lop SET tenlop='$tenlop', malop='$malop', nganh='$nganh', nienkhoa='$nienkhoa',hdt='$hdt' WHERE idlop=$idlop";
        $result = $db->exec($update_query);
        return $result;
    }

    function countSVinLop($idlop)
    {
        $db = new Connect();
        $query = "SELECT COUNT(*) AS totalsv FROM sinhvien WHERE lop=$idlop";
        $result = $db->getInstance($query);
        $total = $result['totalsv'];
        return $total;

    }

    function countLop()
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM lop";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    function filterLopByNganh($nganh)
    {
        $db = new connect();
        $select = "SELECT lop.*, nganh.tennganh,nienkhoa.nienkhoa,hedaotao.tenhdt
        FROM lop 
        INNER JOIN nienkhoa ON lop.nienkhoa = nienkhoa.idnk
        INNER JOIN hedaotao ON lop.hdt =hedaotao.idhdt
        INNER JOIN nganh ON lop.nganh = nganh.idnganh WHERE nganh = '$nganh'";
        $result = $db->getList($select);
        return $result;
    }
    function filterLopByNienKhoa($nienkhoa)
    {
        $db = new connect();
        $select = "SELECT lop.*, nganh.tennganh,nienkhoa.nienkhoa,hedaotao.tenhdt
        FROM lop 
        INNER JOIN nienkhoa ON lop.nienkhoa = nienkhoa.idnk
        INNER JOIN hedaotao ON lop.hdt =hedaotao.idhdt
        INNER JOIN nganh ON lop.nganh = nganh.idnganh WHERE nienkhoa.idnk = '$nienkhoa'";
        $result = $db->getList($select);
        return $result;
    }
    function filterLopByNganhAndNienKhoa($nganh, $nienkhoa)
    {
        $db = new connect();
        $select = "SELECT lop.*, nganh.tennganh,nienkhoa.nienkhoa,hedaotao.tenhdt
        FROM lop 
        INNER JOIN nienkhoa ON lop.nienkhoa = nienkhoa.idnk
        INNER JOIN hedaotao ON lop.hdt =hedaotao.idhdt
        INNER JOIN nganh ON lop.nganh = nganh.idnganh WHERE nganh = '$nganh' AND nienkhoa.idnk = '$nienkhoa'";
        $result = $db->getList($select);
        return $result;
    }
    function countLopByNganhAndNienKhoa($nganh, $nienkhoa)
    {
        $db = new Connect();
        $query = "SELECT COUNT(*) AS total FROM lop
        INNER JOIN nienkhoa ON lop.nienkhoa = nienkhoa.idnk
         WHERE nganh = '$nganh' AND nienkhoa.idnk = '$nienkhoa'";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    function checkMalop($malop)
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS count FROM lop WHERE malop = '$malop'";
        $result = $db->getInstance($query);
        $total= $result['count'] ;
        return $total;
    }
}
?>