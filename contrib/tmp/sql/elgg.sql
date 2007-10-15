-- MySQL dump 10.10
--
-- Host: localhost    Database: latinpyme
-- ------------------------------------------------------
-- Server version	5.0.22-Debian_0ubuntu6.06.2-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `elggcalendar_events`
--

DROP TABLE IF EXISTS `elggcalendar_events`;
CREATE TABLE `elggcalendar_events` (
  `ident` int(10) unsigned NOT NULL auto_increment,
  `owner` int(10) unsigned NOT NULL default '0',
  `calendar` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) collate utf8_unicode_ci default '',
  `description` text collate utf8_unicode_ci NOT NULL,
  `access` varchar(255) collate utf8_unicode_ci default '',
  `location` varchar(50) collate utf8_unicode_ci default '',
  `date_start` int(11) NOT NULL default '0',
  `date_end` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ident`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggcalendar_events`
--


/*!40000 ALTER TABLE `elggcalendar_events` DISABLE KEYS */;
LOCK TABLES `elggcalendar_events` WRITE;
INSERT INTO `elggcalendar_events` VALUES (1,3,3,'Conferencia -- Corfe','III conferencia Servicios','PUBLIC','Corferias',1182445200,1182445200),(2,3,3,'Camara de Comercio','Registro Mercantil','PUBLIC','Camara',1180976400,1180976400),(3,3,3,'web 2.0 charla','Conferencia Desarrollo WEB','user3','Tecnparque',1181926800,1181926800),(4,3,4,'Inauguracion','Inauguracion Red Social Latinpyme','PUBLIC','Latinpyme',1182445200,1182445200),(5,3,3,'costruccion','Contruccion','PUBLIC','evento contruccion',1182877200,1182877200),(6,3,3,'empresa','economia','PUBLIC','empresas',1183136400,1183136400),(7,3,3,'noticas','construccion','PUBLIC','economia',1182358800,1182358800),(8,3,3,'tecnologia','tecnologia','PUBLIC','tecnologia',1182963600,1182963600),(9,3,3,'proexport','exportaciones','PUBLIC','exportaciones',1181754000,1181754000),(10,3,3,'negocios','eventos','PUBLIC','eventos',1182531600,1182531600),(11,3,3,'turismo','turismo','PUBLIC','turismo',1182272400,1182272400),(12,3,3,'calendarios','negocios','PUBLIC','negocios',1181322000,1181322000),(13,3,3,'software','turimo','PUBLIC','industria',1184778000,1184778000),(14,3,3,'latinoamerica','proexport','PUBLIC','latinoamerica',1183050000,1183050000);
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggcalendar_events` ENABLE KEYS */;

--
-- Table structure for table `elggcontent_flags`
--

DROP TABLE IF EXISTS `elggcontent_flags`;
CREATE TABLE `elggcontent_flags` (
  `ident` int(11) NOT NULL auto_increment,
  `url` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`ident`),
  KEY `url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggcontent_flags`
--


/*!40000 ALTER TABLE `elggcontent_flags` DISABLE KEYS */;
LOCK TABLES `elggcontent_flags` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggcontent_flags` ENABLE KEYS */;

--
-- Table structure for table `elggdatalists`
--

