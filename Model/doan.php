<?php
class Doan
{
    function getDoanbySV($idsv)
    {
        $db = new Connect();
        $select = "SELECT doan. *,sinhvien.tensv,giangvien.tengv,lop.tenlop,nganh.tennganh,khoa.tenkhoa,nienkhoa.nienkhoa
        FROM doan
        INNER JOIN sinhvien ON doan.idsv = sinhvien.idsv
        INNER JOIN giangvien ON doan.gvhd = giangvien.idgv
        INNER JOIN lop ON sinhvien.lop = lop.idlop
        INNER JOIN nienkhoa on lop.nienkhoa=nienkhoa.idnk
        INNER JOIN nganh ON sinhvien.nganh = nganh.idnganh
        INNER JOIN khoa ON nganh.khoa =khoa.idkhoa WHERE doan.idsv=$idsv";
        $result = $db->getList($select);
        return $result;
    }
    function getDoanPagebySV($idsv,$start,$limit)
    {
        $db = new Connect();
        $select = "SELECT doan. *,sinhvien.tensv,giangvien.tengv,lop.tenlop,nganh.tennganh,khoa.tenkhoa,nienkhoa.nienkhoa
        FROM doan
        INNER JOIN sinhvien ON doan.idsv = sinhvien.idsv
        INNER JOIN giangvien ON doan.gvhd = giangvien.idgv
        INNER JOIN lop ON sinhvien.lop = lop.idlop
        INNER JOIN nienkhoa on lop.nienkhoa=nienkhoa.idnk
        INNER JOIN nganh ON sinhvien.nganh = nganh.idnganh
        INNER JOIN khoa ON nganh.khoa =khoa.idkhoa WHERE doan.idsv=$idsv limit ". $start . "," . $limit;
        $result = $db->getList($select);
        return $result;
    }
    function getDoanbyGV($idgv)
    {
        $db = new Connect();
        $select = "SELECT doan. *,sinhvien.tensv,giangvien.tengv,lop.tenlop,nganh.tennganh,khoa.tenkhoa,nienkhoa.nienkhoa
        FROM doan
        INNER JOIN sinhvien ON doan.idsv = sinhvien.idsv
        INNER JOIN giangvien ON doan.gvhd = giangvien.idgv
        INNER JOIN lop ON sinhvien.lop = lop.idlop
        INNER JOIN nienkhoa on lop.nienkhoa=nienkhoa.idnk
        INNER JOIN nganh ON sinhvien.nganh = nganh.idnganh
        INNER JOIN khoa ON nganh.khoa =khoa.idkhoa WHERE doan.gvhd=$idgv";
        $result = $db->getList($select);
        return $result;
    }
    function getDoanPagebyGV($idgv,$start,$limit)
    {
        $db = new Connect();
        $select = "SELECT doan. *,sinhvien.tensv,giangvien.tengv,lop.tenlop,nganh.tennganh,khoa.tenkhoa,nienkhoa.nienkhoa
        FROM doan
        INNER JOIN sinhvien ON doan.idsv = sinhvien.idsv
        INNER JOIN giangvien ON doan.gvhd = giangvien.idgv
        INNER JOIN lop ON sinhvien.lop = lop.idlop
        INNER JOIN nienkhoa on lop.nienkhoa=nienkhoa.idnk
        INNER JOIN nganh ON sinhvien.nganh = nganh.idnganh
        INNER JOIN khoa ON nganh.khoa =khoa.idkhoa WHERE doan.gvhd=$idgv limit ". $start . "," . $limit;
        $result = $db->getList($select);
        return $result;
    }
    function getDoanById($iddoan)
    {
        $db = new Connect();
        $select = "SELECT doan. *,sinhvien.tensv,giangvien.tengv,lop.tenlop,nganh.tennganh,khoa.tenkhoa,khoa.idkhoa,nganh.idnganh,lop.idlop,nienkhoa.nienkhoa
        FROM doan
        INNER JOIN sinhvien ON doan.idsv = sinhvien.idsv
        INNER JOIN giangvien ON doan.gvhd = giangvien.idgv
        INNER JOIN lop ON sinhvien.lop = lop.idlop
        INNER JOIN nienkhoa on lop.nienkhoa=nienkhoa.idnk
        INNER JOIN nganh ON sinhvien.nganh = nganh.idnganh
        INNER JOIN khoa ON nganh.khoa =khoa.idkhoa WHERE iddoan = $iddoan";
        $result = $db->getInstance($select);
        return $result;
    }

    function insertDoan($tendoan, $hinhanh,$baocao, $linkdoan, $madoan, $idsv, $gvhd)
    {
        $db = new Connect();
        $select = "INSERT INTO doan ( tendoan,hinhanh,baocao, linkdoan, madoan, idsv, gvhd) VALUES ( '$tendoan','$hinhanh','$baocao','$linkdoan', '$madoan', '$idsv', '$gvhd')";
        $result = $db->exec($select);
        return $result;
    }

    function updateDoan($iddoan, $tendoan, $hinhanh,$baocao, $linkdoan, $madoan, $idsv, $gvhd)
    {
        $db = new Connect();
        $update_query = "UPDATE doan SET tendoan='$tendoan',hinhanh='$hinhanh',baocao='$baocao', linkdoan='$linkdoan', madoan='$madoan', idsv='$idsv', gvhd='$gvhd' WHERE iddoan=$iddoan";
        $result = $db->exec($update_query);
        return $result;
    }
    function updatePointsDoan($iddoan, $diem)
    {
        $db = new Connect();
        $update_query = "UPDATE doan SET diem='$diem' WHERE iddoan=$iddoan";
        $result = $db->exec($update_query);
        return $result;
    }

    function deleteDoan($iddoan)
    {
        $db = new Connect();
        $query = "DELETE FROM doan WHERE iddoan = $iddoan";
        $result = $db->exec($query);
        return $result;
    }
    function countDoan()
    {
        $db = new connect();
        $query = "SELECT COUNT(*) AS total FROM doan";
        $result = $db->getInstance($query);
        $total = $result['total'];
        return $total;
    }
    function countDoanChuaChamDiem($idgv)
{
    $db = new connect();
    $query = "SELECT COUNT(*) AS total FROM doan WHERE gvhd = $idgv AND diem =0";
    $result = $db->getInstance($query);
    $total = $result['total'];
    return $total;
}

}

?>