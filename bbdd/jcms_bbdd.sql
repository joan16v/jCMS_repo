-- 
-- BBDD of jCMS
-- 
-- Import to your database server
-- 

-- 
-- `jcms_noticias`
-- 

CREATE TABLE `jcms_noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` longtext COLLATE latin1_spanish_ci NOT NULL,
  `nombre_en` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion_en` longtext COLLATE latin1_spanish_ci NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=5 ;

INSERT INTO `jcms_noticias` VALUES (4, 'Nuevo CMS: jCMS', '<div>Un sistema de gestión de contenidos (o CMS, del inglés Content Management System) es un programa que permite crear una estructura de soporte (framework) para la creación y administración de contenidos, principalmente en páginas web, por parte de los administradores, editores, participantes y demás roles.</div><div><br></div><div>Consiste en una interfaz que controla una o varias bases de datos donde se aloja el contenido del sitio web. El sistema permite manejar de manera independiente el contenido y el diseño. Así, es posible manejar el contenido y darle en cualquier momento un diseño distinto al sitio web sin tener que darle formato al contenido de nuevo, además de permitir la fácil y controlada publicación en el sitio a varios editores. Un ejemplo clásico es el de editores que cargan el contenido al sistema y otro de nivel superior (moderador o administrador) que permite que estos contenidos sean visibles a todo el público (los aprueba).</div><div><br></div><div>El gestor de contenido es una aplicación informática usada para crear, editar, gestionar y publicar contenido digital multimedia en diversos formatos. El gestor de contenidos genera páginas web dinámicas interactuando con el servidor web para generar la página web bajo petición del usuario, con el formato predefinido y el contenido extraído de la base de datos del servidor.</div><div><br></div><div>Esto permite gestionar, bajo un formato estandarizado, la información del servidor, reduciendo el tamaño de las páginas para descarga y reduciendo el coste de gestión del portal con respecto a un sitio web estático, en el que cada cambio de diseño debe ser realizado en todas las páginas web, de la misma forma que cada vez que se agrega contenido tiene que maquetarse una nueva página HTML y subirla al servidor web.</div><div><br></div><div>Entendido como un sistema de soporte a la gestión de contenidos; ya que, en realidad, son las estrategias de comunicación las que realmente llevan a gestionar contenidos y publicidad de forma efectiva; los sistemas informáticos pueden a lo sumo proporcionar las herramientas necesarias para la publicación en línea, o bien incluir servicios de soporte a la toma de decisiones por lo que a la gestión de contenidos se refiere.</div><div>El gestor de contenidos se aplica generalmente para referirse a sistemas de publicación, pudiendo subestimarse las funcionalidades de soporte y mantenimiento, en detrimento de las funcionalidades relacionadas con la optimización de los tiempos de publicación. La correcta implantación del sistema, con arreglo a las necesidades del cliente es necesaria, y es necesario entender el proyecto de un portal web en el seno de un proyecto de comunicación estructurado y bien planteado.</div><div><br></div><div>La elección de la plataforma correcta será vital para alcanzar los objetivos del cliente, ya que exentan particularidades diferenciales tanto en su adaptabilidad a esquemas gráficos como la posible integrabilidad de funcionalidades y extensiones adicionales.</div><div><br></div><div>El posicionamiento en buscadores está relacionado con el volumen de contenidos de un portal y con la forma en la que éste se presenta. Es importante tener eso en cuenta para la estructura del portal para garantizar un correcto posicionamiento orgánico.</div>', 'New CMS: jCMS', '<div>A Content Management System (CMS)[1][2][3] is a computer program that allows publishing, editing and modifying content as well as maintenance from a central interface. Such systems of content management provide procedures to manage workflow in a collaborative environment.[4] These procedures can be manual steps or an automated cascade. CMSs have been available since the late 1990s.</div><div><br></div><div>CMSs are often used to run websites containing blogs, news, and shopping. Many corporate and marketing websites use CMSs. CMSs typically aim to avoid the need for hand coding, but may support it for specific elements or entire pages.</div><div><br></div><div>The core function and use of content management systems is to present information on websites. CMS features vary widely from system to system. Simple systems showcase a handful of features, while other releases, notably enterprise systems, offer more complex and powerful functions. Most CMS include Web-based publishing, format management, revision control (version control), indexing, search, and retrieval. The CMS increments the version number when new updates are added to an already-existing file. A CMS may serve as a central repository containing documents, movies, pictures, phone numbers, scientific data. CMSs can be used for storing, controlling, revising, semantically enriching and publishing documentation.</div><div><br></div><div>A web content management system[5] (web CMS) is a bundled or stand-alone application to create, manage, store and deploy content on Web pages. Web content includes text and embedded graphics, photos, video, audio, and code (e.g., for applications) that displays content or interacts with the user. A web CMS may catalog and index content, select or assemble content at runtime, or deliver content to specific visitors in a requested way, such as other languages. Web CMSs usually allow client control over HTML-based content, files, documents, and web hosting plans based on the system depth and the niche it serves.</div><div><br></div><div>An enterprise content management system[1] (ECM)[6] organizes documents, contacts and records related to the processes of a commercial organization. It structures the enterprise''s information content and file formats, manages locations, streamlines access by eliminating bottlenecks and optimizes security and integrity.</div><div>Distinguishing between the basic concepts of user and content, the content management system (CMS) has two elements:</div><div><br></div><div>Content management application (CMA) is the front-end user interface that allows a user, even with limited expertise, to add, modify and remove content from a Web site without the intervention of a Webmaster.</div><div>Content delivery application (CDA) compiles that information and updates the Web site.</div>', 4, '2012-11-28 08:03:47');

-- --------------------------------------------------------

-- 
-- `jcms_productos`
-- 

CREATE TABLE `jcms_productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` longtext COLLATE latin1_spanish_ci NOT NULL,
  `nombre_en` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `descripcion_en` longtext COLLATE latin1_spanish_ci NOT NULL,
  `precio` float NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `orden` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=33 ;

INSERT INTO `jcms_productos` VALUES (29, 'Specialized Fate', '<p>Nuevo modelo para mujeres con cuadro rígido en fibra de carbono y rueda 29 pulgadas destinado a la competición o a rutas en las que se busque el rendimiento. La relación ligereza/rigidez es sensacional, con una manejabilidad ideal para afrontar curvas y cambios de desnivel a toda velocidad.<br></p>', 'Specialized Fate', 'New model for women with rigid frame and carbon fiber wheel 29 inches for the competition or routes where performance is sought. The relative lightness / stiffness is sensational, with a face ideal for handling curves and elevation changes at full speed.', 995, 26, 0);
INSERT INTO `jcms_productos` VALUES (30, 'PHP', '<div>PHP es un lenguaje de programación de uso general de código del lado del servidor originalmente diseñado para el desarrollo web de contenido dinámico. Fue uno de los primeros lenguajes de programación del lado del servidor que se podían incorporar directamente en el documento HTML en lugar de llamar a un archivo externo que procese los datos. El código es interpretado por un servidor web con un módulo de procesador de PHP que genera la página Web resultante. PHP ha evolucionado por lo que ahora incluye también una interfaz de línea de comandos que puede ser usada en aplicaciones gráficas independientes. PHP puede ser usado en la mayoría de los servidores web al igual que en casi todos los sistemas operativos y plataformas sin ningún costo.<br></div><div><div><br></div><div>PHP fue creado originalmente por Rasmus Lerdorf en 1995. Actualmente el lenguaje sigue siendo desarrollado con nuevas funciones por el grupo PHP.2 Este lenguaje forma parte del software libre publicado bajo la licencia PHP que es incompatible con la Licencia Pública General de GNU debido a las restricciones del uso del término PHP.</div></div><p></p>', 'PHP', '<div><br>PHP is a server-side scripting language designed for web development but also used as a general-purpose programming language. PHP is now installed on more than 244 million websites and 2.1 million web servers.[2] Originally created by Rasmus Lerdorf in 1995, the reference implementation of PHP is now produced by The PHP Group.[3] While PHP originally stood for Personal Home Page,[4] it now stands for PHP: Hypertext Preprocessor, a recursive acronym.</div><div><br></div><div>PHP code is interpreted by a web server with a PHP processor module, which generates the resulting web page: PHP commands can be embedded directly into an HTML source document rather than calling an external file to process data. It has also evolved to include a command-line interface capability and can be used in standalone graphical applications.</div><div><br></div><div>PHP is free software released under the PHP License, which is incompatible with the GNU General Public License (GPL) due to restrictions on the usage of the term PHP.[7] PHP can be deployed on most web servers and also as a standalone shell on almost every operating system and platform, free of charge.</div></div><p></p>', 0, 27, 0);
INSERT INTO `jcms_productos` VALUES (31, 'MySQL', '<div>MySQL es un sistema de gestión de bases de datos relacional, multihilo y multiusuario con más de seis millones de instalaciones.1 MySQL AB —desde enero de 2008 una subsidiaria de Sun Microsystems y ésta a su vez de Oracle Corporation desde abril de 2009— desarrolla MySQL como software libre en un esquema de licenciamiento dual.</div><div>Por un lado se ofrece bajo la GNU GPL para cualquier uso compatible con esta licencia, pero para aquellas empresas que quieran incorporarlo en productos privativos deben comprar a la empresa una licencia específica que les permita este uso. Está desarrollado en su mayor parte en ANSI C.</div><div><br></div><div>Al contrario de proyectos como Apache, donde el software es desarrollado por una comunidad pública y los derechos de autor del código están en poder del autor individual, MySQL es patrocinado por una empresa privada, que posee el copyright de la mayor parte del código. Esto es lo que posibilita el esquema de licenciamiento anteriormente mencionado. Además de la venta de licencias privativas, la compañía ofrece soporte y servicios. Para sus operaciones contratan trabajadores alrededor del mundo que colaboran vía Internet. MySQL AB fue fundado por David Axmark, Allan Larsson y Michael Widenius.</div><div><br></div><div>MySQL es usado por muchos sitios web grandes y populares, como Wikipedia,2 Google3 4 (aunque no para búsquedas), Facebook,5 6 7 Twitter,8 Flickr,9 y YouTube.</div>', 'MySQL', '<div>MySQL (/ma? ??skju???l/ "My S-Q-L",[3] officially, but also called /ma? ?si?kw?l/ "My Sequel") is (as of July 2013) the world''s most widely used[4][5] open-source relational database management system (RDBMS)[6] that runs as a server providing multi-user access to a number of databases, though SQLite probably has more total embedded deployments.[7] It is named after co-founder Michael Widenius''s daughter, My.[8] The SQL phrase stands for Structured Query Language.</div><div><br></div><div>The MySQL development project has made its source code available under the terms of the GNU General Public License, as well as under a variety of proprietary agreements. MySQL was owned and sponsored by a single for-profit firm, the Swedish company MySQL AB, now owned by Oracle Corporation.</div><div><br></div><div>MySQL is a popular choice of database for use in web applications, and is a central component of the widely used LAMP open source web application software stack (and other ''AMP'' stacks). LAMP is an acronym for "Linux, Apache, MySQL, Perl/PHP/Python." Free-software-open source projects that require a full-featured database management system often use MySQL.</div><div><br></div><div>For commercial use, several paid editions are available, and offer additional functionality. Applications which use MySQL databases include: TYPO3, MODx, Joomla, WordPress, phpBB, MyBB, Drupal and other software. MySQL is also used in many high-profile, large-scale websites, including Wikipedia,[10] Google[11][12] (though not for searches), Facebook,[13][14][15] Twitter,[16] Flickr,[17] and YouTube.</div>', 0, 27, 0);
INSERT INTO `jcms_productos` VALUES (32, 'jQuery', '<div>jQuery es una biblioteca de JavaScript, creada inicialmente por John Resig, que permite simplificar la manera de interactuar con los documentos HTML, manipular el árbol DOM, manejar eventos, desarrollar animaciones (FLV) y agregar interacción con la técnica AJAX a páginas web. Fue presentada el 14 de enero de 2006 en el BarCamp NYC. jQuery es la biblioteca de JavaScript más utilizada.</div><div><br></div><div>jQuery es software libre y de código abierto, posee un doble licenciamiento bajo la Licencia MIT y la Licencia Pública General de GNU v2, permitiendo su uso en proyectos libres y privativos.2 jQuery, al igual que otras bibliotecas, ofrece una serie de funcionalidades basadas en JavaScript que de otra manera requerirían de mucho más código, es decir, con las funciones propias de esta biblioteca se logran grandes resultados en menos tiempo y espacio.</div><div><br></div><div>Las empresas Microsoft y Nokia anunciaron que incluirán la biblioteca en sus plataformas.3 Microsoft la añadirá en su IDE Visual Studio4 y la usará junto con los frameworks ASP.NET AJAX y ASP.NET MVC, mientras que Nokia los integrará con su plataforma Web Run-Time.</div>', 'jQuery', '<div>jQuery is a multi-browser (cf. cross-browser) JavaScript library designed to simplify the client-side scripting of HTML.[2] It was released in January 2006 at BarCamp NYC by John Resig. It is currently developed by a team of developers led by Dave Methvin. Used by over 65% of the 10,000 most visited websites, jQuery is the most popular JavaScript library in use today.</div><div><br></div><div>jQuery is free, open source software, licensed under the MIT License.[5] jQuery''s syntax is designed to make it easier to navigate a document, select DOM elements, create animations, handle events, and develop Ajax applications. jQuery also provides capabilities for developers to create plug-ins on top of the JavaScript library. This enables developers to create abstractions for low-level interaction and animation, advanced effects and high-level, theme-able widgets. The modular approach to the jQuery library allows the creation of powerful dynamic web pages and web applications.</div><div><br></div><div>The set of jQuery core features — DOM element selections, traversal and manipulation —, enabled by its selector engine (named "Sizzle" from v1.3), created a new "programming style", fusing algorithms and DOM-data-structures; and influenced the architecture of other Javascript frameworks like YUI v3 and Dojo.</div><div><br></div><div>Microsoft and Nokia bundle jQuery on their platforms.[6] Microsoft include it with Visual Studio[7] for use within Microsoft''s ASP.NET AJAX framework and ASP.NET MVC Framework while Nokia has integrated it into their Web Run-Time widget development platform.[8] jQuery has also been used in MediaWiki since version 1.16.</div>', 0, 27, 0);

-- --------------------------------------------------------

-- 
-- `jcms_productos_imagenes`
-- 

CREATE TABLE `jcms_productos_imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `imagen` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `orden` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=69 ;

