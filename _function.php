<?php 
    function getPage($page){
        if(isset($_GET["page"])){
            if($page){
                include("src/pages/".$page."/".$page.".php");
            }else{
                include("src/pages/admin/admin.php");
            }
        }else{
            include("src/pages/admin/admin.php");
        }
    }
?>