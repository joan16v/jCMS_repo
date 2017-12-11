<?php

if (mysql_num_rows(mysql_query("select * from jcms_noticias")) > 0) {
    ?><div style="clear: both;"><!-- separador --></div><?php
    $sqlP = "select * from jcms_noticias order by fecha desc limit 3";
    $exP = mysql_query($sqlP);
    while ($rowP = mysql_fetch_object($exP)) {
        $nombre_noticia = $rowP->nombre;
        if ($_SESSION["lang_session"] == "EN") {
            $nombre_noticia = $rowP->nombre_en;
        }

        $desc_noticia = $rowP->descripcion;
        if ($_SESSION["lang_session"] == "EN") {
            $desc_noticia = $rowP->descripcion_en;
        }

        ?><div class="contentNoticia">
            <?php if ($rowP->imagen != "") { ?>
                <div class="imagenNoticia">
                    <a href="index.php?id_not=<?php echo $rowP->id; ?>&desc=<?php echo url_clean($nombre_noticia); ?>"><img src="thumbGal.php?foto=images/noticias/<?php echo $rowP->imagen; ?>" /></a>
                </div>
                <?php
            } ?>
            <div class="tituloNoticia">
                <a href="index.php?id_not=<?php echo $rowP->id; ?>&desc=<?php echo url_clean($nombre_noticia); ?>"><?php echo $nombre_noticia; ?></a>
            </div>
            <div class="fechaNoticia">
                <?php $fechaNot = strtotime($rowP->fecha); echo date("d/m/Y", $fechaNot); ?>
            </div>
            <div class="resumenNoticia">
                <?php if (strlen($desc_noticia) > 100) {
                    echo substr(strip_tags($desc_noticia), 0, 97) . "...";
                } else {
                    echo strip_tags($desc_noticia);
                } ?> <a href="index.php?id_not=<?php echo $rowP->id; ?>&desc=<?php echo url_clean($nombre_noticia); ?>">[+]</a>
            </div>
        </div>
        <div style="clear: both;"><!-- sep --></div><?php
    }

    $ver_todas = "Ver todas";
    if ($_SESSION["lang_session"] == "EN") {
        $ver_todas = "View all";
    }

    ?><div style="text-align: center; margin-top:20px;">[ <a href="index.php?id=4&desc=noticias"><?php echo $ver_todas; ?></a> ]</div><?php
}
