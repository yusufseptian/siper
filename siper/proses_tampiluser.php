 <?php        
         
session_start();
          $query ="SELECT * FROM tbl_siswa WHERE nama_siswa = '".$_SESSION['nama_siswa']."'";
          $result = mysqli_query($koneksi, $query);
          if (!$result) {
            die("Query gagal dijalankan : ".mysqli_errno($koneksi)."-".mysqli_error($koneksi));     
        } 
        $data = mysqli_fetch_assoc($result);
        ?> 
