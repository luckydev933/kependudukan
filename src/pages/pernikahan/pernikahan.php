<p class="content-title">Data Pernikahan</p>
<div class="col-md-6 page">
    <form method="post" enctype="multipart/form-data" class="form">
        <label class="form-label">Nik</label>   
        <select name="nik">
            <option>pilih..</option>
            <?php
            include("_connection.php");
              $query = mysqli_query($connect, "SELECT nik FROM master_kependudukan ORDER BY id DESC");
              while($data = mysqli_fetch_assoc($query)){
                  ?>
                    <option value="<?php echo $data['nik'] ?>"><?php echo $data['nik'] ?></option>
                  <?php
              } 
            ?>
        </select><br>
        <?php 
            $no = 0;
            include("_connection.php");
            $data = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) AS no_urut FROM data_pernikahan"));
            if($data["no_urut"] == 0){
                $no = 1;
            }else{
                $no = $data["no_urut"] + 1;
            }
            $kode_pernikahan = "PR-".date("Y/m/d")."-".$no."";
        ?>
        <label class="form-label">Tanggal Pernikahan</label>
        <input name ="tanggal_pernikahan" type="date">
        <label class="form-label">Status Di Keluarga</label>
        <select name="status">
            <option>pilih..</option>
            <option value="SUAMI">Suami</option>
            <option value="ISTERI">Isteri</option>
        </select><br>
        <label class="form-label">No Akta Nikah</label>
        <input name="no_akta_nikah" type="text"><br>
        <label class="form-label">Lampiran Keterangan Menikah</label>
        <input name="lampiran_buku_nikah" type="file"><br>
        <input type="submit" name="submit" value="Simpan Data" >
    </form>
</div>
<br>
<div class="col-md-12 page">
    <table id="table-penduduk" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Nik</th>
                <th>Nama</th>
                <th>Tanggal Pernikahan</th>
                <th>No Akta</th>
                <th>Alamat</th>
                <th>Pekerjaan</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Pendidikan</th>
                <th>Status di Keluarga</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            include("_connection.php");
            $query = mysqli_query($connect, "SELECT * FROM data_pernikahan AS dp
            LEFT JOIN master_kependudukan AS mk on mk.nik = dp.nik
            LEFT JOIN master_pekerjaan AS mpk on mpk.kd_pekerjaan = mk.kd_pekerjaan
            LEFT JOIN master_pendidikan AS mpd on mpd.kd_pendidikan = mk.kd_pendidikan 
            ") or die(mysqli_error($connect));
            $no = 1;
              while($data = mysqli_fetch_assoc($query)){
                  ?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data["nik"] ?></td>
                    <td><?php echo $data["nama"] ?></td>
                    <td><?php echo $data["tanggal_pernikahan"] ?></td>
                    <td><?php echo $data["no_akta_nikah"] ?></td>
                    <td><?php echo $data["alamat_domisili"] ?></td>
                    <td><?php echo $data["nama_pekerjaan"] ?></td>
                    <td><?php echo $data["jenis_kelamin"] == "L" ? "Laki-laki" : "Perempuan" ?></td>
                    <td><?php echo $data["agama"] ?></td>
                    <td><?php echo $data["nama_pendidikan"] ?></td>
                    <td><?php echo $data["status_keluarga"] ?></td>
                  <?php
              } 
            ?>
        </tbody>
    </table>
</div>
<?php 
    if(isset($_POST['submit'])){
        include("_connection.php");
        $nik = $_POST['nik'];
        $tanggal_pernikahan = $_POST['tanggal_pernikahan'];
        $status = $_POST['status'];
        $no_akta_nikah = $_POST['no_akta_nikah'];
        $lampiran_buku_nikah = $_FILES['lampiran_buku_nikah']['name'];

        // ambil data file
        $namaSementara = $_FILES['lampiran_buku_nikah']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        $dirUpload = "uploads/lampiran/";

        // pindahkan file
        $terupload = move_uploaded_file($namaSementara, $dirUpload.$lampiran_buku_nikah);

        if ($terupload) {
            echo "Upload berhasil!<br/>";
            echo "Link: <a href='".$dirUpload.$lampiran_buku_nikah."'>".$lampiran_buku_nikah."</a>";
        } else {
            echo "Upload Gagal!";
        }

        $query = "INSERT INTO data_pernikahan(nik, tanggal_pernikahan, no_akta_nikah, status_keluarga ,lampiran_buku_nikah)
        VALUES('$nik', '$tanggal_pernikahan', '$no_akta_nikah', '$status', '$lampiran_buku_nikah')";

        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    }
?>