INSERT INTO `jcms_productos_imagenes` VALUES (60, 29, 'hW1FuIEt3O_45535.png', 1);
INSERT INTO `jcms_productos_imagenes` VALUES (59, 29, 'RjrGoTFZjt_2012-specialized-fate-29er-womens-carbon-fiber-mountain-bike1.jpg', 0);
INSERT INTO `jcms_productos_imagenes` VALUES (64, 30, 'ZueV6RQyoQ_20769481735108f96115e068.69337093_182b0dac.jpg', 1);
INSERT INTO `jcms_productos_imagenes` VALUES (63, 30, 'L0RBQJwCnc_PHP-Application-Development-and-Security.jpg', 0);
INSERT INTO `jcms_productos_imagenes` VALUES (65, 31, 'Ni7efvu96O_mysql_desktop_web2.0_1440x1050.png', 0);
INSERT INTO `jcms_productos_imagenes` VALUES (66, 31, 'rJyIjHrAKu_MySQL_wallpaper_by_mortifi.jpg', 1);
INSERT INTO `jcms_productos_imagenes` VALUES (67, 32, 'cPhPlB6lwC_wallpaper_jquery-azul.png', 0);
INSERT INTO `jcms_productos_imagenes` VALUES (68, 32, 'iIpwzpIisX_jquery-wallpaper-800x600.jpg', 1);

