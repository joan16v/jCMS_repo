<? 

include('../includes/config.php');

if( isset($_POST['nombre']) ) {
    $nombre=GetSQLValueString($_POST['nombre'],"string");
    $contenido=GetSQLValueString($_POST['contenido'],"html");
    $nombre_en=GetSQLValueString($_POST['nombre_en'],"string");
    $contenido_en=GetSQLValueString($_POST['contenido_en'],"html");    
    $id_seccion=GetSQLValueString($_POST['id_seccion'],"int");    
    
    $consulta="insert into jcms_noticias (nombre,descripcion,nombre_en,descripcion_en,id_seccion) values ('".$nombre."','".$contenido."','".$nombre_en."','".$contenido_en."','".$id_seccion."')";    
    
    if(!$query = mysql_query($consulta)) { 
        die("Error de conexion a la base de datos.");    
    } else {
        $last_id=mysql_insert_id();
        $fichero = $_FILES["fichero"]["name"];
        $fichero_tmp = $_FILES["fichero"]["tmp_name"];
        if( $fichero!="" ) {
            $destino = "../images/noticias/" . limpiar_nombre_foto($fichero); //echo $destino;             
            if (move_uploaded_file($fichero_tmp, $destino)) {
                mysql_query("update jcms_noticias set imagen='".limpiar_nombre_foto($fichero)."' where id='".$last_id."'");
            }            
        }
        header("Location: index.php?mensaje=add_noticia_ok");
    }    
    exit(0);
}

?>
<html>
<head>
<title>A&ntilde;adir noticia</title>
<link rel="stylesheet" href="admin_style.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type='text/javascript' src='../js/jquery.min.js'></script>

<script type="text/javascript" src="./jwysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="./jwysiwyg/controls/wysiwyg.image.js"></script>
<script type="text/javascript" src="./jwysiwyg/controls/wysiwyg.link.js"></script>
<script type="text/javascript" src="./jwysiwyg/controls/wysiwyg.table.js"></script>
<link rel="stylesheet" href="./jwysiwyg/jquery.wysiwyg.css" type="text/css"/>
<link rel="stylesheet" href="./jwysiwyg/plugins/fileManager/wysiwyg.fileManager.css" type="text/css"/>
<script type="text/javascript" src="./jwysiwyg/plugins/wysiwyg.fileManager.js"></script> 

<script type="text/javascript">
    (function ($) {
    	$(document).ready(function () {
    		$('#contenido,#contenido_en').wysiwyg({
    			css: './editor.css',
				controls: {
				    html: { visible : true },
					"fileManager": {
						visible: true,
						groupIndex: 12,
						tooltip: "File Manager",
						exec: function () {
							$.wysiwyg.fileManager.init(function (file) {
								file ? alert(file) : alert("No file selected.");
							});
						}
					}
				}                
    		});
            $.wysiwyg.fileManager.setAjaxHandler("/admin/jwysiwyg/plugins/fileManager/handlers/PHP/file-manager.php");
    	});
    })(jQuery);
</script>

<script type="text/javascript">
    function check_add() {
        if( document.getElementById('nombre').value!="" ) {
            document.getElementById('formulario_add_sec').submit();
        } else {
            alert("Debes escribir un nombre.");
        }
    }
</script>
</head>
<body>
    <h1>Añadir noticia</h1>
    <form id="formulario_add_sec" action="" method="post" enctype="multipart/form-data">

	<div>T&iacute;tulo de la noticia <img src="images/es.png" /></div>
	<div><input name="nombre" id="nombre" type="text" style="width: 639px;" /></div>
    
	<div>Title <img src="images/en.png" /></div>
	<div><input name="nombre_en" id="nombre_en" type="text" style="width: 639px;" /></div>    
    
    <div style="margin-top: 20px;">Imagen de la noticia</div>
    <div style=" margin-bottom:20px;"><input name="fichero" type="file" style="width:200px;" /></div>
    
	<div style="margin-top: 10px;">Contenido <img src="images/es.png" /></div>
	<div><textarea name="contenido" id="contenido" style="width: 639px; height:400px;"></textarea></div>
    
	<div style="margin-top: 10px;">Description <img src="images/en.png" /></div>
	<div><textarea name="contenido_en" id="contenido_en" style="width: 639px; height:400px;"></textarea></div>    

    <div style="margin-top: 10px;">Ubicación</div>
    <div><select name="id_seccion" style="width: 300px;"><? 
        
        $sub_level=0;        
        function buscar_hijos_rec($id_cat) {
            global $sub_level;    
            if( mysql_num_rows(mysql_query("select * from jcms_secciones where id_padre='".$id_cat."'"))>0 ) {
                $sub_level++;
                $sqlC="select * from jcms_secciones where id_padre='".$id_cat."' order by orden asc";
                $exC=mysql_query($sqlC);
                while( $rowC=mysql_fetch_object($exC) ) {            
                    $id=$rowC->id;
                    ?><option value="<? echo $id; ?>"><? for($k=0;$k<($sub_level*3+3);$k++) echo "&nbsp;"; ?><? echo $rowC->nombre; ?></option><?
                    buscar_hijos_rec($id);
                }        
            }
        }        
        $sql2="select * from jcms_secciones where id_padre=0 order by orden asc";
        $ex2=mysql_query($sql2);
        while( $row2=mysql_fetch_object($ex2) ) {
            $id=$row2->id;
            ?><option value="<? echo $id; ?>"><? for($k=0;$k<($sub_level*3+3);$k++) echo "&nbsp;"; ?><? echo $row2->nombre; ?></option><?
            buscar_hijos_rec($id);
            $sub_level=0;
        }        
        
    ?></select></div> 
    <div style="margin-top: 10px;"><input type="button" onclick="check_add()" value="Guardar" /> <input type="button" value="Cancelar" onclick="window.location='index.php'" /></div>
    </form>
</body>
</html>