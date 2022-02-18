<?php
  include("_connection.php");
  $searchTerm = $_GET['term']; 
  
  // Menampilkan Database
  $query = mysqli_query($connect, "SELECT * FROM master_kependudukan WHERE nik LIKE '%".$searchTerm."%' AND nik ASC"); 
    
  // Generate Array dengan data username
  $nikData = array(); 
  if(mysqli_num_rows($query) > 0){ 
      while($row = mysqli_fetch_assoc($query)){ 
          $data['nik'] = $row['nik']; 
          array_push($nikData, $data); 
      } 
  } 
    
  // Mengembalikan hasil sebagai array Json
  echo json_encode($nikData); 

?>