-- --------------------------------------------------------

-- 
-- `jcms_seccion_index`
-- 

CREATE TABLE `jcms_seccion_index` (
  `id` int(11) NOT NULL,
  `contenido` longtext NOT NULL,
  `contenido_en` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `jcms_seccion_index` VALUES (1, '<p></p><h1>Bienvenido a jCMS</h1><div><br></div><div>jCMS: un gestor de contenidos php+mysql sencillo y gratuito.</div><div><br></div><div>Puedes probar la demo on-line desde:</div><div><br></div><div>Parte pública: http://bit.ly/18qQWc3</div><div><br></div><div>Parte privada: http://bit.ly/14JPArq</div><p></p>', '<p></p><h1>Welcome to jCMS</h1><div><br></div><div>jCMS: free and simple php+mysql content management system.</div><div><br></div><div>You can try the on-line demo:</div><div><br></div><div>Public: http://bit.ly/18qQWc3</div><div><br></div><div>Private: http://bit.ly/14JPArq</div><p></p>');

-- --------------------------------------------------------

-- 
-- `jcms_secciones`
-- 

CREATE TABLE `jcms_secciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_padre` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `contenido` longtext COLLATE latin1_spanish_ci NOT NULL,
  `nombre_en` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `contenido_en` longtext COLLATE latin1_spanish_ci NOT NULL,
  `orden` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=28 ;

INSERT INTO `jcms_secciones` VALUES (27, 0, 'Fotos', '<h1>Fotos</h1>', 'Gallery', '<h1>Gallery</h1>', 0);
INSERT INTO `jcms_secciones` VALUES (4, 0, 'Noticias', '<p></p><h1>Noticias</h1><p></p>', 'News', '<h1>News</h1>', 3);
INSERT INTO `jcms_secciones` VALUES (25, 0, 'Videos', '<p></p><h1>Videos</h1><div><br></div><div>[youtube=http://www.youtube.com/watch?v=h2Nq0qv0K8M]</div><div><br></div><div>[youtube=http://www.youtube.com/watch?v=GNb8T5NBdQg]<br></div><div><br></div><div>[youtube=http://www.youtube.com/watch?v=6pbxQQG25Jw]<br></div><div><br></div><div><br></div><p></p>', 'Videos', '<p></p><h1>Videos</h1><div><br></div><div>[youtube=http://www.youtube.com/watch?v=h2Nq0qv0K8M]</div><div><br></div><div>[youtube=http://www.youtube.com/watch?v=GNb8T5NBdQg]<br></div><div><br></div><div>[youtube=http://www.youtube.com/watch?v=6pbxQQG25Jw]<br></div><div><br></div><p></p>', 10);
