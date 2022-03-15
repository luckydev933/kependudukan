<html>
<head>
         <meta charset="utf-8"/>
         <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
         <meta name="google" value="notranslate"/>
         <title>Rekap Data</title>
         <link rel="stylesheet" type="text/css" href="style.css">
         <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->

      </head>
    <body>
    <center>
    <div class="header" style="line-height: 0.25; letter-spacing:2; margin-top: 10">
        <div>
            <img style="width:5%; float:left" src="../../../images/logo-tala.png" alt="" srcset="">
        </div>
        <p class="header-title" style="font-size: 15px;"><strong>PEMERINTAH KABUPATEN TANAH LAUT</strong></p>
        <P style="font-size: 15px;"><strong>DESA TAJAU PECAH</strong></P>
        <P style="font-size: 15px;"><strong>KECAMATAN BATU AMPAR</strong></P>
        <p style="font-size: 10px;">Alamat: Jl. Merpati RT.005 Dusun II Kode Pos 70882</p>
    </div>
    <hr style="border: 1px solid black">
    </center>
    <?php 
    if(isset($_GET['kategori'])){
        $kategori = $_GET['kategori'];
        $dari = $_GET['dari'];
        $hingga = $_GET['hingga'];

        if($kategori == "kependudukan"){
            ?>
            <center>
                <h3 style="font-size: 15px; letter-spacing:2;">DATA KEPENDUDUKAN PERIODE <?php echo $dari ?> s/d <?php echo $hingga ?> DESA TAJAU PECAH<h3>
            </center>
                
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
                include("../../../_connection.php");
                $query = mysqli_query($connect, "SELECT * FROM master_kependudukan as mk
                    LEFT JOIN master_pekerjaan as mp ON mp.kd_pekerjaan = mk.kd_pekerjaan 
                    LEFT JOIN master_pendidikan as mpd ON mpd.kd_pendidikan = mk.kd_pendidikan
                    LEFT JOIN master_status_nikah as mpn ON mpn.kd_status_nikah = mk.kd_status_nikah
                    WHERE mk.created_time BETWEEN '$dari' AND '$hingga'
                ") or die(mysqli_error($connect));
                $no = 1;
                while($data = mysqli_fetch_assoc($query)){
                    ?>
                    <tr>
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
                </tr>  
                    <?php
                } 
                ?>
            </tbody>
        </table>
        <?php
        }
        if($kategori == "pernikahan"){
            ?>
            <h3>Data Pernikahan Periode <?php echo $dari ?> s/d <?php echo $hingga ?> Desa Tajau Pecah<h3>
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
                    include("../../../_connection.php");
                    $query = mysqli_query($connect, "SELECT * FROM data_pernikahan AS dp
                    LEFT JOIN master_kependudukan AS mk on mk.nik = dp.nik
                    LEFT JOIN master_pekerjaan AS mpk on mpk.kd_pekerjaan = mk.kd_pekerjaan
                    LEFT JOIN master_pendidikan AS mpd on mpd.kd_pendidikan = mk.kd_pendidikan 
                    WHERE dp.created_time BETWEEN '$dari' AND '$hingga'
                    ") or die(mysqli_error($connect));
                    $no = 1;
                    while($data = mysqli_fetch_assoc($query)){
                        ?>
                        <tr>
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
                            <td><?php echo $data["status_keluarga"] == "S" ? "SUAMI" : "ISTERI"?></td>
                        </tr>
                        <?php
                    } 
                    ?>
                </tbody>
            </table>
            <?php   
           
        }
        if($kategori == "keluarga"){
            ?>
            <h3>Data Keluarga Periode <?php echo $dari ?> s/d <?php echo $hingga ?> Desa Tajau Pecah<h3>
            <table id="table-penduduk" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nik</th>
                        <th>No KK</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Pekerjaan</th>
                        <th>Jenis Kelamin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    include("../../../_connection.php");
                    $query = mysqli_query($connect, "SELECT dk.nik, mk.nama, mk.alamat_domisili, 
                    mk.jenis_kelamin, mp.nama_pekerjaan, dk.kd_keluarga, dk.lampiran_kk
                    FROM data_keluarga dk
                    LEFT JOIN master_kependudukan mk on mk.nik = dk.nik
                    LEFT JOIN master_pekerjaan mp on mp.kd_pekerjaan = mk.kd_pekerjaan
                    WHERE dk.created_time BETWEEN '$dari' AND '$hingga'
                    ") or die(mysqli_error($connect));
                    $no = 1;
                    while($data = mysqli_fetch_assoc($query)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $data["nik"] ?></td>
                            <td><?php echo $data["kd_keluarga"] ?></td>
                            <td><?php echo $data["nama"] ?></td>
                            <td><?php echo $data["alamat_domisili"] ?></td>
                            <td><?php echo $data["nama_pekerjaan"] ?></td>
                            <td><?php echo $data["jenis_kelamin"] == "L" ? "Laki-laki" : "Perempuan" ?></td>
                        </tr>
                        <?php
                    } 
                    ?>
                </tbody>
            </table>
            <?php
        }
        if($kategori == "kelahiran"){
            ?>
                <table id="table-penduduk" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kelahiran</th>
                            <th>Tanggal Lahir</th>
                            <th>Berat Lahir</th>
                            <th>Ayah</th>
                            <th>Ibu</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include("../../../_connection.php");
                        $query = mysqli_query($connect, "SELECT * FROM data_kelahiran
                        WHERE created_time BETWEEN '$dari' AND '$hingga'
                        ") or die(mysqli_error($connect));
                        $no = 1;
                        while($data = mysqli_fetch_assoc($query)){
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data["kd_kelahiran"] ?></td>
                                <td><?php echo $data["tanggal_lahir"] ?></td>
                                <td><?php echo $data["berat_lahir"] ?></td>
                                <td><?php echo $data["nik_ayah"] ?></td>
                                <td><?php echo $data["nik_ibu"] ?></td>
                                <td><?php echo $data["jenis_kelamin"] == "L" ? "Laki-laki" : "Perempuan" ?></td>
                        </tr>
                            <?php
                        } 
                        ?>
                    </tbody>
                </table>
            <?php
        }
        if($kategori == "statistik"){
            include("../../../_connection.php");
            $jumlah_penduduk = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) AS jumlah FROM master_kependudukan WHERE created_time BETWEEN '$dari' AND '$hingga'"));
            $jumlah_pernikahan = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) AS jumlah FROM data_pernikahan WHERE created_time BETWEEN '$dari' AND '$hingga'"));
            $jumlah_keluarga = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) AS jumlah FROM data_keluarga WHERE created_time BETWEEN '$dari' AND '$hingga' GROUP BY kd_keluarga"));
            $jumlah_kelahiran = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) AS jumlah FROM data_kelahiran WHERE created_time BETWEEN '$dari' AND '$hingga'"));
            ?>
                <h3>Statistik Pencatatan Kependudukan Periode <?php echo $dari ?> s/d <?php echo $hingga ?> Desa Tajau Pecah</h3>
                <div style="width: 40%; border: 1px solid black; padding: 15px 15px">
                <strong>Jumlah Penduduk</strong>
                <p style="margin-left:20"><?php echo $jumlah_penduduk["jumlah"] ?></p>
                <strong>Jumlah Pernikahan</strong>
                <p style="margin-left:20"><?php echo $jumlah_pernikahan["jumlah"] ?></p>
                <strong>Jumlah Keluarga</strong>
                <p style="margin-left:20"><?php echo $jumlah_keluarga["jumlah"] ?></p>
                <strong>Jumlah kelahiran</strong>
                <p style="margin-left:20"><?php echo $jumlah_kelahiran["jumlah"] ?></p>
                </div>
            <?php
        }
    }

    ?>
    <br>
    <div style="float:right">
        <p>Pltk. Kepala Desa Tajau Pecah</p><br><br><br>
        <center><p style="font-size: 15px; letter-spacing: 2"><strong>AGUS STYAWATI</strong></P></center>
    </div>
    <div style="float:bottom">
        <p style="font-size: 8px">dicetak pada tanggal : <?php echo date('d/m/y') ?></p>
    </div>
    </body>
    <script>
        var css = '@page { size: landscape; }',
        head = document.head || document.getElementsByTagName('head')[0],
        style = document.createElement('style');

        style.type = 'text/css';
        style.media = 'print';

        if (style.styleSheet){
        style.styleSheet.cssText = css;
        } else {
        style.appendChild(document.createTextNode(css));
        }

        head.appendChild(style);

        window.print();
    </script>
</html>