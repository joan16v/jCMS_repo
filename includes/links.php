<? 

$sub_level=0;

function buscar_hijos_rec($id_cat) {
    global $sub_level;    
    if( mysql_num_rows(mysql_query("select * from jcms_secciones where id_padre='".$id_cat."'"))>0 ) {
        $sub_level++;
        $sqlC="select * from jcms_secciones where id_padre='".$id_cat."' order by orden asc";
        $exC=mysql_query($sqlC);
        while( $rowC=mysql_fetch_object($exC) ) {           
            
            $id=$rowC->id;
            $nombre_sec=$rowC->nombre;
            if( $_SESSION["lang_session"]=="EN" ) $nombre_sec=$rowC->nombre_en;            
            
            $display="";
            if($sub_level>0) $display="style=\"display:none;\"";
            if( isset($_GET['id']) && ($_GET['id']==$id_cat || $_GET['id']==$id || $rowC->id_padre==id_padre($_GET['id'])) ) $display="";
            
            echo "<div class=\"links_subnivel".$sub_level."\" ".$display."><a href=\"index.php?id=".$id."&desc=".url_clean($nombre_sec)."\">".strtoupper($nombre_sec)."</a></div>";
            buscar_hijos_rec($id);
        }        
    }
}

function id_padre($id) {
    return mysql_result(mysql_query("select id_padre from jcms_secciones where id='".$id."'"),0,"id_padre");
}

$sql2="select * from jcms_secciones where id_padre=0 order by orden asc";
$ex2=mysql_query($sql2);
while( $row2=mysql_fetch_object($ex2) ) {
    
    $id=$row2->id;
    $nombre_sec=($row2->nombre);
    if( $_SESSION["lang_session"]=="EN" ) $nombre_sec=$row2->nombre_en;
    
    //$display="";
    //if($id==4) $display="style=\"display:none;\"";    
    
    echo "<div class=\"links_subnivel".$sub_level."\" ".$display."><a href=\"index.php?id=".$id."&desc=".url_clean($nombre_sec)."\">".strtoupper($nombre_sec)."</a></div>";
    buscar_hijos_rec($id);
    $sub_level=0;
}

?>