<?php

// jCMS
// created by Joan Gimenez Donat
// @joan16v
// joan16v@gmail.com

include('includes/config.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title><?php include('includes/title.php'); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php include('includes/meta.php'); ?>
        <base href="<?php echo BASE_HREF; ?>" />
        <script type='text/javascript' src='./js/jquery.min.js'></script>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700' rel='stylesheet' type='text/css' />
        <script type="text/javascript" src="./js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" href="./js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="./js/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
        <script src="./js/nivo-slider/jquery.nivo.slider.pack.js" type="text/javascript"></script>
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="shortcut icon" href="favicon.gif" />
    </head>

    <body>
        <div id="container">

            <div id="top">
                <div style="position: absolute; top:4px; left:27px;"><a title="jCMS" href="index.php"><img src="template/logo_jcms.jpg" /></a></div>

                <div id="menu_header">
                    <?php include('includes/links.php'); ?>
                    <?php

                        $contactar = "CONTACTAR";
                        if ($_SESSION["lang_session"] == "EN") {
                            $contactar = "CONTACT";
                        }

                    ?>
                    <?php echo "<div class=\"links_subnivel0\"><a href=\"index.php?seccion=contacto\">" . $contactar . "</a></div>"; ?>
                </div>
            </div>

            <div style="position:absolute; top:43px; right:13px;">
                <a href="index.php?lang=ES"><img src="template/esp.png" /></a> &nbsp; <a href="index.php?lang=EN"><img src="template/ing.png" /></a>
            </div>

            <script type="text/javascript">
                $(window).load(function() {
                    $('#slider').nivoSlider({
                        effect: 'slideInLeft',
                        slices: 15,
                        boxCols: 8,
                        boxRows: 4,
                        animSpeed: 500,
                        pauseTime: 3000,
                        startSlide: 0,
                        directionNav: false,
                        controlNav: true,
                        controlNavThumbs: false,
                        pauseOnHover: true,
                        manualAdvance: false,
                        prevText: '',
                        nextText: '',
                        randomStart: false,
                        beforeChange: function(){},
                        afterChange: function(){},
                        slideshowEnd: function(){},
                        lastSlide: function(){},
                        afterLoad: function(){}
                    });
                });
            </script>

            <style>
                .nivo-controlNav {
                    position:absolute;
                    bottom:0px;
                    right:20px;
                    z-index:1000;
                }
                .nivo-controlNav a {
                    display: block;
                    width: 16px;
                    height: 16px;
                    background: url(/template/Bullet-grey.png) no-repeat;
                    text-indent: -9999px;
                    border: 0;
                    margin-right: 3px;
                    float: left;
                }
                .nivo-controlNav a.active {
                    background: url(/template/Bullet-dark.png) no-repeat;
                }
            </style>

            <div style="position: absolute; top: 155px; left:0px; width:999px; height:233px; overflow: hidden;" class="slider-wrapper">
                <div id="slider" class="nivoSlider">
                    <img src="template/cab.jpg" alt="" />
                    <img src="template/cab2.jpg" alt="" />
                    <img src="template/cab3.jpg" alt="" />
                </div>
            </div>

            <div id="center">

                <div id="links">

                    <div class="box">
                        <?php

                            $nombre_box = "NOTICIAS";
                            if ($_SESSION["lang_session"] == "EN") {
                                $nombre_box = "NEWS";
                            }
                            echo $nombre_box;

                        ?>
                    </div>
                    <div style="margin-top: 0px; margin-left:20px; margin-bottom:20px;">
                        <?php include('includes/last_news.php'); ?>
                    </div>

                    <div class="box">
                        <?php

                            $nombre_box = "BUSCAR";
                            if ($_SESSION["lang_session"] == "EN") {
                                $nombre_box = "SEARCH";
                            }
                            echo $nombre_box;

                        ?>
                    </div>
                    <div style="margin-top: 20px; margin-left:20px;">
                        <?php include('includes/search.php'); ?>
                    </div>

                </div>

            <div id="content">
                <?php include('includes/content.php'); ?>
            </div>

        </div>
        <div style="clear: both;"><!-- separador --></div>

        </div>

        <div id="bottom"></div>

        <?php

        if (isset($_GET['contact'])) {
            if ($_GET['contact'] == "send") {
                $respuesta = "Se ha enviado tu consulta. En breve te daremos una respuesta.";
                if ($_SESSION["lang_session"] == "EN") {
                    $respuesta="Contact form sent.";
                }

                ?>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $.fancybox({
                            'hideOnContentClick': false,
                            'titleShow':false,
                            'content':'<div style="text-align:center; padding:20px; font-size:14px; color:#333;"><? echo $respuesta; ?></div>'
                        });
                    });
                </script>
                <?php
            }
            if ($_GET['contact'] == "error") {
                $respuesta = "Error enviando la consulta.";
                if ($_SESSION["lang_session"] == "EN") {
                    $respuesta = "Error sending contact form.";
                }
                ?>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $.fancybox({
                            'hideOnContentClick': false,
                            'titleShow':false,
                            'content':'<div style="text-align:center; padding:20px; font-size:14px; color:#333;"><? echo $respuesta; ?></div>'
                        });
                    });
                </script>
                <?php
            }
        }

        ?>
    </body>
</html>
