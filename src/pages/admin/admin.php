<p class="content-title">Data Statistik Kependudukan</p>
<div class="row">
<div class="col-md-2 page">
    Welcome,
    Admin
</div>
<div class="col-md-10 page">
    <div class="row">
        <div class="col-md-6">
            <div id="myChart" style="max-width:100%; height:400px;"></div>
        </div>
        <div class="col-md-6">
            <div id="gender" style="max-width:100%; height:400px"></div>
        </div>
    </div>
</div>

<script>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
var data = google.visualization.arrayToDataTable([
  ['Statistik Kependudukan', 'Jumlah'],
  ['Kelahiran',54.8],
  ['Pernikahan',48.6],
  ['Keluarga',44.4],
]);

var data_gender = google.visualization.arrayToDataTable([
  ['', 'Jumlah'],
  ['Laki-laki',54.8],
  ['Perempuan',48.6],
]);

var options = {
  title:'Statistik Kependudukan',
  is3D:true
};

var options_gender = {
  title:'Jumlah Penduduk Berdasarkan Gender',
  is3D:true
};

var chart = new google.visualization.PieChart(document.getElementById('myChart'));
var gender = new google.visualization.PieChart(document.getElementById('gender'));
chart.draw(data, options);
gender.draw(data_gender, options_gender);
}
// var chart_gender = new google.visualization.PieChart(document.getElementById('gender'));
//   chart.draw(data_gender, options_gender);
// }
</script>