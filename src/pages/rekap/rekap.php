<p class="content-title">Rekap Data </p>
<div class="row">
<div class="col-md-6 page">
    <form method="get" action="src/pages/rekap/cetak.php" enctype="multipart/form-data" class="form">
        <label class="form-label">Kategori Data</label>   
        <select id="kategori" name="kategori">
            <option>pilih..</option>
            <option value="kependudukan">Kependudukan</option>
            <option value="pernikahan">Pernikahan</option>
            <option value="keluarga">Keluarga</option>
            <option value="kelahiran">Kelahiran</option>
            <option value="statistik">Statistik kependudukan</option>
        </select><br>
        <div id="viewbox">
            
        </div>
        <!-- <input hidden id="edit_data" type="submit" name="edit" value="Simpan Perubahan" > -->
    </form>
</div>

<script type="text/javascript">
    const kategori = document.getElementById('kategori')
    kategori.addEventListener('change', function(){
        var html = `
            <label class="form-label">Periode (Dari)</label>
            <input type="date" id="dari" name="dari">
            <label class="form-label">Periode (Hingga)</label>
            <input type="date" id="hingga" name="hingga"><br>
            <input id="simpan_data" type="submit" name="submit" value="Submit" >
        `
        document.getElementById("viewbox").innerHTML = html
    })
</script>