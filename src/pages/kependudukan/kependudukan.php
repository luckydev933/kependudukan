<p class="content-title">Data Kependudukan</p>
<div class="col-md-12 page">
    <form method="post" class="form">
        <label class="form-label">Nik</label>
        <input name="nik" type="text">

        <label class="form-label">Nama</label>
        <input name="nama" type="text">

        <label class="form-label">Alamat KTP</label>
        <input name="alamat_ktp" type="text">

        <label class="form-label">Pekerjaan</label>
        
        <select name="kd_pekerjaan">
            <option>pilih..</option>
            <?php 
              include("_connection.php");
              $query = mysqli_query($connect, "SELECT * FROM master_pekerjaan");
                while($data = mysqli_fetch_assoc($query)){
                    ?>
                      <option value="<?php echo $data['kd_pekerjaan'] ?>"><?php echo $data['nama_pekerjaan'] ?></option>
                    <?php
                } 
            ?>
        </select>
        <label class="form-label">Status Nikah</label>
        <select name="kd_status_nikah">
            <option>pilih..</option>
            <?php 
              include("_connection.php");
              $query = mysqli_query($connect, "SELECT * FROM master_status_nikah");
                while($data = mysqli_fetch_assoc($query)){
                    ?>
                      <option value="<?php echo $data['kd_status_nikah'] ?>"><?php echo $data['keterangan'] ?></option>
                    <?php
                } 
            ?>
        </select>
        <label class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin">
            <option>pilih..</option>
            <option value="L">L</option>
            <option value="P">P</option>
        </select>
        <label class="form-label">Agama</label>
        <select name="agama">
            <option>pilih..</option>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Katolik">Katolik</option>
            <option value="Hindu">Hindu</option>
            <option value="Buddha">Buddha</option>
            <option value="Kong-Hu-Chu">Kong-Hu-Chu</option>
        </select>
        <label class="form-label">Tanggal Lahir</label>
        <input name="tanggal_lahir" type="date">
        <label class="form-label">Pendidikan</label>
        <select name="kd_pendidikan">
            <option>pilih..</option>
            <?php 
              include("_connection.php");
              $query = mysqli_query($connect, "SELECT * FROM master_pendidikan ORDER BY kd_pendidikan ASC");
                while($data = mysqli_fetch_assoc($query)){
                    ?>
                      <option value="<?php echo $data['kd_pendidikan'] ?>"><?php echo $data['nama_pendidikan'] ?></option>
                    <?php
                } 
            ?>
        </select>
        <br>
        
        <label class="form-label">RT</label>
        <input name="rt" type="text">
        <label class="form-label">RW</label>
        <input name="rw" type="text">
        <label class="form-label">Alamat Domisili</label>
        <input name="alamat_domisili" type="text">
        <br><br>
        <input type="submit" name="submit" value="Simpan Data" >
    </form>
</div><hr>
<p class="content-title">List Kependudukan</p>
<div class="col-md-12 page">
    <table id="table-penduduk" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Nik</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Alamat KTP</th>
                <th>Pekerjaan</th>
                <th>Status Nikah</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Pendidikan</th>
                <th>RT</th>
                <th>RW</th>
                <th>Alamat Domisili</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            include("_connection.php");
            $query = mysqli_query($connect, "SELECT * FROM master_kependudukan as mk
                LEFT JOIN master_pekerjaan as mp ON mp.kd_pekerjaan = mk.kd_pekerjaan 
                LEFT JOIN master_pendidikan as mpd ON mpd.kd_pendidikan = mk.kd_pendidikan
                LEFT JOIN master_status_nikah as mpn ON mpn.kd_status_nikah = mk.kd_status_nikah
            ") or die(mysqli_error($connect));
            $no = 1;
              while($data = mysqli_fetch_assoc($query)){
                  ?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data["nik"] ?></td>
                    <td><?php echo $data["nama"] ?></td>
                    <td><?php echo $data["tanggal_lahir"] ?></td>
                    <td><?php echo $data["alamat_ktp"] ?></td>
                    <td><?php echo $data["nama_pekerjaan"] ?></td>
                    <td><?php echo $data["keterangan"] ?></td>
                    <td><?php echo $data["jenis_kelamin"] == "L" ? "Laki-laki" : "Perempuan" ?></td>
                    <td><?php echo $data["agama"] ?></td>
                    <td><?php echo $data["nama_pendidikan"] ?></td>
                    <td><?php echo $data["rt"] ?></td>
                    <td><?php echo $data["rw"] ?></td>
                    <td><?php echo $data["alamat_domisili"] ?></td>
                  <?php
              } 
            ?>
        </tbody>
    </table>
</div>
<?php
    include("_connection.php");
    if(isset($_POST["submit"])){
        $nik = $_POST["nik"];
        $nama = $_POST["nama"];
        $alamat_ktp = $_POST["alamat_ktp"];
        $kd_pekerjaan = $_POST["kd_pekerjaan"];
        $kd_status_nikah = $_POST["kd_status_nikah"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $agama = $_POST["agama"];
        $kd_pendidikan = $_POST["kd_pendidikan"];
        $rt = $_POST["rt"];
        $rw = $_POST["rw"];
        $alamat_domisili = $_POST["alamat_domisili"];
        $tanggal_lahir = $_POST["tanggal_lahir"];

        $query = mysqli_query($connect, "INSERT INTO master_kependudukan(nik, nama, alamat_ktp, kd_pekerjaan, 
        kd_status_nikah, jenis_kelamin, agama, kd_pendidikan, rt, rw, alamat_domisili, tanggal_lahir)
         VALUES('$nik','$nama',
        '$alamat_ktp','$kd_pekerjaan','$kd_status_nikah',
        '$jenis_kelamin','$agama', '$kd_pendidikan',
        '$rt','$rw','$alamat_domisili','$tanggal_lahir')") or die(mysqli_error($connect));
    }
?>