<?php

include('../includes/config.php');

if (isset($_GET['id'])) {
    $id = GetSQLValueString($_GET['id'], "int");
    $consulta = "delete from jcms_noticias where id='" . $id . "'";

    if (!$query = mysql_query($consulta)) {
        die("Error de conexion a la base de datos.");
    } else {
        header("Location: index.php?mensaje=borrar_noticia_ok");
    }
    exit(0);
}

?>
<html>
    <head>
        <title>Borrar noticia</title>
        <link rel="stylesheet" href="admin_style.css" type="text/css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <div style="margin: 20px;">
            <h1>Borrar noticia</h1>
            <script type="text/javascript">
                function borrar_noticia(id) {
                    if (confirm("¿Seguro?")) {
                        window.location = 'borrar_noticia.php?id=' + id;
                    }
                }
            </script>
            <?php

            if (isset($_GET['id'])) {
            } else {
                $sub_level = 0;
                function buscar_hijos_rec($id_cat) {
                    global $sub_level;
                    if (mysql_num_rows(mysql_query("select * from jcms_secciones where id_padre='" . $id_cat . "'")) > 0) {
                        $sub_level++;
                        $sqlC = "select * from jcms_secciones where id_padre='" . $id_cat . "' order by orden asc";
                        $exC = mysql_query($sqlC);
                        while ($rowC = mysql_fetch_object($exC)) {
                            $id = $rowC->id;
                            echo "<div style=\"padding-left:" . ($sub_level * 10) . "px; font-weight:bold;\">" . $rowC->nombre . "</div>";
                            if (mysql_num_rows(mysql_query("select * from jcms_noticias where id_seccion='" . $id . "'")) > 0) {
                                $sqlP = "select * from jcms_noticias where id_seccion='" . $id . "' order by fecha desc";
                                $exP = mysql_query($sqlP);
                                while ($rowP = mysql_fetch_object($exP)) {
                                    echo "<div style=\"padding-left:" . (($sub_level + 1) * 10) . "px; font-weight:normal;\">" . $rowP->nombre . " <a title=\"Borrar noticia\" href=\"javascript:borrar_noticia(" . $rowP->id . ");\"><img src=\"images/delete.png\"></a></div>";
                                }
                            }
                            buscar_hijos_rec($id);
                        }
                    }
                }
                $sql2 = "select * from jcms_secciones where id_padre=0 order by orden asc";
                $ex2 = mysql_query($sql2);
                while ($row2 = mysql_fetch_object($ex2)) {
                    $id = $row2->id;
                    echo "<div style=\"padding-left:" . ($sub_level * 10) . "px; font-weight:bold;\">" . $row2->nombre . "</div>";
                    if (mysql_num_rows(mysql_query("select * from jcms_noticias where id_seccion='" . $id . "'")) > 0) {
                        $sqlP = "select * from jcms_noticias where id_seccion='" . $id . "' order by fecha desc";
                        $exP = mysql_query($sqlP);
                        while ($rowP = mysql_fetch_object($exP)) {
                            echo "<div style=\"padding-left:" . (($sub_level + 1) * 10) . "px; font-weight:normal;\">" . $rowP->nombre . " <a title=\"Borrar noticia\" href=\"javascript:borrar_noticia(" . $rowP->id . ");\"><img src=\"images/delete.png\"></a></div>";
                        }
                    }
                    buscar_hijos_rec($id);
                    $sub_level = 0;
                }
                ?><div style="margin-top: 20px;"><input type="button" value="Volver" onclick="window.location='index.php'" /></div><?php
            }

            ?>
        </div>
    </body>
</html>
