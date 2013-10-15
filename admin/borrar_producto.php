<? 

//delete product

include('../includes/config.php');

if( isset( $_GET['id'] ) ) {
    $id=GetSQLValueString($_GET['id'],"int");    
    $consulta="delete from jcms_productos where id='".$id."'";    
    
    if(!$query = mysql_query($consulta)) { 
        die("Error de conexion a la base de datos.");    
    } else {
        mysql_query("delete from jcms_productos_imagenes where id_producto='".$id."'");
        header("Location: index.php?mensaje=borrar_producto_ok");
    }    
    exit(0);
}

?>
<html>
<head>
<title>Borrar producto</title>
<link rel="stylesheet" href="admin_style.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>

<div style="margin: 20px;">
    <h1>Borrar producto</h1>    
    <script type="text/javascript">
        function borrar_producto(id) {
            if( confirm("¿Seguro?") ) {
                window.location='borrar_producto.php?id='+id;
            }
        }
    </script>
    <? 
    
    if( isset( $_GET['id'] ) ) {        

    } else {
        $sub_level=0;        
        function buscar_hijos_rec($id_cat) {
            global $sub_level;    
            if( mysql_num_rows(mysql_query("select * from jcms_secciones where id_padre='".$id_cat."'"))>0 ) {
                $sub_level++;
                $sqlC="select * from jcms_secciones where id_padre='".$id_cat."' order by orden asc";
                $exC=mysql_query($sqlC);
                while( $rowC=mysql_fetch_object($exC) ) {            
                    $id=$rowC->id;
                    echo "<div style=\"padding-left:".($sub_level*10)."px; font-weight:bold;\">".$rowC->nombre."</div>";                    
                    if( mysql_num_rows(mysql_query("select * from jcms_productos where id_seccion='".$id."'"))>0 ) { 
                        $sqlP="select * from jcms_productos where id_seccion='".$id."' order by orden asc";
                        $exP=mysql_query($sqlP);
                        while( $rowP=mysql_fetch_object($exP) ) {
                            echo "<div style=\"padding-left:".(($sub_level+1)*10)."px; font-weight:normal;\">".$rowP->nombre." <a title=\"Borrar producto\" href=\"javascript:borrar_producto(".$rowP->id.");\"><img src=\"images/delete.png\"></a></div>";
                        }
                    }
                    buscar_hijos_rec($id);
                }        
            }
        }        
        $sql2="select * from jcms_secciones where id_padre=0 order by orden asc";
        $ex2=mysql_query($sql2);
        while( $row2=mysql_fetch_object($ex2) ) {
            $id=$row2->id;
            echo "<div style=\"padding-left:".($sub_level*10)."px; font-weight:bold;\">".$row2->nombre."</div>";
            if( mysql_num_rows(mysql_query("select * from jcms_productos where id_seccion='".$id."'"))>0 ) { 
                $sqlP="select * from jcms_productos where id_seccion='".$id."' order by orden asc";
                $exP=mysql_query($sqlP);
                while( $rowP=mysql_fetch_object($exP) ) {
                    echo "<div style=\"padding-left:".(($sub_level+1)*10)."px; font-weight:normal;\">".$rowP->nombre." <a title=\"Borrar producto\" href=\"javascript:borrar_producto(".$rowP->id.");\"><img src=\"images/delete.png\"></a></div>";
                }
            }            
            buscar_hijos_rec($id);
            $sub_level=0;
        }
        ?><div style="margin-top: 20px;"><input type="button" value="Volver" onclick="window.location='index.php'" /></div><?          
    }      
    
    ?>    
</div>    
</body>
</html>
