<p class="content-title">Data Kependudukan</p>
<div class="col-md-12 page">
    <form method="post" class="form">
        <label class="form-label">Nik</label>
        <input id="nik" name="nik" type="text">

        <label class="form-label">Nama</label>
        <input name="nama" type="text" id="nama">

        <label class="form-label">Alamat KTP</label>
        <input name="alamat_ktp" type="text" id="alamat_ktp">

        <label class="form-label">Pekerjaan</label>
        
        <select id="kd_pekerjaan" name="kd_pekerjaan">
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
        <select id="kd_status_nikah" name="kd_status_nikah">
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
        <select id="jenis_kelamin" name="jenis_kelamin">
            <option>pilih..</option>
            <option value="L">L</option>
            <option value="P">P</option>
        </select>
        <label class="form-label">Agama</label>
        <select id="agama" name="agama">
            <option>pilih..</option>
            <option value="Islam">Islam</option>
            <option value="Kristen">Kristen</option>
            <option value="Katolik">Katolik</option>
            <option value="Hindu">Hindu</option>
            <option value="Buddha">Buddha</option>
            <option value="Kong-Hu-Chu">Kong-Hu-Chu</option>
        </select>
        <label class="form-label">Tanggal Lahir</label>
        <input id="tanggal_lahir" name="tanggal_lahir" type="date">
        <label class="form-label">Pendidikan</label>
        <select id="kd_pendidikan" name="kd_pendidikan">
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
        <input id="rt" name="rt" type="text">
        <label class="form-label">RW</label>
        <input id="rw" name="rw" type="text">
        <label class="form-label">Alamat Domisili</label>
        <input id="alamat_domisili" name="alamat_domisili" type="text">
        <br><br>
        <input id="simpan_data" type="submit" name="submit" value="Simpan Data" >
        <input hidden id="edit_data" type="submit" name="edit" value="Simpan Perubahan" >
    </form>
</div><hr>
<p class="content-title">List Kependudukan</p>
<div class="col-md-12 page">
    <table id="table-penduduk" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th></th>
                <th></th>
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
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><input onclick="EditData('<?php echo $data['nik'] ?>')" type="button" value="Edit"></td>
                    <td><a href= "process/kependudukan/hapus.php?nik=<?php echo $data['nik'] ?>&module=kependudukan" type="button">Delete</a></td>
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
              </tr>  
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
    if(isset($_POST["edit"])){
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

        $query = mysqli_query($connect, "UPDATE master_kependudukan
            SET nama='$nama', alamat_ktp='$alamat_ktp', kd_pekerjaan='$kd_pekerjaan',
            kd_status_nikah='$kd_status_nikah', jenis_kelamin='$jenis_kelamin', agama='$agama',
            kd_pendidikan='$kd_pendidikan', rt='$rt', rw='$rw', alamat_domisili='$alamat_domisili',
            tanggal_lahir='$tanggal_lahir' WHERE nik='$nik'
        ")or die(mysqli_error($connect));
    }
?>

<script>
    function EditData(value){
        $.get("process/kependudukan/editdata.php?nik="+value+"&module=kependudukan", (data, status) => {
            document.getElementById("edit_data").removeAttribute("hidden")
            let object = JSON.parse(data)
            document.getElementById("nik").focus()
            document.getElementById("nik").setAttribute("readonly", true)
            document.getElementById("nik").value = object.nik
            document.getElementById("nama").value = object.nama
            document.getElementById("alamat_ktp").value = object.alamat_ktp
            document.getElementById("kd_pekerjaan").value = object.kd_pekerjaan
            document.getElementById("kd_status_nikah").value = object.kd_status_nikah
            document.getElementById("jenis_kelamin").value = object.jenis_kelamin
            document.getElementById("agama").value = object.agama
            document.getElementById("tanggal_lahir").value = object.tanggal_lahir
            document.getElementById("kd_pendidikan").value = object.kd_pendidikan
            document.getElementById("rt").value = object.rt
            document.getElementById("rw").value = object.rw
            document.getElementById("alamat_domisili").value = object.alamat_domisili
            document.getElementById("simpan_data").disabled = true
        })
    }
</script>