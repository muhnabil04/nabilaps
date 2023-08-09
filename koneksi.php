<?php
//session
class database
{

    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "data_siswa";
    var $koneksi = "";
    function __construct()
    {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    function tampil_data()
    {
        $data = mysqli_query($this->koneksi, "SELECT `siswa`.`id`, `siswa`.`nama`, `siswa`.`nisn`, `siswa`.`alamat`, `siswa`.`foto`, `kelas`.`wali_kelas`, `kelas`.`nama_kelas`, `mapel`.`nama_mapel`, `mapel`.`guru_mapel`, `nilai`.`jumlah_nilai`
    FROM `siswa`
    INNER JOIN `kelas` ON `siswa`.`kelas_id` = `kelas`.`id`
    INNER JOIN `mapel` ON `siswa`.`mapel_id` = `mapel`.`id`
    INNER JOIN `nilai` ON `siswa`.`nilai_id` = `nilai`.`id`
    ORDER BY `siswa`.`id` ASC");

        $hasil = array();
        while ($row = mysqli_fetch_assoc($data)) {
            $hasil[] = $row;
        }

        return $hasil;
    }



    public function getKelas()
    {
        $query = "SELECT * FROM kelas";
        $result = $this->koneksi->query($query);
        return $result;
    }

    public function getMapel()
    {
        $query = "SELECT * FROM mapel";
        $result = $this->koneksi->query($query);
        return $result;
    }

    public function getNilai()
    {
        $query = "SELECT * FROM nilai";
        $result = $this->koneksi->query($query);
        return $result;
    }


    function tambah($nama, $kelas_id, $nisn, $alamat, $mapel_id, $nilai_id, $foto)

    {
        $query_siswa = mysqli_query($this->koneksi, "INSERT INTO siswa (nama, kelas_id, nisn, alamat, mapel_id, nilai_id, foto) VALUES ('$nama', '$kelas_id', '$nisn', '$alamat', '$mapel_id', '$nilai_id','$foto')");

        if ($query_siswa) {
            header("Location: index.php");
        } else {
            return;
        }
    }

    function getid($id)
    {
        $query = mysqli_query($this->koneksi, "SELECT * FROM siswa WHERE id='$id'");
        return $query->fetch_array();
    }



    function getdetail($id)
    {
        $query = mysqli_query($this->koneksi, "SELECT `siswa`.`id`, `siswa`.`nama`, `siswa`.`nisn`, `siswa`.`alamat`, `siswa`.`foto`, `kelas`.`wali_kelas`, `kelas`.`nama_kelas`, `mapel`.`nama_mapel`, `mapel`.`guru_mapel`, `nilai`.`jumlah_nilai`
        FROM `siswa`
        INNER JOIN `kelas` ON `siswa`.`kelas_id` = `kelas`.`id`
        INNER JOIN `mapel` ON `siswa`.`mapel_id` = `mapel`.`id`
        INNER JOIN `nilai` ON `siswa`.`nilai_id` = `nilai`.`id`
        WHERE `siswa`.`id`='$id'");
        // print_r($query);
        // die;
        return $query->fetch_assoc();
    }

    function getNilaiStatus($nilai)
    {
        if ($nilai >= 80) {
            return 'A';
        } elseif ($nilai >= 70) {
            return 'B';
        } elseif ($nilai >= 60) {
            return 'C';
        } else {
            return 'D';
        }
    }

    function update($id, $nama, $kelas_id, $nisn, $alamat, $mapel_id, $nilai_id, $foto)
    {
        $foto = mysqli_real_escape_string($this->koneksi, $foto);


        if (empty($foto)) {
            $foto_lama_query = mysqli_query($this->koneksi, "SELECT foto FROM siswa WHERE id='$id'");
            $foto_lama = mysqli_fetch_assoc($foto_lama_query)['foto'];
            $query_update = mysqli_query($this->koneksi, "UPDATE siswa SET nama='$nama', kelas_id='$kelas_id', nisn='$nisn', alamat='$alamat', mapel_id='$mapel_id', nilai_id='$nilai_id', foto='$foto_lama' WHERE id='$id'");
        } else {
            $query_update = mysqli_query($this->koneksi, "UPDATE siswa SET nama='$nama', kelas_id='$kelas_id', nisn='$nisn', alamat='$alamat', mapel_id='$mapel_id', nilai_id='$nilai_id', foto='$foto' WHERE id='$id'");
        }

        return $query_update;
    }

    function delete($id)
    {
        $query = "DELETE FROM siswa WHERE id='$id'";
        $result = mysqli_query($this->koneksi, $query);
        return $result;
    }



    function cari($keyword)
    {
        $keyword = mysqli_real_escape_string($this->koneksi, $keyword);
        $query = "SELECT siswa.id, siswa.nama, siswa.nisn, siswa.alamat, siswa.foto, kelas.wali_kelas, kelas.nama_kelas, mapel.nama_mapel, mapel.guru_mapel, nilai.jumlah_nilai 
        FROM siswa
        INNER JOIN kelas ON siswa.kelas_id = kelas.id
        INNER JOIN mapel ON siswa.mapel_id = mapel.id
        INNER JOIN nilai ON siswa.nilai_id = nilai.id
        WHERE 
        nama LIKE '%$keyword%'
        OR nisn LIKE '%$keyword%'
        OR alamat LIKE '%$keyword%'
        OR nama_kelas LIKE '%$keyword%'
        OR wali_kelas LIKE '%$keyword%'
        OR wali_kelas LIKE '%$keyword%'
        OR nama_mapel LIKE '%$keyword%'
        OR guru_mapel LIKE '%$keyword%'
         OR jumlah_nilai LIKE '%$keyword%'
        ";

        $result = $this->koneksi->query($query);
        $hasil = array();
        while ($row = $result->fetch_assoc()) {
            $hasil[] = $row;
        }
        return $hasil;
    }



    function count_data($keyword)
    {
        $keyword = mysqli_real_escape_string($this->koneksi, $keyword);
        $query = "SELECT COUNT(*) as total 
            FROM siswa
            INNER JOIN kelas ON siswa.kelas_id = kelas.id
            INNER JOIN mapel ON siswa.mapel_id = mapel.id
            INNER JOIN nilai ON siswa.nilai_id = nilai.id
            WHERE 
            nama LIKE '%$keyword%'
            OR nisn LIKE '%$keyword%'
            OR alamat LIKE '%$keyword%'
            OR nama_kelas LIKE '%$keyword%'
            ";

        $result = $this->koneksi->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }

    function get_paginated_data($keyword, $page = 1, $limit = 10)
    {
        $keyword = mysqli_real_escape_string($this->koneksi, $keyword);
        $offset = ($page - 1) * $limit;

        $query = "SELECT siswa.id, siswa.nama, siswa.nisn, siswa.alamat, kelas.wali_kelas, kelas.nama_kelas, mapel.nama_mapel, mapel.guru_mapel, nilai.jumlah_nilai 
              FROM siswa
              INNER JOIN kelas ON siswa.kelas_id = kelas.id
              INNER JOIN mapel ON siswa.mapel_id = mapel.id
              INNER JOIN nilai ON siswa.nilai_id = nilai.id
              WHERE 
              nama LIKE '%$keyword%'
              OR nisn LIKE '%$keyword%'
              OR alamat LIKE '%$keyword%'
              OR nama_kelas LIKE '%$keyword%'
              LIMIT $limit OFFSET $offset";

        $result = $this->koneksi->query($query);
        $hasil = array();
        while ($row = $result->fetch_assoc()) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tambahMapel($id, $mapel_id, $nilai_id)
    {
        $query_mapel = mysqli_query($this->koneksi, "INSERT INTO siswa_mapel (siswa_id, mapel_id, nilai_id) VALUES ('$id','$mapel_id', '$nilai_id')");
        if ($query_mapel) {
            header("Location: detail.php?id=$id");
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
        }
    }

    public function getsiswaMapel($id)
    {
        $query = "SELECT * FROM siswa_mapel
        INNER JOIN siswa ON siswa_mapel.siswa_id = siswa.id
        INNER JOIN mapel ON siswa_mapel.mapel_id = mapel.id
        INNER JOIN nilai ON siswa_mapel.nilai_id = nilai.id
        WHERE siswa_mapel.siswa_id = '$id' ";

        $result = $this->koneksi->query($query);
        return $result;
    }

    public function getLanding()
    {
        $query = "SELECT * FROM landing";
        $result = $this->koneksi->query($query);
        return $result;
    }



    function getidlanding($id)
    {
        $query = mysqli_query($this->koneksi, "SELECT * FROM landing WHERE id='$id'");
        return $query->fetch_array();
    }

    function editLanding($id, $text, $foto)
    {
        $foto = mysqli_real_escape_string($this->koneksi, $foto);


        if (empty($foto)) {
            $foto_lama_query = mysqli_query($this->koneksi, "SELECT foto FROM landing WHERE id='$id'");
            $foto_lama = mysqli_fetch_assoc($foto_lama_query)['foto'];
            $query_update = mysqli_query($this->koneksi, "UPDATE landing SET nama='$text',foto='$foto_lama' WHERE id='$id'");
        } else {
            $query_update = mysqli_query($this->koneksi, "UPDATE landing SET nama='$text',foto='$foto' WHERE id='$id'");
        }

        return $query_update;
    }
}