DROP TABLE IF EXISTS `elggdatalists`;
CREATE TABLE `elggdatalists` (
  `ident` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `value` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ident`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggdatalists`
--


/*!40000 ALTER TABLE `elggdatalists` DISABLE KEYS */;
LOCK TABLES `elggdatalists` WRITE;
INSERT INTO `elggdatalists` VALUES (1,'version','2007042001'),(2,'explodeservice','O:8:\"stdClass\":1:{s:5:\"ident\";i:0;}registernew'),(3,'explodelastpinged','1181691003'),(4,'newsclient_lastcronprune','1181848675');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggdatalists` ENABLE KEYS */;

--
-- Table structure for table `elggfeed_posts`
--

DROP TABLE IF EXISTS `elggfeed_posts`;
CREATE TABLE `elggfeed_posts` (
  `ident` int(11) NOT NULL auto_increment,
  `posted` varchar(64) collate utf8_unicode_ci NOT NULL default '0' COMMENT 'imported human readable date',
  `added` int(11) NOT NULL default '0' COMMENT 'unix timestamp',
  `feed` int(11) NOT NULL default '0' COMMENT '-> feeds.ident',
  `title` text collate utf8_unicode_ci NOT NULL,
  `body` text collate utf8_unicode_ci NOT NULL,
  `url` varchar(255) collate utf8_unicode_ci NOT NULL default '' COMMENT 'post-specific or permalink URL',
  PRIMARY KEY  (`ident`),
  KEY `feed` (`feed`),
  KEY `posted` (`posted`,`added`),
  KEY `added` (`added`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggfeed_posts`
--


/*!40000 ALTER TABLE `elggfeed_posts` DISABLE KEYS */;
LOCK TABLES `elggfeed_posts` WRITE;
INSERT INTO `elggfeed_posts` VALUES (1,'Wed, 13 Jun 2007 02:36:44 +0000',1181702204,1,'El imparable boom empresarial de Second Life','<div class=\'snap_preview\'><p style=\"text-align:center;\"><img src=\"http://www.revenews.com/wayneporter/archives/second_life_logo.jpg\" alt=\"http://www.revenews.com/wayneporter/archives/second_life_logo.jpg\" /></p>\n<p>??El banco espa??ol Ibiza Bank abre sucursal en Second Life, y empresas como Reebok o Adidas empiezan a enviar f??sicamente los productos comprados en sus sedes virtuales.<br />\nHay quien ped??a a gritos, con la llegada de las nuevas tecnolog??as, la creaci??n de un mundo paralelo en el que tener otra vida. Sus plegarias fueron atendidas con la llegada de Second Life, un mundo virtual creado por Philip Rosedale y que ha conseguido una muy buena aceptaci??n, tanto por los usuarios como por las empresas.</p>\n<p>Seg??n las cifras oficiales, este sistema 3D ya cuenta con m??s de siete millones de residentes, de los que el 3% son espa??oles. Las cifras no dejan de crecer, y ante esta situaci??n no es de extra??ar que numerosas compa????as hayan decidido apostar por una presencia virtual en SL, antes de que su competencia les adelante y les quite presencia.</p>\n<p>Un caso claro son los bancos, que poco a poco han comenzado a abrir sucursales por las calles de Second Life. ABN Amro fue la primera entidad financiera en abrir sus puertas de forma virtual, y a ella le siguieron otras grandes como ING Direct. Ahora llega el turno de las sociedades espa??olas, y una de ellas ha decidido lanzarse a esta innovadora iniciativa.</p>\n<p>Se trata de Ibiza Bank, que con la apertura de su sucursal se ha convertido en el primer banco espa??ol en estar presente en este mundo 3D. A trav??s del portal Mundo Second Life los usuarios podr??n comprar d??lares linden (moneda de SL) para utilizar en sus transacciones virtuales. La iniciativa ha llegado cargada de novedades, y una de las principales es que los usuarios no tendr??n que ser Premium (servicio de pago) dentro de SL, ya que cualquiera tendr?? acceso a la compra de la moneda.</p>\n<p>Adem??s, la compra se realiza en euros, y no en d??lares (como en la mayor parte de bancos que operan en el sistema), por lo que el usuario puede conocer desde el primer momento qu?? cantidad se le cargar?? a su cuenta. Se trata de una prueba de fuego para este banco, que estudiar?? en los pr??ximos meses los resultados de la iniciativa.</p>\n<p>Pero no s??lo el mercado financiero est?? interesado en Second Life. Numerosas marcas importantes tambi??n est??n comenzando a abrir tiendas en este mundo paralelo. Reebok, Adidas o American Apparel son algunas de ellas, aunque de momento sus previsiones en este nuevo mercado son m??s bien modestas.</p>\n<p>Seg??n las cifras que barajan, el desarrollo del comercio en SL es firme pero lento. Las compa????as ven su presencia en este sistema m??s como una cuesti??n de que de posibilidades reales de negocio, aunque el panorama est?? cambiando poco a poco. De hecho, ofrecen la posibilidad de comprar un art??culo en el mundo virtual y , un paso m??s en la integraci??n de las redes sociales con las compras en Internet.</p>\n<p>Por el momento, y pese a los esfuerzos de algunas de ellas, abrir una oficina o tienda en Second Life sigue sin ser rentable, aunque supone un posicionamiento claro de la marca y un valor a??adido. Eso s??, todo apunta a que esto no ha hecho nada m??s que empezar.</p>\n<p><a href=\"http://www.baquia.com \">www.baquia.com </a></p>\n</div>','http://treszero.wordpress.com/2007/06/13/el-imparable-boom-empresarial-de-second-life/'),(2,'Tue, 12 Jun 2007 16:10:47 +0000',1181664647,1,'LinkedIn ser?? el due??o del negocio del networking','<div class=\'snap_preview\'><p>Opinion del CEO sobre LinkedIn, Dan Nye. Tambi??n comento que en el futuro las personas tendr??n dos perfiles en Internet, <strong>uno personal y otro laboral en una red social de networking</strong>. Con 11 millones de miembros, 180.000 nuevos cada semana LinkedIn es la l??der en este tipo de redes sociales.<br />\nNye confiesa su poco miedo a la competencia con su seguidor europeo Xing: ???Vamos a ganar el mundo de habla inglesa y las econom??as adyacentes???.<br />\nBastante confiado se nota al CEO de LinkedIn pero hay que tener en cuenta los posibles movimientos en una opci??n que cada d??a tiene m??s importancia en la red. Xing ya realizo la compra de e-conozco de tr??fico sobre todo espa??ol y en la ??ltima semana de Plaxo con tr??fico americano. ??Cual ser?? la siguiente compra o fusi??n? ??Las grandes compa??ias de Internet empezar?? a invertir en este nicho de mercado?</p>\n<p>Via: <a href=\"http://www.mujerestic.com/linkedin-sera-el-dueno-del-negocio-del-networking/\">Mujeres TIC </a></p>\n</div>','http://treszero.wordpress.com/2007/06/12/linkedin-sera-el-dueno-del-negocio-del-networking/'),(3,'Tue, 12 Jun 2007 15:01:37 +0000',1181660497,1,'Firefox 3 ha sido concebido','<div class=\'snap_preview\'><p><strong>Una versi??n alfa del pr??ximo Firefox ya puede ser descargada de Internet.</strong></p>\n<p style=\"text-align:center;\"><img src=\"http://www.diarioti.com/sisimg/14421b_firefox.jpg\" border=\"1\" hspace=\"5\" vspace=\"0\" /></p>\n<p>Gran Paradiso Alpha 5 es el nombre de trabajo que Mozilla ha asignado a <a href=\"http://releases.mozilla.org/pub/mozilla.org/firefox/releases/granparadiso\">Firefox 3</a>. La nueva versi??n se basa en Gecko 1.9 de Mozilla, que es la plataforma para la nueva generaci??n de navegadores de Mozilla.</p>\n<p>El principal cambio aplicado a Firefox consiste de los denominados &#8220;places&#8221;, que es una nueva forma de gestionar favoritos, suscripciones a RSS e historial. De hecho, Places fue un componente de Firefox 2 Alpha 1, pero fue eliminado de las versiones posteriores del navegador.</p>\n<p>Por lo dem??s, el nuevo navegador usar?? menos recursos del sistema. La nueva funci??n de optimizaci??n estar?? disponible para Mac OS X y la mitad de las instalaciones de Windows, pero inicialmente no para Linux. La versi??n alfa del navegador incorpora adem??s un administrador de contrase??as basado en Javascript.</p>\n<p>Mozilla recalca que la versi??n de prueba ha sido publicada exclusivamente para tal prop??sito y no debe ser usada como un producto definitivo. Por lo tanto, sugiere a los usuarios aficionados tener precauci??n, ya que el producto puede presentar bugs - o errores de c??digo.</p>\n<p>Fuente: <a href=\"http://www.diarioti.com/gate/n.php?id=14421\">Diario Ti</a></p>\n<p>Descarga: <a href=\"http://releases.mozilla.org/pub/mozilla.org/firefox/releases/granparadiso\">FTP Mozilla??</a></p>\n</div>','http://treszero.wordpress.com/2007/06/12/firefox-3-ha-sido-concebido/'),(4,'Tue, 12 Jun 2007 14:39:26 +0000',1181659166,1,'El iPhone trabajar?? con aplicaciones Web 2.0 de terceras partes','<div class=\'snap_preview\'><p><strong>Una nueva e innovadora forma de crear aplicaciones para el iPhone.</strong></p>\n<p>WWDC 2007, San Francisco (California, EEUU) -11 de junio de 2007- Apple ha anunciado hoy que su revolucionario iPhone ejecutar?? aplicaciones creadas de acuerdo con los est??ndares de Internet Web 2.0 cuando se empiece a comercializar en EEUU el 29 de junio.</p>\n<p>Los desarrolladores de software pueden crear aplicaciones Web 2.0 que tendr??n el mismo aspecto y comportamiento que las aplicaciones incorporadas en el iPhone; aplicaciones que pueden de manera natural acceder a los servicios del iPhone, incluyendo la realizaci??n de llamadas telef??nicas, env??o de eMails y visualizaci??n de lugares en Google Maps. Las aplicaciones de terceras partes creadas utilizando los est??ndares Web 2.0 pueden ampliar y extender las capacidades del iPhone sin poner en compromiso su fiabilidad o seguridad.</p>\n<p>&#8220;Tanto los desarrolladores como los usuarios estar??n muy sorprendidos y satisfechos por lo fant??stico del aspecto y del funcionamiento de estas aplicaciones en el iPhone&#8221;, dice Steve Jobs, CEO de Apple. &#8220;Nuestro innovador enfoque, utilizando est??ndares basados en Web 2.0, permite a los desarrolladores crear asombrosas nuevas aplicaciones manteniendo el iPhone seguro y fiable&#8221;.</p>\n<p>Las aplicaciones basadas en Web 2.0 est??n siendo adoptadas por grandes desarrolladores ya que son mucho m??s interactivas y sensibles que las tradicionales aplicaciones web, y pueden ser f??cilmente distribuidas v??a Internet y actualizadas c??modamente sin m??s que cambiar el c??digo en los propios servidores de los desarrolladores.<br />\nLos modernos est??ndares web proporcionan tambi??n acceso a datos y transacciones seguras, como sucede en Amazon.com o en la banca online.</p>\n<p><a href=\"http://www.apple.es\">www.apple.es</a></p>\n</div>','http://treszero.wordpress.com/2007/06/12/el-iphone-trabajara-con-aplicaciones-web-20-de-terceras-partes/'),(5,'Mon, 11 Jun 2007 14:49:49 +0000',1181573389,1,'Estad??sticas de Creative Commons','<div class=\'snap_preview\'><p>El <a href=\"http://www.ccestadisticas.negociosabiertos.com/\" title=\"Generador de Estad?sticas de Creative Commons 1.0\">generador de estad??sticas de Creative Commons</a> en su primera versi??n nos ayuda a ver datos de obras licenciadas con <a href=\"http://www.maestrosdelweb.com/editorial/creativecommons/\" title=\"Creative Commons y los derechos de autor en internet\">CC</a> y disponibles en l??nea.<br />\n<span></span></p>\n<p align=\"center\"><img src=\"http://www.maestrosdelweb.com/images/stats-creative-commons.jpg\" alt=\"Estad?sticas de Creative Commons\" height=\"189\" width=\"405\" /></p>\n<p>Utiliza los principales motores de b??squeda del mercado: <a href=\"http://www.maestrosdelweb.com/editorial/yahoohis/\" title=\"La Historia de Yahoo\">Yahoo</a>, <a href=\"http://www.maestrosdelweb.com/editorial/googlehis/\" title=\"La historia de Google\">Google</a>, Altavista, All The Web. Luego, seleccionando por pa??s nos da los detalles de todas las obras que hay con Creative Commons en dicha regi??n aprovechando el valor de los backlinks que han almacenado los buscadores.</p>\n<p>El proyecto nos ayuda sin duda a conocer el avance de las licencias CC en el mercado hispano. Ser??a interesante hacer una comparaci??n de los pa??ses enumerados, as?? como los buscadores para ver el panorama completo. La herramienta ya est?? lista, as?? que tal vez algui??n se anima a ejecutarlo.</p>\n<p>V??a: <a href=\"http://www.negociosabiertos.com/?p=81\" title=\"Negocios Abiertos  ?? Blog Archive   ?? Generador de estad?sticas de Creative Commons 1.0\">Negocios Abiertos</a></p>\n<p>Fuente: <a href=\"http://www.maestrosdelweb.com/actualidad/estadisticas-de-creative-commons/\">MaestrosdelWEB??</a></p>\n</div>','http://treszero.wordpress.com/2007/06/11/estadisticas-de-creative-commons/'),(6,'Mon, 11 Jun 2007 14:46:33 +0000',1181573193,1,'Las marcas usan el marketing directo','<div class=\'snap_preview\'><p>El 56% de los anunciantes utiliza el marketing directo para promocionar su marca y se sale de las campa??as masivas, seg??n el estudio <a href=\"http://www.emarketer.com/Article.aspx?id=1004997\">The Integration of DM and Brand</a> publicado por eMarketer y realizado por <a href=\"http://www.the-dma.org/\">The DMA</a> (Asociaci??n de Marketing Directo de Estados Unidos). Con la proliferaci??n de canales con posibilidades de interacci??n directa, es m??s que comprensible que las marcas traten de acercarse a los consumidores uno a uno, o de la forma m??s personal posible.Los canales que m??s se emplean son la web con mecanismos de respuesta directa (50%), el 48% ofertas con seguimiento y el 45% utiliza las webs con llamadas a la acci??n. Tambi??n en las campa??as de radio y TV se siguen empleando elementos para que los consumidores se comuniquen con la marca, y los n??meros de tel??fono especiales son un recurso muy utilizado.</p>\n<p>El email tambi??n se utiliza mucho para el marketing directo, con llamadas a la acci??n en el 52% de los casos, ofertas con seguimiento y otros mecanismos de respuesta en el 47%. Y el 28% de los anunciantes utiliza elementos de respuesta directa en su marketing de buscadores, mientras que un 31% lo utiliza con prop??sitos de targeting y el 25% para crear listas de contactos.</p>\n<p>Via: <a href=\"http://etc.territoriocreativo.es/etc/2007/06/las-marcas-usan-el-marketing-directo.html\">ETC??</a></p>\n</div>','http://treszero.wordpress.com/2007/06/11/las-marcas-usan-el-marketing-directo/'),(7,'Mon, 11 Jun 2007 14:02:06 +0000',1181570526,1,'Los Adolecentes hacen correr el rumor','<div class=\'snap_preview\'><p>Los j??venes de la llamada generaci??n Y, de entre 13 y 24 a??os, son los m??s proclives a correr la voz sobre las cosas que les gustan. Adem??s, son quienes m??s disfrutan de los contenidos generados por los usuarios.</p>\n<p>Seg??n el informe State of the Media Democracy, realizado en Estados Unidos por la empresa de consultor??a e investigaci??n de mercados Harrison Group para la compa????a de servicios profesionales Deloitte &amp; Touche, las aptitudes para el &#8220;boca a oreja&#8221; de la generaci??n Y vienen de sus largas listas de contactos electr??nicos, a las que env??an mensajes instant??neos y emails. Los chicos de esta generaci??n tienen una media de 37 contactos en sus listas, una cantidad considerable si se piensa que la media general es de 17 contactos.</p>\n<p><strong>Que corra de boca en boca</strong><br />\nSe trata de una generaci??n que se maneja con absoluta facilidad en internet y son capaces de correr la voz sin problemas. Cuando los miembros de la generaci??n del milenio, como tambi??n se llama a este grupo de edad, ven un anuncio de televisi??n o un sitio web que les gusta, se lo cuentan a una media de 18 personas, mientras que la media de todas las edades es de 10 personas. De hecho, la principal raz??n para visitar un sitio web suele ser que un amigo lo ha recomendado; en otros casos se visita el sitio web tras ver el anuncio en televisi??n.</p>\n<p><strong>No toda la publicidad es aceptada</strong><br />\nSin embargo, el que los adolescentes sean proclives al llamado word of mouth se contradice con sus preferencias publicitarias. Un estudio realizado por Harris Interactive en mayo de 2006 demuestra que los adolescentes prefieren encontrarse con el ya conocido product placement que con campa??as de marketing viral.</p>\n<p>Adem??s, algunas t??cticas provocan una respuesta claramente negativa: el 45% de los j??venes entre 13 y 18 a??os rechaza la idea de encontrarse en un chat con alg??n promotor que publicite sus productos. El 44% se opone a que se regalen productos de muestra a los j??venes m??s populares. El 65% se opone a que se les pida sus datos personales. Y el 55% est?? en contra de la publicidad en tel??fonos m??viles. Tampoco acaban de aceptar que se escriban blogs dedicados a productos (32% en contra).</p>\n<p><strong>??Qu?? hacen los adolescentes en la red?</strong><br />\nEn cuanto al consumo de contenidos online de esta generaci??n, su principal ocupaci??n es la b??squeda, descarga y escuchar m??sica (78%), seguida de la lectura y visionado de contenidos personales creados por otros (71%). Tambi??n visitan sitios de juego online (66%) o ven YouTube y otros sitios de v??deo online (62%). Otra funci??n habitual de la red en estas edades es la de cauce de las relaciones sociales (62%).</p>\n<p>La creaci??n de contenidos personales (58%) y mantener y compartir fotos (53%) son las facetas activas m??s habituales en esta generaci??n. Algo m??s de un tercio de los encuestados mantiene sus propios blogs y sitios web. La misma cantidad suele participar en foros de discusi??n.</p>\n<p>Las ??nicas actividades en las que esta generaci??n es superada por otras es en la b??squeda de informaci??n y productos financieros y en la participaci??n en subastas online, tipo eBay.</p>\n<p>Via: <a href=\"http://www.marketingdirecto.com/noticias/noticia.php?idnoticia=23247&amp;titular=LOS%20ADOLESCENTES%20HACEN%20CORRER%20EL%20RUMOR\">Marketing Directo</a></p>\n</div>','http://treszero.wordpress.com/2007/06/11/los-adolecentes-hacen-correr-el-rumor/'),(8,'Mon, 11 Jun 2007 00:55:32 +0000',1181523332,1,'Administracion 2.0','<div class=\'snap_preview\'><p>Escrito por: Johan Eduardo Quijano</p>\n<p>Fuente: <a href=\"http://vozivoto.blogspot.com/2006/05/administracion-20.html\">VozyVoto </a></p>\n<p>Mirando en la Blogosfera se puede observar como estan utilizando el termino &#8220;2.0&#8243; para dar la idea de algo &#8220;nuevo&#8221;, mas evolucionado en terminos culturales en algunos casos y tecnologicos en otros. Es notable que muchos dudan todavia de la credibilidad del termino aplicado en otros aspectos como publicidad 2.0 y otros lo usuan solo por vender mas una idea novedosa.</p>\n<p>Encontre un termino llamado Administracion 2.0 que basicamente comenta cada una de las 3 ??reas que se consideran en web 2.0: sindicaci??n de contenidos, integraci??n de servicios y desarrollo de aplicaciones sociales.</p>\n<p><strong>Sindicaci??n de contenidos</strong>. Para que podemos usar el RSS o ATOM? pues por ejemplo para sindicar los contratos (o licitaciones) que un Ministerio tiene previsto. Administraci??n 2.0 permite la sindicaci??n de esos contenidos para que cada empresa los agrupe a su gusto. La construcci??n de portales de licitaciones y Bases de datos centralizadas para ser el ??nico punto de acceso es el pasado la Administraci??n 2.0 es el futuro.</p>\n<p><strong>Integraci??n de servicios</strong>: La arquitectura SOA y el protocolo SOAP son perfectas para construir el intercambio de datos entre las administraciones. Para conectar todos los registros de licitadores de todas las administraciones. Cualquier empresa puede licitar el cualquier administracion sin tener que volver a presentar el tocho de papeles. Este es el futuro.</p>\n<p><strong>Aplicaciones sociales</strong>. la colaboraci??n para la &#8220;oficina virtual&#8221;. Basadas en servidores &#8220;de igual a igual&#8221; que se adapten al cambiante y cada vez m??s complejo ambiente laboral&#8221;. La nueva oficina de atenci??n al p??blico es colaborativa, sin importar el lugar ni el momento, es una extensi??n sencilla y natural de la forma en que los trabajadores con informaci??n coordinan sus respuestas&#8221;.</p>\n<p>Y todavia hay m??s usos: la tecnologia de la wikipedia se puede trasladar al mundo legislativo, y el ???tagging??? trasladable a la participaci??n en la actividad parlamentaria.</p>\n<p>La Administracion 2.0 se puede alcanzar pero se necesita profesionales creativos, innovadores y, sobre todo, rebeldes.?? Como podemos observar aparentemente el uso de estas tecnologias esta siendo utilizada para aplicar el &#8220;2.0&#8243; a muchos sectores. Creen que es adecuado el uso de este termino ?.</p>\n<p>Llegara un punto donde la gente se canse de escuchar este termino o por el contrario se fortalecera en el tiempo ?.</p>\n<p>Escrito por: Johan Eduardo Quijano</p>\n</div>','http://treszero.wordpress.com/2007/06/11/administracion-20/'),(9,'Sun, 10 Jun 2007 02:10:45 +0000',1181441445,1,'Ya hay empresas “wiki”','<div class=\'snap_preview\'><p>Grandes empresas como Nokia o el banco Dresdner Kleinwort ya empezaron a implementar el modelo de Wikipedia para organizar mejor su trabajo interno, ante la importancia que entre sus empleados adquir??a ese sistema como herramienta. Una &#8220;wiki&#8221; es un sitio web colaborativo que puede ser editado por varios usuarios. As??, las &#8220;wikis&#8221; sirven para actualizar calendarios y status de proyectos, editar documentos y otros trabajos. Adem??s, se reduce el tr??fico de e-mails.</p>\n<p>Fuente: <a href=\"http://www.larazon.com.ar/notas/2007/05/12/01417458.html\">LaRazon??</a></p>\n</div>','http://treszero.wordpress.com/2007/06/10/ya-hay-empresas-wiki/'),(10,'Sun, 10 Jun 2007 02:09:34 +0000',1181441374,1,'Google ha comprado 12 empresas en un a??o','<div class=\'snap_preview\'><p><strong>Medios, Radio y TV El buscador ha pasado a convertirse en una de las primeras compradoras de Star-ups.</strong></p>\n<p style=\"text-align:center;\"><img src=\"http://www.google.com/intl/en_ALL/images/logo.gif\" alt=\"Google\" height=\"110\" width=\"276\" /></p>\n<p>De empresas de seguridad inform??tica a Youtube. Google ha adquirido 12 empresas en los ??ltimos doce meses.</p>\n<p>Las firmas adquiridas abarcan todo tipo de sectores, desde portales de intercambio, como Youtube, a servicios de publicidad online con Doubleclick. Precisamente estas dos son las que m??s dinero le han costado.,</p>\n<p>Curiosamente la fiebre compradora de Google alcanza su m??ximo esplendor en la primavera del 2007.</p>\n<p>Estas son las empresas compradas por Google</p>\n<p>Agosto del 2006: Neven Vision, empresa especializada en tecnolog??a de b??squeda m??vil de fotos.</p>\n<p>Octubre del 2006: Jotspot. Una compra que fue considerada estrat??gica en su momento y que al cabo de los meses ha pasado a ser todo un enigma. Tras la compra, la compa????a dejo de aceptar nuevas altas y sufre graves problemas de disponibilidad del servicio. Esta especializada en wikis.</p>\n<p>Octubre del 2006: Youtube. La primera de las grandes compras del buscador con una inversi??n de 1650 millones de d??lares.</p>\n<p>Diciembre del 2006: Endoxon. Una compa????a helv??tica especializada en tecnolog??a de mapas.</p>\n<p>Marzo del 2007: Trendalyzer, una empresa desarrolladora de software corporativo que permite crear y reproducir gr??ficos din??micos y estad??sticas.</p>\n<p>Marzo del 2007: Adscape Media, compa????a de publicidad en soportes electr??nicos.</p>\n<p>Abril del 2007: Doubleclick. La compra est?? pendiente de recibir la autorizaci??n definitiva y va a ser investigada por la FTC tras recibir quejas de competidores. Es la compra m??s cara en la historia del buscador con una inversi??n de 3.100 millones de d??lares.</p>\n<p>Abril del 2007: Marratech, compa????a sueca especializada en sistemas de videoconferencia.</p>\n<p>Abril del 2007: Tonic Sistems, especializada en la presentaci??n y conversi??n de documentos. La adquisici??n encaja en la estrategia de Google de seguir aumentando las prestaciones de su paquete ofim??tico online Google Docs &amp; Spreadsheets, alternativa a Microsoft Office</p>\n<p>29 mayo del 2007: GreenBorder Technologies, fabricante de productos de seguridad inform??tica enfocada especialmente a la navegaci??n Web.</p>\n<p>31 Mayo del 2007: Panoramio, un proyecto espa??ol que destaca por unir fotos subidas por los propios usuarios con el servicio Google Maps.</p>\n<p>1 Junio del 2007: Feedburner, un hist??rico servicio de sindicaci??n de RSS que cuenta entre sus afiliados a la flor y nota de la blogosfera mundial.</p>\n</div>','http://treszero.wordpress.com/2007/06/10/google-ha-comprado-12-empresas-en-un-ano/'),(11,'',1181834458,2,'Camara de Comercio','<table>\n<tr><td><b>Date:</b></td><td> Mon, 04 Jun 2007 </td></tr>\n<tr><td><b>Start Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>End Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>Location:</b></td><td> Camara </td></tr>\n<tr><td><b>Description:</b></td><td> Registro Mercantil </td></tr>\n<tr><td><b>Palabras clave:</b></td><td> 	camara </td></tr>\n</table>','http://latinpyme/mod/calendar/dayview.php?calendar_name=johanqnms&month=06&day=04&year=2007'),(12,'',1181834458,2,'Conferencia -- Corfe','<table>\n<tr><td><b>Date:</b></td><td> Thu, 21 Jun 2007 </td></tr>\n<tr><td><b>Start Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>End Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>Location:</b></td><td> Corferias </td></tr>\n<tr><td><b>Description:</b></td><td> III conferencia Servicios </td></tr>\n<tr><td><b>Palabras clave:</b></td><td> 	corferias	servicios	conferencia </td></tr>\n</table>','http://latinpyme/mod/calendar/dayview.php?calendar_name=johanqnms&month=06&day=21&year=2007'),(13,'',1181849231,2,'calendarios','<table>\n<tr><td><b>Date:</b></td><td> Fri, 08 Jun 2007 </td></tr>\n<tr><td><b>Start Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>End Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>Location:</b></td><td> negocios </td></tr>\n<tr><td><b>Description:</b></td><td> negocios </td></tr>\n<tr><td><b>Palabras clave:</b></td><td> 	exportaciones	turismo	latinpyme	proexport	industria	negocios	calzado </td></tr>\n</table>','http://latinpyme/mod/calendar/dayview.php?calendar_name=johanqnms&month=06&day=08&year=2007'),(14,'',1181849231,2,'proexport','<table>\n<tr><td><b>Date:</b></td><td> Wed, 13 Jun 2007 </td></tr>\n<tr><td><b>Start Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>End Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>Location:</b></td><td> exportaciones </td></tr>\n<tr><td><b>Description:</b></td><td> exportaciones </td></tr>\n<tr><td><b>Palabras clave:</b></td><td> 	turismo	latinpyme	proexport	construccion	economia	empresarios	exportaciones	industria	negocios	calzado </td></tr>\n</table>','http://latinpyme/mod/calendar/dayview.php?calendar_name=johanqnms&month=06&day=13&year=2007'),(15,'',1181849231,2,'turismo','<table>\n<tr><td><b>Date:</b></td><td> Tue, 19 Jun 2007 </td></tr>\n<tr><td><b>Start Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>End Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>Location:</b></td><td> turismo </td></tr>\n<tr><td><b>Description:</b></td><td> turismo </td></tr>\n<tr><td><b>Palabras clave:</b></td><td> 	exportaciones	turismo	latinpyme	proexport	industria	negocios	calzado </td></tr>\n</table>','http://latinpyme/mod/calendar/dayview.php?calendar_name=johanqnms&month=06&day=19&year=2007'),(16,'',1181849231,2,'noticas','<table>\n<tr><td><b>Date:</b></td><td> Wed, 20 Jun 2007 </td></tr>\n<tr><td><b>Start Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>End Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>Location:</b></td><td> economia </td></tr>\n<tr><td><b>Description:</b></td><td> construccion </td></tr>\n<tr><td><b>Palabras clave:</b></td><td> 	construccion	economia	empresarios	exportaciones	negocios	proexport	tecnologia	turismo	calzado	latinpyme </td></tr>\n</table>','http://latinpyme/mod/calendar/dayview.php?calendar_name=johanqnms&month=06&day=20&year=2007'),(17,'',1181849231,2,'negocios','<table>\n<tr><td><b>Date:</b></td><td> Fri, 22 Jun 2007 </td></tr>\n<tr><td><b>Start Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>End Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>Location:</b></td><td> eventos </td></tr>\n<tr><td><b>Description:</b></td><td> eventos </td></tr>\n<tr><td><b>Palabras clave:</b></td><td> 	turismo	latinpyme	proexport	construccion	economia	empresarios	exportaciones	industria	negocios	calzado </td></tr>\n</table>','http://latinpyme/mod/calendar/dayview.php?calendar_name=johanqnms&month=06&day=22&year=2007'),(18,'',1181849231,2,'costruccion','<table>\n<tr><td><b>Date:</b></td><td> Tue, 26 Jun 2007 </td></tr>\n<tr><td><b>Start Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>End Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>Location:</b></td><td> evento contruccion </td></tr>\n<tr><td><b>Description:</b></td><td> Contruccion </td></tr>\n<tr><td><b>Palabras clave:</b></td><td> 	construccion	economia	empresarios	exportaciones	industria	intereses	latinpyme	negocios	noticias	proexport	servicios	tecnologia	turismo	calzado </td></tr>\n</table>','http://latinpyme/mod/calendar/dayview.php?calendar_name=johanqnms&month=06&day=26&year=2007'),(19,'',1181849231,2,'tecnologia','<table>\n<tr><td><b>Date:</b></td><td> Wed, 27 Jun 2007 </td></tr>\n<tr><td><b>Start Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>End Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>Location:</b></td><td> tecnologia </td></tr>\n<tr><td><b>Description:</b></td><td> tecnologia </td></tr>\n<tr><td><b>Palabras clave:</b></td><td> 	construccion	economia	empresarios	exportaciones	industria	intereses	latinpyme	negocios	noticias	proexport	servicios	tecnologia	turismo	calzado </td></tr>\n</table>','http://latinpyme/mod/calendar/dayview.php?calendar_name=johanqnms&month=06&day=27&year=2007'),(20,'',1181849231,2,'latinoamerica','<table>\n<tr><td><b>Date:</b></td><td> Thu, 28 Jun 2007 </td></tr>\n<tr><td><b>Start Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>End Time:</b></td><td> 17:00:00 GMT </td></tr>\n<tr><td><b>Location:</b></td><td> latinoamerica </td></tr>\n<tr><td><b>Description:</b></td><td> proexport </td></tr>\n<tr><td><b>Palabras clave:</b></td><td> 	latinpyme	negocios	proexport	turismo	calzado </td></tr>\n</table>','http://latinpyme/mod/calendar/dayview.php?calendar_name=johanqnms&month=06&day=28&year=2007');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggfeed_posts` ENABLE KEYS */;

--
-- Table structure for table `elggfeed_subscriptions`
--

DROP TABLE IF EXISTS `elggfeed_subscriptions`;
CREATE TABLE `elggfeed_subscriptions` (
  `ident` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL default '0' COMMENT '-> users.ident',
  `feed_id` int(10) unsigned NOT NULL default '0' COMMENT '-> feeds.ident',
  `autopost` enum('yes','no') collate utf8_unicode_ci NOT NULL default 'no' COMMENT 'whether to insert into subscriber''s own blog',
  `autopost_tag` varchar(128) collate utf8_unicode_ci NOT NULL default '' COMMENT 'tag list to add to auto-posts',
  PRIMARY KEY  (`ident`),
  KEY `feed_id` (`feed_id`),
  KEY `user_id` (`user_id`),
  KEY `autopost` (`autopost`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggfeed_subscriptions`
--


/*!40000 ALTER TABLE `elggfeed_subscriptions` DISABLE KEYS */;
LOCK TABLES `elggfeed_subscriptions` WRITE;
INSERT INTO `elggfeed_subscriptions` VALUES (1,3,1,'no',''),(2,3,2,'no','latinpyme,textiles');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggfeed_subscriptions` ENABLE KEYS */;

--
-- Table structure for table `elggfeeds`
--

DROP TABLE IF EXISTS `elggfeeds`;
CREATE TABLE `elggfeeds` (
  `ident` int(10) unsigned NOT NULL auto_increment,
  `url` varchar(128) collate utf8_unicode_ci NOT NULL default '' COMMENT 'URL of actual feed',
  `feedtype` varchar(16) collate utf8_unicode_ci NOT NULL default '' COMMENT 'not used?',
  `name` text collate utf8_unicode_ci NOT NULL,
  `tagline` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `siteurl` varchar(128) collate utf8_unicode_ci NOT NULL default '' COMMENT 'URL of parent site/page',
  `last_updated` int(11) NOT NULL default '0' COMMENT 'unix timestamp',
  PRIMARY KEY  (`ident`),
  KEY `url` (`url`,`feedtype`),
  KEY `last_updates` (`last_updated`),
  KEY `siteurl` (`siteurl`),
  KEY `tagline` (`tagline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggfeeds`
--


/*!40000 ALTER TABLE `elggfeeds` DISABLE KEYS */;
LOCK TABLES `elggfeeds` WRITE;
INSERT INTO `elggfeeds` VALUES (1,'http://feeds.feedburner.com/treszero','','Tres Zero','Redes Sociales del Conocimiento WEB 2.0','http://treszero.wordpress.com',1181848675),(2,'http://latinpyme/johanqnms/calendar/rss','','Johan Quijano : Calendar','The calendar for Johan Quijano, hosted on LatinPyme.','http://latinpyme/johanqnms/calendar/',1181849231);
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggfeeds` ENABLE KEYS */;

--
-- Table structure for table `elggfile_folders`
--

DROP TABLE IF EXISTS `elggfile_folders`;
CREATE TABLE `elggfile_folders` (
  `ident` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL default '0' COMMENT '-> users.ident, folder creator',
  `files_owner` int(11) NOT NULL default '0' COMMENT '-> users.ident, folder owner (community)',
  `parent` int(11) NOT NULL default '0' COMMENT '-> file_folders.ident, parent folder',
  `name` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `access` varchar(20) collate utf8_unicode_ci NOT NULL default 'PUBLIC',
  `handler` varchar(32) collate utf8_unicode_ci NOT NULL default 'elgg',
  PRIMARY KEY  (`ident`),
  KEY `files_owner` (`files_owner`),
  KEY `owner` (`owner`),
  KEY `access` (`access`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggfile_folders`
--


/*!40000 ALTER TABLE `elggfile_folders` DISABLE KEYS */;
LOCK TABLES `elggfile_folders` WRITE;
INSERT INTO `elggfile_folders` VALUES (1,3,7,-1,'Viajes','LOGGED_IN','elgg'),(3,3,7,-1,'Logos','LOGGED_IN','elgg'),(4,3,3,-1,'Documentos','LOGGED_IN','elgg'),(5,3,3,-1,'Galeria','LOGGED_IN','photogallery'),(6,3,3,-1,'Videos','LOGGED_IN','elgg'),(7,3,3,-1,'Tutoriales','LOGGED_IN','elgg'),(8,3,4,-1,'Social Tres Zero','LOGGED_IN','elgg'),(9,3,4,-1,'Publicidad','LOGGED_IN','elgg'),(10,3,4,-1,'Mercadeo','LOGGED_IN','elgg');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggfile_folders` ENABLE KEYS */;

--
-- Table structure for table `elggfile_metadata`
--

DROP TABLE IF EXISTS `elggfile_metadata`;
CREATE TABLE `elggfile_metadata` (
  `ident` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `value` text collate utf8_unicode_ci NOT NULL,
  `file_id` int(11) NOT NULL default '0' COMMENT '-> files.ident',
  PRIMARY KEY  (`ident`),
  KEY `name` (`name`,`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggfile_metadata`
--


/*!40000 ALTER TABLE `elggfile_metadata` DISABLE KEYS */;
LOCK TABLES `elggfile_metadata` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggfile_metadata` ENABLE KEYS */;

--
-- Table structure for table `elggfiles`
--

DROP TABLE IF EXISTS `elggfiles`;
CREATE TABLE `elggfiles` (
  `ident` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL default '0' COMMENT '-> users.ident, file uploader',
  `files_owner` int(11) NOT NULL default '0' COMMENT '-> users.ident, file owner (community)',
  `folder` int(11) NOT NULL default '-1' COMMENT '-> file_folders.ident, parent folder',
  `community` int(11) NOT NULL default '-1' COMMENT 'not used?',
  `title` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `originalname` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `description` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `location` varchar(255) collate utf8_unicode_ci NOT NULL default '' COMMENT 'file location in dataroot',
  `access` varchar(20) collate utf8_unicode_ci NOT NULL default 'PUBLIC',
  `size` int(11) NOT NULL default '0' COMMENT 'bytes',
  `time_uploaded` int(11) NOT NULL default '0' COMMENT 'unix timestamp',
  `handler` varchar(32) collate utf8_unicode_ci NOT NULL default 'elgg',
  PRIMARY KEY  (`ident`),
  KEY `owner` (`owner`,`folder`,`access`),
  KEY `size` (`size`),
  KEY `time_uploaded` (`time_uploaded`),
  KEY `originalname` (`originalname`),
  KEY `community` (`community`),
  KEY `files_owner` (`files_owner`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggfiles`
--


/*!40000 ALTER TABLE `elggfiles` DISABLE KEYS */;
LOCK TABLES `elggfiles` WRITE;
INSERT INTO `elggfiles` VALUES (1,3,3,5,-1,'','pepsi.JPG','','files/j/johanqnms/pepsi.JPG','PUBLIC',3708,1181754653,'elgg'),(2,3,7,3,-1,'Logo Tres Zero','LOGO3Zerosmaill.JPG','Logo','files/c/calzachile/LOGO3Zerosmaill.JPG','LOGGED_IN',27226,1181755180,'elgg'),(3,3,7,1,-1,'Escudo Colombia','Presentaci%c3%b3n_DIH_y_Convencion_Ottawa[1].ppt','','files/c/calzachile/Presentaci_c3_b3n_DIH_y_Convencion_Ottawa_1_.ppt','LOGGED_IN',552960,1181755285,'elgg'),(4,3,3,5,-1,'Spy','1.jpg','Fotografia','files/j/johanqnms/1.jpg','LOGGED_IN',712373,1181834724,'elgg'),(5,3,4,-1,-1,'Visita Empresarial','5.jpg','Foto Empresarios Colombia','files/w/web/5.jpg','LOGGED_IN',93335,1181840316,'elgg'),(6,3,3,4,-1,'fotos','2.jpg','Salida Empresarial','files/j/johanqnms/2.jpg','LOGGED_IN',364525,1181847913,'elgg'),(7,3,3,-1,-1,'Envios','12.4.2007 г. 12_12_0001.jpg','Envios Vida Actual','files/j/johanqnms/12.4.2007_._12_12_0001.jpg','LOGGED_IN',156959,1181848571,'elgg');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggfiles` ENABLE KEYS */;

--
-- Table structure for table `elggfiles_incoming`
--

DROP TABLE IF EXISTS `elggfiles_incoming`;
CREATE TABLE `elggfiles_incoming` (
  `ident` int(10) unsigned NOT NULL auto_increment,
  `installid` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `intentiondate` int(11) unsigned NOT NULL default '0',
  `size` bigint(20) unsigned NOT NULL default '0',
  `foldername` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `user_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ident`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggfiles_incoming`
--


/*!40000 ALTER TABLE `elggfiles_incoming` DISABLE KEYS */;
LOCK TABLES `elggfiles_incoming` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggfiles_incoming` ENABLE KEYS */;

--
-- Table structure for table `elggfriends`
--

DROP TABLE IF EXISTS `elggfriends`;
CREATE TABLE `elggfriends` (
  `ident` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL default '0' COMMENT '-> users.ident, doing the friending',
  `friend` int(11) NOT NULL default '0' COMMENT '-> users.ident, being friended',
  `status` varchar(4) collate utf8_unicode_ci NOT NULL default 'perm' COMMENT 'not used?',
  PRIMARY KEY  (`ident`),
  KEY `owner` (`owner`),
  KEY `friend` (`friend`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggfriends`
--


/*!40000 ALTER TABLE `elggfriends` DISABLE KEYS */;
LOCK TABLES `elggfriends` WRITE;
INSERT INTO `elggfriends` VALUES (1,0,2,'perm'),(2,2,0,'perm'),(3,2,1,'perm'),(4,0,3,'perm'),(5,3,0,'perm'),(6,3,1,'perm'),(7,3,4,'perm'),(16,3,2,'perm'),(10,2,3,'perm'),(11,2,5,'perm'),(12,3,6,'perm'),(13,2,6,'perm'),(14,3,7,'perm'),(15,2,7,'perm'),(17,1,2,'perm');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggfriends` ENABLE KEYS */;

--
-- Table structure for table `elggfriends_requests`
--

DROP TABLE IF EXISTS `elggfriends_requests`;
CREATE TABLE `elggfriends_requests` (
  `ident` int(10) unsigned NOT NULL auto_increment,
  `owner` int(11) NOT NULL COMMENT '-> users.ident, doing the friending',
  `friend` int(11) NOT NULL COMMENT '-> users.ident, being friended',
  PRIMARY KEY  (`ident`),
  KEY `owner` (`owner`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggfriends_requests`
--


/*!40000 ALTER TABLE `elggfriends_requests` DISABLE KEYS */;
LOCK TABLES `elggfriends_requests` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggfriends_requests` ENABLE KEYS */;

--
-- Table structure for table `elgggroup_membership`
--

DROP TABLE IF EXISTS `elgggroup_membership`;
CREATE TABLE `elgggroup_membership` (
  `ident` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0' COMMENT '-> users.ident',
  `group_id` int(11) NOT NULL default '0' COMMENT '-> groups.ident',
  PRIMARY KEY  (`ident`),
  KEY `user_id` (`user_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elgggroup_membership`
--


/*!40000 ALTER TABLE `elgggroup_membership` DISABLE KEYS */;
LOCK TABLES `elgggroup_membership` WRITE;
INSERT INTO `elgggroup_membership` VALUES (1,2,1),(2,4,1);
UNLOCK TABLES;
/*!40000 ALTER TABLE `elgggroup_membership` ENABLE KEYS */;

--
-- Table structure for table `elgggroups`
--

DROP TABLE IF EXISTS `elgggroups`;
CREATE TABLE `elgggroups` (
  `ident` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL default '0' COMMENT '-> users.ident',
  `name` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `access` varchar(20) collate utf8_unicode_ci NOT NULL default 'PUBLIC',
  PRIMARY KEY  (`ident`),
  KEY `owner` (`owner`,`name`),
  KEY `access` (`access`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elgggroups`
--


/*!40000 ALTER TABLE `elgggroups` DISABLE KEYS */;
LOCK TABLES `elgggroups` WRITE;
INSERT INTO `elgggroups` VALUES (1,3,'Grupo Empresarial WEB 2.0','PUBLIC');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elgggroups` ENABLE KEYS */;

--
-- Table structure for table `elggicons`
--

DROP TABLE IF EXISTS `elggicons`;
CREATE TABLE `elggicons` (
  `ident` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL default '0' COMMENT '-> users.ident',
  `filename` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `description` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`ident`),
  KEY `owner` (`owner`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggicons`
--


/*!40000 ALTER TABLE `elggicons` DISABLE KEYS */;
LOCK TABLES `elggicons` WRITE;
INSERT INTO `elggicons` VALUES (1,3,'67.jpg',''),(2,4,'logo_microsoft.JPG','http://johanqnms.googlepages.com/LOGO3Zerosmaill.JPG'),(3,2,'gustav.png','Gustavo'),(4,6,'pepsi.JPG',''),(5,7,'chile.JPG','');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggicons` ENABLE KEYS */;

--
-- Table structure for table `elgginvitations`
--

DROP TABLE IF EXISTS `elgginvitations`;
CREATE TABLE `elgginvitations` (
  `ident` int(11) NOT NULL auto_increment,
  `name` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `email` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `code` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `owner` int(11) NOT NULL default '0' COMMENT '-> users.ident, sender of invitation',
  `added` int(11) NOT NULL default '0' COMMENT 'unix timestamp',
  PRIMARY KEY  (`ident`),
  KEY `code` (`code`),
  KEY `email` (`email`),
  KEY `added` (`added`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elgginvitations`
--


/*!40000 ALTER TABLE `elgginvitations` DISABLE KEYS */;
LOCK TABLES `elgginvitations` WRITE;
INSERT INTO `elgginvitations` VALUES (3,'Gustavo González','xtingray@gmail.com','iarbvx32',0,1181777530),(4,'Gustavo González','xtingray@hotmail.com','ie7z3ta4',0,1181777815),(5,'Andrea','andreaximena@gmail.com','ieidq71x',3,1181835101);
UNLOCK TABLES;
/*!40000 ALTER TABLE `elgginvitations` ENABLE KEYS */;

--
-- Table structure for table `elggmessages`
--

DROP TABLE IF EXISTS `elggmessages`;
CREATE TABLE `elggmessages` (
  `ident` int(11) NOT NULL auto_increment,
  `title` text collate utf8_unicode_ci NOT NULL,
  `body` text collate utf8_unicode_ci NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `posted` int(11) NOT NULL,
  `status` enum('read','unread') collate utf8_unicode_ci NOT NULL default 'unread',
  `hidden_from` enum('1','0') collate utf8_unicode_ci NOT NULL default '0',
  `hidden_to` enum('1','0') collate utf8_unicode_ci NOT NULL default '0',
  PRIMARY KEY  (`ident`),
  KEY `from` (`from_id`,`to_id`,`posted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggmessages`
--


/*!40000 ALTER TABLE `elggmessages` DISABLE KEYS */;
LOCK TABLES `elggmessages` WRITE;
INSERT INTO `elggmessages` VALUES (1,'New LatinPyme friend','Gustavo González has added you as a friend!\n\nTo visit this user\'s profile, click on the following link:\n\n	http://latinpyme/spy/\n\nTo view all your friends, click here:\n\n	http://latinpyme/johanqnms/friends/\n\nRegards,\n\nThe LatinPyme team.',-1,3,1181751891,'read','0','1'),(2,'Nuevo Textiles miembro','Gustavo González has joined Textiles!\n\nTo visit this user\'s profile, click on the following link:\n\n	http://latinpyme/spy/\n\nTo view all community members, click here:\n\n	http://latinpyme/_communities/members.php?owner=5\n\nRegards,\n\nThe LatinPyme team.',-1,2,1181752924,'unread','0','0'),(3,'Nuevo LatinPyme amigo','Johan Quijano te ha añadido como un amigo!\n\nPara visitar el perfil de este usuario, visite el siguiente enlace:\n\n	http://latinpyme/johanqnms/\n\nPara ver a todos sus amigos, haga click aqui:\n\n	http://latinpyme/spy/friends/\n\nSaludos,\n\nEl equipo LatinPyme.',-1,2,1181757679,'read','0','0'),(4,'Hagamos negocios!','Se apunta!',2,3,1181789403,'read','0','0'),(5,'New LatinPyme friend','News has added you as a friend!\n\nTo visit this user\'s profile, click on the following link:\n\n	http://latinpyme/news/\n\nTo view all your friends, click here:\n\n	http://latinpyme/spy/friends/\n\nRegards,\n\nThe LatinPyme team.',-1,2,1181789595,'unread','0','0'),(6,'Mensaje de prueba','Hagamos negocios!',1,2,1181789623,'read','0','0'),(7,'Bug -- Leer','<p>Como no tenia internet en el tecno, entonces por este lado. Encontre no un error si no mas bien un detalle,...</p><p>&nbsp;</p><p>Estaba navegando por &quot;mi blog&quot;&nbsp; , luego fui a los blog de &quot;mis amigos&quot;, y realice un comentario. pero a la hora de enviarlo aparecieron dos.</p><p>Ademas a la hora de regresar despues de enviar el mensaje de opinion en el blog, termine en la red sociedad latino... de expo... no se como y me toco devolverme por &quot;mi blog&quot;. La idea es que es confuso. Mirar navegabilidad.&nbsp;</p><p>&nbsp;</p>',3,2,1181834146,'unread','0','0'),(8,'Bug en Calendario','<p>Entro a &quot;mi calendario&quot;selecciono un dia, luego creo un nuevo evento y lo agrego. Despues aparece una ventana donde esta la descripcion del evento. Le doy click en exportar y sale: </p><p>&nbsp;</p><p><strong>Warning</strong>:  fopen(/usr/local/apache/tmp/data/export/johanqnms_Conferencia_--_Corfe.ics) [<a href=\"http:///mod/calendar/function.fopen\">function.fopen</a>]: failed to open stream: No such file or directory in <strong>/usr/local/apache/tmp/mod/calendar/export.php</strong> on line <strong>88</strong><br /> <br /> <strong>Warning</strong>:  fwrite(): supplied argument is not a valid stream resource in <strong>/usr/local/apache/tmp/mod/calendar/export.php</strong> on line <strong>91</strong><br /> Cannot write file </p>',3,1,1181834338,'unread','0','0'),(9,'Subida de Archivos','<p>Cuando se suben archivos en la misma pagina aparece:</p><p>Crear Carpeta</p><p>Subir archivos</p><p>&nbsp;</p><p>Deberian estar separados,,,,, &nbsp;</p>',3,2,1181834611,'unread','0','0'),(10,'Invitaciones','<p>La parte de invitar a un amigo es lo mas importante de las redes sociales, Marketing viral y demas...</p><p>&nbsp;</p><p>Esta muy oculto, pendiente colocar por lo menos en la primera pagina despues del logeo como en Xing, neurona etc.... </p><p>&nbsp;</p><p>http://latinpyme/_invite/&nbsp;</p>',3,2,1181835053,'unread','0','0'),(11,'Feeds','cuando uno se subcribe a un feed ya sea del portal o externo, aparecen unos botones visualmente feos verdes y anaranjado',3,2,1181836246,'unread','0','0'),(12,'Bug -- Editar post BLOG','<p>Cree un nuevo port para &quot;mi blog&quot;. Luego cuando fue creado le di click en &quot;editar&quot; para cambiarle el titulo.</p><p>&nbsp;</p><p>En la parte superior aparecio:&nbsp;</p><p>&nbsp;</p><p><br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong><br /> <br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong><br /> <br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong><br /> <br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong><br /> <br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong><br /> <br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong><br /> <br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong><br /> <br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong><br /> <br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong><br /> <br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong><br /> <br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong><br /> <br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong><br /> <br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong><br /> <br /> <strong>Warning</strong>:  in_array() [<a href=\"http:///weblog/edit/function.in-array\">function.in-array</a>]: Wrong datatype for second argument in <strong>/usr/local/apache/tmp/mod/blog/lib/weblogs_posts_edit.php</strong> on line <strong>36</strong> </p>',3,2,1181837025,'unread','0','0'),(13,'Apunte','<p>Enlace &quot;social&quot;</p><p>&nbsp;</p><p>Fotos de los eventos, propios, latinpyme, conferencias, etc ...</p>',3,2,1181839584,'unread','0','0'),(14,'Widget -- Archivos','El widget de archivos no funciona. No muestra los archivos subidos por el usuarios',3,2,1181848367,'unread','0','0');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggmessages` ENABLE KEYS */;

--
-- Table structure for table `elggpassword_requests`
--

DROP TABLE IF EXISTS `elggpassword_requests`;
CREATE TABLE `elggpassword_requests` (
  `ident` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL default '0' COMMENT '-> users.ident',
  `code` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`ident`),
  KEY `owner` (`owner`,`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggpassword_requests`
--


/*!40000 ALTER TABLE `elggpassword_requests` DISABLE KEYS */;
LOCK TABLES `elggpassword_requests` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggpassword_requests` ENABLE KEYS */;

--
-- Table structure for table `elggprofile_data`
--

DROP TABLE IF EXISTS `elggprofile_data`;
CREATE TABLE `elggprofile_data` (
  `ident` int(10) unsigned NOT NULL auto_increment,
  `owner` int(10) unsigned NOT NULL default '0' COMMENT '-> users.ident',
  `access` varchar(20) collate utf8_unicode_ci NOT NULL default 'PUBLIC',
  `name` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `value` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ident`),
  KEY `owner` (`owner`,`access`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggprofile_data`
--


/*!40000 ALTER TABLE `elggprofile_data` DISABLE KEYS */;
LOCK TABLES `elggprofile_data` WRITE;
INSERT INTO `elggprofile_data` VALUES (78,3,'PUBLIC','minibio','Gerente General'),(12,5,'PUBLIC','biography','Esta comunidad esta orientada al sector de los textiles.'),(101,4,'PUBLIC','biography','Redes Sociales\r\n\r\nWEB 2.0\r\n\r\nDesarrollo WEB'),(14,2,'PUBLIC','biography','Emprendedor del Parque Tecnologico del Software.'),(15,2,'PUBLIC','minibio','Gerente General - Soluciones Kazak Ltda'),(16,2,'PUBLIC','interests','Emprendimiento, Tecnología, Negocios, Software Libre'),(17,2,'LOGGED_IN','goals','Generar contactos para'),(77,3,'PUBLIC','biography','Tres Zero\r\nWEB 2.0\r\n\r\nRedes Sociales del Conomimiento\r\n\r\nMarketing \r\n\r\nPublicidad Online'),(79,3,'PUBLIC','interests','Comunidades Online, Desarrollo WEB, Redes Sociales'),(80,3,'PUBLIC','likes','Conferencias, Cursos Virtuales, e - commerce, e - Learning, Eventos, listas de correo, Seminariosm, web 2.0'),(81,3,'LOGGED_IN','goals','Comunidad Empresarial, Emprendimiento, Empresarios, Redes Sociales'),(82,3,'LOGGED_IN','skills','Desarrollo WEB, Marketing, Publicidad'),(83,3,'LOGGED_IN','streetaddress','Cll 54 Nº 10 - 39'),(84,3,'LOGGED_IN','town','Bogotá'),(85,3,'LOGGED_IN','country','Colombia'),(86,3,'LOGGED_IN','emailaddress','treszerocolombia@gmail.com'),(87,3,'LOGGED_IN','workphone','6976138'),(88,3,'LOGGED_IN','mobphone','3172374608'),(89,3,'LOGGED_IN','workweb','www.treszero.com'),(90,3,'LOGGED_IN','personalweb','www.treszero.wordpress.com'),(91,3,'LOGGED_IN','msn','treszerocolombia@gmail.com'),(92,3,'LOGGED_IN','skype','treszero'),(93,3,'LOGGED_IN','occupation','Ingeniero de Sistemas'),(94,3,'LOGGED_IN','industry','Desarrollo WEB, Software'),(95,3,'LOGGED_IN','organisation','Tres Zero'),(96,3,'LOGGED_IN','jobtitle','Gerente'),(97,3,'LOGGED_IN','jobdescription','Administracion Tres Zero'),(98,3,'LOGGED_IN','educationlevel','Universitario'),(99,3,'LOGGED_IN','university','Universidad Distrital'),(100,3,'LOGGED_IN','universitydegree','Ingeniero de Sistemas'),(102,4,'LOGGED_IN','minibio','Redes Sociales del Conocimiento'),(103,4,'LOGGED_IN','interests','Empresas, Emprendimiento, negocios, negocios internacionales, publicidad , mercadeo'),(104,4,'LOGGED_IN','likes','WEB 2.0, redes sociales, conocimiento,'),(105,4,'LOGGED_IN','goals','Emprendedores, empresas 2.0,redes sociales'),(106,4,'LOGGED_IN','skills','Redes sociales, emprendimiento, programacion neurolinguistica, publicidad, mercadeo'),(153,6,'PUBLIC','biography','Socieda Latinoamerica de Exportadores\r\n\r\nExportadores Latinoamericanos'),(154,6,'LOGGED_IN','minibio','Exportaciones, importaciones, aduanas nacionales'),(155,6,'LOGGED_IN','interests','empresas exportadores, Empresas Latinoamerica, pymes'),(156,6,'LOGGED_IN','likes','latinoamerica, mipymes, pymes'),(157,6,'LOGGED_IN','goals','red de exportadores'),(158,6,'LOGGED_IN','skills','exportaciones, importaciones, pymes'),(128,7,'LOGGED_IN','biography','Calzado\r\n\r\nIndustria del Calzado'),(129,7,'LOGGED_IN','minibio','Industria del Calzado Argentina'),(130,7,'LOGGED_IN','interests','Calzado, cuero, proveedores, reglamentaciones, tintas'),(131,7,'LOGGED_IN','likes','Calzado, cuero, proveedores, reglamentaciones, tintas'),(132,7,'LOGGED_IN','goals','red de proveedores, redes social del calzado'),(133,7,'LOGGED_IN','skills','calzado'),(134,7,'LOGGED_IN','streetaddress','Cll 100 Nº 25 - 40 Suroeste'),(135,7,'LOGGED_IN','town','Ciudad de Mexico'),(136,7,'LOGGED_IN','country','Mexico'),(137,7,'LOGGED_IN','emailaddress','calzado@mexicocalzado.com'),(138,7,'LOGGED_IN','workphone','223-459568234'),(139,7,'LOGGED_IN','homephone','433-48598439'),(140,7,'LOGGED_IN','mobphone','34-43945934'),(141,7,'LOGGED_IN','workweb','www.calzadomexico.com'),(142,7,'LOGGED_IN','personalweb','www.blogcalzadomexico.com'),(143,7,'LOGGED_IN','skype','calzadomexico'),(159,6,'LOGGED_IN','streetaddress','Avenida43 Nº 39 -- Este W'),(160,6,'LOGGED_IN','town','Buenos Aires'),(161,6,'LOGGED_IN','country','Argentina'),(162,6,'LOGGED_IN','emailaddress','sociedadexportadores@exportadores.com'),(163,6,'LOGGED_IN','workphone','432-4358938'),(164,6,'LOGGED_IN','homephone','45-453455454'),(165,6,'LOGGED_IN','mobphone','45-56456567'),(166,6,'LOGGED_IN','workweb','www.sociedadexportadores.com'),(167,6,'LOGGED_IN','msn','exportadores@hotmail.com');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggprofile_data` ENABLE KEYS */;

--
-- Table structure for table `elggtags`
--

DROP TABLE IF EXISTS `elggtags`;
CREATE TABLE `elggtags` (
  `ident` int(11) NOT NULL auto_increment,
  `tag` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `tagtype` varchar(20) collate utf8_unicode_ci NOT NULL default '' COMMENT 'type of object the tag links to',
  `ref` int(11) NOT NULL default '0' COMMENT 'ident of object the tag links to',
  `access` varchar(20) collate utf8_unicode_ci NOT NULL default 'PUBLIC',
  `owner` int(11) NOT NULL default '0' COMMENT '-> users.ident',
  PRIMARY KEY  (`ident`),
  KEY `owner` (`owner`),
  KEY `tagtype_ref` (`tagtype`,`ref`),
  KEY `tagliteral` (`tag`(20)),
  KEY `access` (`access`),
  FULLTEXT KEY `tag` (`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggtags`
--


/*!40000 ALTER TABLE `elggtags` DISABLE KEYS */;
LOCK TABLES `elggtags` WRITE;
INSERT INTO `elggtags` VALUES (112,'Comunidad Empresarial','goals',81,'LOGGED_IN',3),(4,'Negocios','interests',16,'PUBLIC',2),(5,'Software Libre','interests',16,'PUBLIC',2),(6,'Tecnología','interests',16,'PUBLIC',2),(7,'Emprendimiento','interests',16,'PUBLIC',2),(8,'Generar contactos para','goals',17,'LOGGED_IN',2),(100,'Comunidades Online','interests',79,'PUBLIC',3),(107,'web 2.0','likes',80,'PUBLIC',3),(108,'Conferencias','likes',80,'PUBLIC',3),(106,'listas de correo','likes',80,'PUBLIC',3),(105,'e - commerce','likes',80,'PUBLIC',3),(104,'e - Learning','likes',80,'PUBLIC',3),(103,'Seminariosm','likes',80,'PUBLIC',3),(115,'Desarrollo WEB','skills',82,'LOGGED_IN',3),(114,'Publicidad','skills',82,'LOGGED_IN',3),(99,'Redes Sociales','interests',79,'PUBLIC',3),(98,'Desarrollo WEB','interests',79,'PUBLIC',3),(102,'Eventos','likes',80,'PUBLIC',3),(111,'Redes Sociales','goals',81,'LOGGED_IN',3),(110,'Empresarios','goals',81,'LOGGED_IN',3),(109,'Emprendimiento','goals',81,'LOGGED_IN',3),(101,'Cursos Virtuales','likes',80,'PUBLIC',3),(113,'Marketing','skills',82,'LOGGED_IN',3),(116,'Bogotá','town',84,'LOGGED_IN',3),(117,'Colombia','country',85,'LOGGED_IN',3),(119,'Desarrollo WEB','industry',94,'LOGGED_IN',3),(118,'Software','industry',94,'LOGGED_IN',3),(120,'administracion','weblog',5,'LOGGED_IN',3),(121,'clientes','weblog',5,'LOGGED_IN',3),(122,'contactos','weblog',5,'LOGGED_IN',3),(123,'empresas','weblog',5,'LOGGED_IN',3),(124,'mercadeo','weblog',5,'LOGGED_IN',3),(125,'publicidad','weblog',5,'LOGGED_IN',3),(126,'redes sociales','weblog',5,'LOGGED_IN',3),(127,'web 2.0','weblog',5,'LOGGED_IN',3),(128,'Administracion','weblogcat',3,'PUBLIC',3),(129,'mercadeo','weblogcat',3,'PUBLIC',3),(130,'publicidad','weblogcat',3,'PUBLIC',3),(131,'web 2.0','weblogcat',3,'PUBLIC',3),(132,'corferias','calendar',1,'PUBLIC',3),(133,'servicios','calendar',1,'PUBLIC',3),(134,'conferencia','calendar',1,'PUBLIC',3),(135,'camara','calendar',2,'PUBLIC',3),(136,'documentos','folder',4,'LOGGED_IN',3),(138,'fotografia','file',4,'LOGGED_IN',3),(139,'mercadeo','weblog',6,'LOGGED_IN',3),(140,'publicidad','weblog',6,'LOGGED_IN',3),(141,'redes sociales','weblog',6,'LOGGED_IN',3),(142,'web 2.0','weblog',6,'LOGGED_IN',3),(143,'empresas 2.0','weblog',6,'LOGGED_IN',3),(144,'empresas 2.0','weblog',2,'LOGGED_IN',3),(145,'firefox','weblog',2,'LOGGED_IN',3),(146,'mercadeo','weblog',2,'LOGGED_IN',3),(147,'publicidad','weblog',2,'LOGGED_IN',3),(148,'redes sociales','weblog',2,'LOGGED_IN',3),(149,'tecnologia','weblog',2,'LOGGED_IN',3),(150,'desarrollo web','calendar',3,'user3',3),(151,'empresas 2.0','calendar',3,'user3',3),(152,'redes sociales','calendar',3,'user3',3),(153,'web 2.0','calendar',3,'user3',3),(154,'conferencia','calendar',3,'user3',3),(155,'tecnoparque','weblog',7,'LOGGED_IN',3),(156,'emprendimiento','weblog',7,'LOGGED_IN',3),(157,'empresas 2.0','weblog',7,'LOGGED_IN',3),(158,'redes sociales','weblog',7,'LOGGED_IN',3),(159,'Emprendimiento','interests',103,'LOGGED_IN',4),(160,'mercadeo','interests',103,'LOGGED_IN',4),(161,'negocios','interests',103,'LOGGED_IN',4),(162,'negocios internacionales','interests',103,'LOGGED_IN',4),(163,'publicidad','interests',103,'LOGGED_IN',4),(164,'Empresas','interests',103,'LOGGED_IN',4),(165,'conocimiento','likes',104,'LOGGED_IN',4),(166,'redes sociales','likes',104,'LOGGED_IN',4),(167,'WEB 2.0','likes',104,'LOGGED_IN',4),(168,'empresas 2.0','goals',105,'LOGGED_IN',4),(169,'Emprendedores','goals',105,'LOGGED_IN',4),(170,'redes sociales','goals',105,'LOGGED_IN',4),(171,'emprendimiento','skills',106,'LOGGED_IN',4),(172,'mercadeo','skills',106,'LOGGED_IN',4),(173,'programacion neurolinguistica','skills',106,'LOGGED_IN',4),(174,'publicidad','skills',106,'LOGGED_IN',4),(175,'Redes sociales','skills',106,'LOGGED_IN',4),(176,'comunidad','calendar',4,'PUBLIC',3),(177,'empresarios','calendar',4,'PUBLIC',3),(178,'empresas 2.0','calendar',4,'PUBLIC',3),(179,'online','calendar',4,'PUBLIC',3),(180,'mercadeo','calendar',4,'PUBLIC',3),(181,'publicidad','calendar',4,'PUBLIC',3),(182,'redes sociales','calendar',4,'PUBLIC',3),(183,'construccion','weblog',8,'LOGGED_IN',3),(184,'economia','weblog',8,'LOGGED_IN',3),(185,'empresarios','weblog',8,'LOGGED_IN',3),(186,'exportaciones','weblog',8,'LOGGED_IN',3),(187,'industria','weblog',8,'LOGGED_IN',3),(188,'intereses','weblog',8,'LOGGED_IN',3),(189,'latinpyme','weblog',8,'LOGGED_IN',3),(190,'negocios','weblog',8,'LOGGED_IN',3),(191,'noticias','weblog',8,'LOGGED_IN',3),(192,'servicios','weblog',8,'LOGGED_IN',3),(193,'tecnologia','weblog',8,'LOGGED_IN',3),(194,'turismo','weblog',8,'LOGGED_IN',3),(195,'calzado','weblog',8,'LOGGED_IN',3),(196,'proexport','weblog',8,'LOGGED_IN',3),(221,'servicios','weblog',9,'LOGGED_IN',3),(220,'proexport','weblog',9,'LOGGED_IN',3),(219,'noticias','weblog',9,'LOGGED_IN',3),(218,'negocios','weblog',9,'LOGGED_IN',3),(217,'latinpyme','weblog',9,'LOGGED_IN',3),(216,'intereses','weblog',9,'LOGGED_IN',3),(215,'industria','weblog',9,'LOGGED_IN',3),(214,'exportaciones','weblog',9,'LOGGED_IN',3),(213,'empresarios','weblog',9,'LOGGED_IN',3),(212,'economia','weblog',9,'LOGGED_IN',3),(211,'construccion','weblog',9,'LOGGED_IN',3),(222,'tecnologia','weblog',9,'LOGGED_IN',3),(223,'turismo','weblog',9,'LOGGED_IN',3),(224,'calzado','weblog',9,'LOGGED_IN',3),(225,'construccion','calendar',5,'PUBLIC',3),(226,'economia','calendar',5,'PUBLIC',3),(227,'empresarios','calendar',5,'PUBLIC',3),(228,'exportaciones','calendar',5,'PUBLIC',3),(229,'industria','calendar',5,'PUBLIC',3),(230,'intereses','calendar',5,'PUBLIC',3),(231,'latinpyme','calendar',5,'PUBLIC',3),(232,'negocios','calendar',5,'PUBLIC',3),(233,'noticias','calendar',5,'PUBLIC',3),(234,'proexport','calendar',5,'PUBLIC',3),(235,'servicios','calendar',5,'PUBLIC',3),(236,'tecnologia','calendar',5,'PUBLIC',3),(237,'turismo','calendar',5,'PUBLIC',3),(238,'calzado','calendar',5,'PUBLIC',3),(239,'construccion','calendar',6,'PUBLIC',3),(240,'economia','calendar',6,'PUBLIC',3),(241,'empresarios','calendar',6,'PUBLIC',3),(242,'exportaciones','calendar',6,'PUBLIC',3),(243,'industria','calendar',6,'PUBLIC',3),(244,'intereses','calendar',6,'PUBLIC',3),(245,'latinpyme','calendar',6,'PUBLIC',3),(246,'negocios','calendar',6,'PUBLIC',3),(247,'noticias','calendar',6,'PUBLIC',3),(248,'proexport','calendar',6,'PUBLIC',3),(249,'servicios','calendar',6,'PUBLIC',3),(250,'tecnologia','calendar',6,'PUBLIC',3),(251,'turismo','calendar',6,'PUBLIC',3),(252,'calzado','calendar',6,'PUBLIC',3),(253,'construccion','calendar',7,'PUBLIC',3),(254,'economia','calendar',7,'PUBLIC',3),(255,'empresarios','calendar',7,'PUBLIC',3),(256,'exportaciones','calendar',7,'PUBLIC',3),(257,'negocios','calendar',7,'PUBLIC',3),(258,'proexport','calendar',7,'PUBLIC',3),(259,'tecnologia','calendar',7,'PUBLIC',3),(260,'turismo','calendar',7,'PUBLIC',3),(261,'calzado','calendar',7,'PUBLIC',3),(262,'latinpyme','calendar',7,'PUBLIC',3),(263,'construccion','calendar',8,'PUBLIC',3),(264,'economia','calendar',8,'PUBLIC',3),(265,'empresarios','calendar',8,'PUBLIC',3),(266,'exportaciones','calendar',8,'PUBLIC',3),(267,'industria','calendar',8,'PUBLIC',3),(268,'intereses','calendar',8,'PUBLIC',3),(269,'latinpyme','calendar',8,'PUBLIC',3),(270,'negocios','calendar',8,'PUBLIC',3),(271,'noticias','calendar',8,'PUBLIC',3),(272,'proexport','calendar',8,'PUBLIC',3),(273,'servicios','calendar',8,'PUBLIC',3),(274,'tecnologia','calendar',8,'PUBLIC',3),(275,'turismo','calendar',8,'PUBLIC',3),(276,'calzado','calendar',8,'PUBLIC',3),(277,'turismo','calendar',9,'PUBLIC',3),(278,'latinpyme','calendar',9,'PUBLIC',3),(279,'proexport','calendar',9,'PUBLIC',3),(280,'construccion','calendar',9,'PUBLIC',3),(281,'economia','calendar',9,'PUBLIC',3),(282,'empresarios','calendar',9,'PUBLIC',3),(283,'exportaciones','calendar',9,'PUBLIC',3),(284,'industria','calendar',9,'PUBLIC',3),(285,'negocios','calendar',9,'PUBLIC',3),(286,'calzado','calendar',9,'PUBLIC',3),(287,'turismo','calendar',10,'PUBLIC',3),(288,'latinpyme','calendar',10,'PUBLIC',3),(289,'proexport','calendar',10,'PUBLIC',3),(290,'construccion','calendar',10,'PUBLIC',3),(291,'economia','calendar',10,'PUBLIC',3),(292,'empresarios','calendar',10,'PUBLIC',3),(293,'exportaciones','calendar',10,'PUBLIC',3),(294,'industria','calendar',10,'PUBLIC',3),(295,'negocios','calendar',10,'PUBLIC',3),(296,'calzado','calendar',10,'PUBLIC',3),(297,'exportaciones','calendar',11,'PUBLIC',3),(298,'turismo','calendar',11,'PUBLIC',3),(299,'latinpyme','calendar',11,'PUBLIC',3),(300,'proexport','calendar',11,'PUBLIC',3),(301,'industria','calendar',11,'PUBLIC',3),(302,'negocios','calendar',11,'PUBLIC',3),(303,'calzado','calendar',11,'PUBLIC',3),(304,'exportaciones','calendar',12,'PUBLIC',3),(305,'turismo','calendar',12,'PUBLIC',3),(306,'latinpyme','calendar',12,'PUBLIC',3),(307,'proexport','calendar',12,'PUBLIC',3),(308,'industria','calendar',12,'PUBLIC',3),(309,'negocios','calendar',12,'PUBLIC',3),(310,'calzado','calendar',12,'PUBLIC',3),(311,'latinpyme','calendar',13,'PUBLIC',3),(312,'turismo','calendar',13,'PUBLIC',3),(313,'proexport','calendar',13,'PUBLIC',3),(314,'negocios','calendar',13,'PUBLIC',3),(315,'calzado','calendar',13,'PUBLIC',3),(316,'latinpyme','calendar',14,'PUBLIC',3),(317,'negocios','calendar',14,'PUBLIC',3),(318,'proexport','calendar',14,'PUBLIC',3),(319,'turismo','calendar',14,'PUBLIC',3),(320,'calzado','calendar',14,'PUBLIC',3),(321,'latinpyme','weblog',10,'LOGGED_IN',3),(322,'negocios','weblog',10,'LOGGED_IN',3),(323,'proexport','weblog',10,'LOGGED_IN',3),(324,'turismo','weblog',10,'LOGGED_IN',3),(325,'calzado','weblog',10,'LOGGED_IN',3),(326,'latinpyme','weblog',11,'LOGGED_IN',3),(327,'negocios','weblog',11,'LOGGED_IN',3),(328,'proexport','weblog',11,'LOGGED_IN',3),(329,'turismo','weblog',11,'LOGGED_IN',3),(330,'calzado','weblog',11,'LOGGED_IN',3),(397,'pymes','interests',155,'LOGGED_IN',6),(398,'empresas exportadores','interests',155,'LOGGED_IN',6),(401,'latinoamerica','likes',156,'LOGGED_IN',6),(400,'pymes','likes',156,'LOGGED_IN',6),(399,'mipymes','likes',156,'LOGGED_IN',6),(402,'red de exportadores','goals',157,'LOGGED_IN',6),(405,'exportaciones','skills',158,'LOGGED_IN',6),(404,'pymes','skills',158,'LOGGED_IN',6),(403,'importaciones','skills',158,'LOGGED_IN',6),(373,'Calzado','interests',130,'LOGGED_IN',7),(371,'reglamentaciones','interests',130,'LOGGED_IN',7),(372,'tintas','interests',130,'LOGGED_IN',7),(377,'tintas','likes',131,'LOGGED_IN',7),(376,'reglamentaciones','likes',131,'LOGGED_IN',7),(380,'red de proveedores','goals',132,'LOGGED_IN',7),(379,'redes social del calzado','goals',132,'LOGGED_IN',7),(381,'calzado','skills',133,'LOGGED_IN',7),(370,'proveedores','interests',130,'LOGGED_IN',7),(369,'cuero','interests',130,'LOGGED_IN',7),(375,'proveedores','likes',131,'LOGGED_IN',7),(374,'cuero','likes',131,'LOGGED_IN',7),(382,'Ciudad de Mexico','town',135,'LOGGED_IN',7),(383,'Mexico','country',136,'LOGGED_IN',7),(378,'Calzado','likes',131,'LOGGED_IN',7),(396,'Empresas Latinoamerica','interests',155,'LOGGED_IN',6),(406,'Buenos Aires','town',160,'LOGGED_IN',6),(407,'Argentina','country',161,'LOGGED_IN',6),(408,'empresas','file',5,'LOGGED_IN',4),(409,'latinpyme','file',5,'LOGGED_IN',4),(410,'proveedores','file',5,'LOGGED_IN',4),(411,'latinpyme','file',6,'LOGGED_IN',3),(412,'redes sociales','file',6,'LOGGED_IN',3),(413,'turismo','file',6,'LOGGED_IN',3),(414,'cueros','file',7,'LOGGED_IN',3),(415,'latinpyme','file',7,'LOGGED_IN',3),(416,'proveedores','file',7,'LOGGED_IN',3),(417,'textiles','file',7,'LOGGED_IN',3);
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggtags` ENABLE KEYS */;

--
-- Table structure for table `elggtemplate_elements`
--

DROP TABLE IF EXISTS `elggtemplate_elements`;
CREATE TABLE `elggtemplate_elements` (
  `ident` int(11) NOT NULL auto_increment,
  `name` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `content` text collate utf8_unicode_ci NOT NULL,
  `template_id` int(11) NOT NULL default '0' COMMENT '-> templates.ident',
  PRIMARY KEY  (`ident`),
  KEY `name` (`name`,`template_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggtemplate_elements`
--


/*!40000 ALTER TABLE `elggtemplate_elements` DISABLE KEYS */;
LOCK TABLES `elggtemplate_elements` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggtemplate_elements` ENABLE KEYS */;

--
-- Table structure for table `elggtemplates`
--

DROP TABLE IF EXISTS `elggtemplates`;
CREATE TABLE `elggtemplates` (
  `ident` int(11) NOT NULL auto_increment,
  `name` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `owner` int(11) NOT NULL default '0' COMMENT '-> users.ident, template creator',
  `public` enum('yes','no') collate utf8_unicode_ci NOT NULL default 'yes',
  `shortname` varchar(128) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ident`),
  KEY `name` (`name`,`owner`,`public`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggtemplates`
--


/*!40000 ALTER TABLE `elggtemplates` DISABLE KEYS */;
LOCK TABLES `elggtemplates` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggtemplates` ENABLE KEYS */;

--
-- Table structure for table `elgguser_flags`
--

DROP TABLE IF EXISTS `elgguser_flags`;
CREATE TABLE `elgguser_flags` (
  `ident` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0' COMMENT '-> users.ident, user the flag refers to',
  `flag` varchar(64) collate utf8_unicode_ci NOT NULL default '',
  `value` varchar(64) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`ident`),
  KEY `user_id` (`user_id`,`flag`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elgguser_flags`
--


/*!40000 ALTER TABLE `elgguser_flags` DISABLE KEYS */;
LOCK TABLES `elgguser_flags` WRITE;
INSERT INTO `elgguser_flags` VALUES (1,1,'admin','1'),(214,2,'language','es'),(379,3,'language','es'),(11,3,'visualeditor','yes'),(68,2,'visualeditor','yes'),(70,2,'publiccomments','1'),(71,2,'emailnotifications','1'),(78,5,'visualeditor','yes'),(80,5,'language','es'),(101,4,'visualeditor','yes'),(127,7,'visualeditor','yes'),(129,7,'language','es'),(196,1,'language','en_US'),(190,1,'visualeditor','yes'),(268,3,'publiccomments','1'),(269,3,'emailnotifications','1');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elgguser_flags` ENABLE KEYS */;

--
-- Table structure for table `elggusers`
--

DROP TABLE IF EXISTS `elggusers`;
CREATE TABLE `elggusers` (
  `ident` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(128) collate utf8_unicode_ci NOT NULL default '' COMMENT 'login name',
  `password` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `email` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `name` varchar(128) collate utf8_unicode_ci NOT NULL default '' COMMENT 'descriptive name',
  `lastname` varchar(128) collate utf8_unicode_ci NOT NULL default '' COMMENT 'descriptive name',
  `icon` int(11) NOT NULL default '-1' COMMENT '-> icons.ident',
  `active` enum('yes','no') collate utf8_unicode_ci NOT NULL default 'yes',
  `alias` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `code` varchar(32) collate utf8_unicode_ci NOT NULL default '' COMMENT 'auth value for cookied login',
  `icon_quota` int(11) NOT NULL default '10' COMMENT 'number of icons',
  `file_quota` int(11) NOT NULL default '1000000000' COMMENT 'bytes',
  `template_id` int(11) NOT NULL default '-1' COMMENT '-> templates.ident',
  `owner` int(11) NOT NULL default '-1' COMMENT '-> users.ident, community owner',
  `user_type` varchar(128) collate utf8_unicode_ci NOT NULL default 'person' COMMENT 'person, community, etc',
  `moderation` varchar(4) collate utf8_unicode_ci NOT NULL default 'no' COMMENT 'friendship moderation setting',
  `last_action` int(10) unsigned NOT NULL default '0' COMMENT 'unix timestamp',
  `template_name` varchar(128) collate utf8_unicode_ci NOT NULL default 'Default_Template' COMMENT '-> templates.shortname',
  PRIMARY KEY  (`ident`),
  KEY `username` (`username`,`password`,`name`,`active`),
  KEY `code` (`code`),
  KEY `icon` (`icon`),
  KEY `icon_quota` (`icon_quota`),
  KEY `file_quota` (`file_quota`),
  KEY `email` (`email`),
  KEY `template_id` (`template_id`),
  KEY `community` (`owner`),
  KEY `user_type` (`user_type`),
  KEY `moderation` (`moderation`),
  KEY `last_action` (`last_action`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggusers`
--


/*!40000 ALTER TABLE `elggusers` DISABLE KEYS */;
LOCK TABLES `elggusers` WRITE;
INSERT INTO `elggusers` VALUES (1,'news','21232f297a57a5a743894a0e4a801fc3','spy@localhost','News',-1,'yes','','',10,10000000,-1,-1,'person','no',1181794887,'Default_Template'),(2,'spy','16ba647ada85be7c591c5e51e5a268ae','spy@hope.blackbox.net','Gustavo González',3,'yes','','',10,1000000000,-1,-1,'person','no',1181796644,'Default_Template'),(3,'johanqnms','e10adc3949ba59abbe56e057f20f883e','johan@hope.blackbox.net','Johan Quijano',1,'yes','','a2f159a97fc5eb41c931b4af18d9a42e',10,1000000000,-1,-1,'person','yes',1181856187,'Default_Template'),(4,'web','','','TRES ZERO',2,'yes','','',10,1000000000,-1,3,'community','no',0,'Default_Template'),(5,'leader','','','Textiles',-1,'yes','','',10,1000000000,-1,2,'community','no',0,'Default_Template'),(6,'sle','','','Sociedad Latinoamericana de Exportadores',4,'yes','','',10,1000000000,-1,3,'community','no',0,'Default_Template'),(7,'calzachile','','','Calzado -- Chile',5,'yes','','',10,1000000000,-1,3,'community','yes',0,'Default_Template');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggusers` ENABLE KEYS */;

--
-- Table structure for table `elggusers_alias`
--

DROP TABLE IF EXISTS `elggusers_alias`;
CREATE TABLE `elggusers_alias` (
  `ident` int(10) unsigned NOT NULL auto_increment,
  `installid` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `username` varchar(32) collate utf8_unicode_ci NOT NULL default '',
  `firstname` varchar(64) collate utf8_unicode_ci NOT NULL default '',
  `lastname` varchar(64) collate utf8_unicode_ci NOT NULL default '',
  `email` varchar(128) collate utf8_unicode_ci NOT NULL default '',
  `user_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`ident`),
  KEY `username` (`username`),
  KEY `installid` (`installid`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggusers_alias`
--


/*!40000 ALTER TABLE `elggusers_alias` DISABLE KEYS */;
LOCK TABLES `elggusers_alias` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggusers_alias` ENABLE KEYS */;

--
-- Table structure for table `elggweblog_comments`
--

DROP TABLE IF EXISTS `elggweblog_comments`;
CREATE TABLE `elggweblog_comments` (
  `ident` int(11) NOT NULL auto_increment,
  `post_id` int(11) NOT NULL default '0' COMMENT '-> weblog_posts.ident',
  `owner` int(11) NOT NULL default '0' COMMENT '-> users.ident, commenter',
  `postedname` varchar(128) collate utf8_unicode_ci NOT NULL default '' COMMENT 'displayed name of commenter',
  `body` text collate utf8_unicode_ci NOT NULL,
  `posted` int(11) NOT NULL default '0' COMMENT 'unix timestamp',
  PRIMARY KEY  (`ident`),
  KEY `owner` (`owner`),
  KEY `posted` (`posted`),
  KEY `post_id` (`post_id`),
  KEY `postedname` (`postedname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggweblog_comments`
--


/*!40000 ALTER TABLE `elggweblog_comments` DISABLE KEYS */;
LOCK TABLES `elggweblog_comments` WRITE;
INSERT INTO `elggweblog_comments` VALUES (1,4,3,'Johan Quijano','Interesante aporte a la comunidad',1181833727),(3,9,3,'Johan Quijano','bueno',1181839443);
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggweblog_comments` ENABLE KEYS */;

--
-- Table structure for table `elggweblog_posts`
--

DROP TABLE IF EXISTS `elggweblog_posts`;
CREATE TABLE `elggweblog_posts` (
  `ident` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL default '0' COMMENT '-> users.ident, poster',
  `weblog` int(11) NOT NULL default '-1' COMMENT '-> users.ident, blog being posted into',
  `icon` int(11) NOT NULL default '-1',
  `access` varchar(20) collate utf8_unicode_ci NOT NULL default 'PUBLIC',
  `posted` int(11) NOT NULL default '0' COMMENT 'unix timestamp',
  `title` text collate utf8_unicode_ci NOT NULL,
  `body` text collate utf8_unicode_ci NOT NULL,
  `last_updated` int(11) NOT NULL default '0' COMMENT 'unix timestamp',
  PRIMARY KEY  (`ident`),
  KEY `owner` (`owner`),
  KEY `access` (`access`),
  KEY `posted` (`posted`),
  KEY `community` (`weblog`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggweblog_posts`
--


/*!40000 ALTER TABLE `elggweblog_posts` DISABLE KEYS */;
LOCK TABLES `elggweblog_posts` WRITE;
INSERT INTO `elggweblog_posts` VALUES (1,1,1,-1,'PUBLIC',1119422380,'Hello','Welcome to this Elgg installation.',0),(2,3,3,1,'LOGGED_IN',1181744492,'Firefox 3 ha sido concebido','<h2><a href=\"http://treszero.wordpress.com/2007/06/12/firefox-3-ha-sido-concebido/\"  title=\"Permanent Link to Firefox 3 ha sido&nbsp;concebido\"><br /></a></h2> 				Junio 12th, 2007  by treszero  				 					<p><strong>Una versi&oacute;n alfa del pr&oacute;ximo Firefox ya puede ser descargada de Internet.</strong></p><p><a href=\"http://www.treszero.wordpress.com/\">www.treszero.wordpress.com&nbsp;</a></p>',1181835949),(3,3,4,-1,'LOGGED_IN',1181744534,'Firefox 3 ha sido concebido','www.treszero.wordpress.com',0),(4,3,6,1,'PUBLIC',1181754685,'Inmersion Games en CNN','<p>{{video:http://www.youtube.com/v/UMIl_GmUFXg@@240x200}}</p><p>&nbsp;</p><p>Inmersion Games en CNN</p>',1181833828),(5,3,3,1,'LOGGED_IN',1181833659,'Red Social Empresarial','<strong>Las Redes Sociales empresariales</strong> son una nueva forma actualmente para dar a conocer su empresa y poder contactar a nuevos cliente por otro medio alternativo al tradicional.',1181833659),(6,3,3,1,'LOGGED_IN',1181835898,'Empresas 2.0','Empresas 2.0 basadas en publicidad de las redes sociales online, <br /><img src=\"http://latinpyme/_tinymce/jscripts/tiny_mce/plugins/emotions/images/smiley-cool.gif\"  border=\"0\"  alt=\"Chulo\"  title=\"Chulo\" />',1181835898),(7,3,3,1,'LOGGED_IN',1181836130,'emprendimiento','<p>empresas 2.0 con una vision de negocios claramente potenciada </p>',1181836130),(8,3,3,1,'LOGGED_IN',1181836872,'Calzado Exportaciones Proexport','La industria del calzado en latinoamerica esta ampliando fronteras segun estadisticas de proexport',1181836872),(9,3,3,1,'LOGGED_IN',1181836915,'Turimo -- Colombia','El Turismo en colombia se ha reestablecido gracias a las politicas de seguridad en el 2007',1181839443),(10,3,4,1,'LOGGED_IN',1181837713,'Red Empresarial LatinPyme','La red Empresarial Latinpyme sera lanzada proximente.',1181837713),(11,3,4,1,'LOGGED_IN',1181837755,'Nueva edicion Latinpyme','La ultima edicion de la revista empresarial latinpyme esta a la venta.',1181837756);
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggweblog_posts` ENABLE KEYS */;

--
-- Table structure for table `elggweblog_watchlist`
--

DROP TABLE IF EXISTS `elggweblog_watchlist`;
CREATE TABLE `elggweblog_watchlist` (
  `ident` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL default '0' COMMENT '-> users.ident, watcher',
  `weblog_post` int(11) NOT NULL default '0' COMMENT '-> weblog_posts.ident, watched post',
  PRIMARY KEY  (`ident`),
  KEY `owner` (`owner`),
  KEY `weblog_post` (`weblog_post`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggweblog_watchlist`
--


/*!40000 ALTER TABLE `elggweblog_watchlist` DISABLE KEYS */;
LOCK TABLES `elggweblog_watchlist` WRITE;
INSERT INTO `elggweblog_watchlist` VALUES (1,3,4);
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggweblog_watchlist` ENABLE KEYS */;

--
-- Table structure for table `elggwidget_data`
--

DROP TABLE IF EXISTS `elggwidget_data`;
CREATE TABLE `elggwidget_data` (
  `ident` int(11) NOT NULL auto_increment,
  `widget` int(11) NOT NULL,
  `name` varchar(128) collate utf8_unicode_ci NOT NULL,
  `value` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ident`),
  KEY `widget` (`widget`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggwidget_data`
--


/*!40000 ALTER TABLE `elggwidget_data` DISABLE KEYS */;
LOCK TABLES `elggwidget_data` WRITE;
INSERT INTO `elggwidget_data` VALUES (17,9,'widget_text_body','Tres Zero \r\nwww.treszero.wordpress.com\r\n\r\nRedes Sociales del Conocimiento'),(16,9,'widget_text_title','Tres Zero'),(21,14,'latest_files','Archivos');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggwidget_data` ENABLE KEYS */;

--
-- Table structure for table `elggwidgets`
--

DROP TABLE IF EXISTS `elggwidgets`;
CREATE TABLE `elggwidgets` (
  `ident` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL,
  `type` varchar(128) collate utf8_unicode_ci NOT NULL,
  `location` varchar(128) collate utf8_unicode_ci NOT NULL,
  `location_id` int(11) NOT NULL,
  `wcolumn` int(11) NOT NULL,
  `display_order` int(11) NOT NULL,
  `access` varchar(128) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ident`),
  KEY `owner` (`owner`,`display_order`,`access`),
  KEY `location_id` (`location_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `elggwidgets`
--


/*!40000 ALTER TABLE `elggwidgets` DISABLE KEYS */;
LOCK TABLES `elggwidgets` WRITE;
INSERT INTO `elggwidgets` VALUES (1,3,'blog::blog','profile',0,0,40,'user3'),(9,3,'widget::text','profile',0,0,30,'PUBLIC'),(4,2,'blog::blog','profile',0,0,30,'user2'),(6,2,'contenttoolbar::video','profile',0,0,20,'user2'),(7,2,'blog::blog','profile',0,0,10,'user2'),(14,3,'file::files','profile',0,0,10,'LOGGED_IN'),(10,3,'profile::friends','profile',0,0,20,'PUBLIC');
UNLOCK TABLES;
/*!40000 ALTER TABLE `elggwidgets` ENABLE KEYS */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

