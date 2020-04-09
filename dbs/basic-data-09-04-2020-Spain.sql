-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: chanza_dev
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `sylius_adjustment`
--

LOCK TABLES `sylius_adjustment` WRITE;
/*!40000 ALTER TABLE `sylius_adjustment` DISABLE KEYS */;
INSERT INTO `sylius_adjustment` VALUES (1,1,NULL,NULL,'shipping','Correos Estándar',1200,0,0,NULL,'2018-08-23 13:34:16','2018-08-23 13:34:16'),(2,2,NULL,NULL,'shipping','Correos Estándar',1200,0,0,NULL,'2018-09-21 12:28:32','2018-09-21 12:28:32');
/*!40000 ALTER TABLE `sylius_adjustment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_channel`
--

LOCK TABLES `sylius_channel` WRITE;
/*!40000 ALTER TABLE `sylius_channel` DISABLE KEYS */;
INSERT INTO `sylius_channel` VALUES (1,1,1,20,'default','España',NULL,NULL,1,'127.0.0.1','2018-08-20 10:02:45','2018-09-21 08:13:33',NULL,'order_items_based','vgr.gamez@gmail.com',1,1,1,null,null),(2,4,1,20,'cat','Cataluña',NULL,NULL,1,'127.0.0.1','2018-09-21 08:12:55','2018-09-21 08:12:56',NULL,'order_items_based','iam@valentigamez.com',1,1,1,null,null);
/*!40000 ALTER TABLE `sylius_channel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_channel_currencies`
--

LOCK TABLES `sylius_channel_currencies` WRITE;
/*!40000 ALTER TABLE `sylius_channel_currencies` DISABLE KEYS */;
INSERT INTO `sylius_channel_currencies` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `sylius_channel_currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_channel_locales`
--

LOCK TABLES `sylius_channel_locales` WRITE;
/*!40000 ALTER TABLE `sylius_channel_locales` DISABLE KEYS */;
INSERT INTO `sylius_channel_locales` VALUES (1,1),(2,4);
/*!40000 ALTER TABLE `sylius_channel_locales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_country`
--

LOCK TABLES `sylius_country` WRITE;
/*!40000 ALTER TABLE `sylius_country` DISABLE KEYS */;
INSERT INTO `sylius_country` VALUES (3,'ES',1);
/*!40000 ALTER TABLE `sylius_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_currency`
--

LOCK TABLES `sylius_currency` WRITE;
/*!40000 ALTER TABLE `sylius_currency` DISABLE KEYS */;
INSERT INTO `sylius_currency` VALUES (1,'EUR','2018-08-20 10:02:45','2018-08-20 10:02:45');
/*!40000 ALTER TABLE `sylius_currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_gateway_config`
--

LOCK TABLES `sylius_gateway_config` WRITE;
/*!40000 ALTER TABLE `sylius_gateway_config` DISABLE KEYS */;
INSERT INTO `sylius_gateway_config` VALUES (1,'transferencia','offline','[]');
/*!40000 ALTER TABLE `sylius_gateway_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_locale`
--

LOCK TABLES `sylius_locale` WRITE;
/*!40000 ALTER TABLE `sylius_locale` DISABLE KEYS */;
INSERT INTO `sylius_locale` VALUES (1,'es','2018-08-20 10:02:45','2018-08-20 10:02:45'),(4,'ca_ES','2018-08-20 10:30:20','2018-08-20 10:30:21');
/*!40000 ALTER TABLE `sylius_locale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_payment_method`
--

LOCK TABLES `sylius_payment_method` WRITE;
/*!40000 ALTER TABLE `sylius_payment_method` DISABLE KEYS */;
INSERT INTO `sylius_payment_method` VALUES (1,1,'transferencia',NULL,1,10,'2018-08-20 12:36:15','2018-08-20 12:36:18');
/*!40000 ALTER TABLE `sylius_payment_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_payment_method_translation`
--

LOCK TABLES `sylius_payment_method_translation` WRITE;
/*!40000 ALTER TABLE `sylius_payment_method_translation` DISABLE KEYS */;
INSERT INTO `sylius_payment_method_translation` VALUES (1,1,'Transferencia bancaria','Al terminar de realizar el pedido hay que realizar una transferencia.','Al terminar de realizar el pedido hay que realizar una transferencia a la cuenta bancaria ESXX XXXX XXXX XXXX XXXX XXXX del importe total con el número de pedido como concepto.','es'),(2,1,'Transferència bancària','Al acabar la comanda s\'ha de realitzar una transferència.','Al acabar la comanda s\'ha de realitzar una transferència al número de compte ESXX XXXX XXXX XXXX XXXX XXXX del import total amb el número de comanda com a concepte.','ca_ES');
/*!40000 ALTER TABLE `sylius_payment_method_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_product_attribute`
--

LOCK TABLES `sylius_product_attribute` WRITE;
/*!40000 ALTER TABLE `sylius_product_attribute` DISABLE KEYS */;
INSERT INTO `sylius_product_attribute` VALUES (1,'marca','select','json','a:4:{s:7:\"choices\";a:129:{s:32:\"fb6eab6c8128d7e014ccde4c624e7e81\";a:1:{s:2:\"es\";s:18:\"CD VIRGEN \"VINILO\"\";}s:32:\"b77bf68217df9d2b6f357d57eee778f7\";a:1:{s:2:\"es\";s:16:\"CAJA PARA DISCOS\";}s:32:\"15ec7d423b81414313141a7911cbd093\";a:1:{s:2:\"es\";s:16:\"ESTUCHE DVD SLIM\";}s:32:\"a70586b747009e58f8ce8265916d6a9e\";a:1:{s:2:\"es\";s:12:\"MALETA COFRE\";}s:32:\"46236951115d92d4a9729f9262c7ca19\";a:1:{s:2:\"es\";s:19:\"DOBLE CD TRAY NEGRO\";}s:32:\"7e9e1a2c18c2a986974316111f59446d\";a:1:{s:2:\"es\";s:27:\"MODULO ESTANTERIA DE MADERA\";}s:32:\"794129fd47aeee40ef08f5d370b3407d\";a:1:{s:2:\"es\";s:18:\"CAJON MADERA NEGRA\";}s:32:\"10d1b0b6994033bd2971fde962cd05bb\";a:1:{s:2:\"es\";s:25:\"CAJA ENVIO SINGLES 1 A 25\";}s:32:\"29b05a82c91ab5445140ac17ae28ad3b\";a:1:{s:2:\"es\";s:25:\"CAJA ENVIO LP CRUZ 1 A 12\";}s:32:\"49cea0367a72f3cda15ab7e4fddcefc9\";a:1:{s:2:\"es\";s:19:\"CAJA EMBALAJE 25 CD\";}s:32:\"529de108a4db4414337e891edf9f943f\";a:1:{s:2:\"es\";s:25:\"LIMPIADOR DISCOS SPRAY AM\";}s:32:\"46ee453be2e52e8c7302323b081fafd7\";a:1:{s:2:\"es\";s:26:\"CINTA CASSETTE VIRGEN C-90\";}s:32:\"026dec76034666022cf7e3e6c696e9d3\";a:1:{s:2:\"es\";s:17:\"FUNDA CD SIN CAJA\";}s:32:\"d8cea520ae701443a3fdca779f9ec7c5\";a:1:{s:2:\"es\";s:15:\"SPRAY PROTECTOR\";}s:32:\"040df39d98a244bf44644c8a924fa71e\";a:1:{s:2:\"es\";s:18:\"CAJA CARTON SOLIDO\";}s:32:\"28b020f1b9f07468d30ee28f69cb7bbd\";a:1:{s:2:\"es\";s:41:\"CINTA CASSETTE VIRGEN FUJI ZII C-90 CROMO\";}s:32:\"1fe221487271b61d7d68f7e6b1dbdeda\";a:1:{s:2:\"es\";s:39:\"FUNDAS LP PAPEL ANTIESTATICO AUDIOFILOS\";}s:32:\"7707d170a64944a2ad121c200e9e54ee\";a:1:{s:2:\"es\";s:20:\"EMBALAJE PROFESIONAL\";}s:32:\"7314a875c02b5131892223abfe9bd61a\";a:1:{s:2:\"es\";s:21:\"FUNDAS SINGLE BLANDAS\";}s:32:\"0833a923c2c01112aa9d2f4109e0c5b4\";a:1:{s:2:\"es\";s:19:\"FUNDA LP CON CIERRE\";}s:32:\"f7dff9b1b69ef141d99a683148bcec38\";a:1:{s:2:\"es\";s:23:\"FUNDAS LP CARTON BLANCO\";}s:32:\"cc6ee83087a42cf88a3d0072f0631e9d\";a:1:{s:2:\"es\";s:31:\"FUNDAS LP CARTON ROJO CUADRADAS\";}s:32:\"2b6334bcafac2b1c200400ff449d5cd2\";a:1:{s:2:\"es\";s:21:\"SPRAY QUITA ETIQUETAS\";}s:32:\"740843d70220e7683c164de451ec789f\";a:1:{s:2:\"es\";s:12:\"MALETA RETRO\";}s:32:\"33ca15f47c29e1b39f270ae06b6c0706\";a:1:{s:2:\"es\";s:21:\"MALETA DJ 100 SINGLES\";}s:32:\"c8881012bc25982b7424c6792fe1ce3e\";a:1:{s:2:\"es\";s:18:\"CAJA PARA CD Y DVD\";}s:32:\"69c64b1b42e75dcf7a1ddac096fd37b0\";a:1:{s:2:\"es\";s:19:\"FUNDAS SINGLE REPRO\";}s:32:\"00fdb5464d44006f70e5c53817be0e6b\";a:1:{s:2:\"es\";s:9:\"MALETA DJ\";}s:32:\"a33ef75138814e39c2292b9facc297d0\";a:1:{s:2:\"es\";s:28:\"FUNDAS PARA BOX SETS GRANDES\";}s:32:\"3d5b429ef17033a466e75388f828fb48\";a:1:{s:2:\"es\";s:28:\"FUNDAS DOBLE LP GATEFOLD PVC\";}s:32:\"56b39a3bb4edee4b0e5304422fd5cced\";a:1:{s:2:\"es\";s:26:\"FUNDAS SINGLE CARTON NEGRO\";}s:32:\"8e206702d1256d2ae19c35ae7a69408c\";a:1:{s:2:\"es\";s:21:\"FUNDA LP CARTON KRAFT\";}s:32:\"bb0cd193e828f772247130e7b1ce021f\";a:1:{s:2:\"es\";s:37:\"FUNDAS LP Y DOBLE LP MEDIUM GALGA 400\";}s:32:\"cea34afd5a51a3d56b0ce20b21204639\";a:1:{s:2:\"es\";s:25:\"FUNDAS LP PAPEL AUDIOFILO\";}s:32:\"ce6aa2043d8fe17890d03a8c8ce98135\";a:1:{s:2:\"es\";s:45:\"FUNDAS LP PAPEL NEGRO ANTIESTATICO AUDIOFILOS\";}s:32:\"1e69395af0096740b9d08d54bf4e21fa\";a:1:{s:2:\"es\";s:33:\"FUNDAS SINGLE PAPEL ANTIESTATICAS\";}s:32:\"c20c5de8532bc3919687dfc7ceb7eee4\";a:1:{s:2:\"es\";s:30:\"FUNDAS SINGLE CARTON AMARILLAS\";}s:32:\"fb55bf0f86fbf4cbfa9a36ea7d08de70\";a:1:{s:2:\"es\";s:16:\"CAJA ENVIO 50 LP\";}s:32:\"8d4229d9d376da761d89fb0fb7bb5245\";a:1:{s:2:\"es\";s:22:\"FUNDAS LP PAPEL NEGRAS\";}s:32:\"2de54b55d3d1b6e9a40d226a4b40ea90\";a:1:{s:2:\"es\";s:26:\"SOBRE ALCOCHADO MULTIMEDIA\";}s:32:\"935ef89d1654b4de1e61ff6bf3a85dcc\";a:1:{s:2:\"es\";s:16:\"PACK CAJAS ENVIO\";}s:32:\"2f2fe2f48d63b6f17b4b25b4dafe6a07\";a:1:{s:2:\"es\";s:25:\"PACK EMBALAJE PROFESIONAL\";}s:32:\"536c172b0070e90ecab50052321f770d\";a:1:{s:2:\"es\";s:18:\"CINTA ADHESIVA PVC\";}s:32:\"a9ac75cf534b12513c1d1cc3baad12c2\";a:1:{s:2:\"es\";s:15:\"AIRE COMPRIMIDO\";}s:32:\"42f71184bd2181e4df28b465c30ee539\";a:1:{s:2:\"es\";s:17:\"CAJON PARA DISCOS\";}s:32:\"02ed96e820b84472df949812be996e2a\";a:1:{s:2:\"es\";s:25:\"FUNDAS SINGLE CARTON AZUL\";}s:32:\"7cbc915354275177672b6e9a438085f1\";a:1:{s:2:\"es\";s:24:\"FUNDAS LP GRUESAS DELUXE\";}s:32:\"65a78172f2747f825f32f2b485ef4ba0\";a:1:{s:2:\"es\";s:28:\"FUNDAS SINGLE CARTON BLANCAS\";}s:32:\"811211a9a8fae9cef317d1acaa582476\";a:1:{s:2:\"es\";s:21:\"FUNDA CD PAPEL BLANCO\";}s:32:\"fd5815fdee8c3fcb39c908384ec048ef\";a:1:{s:2:\"es\";s:15:\"PRODUCTO OUTLET\";}s:32:\"b77a674da348191a8819f48567573881\";a:1:{s:2:\"es\";s:25:\"CAJA ENVIO SINGLES 1 A 12\";}s:32:\"751951766d8f9924caf4dd91b83fbdb9\";a:1:{s:2:\"es\";s:13:\"CAJA DOBLE CD\";}s:32:\"c2481f2fb92e0124f3ba3a485e73b888\";a:1:{s:2:\"es\";s:26:\"FUNDAS SINGLE TIPO CRISTAL\";}s:32:\"50ec8209c50af0e39fe833803e9e7732\";a:1:{s:2:\"es\";s:35:\"LIMPIADOR DISCOS VINILO Y GRAMOFONO\";}s:32:\"21da4f8810e107b748447a1ff9042bcb\";a:1:{s:2:\"es\";s:33:\"FUNDAS PARA BOX SETS TIPO CRISTAL\";}s:32:\"af4d324e625af12f8ab078e6bbdedea3\";a:1:{s:2:\"es\";s:30:\"DIVISOR CLASIFICADOR DE MADERA\";}s:32:\"761b2c6160ca3459712fe194419fa2e3\";a:1:{s:2:\"es\";s:27:\"FUNDAS SINGLE CARTON VERDES\";}s:32:\"9e9d5fd14eda02b8f973c038891d8367\";a:1:{s:2:\"es\";s:20:\"CAJON MADERA NATURAL\";}s:32:\"f9552e511834a5c6284260d0e7e27087\";a:1:{s:2:\"es\";s:23:\"CAJA ENVIO MULTIFORMATO\";}s:32:\"178d36427a64bd904f4ff28847d899ea\";a:1:{s:2:\"es\";s:26:\"DOBLE CD TRAY TRANSPARENTE\";}s:32:\"e90a9069402251326273f89d2a345258\";a:1:{s:2:\"es\";s:25:\"FUNDAS LP BLANDAS GRANDES\";}s:32:\"8a7f88e71822dc963ccac0cfba61d113\";a:1:{s:2:\"es\";s:27:\"FUNDAS SINGLE CARTON NEGRAS\";}s:32:\"ed5c72643d2629f7857d36bebef9f148\";a:1:{s:2:\"es\";s:41:\"PACK COMBINADO CAJAS CARTON ENVIO DISCOS \";}s:32:\"ce187fbedf956841648dcea9b27ad2b8\";a:1:{s:2:\"es\";s:26:\"DISPLAY EXPOSITOR COLGANTE\";}s:32:\"ff02d7b03bf4c0118f9e944a70b5a053\";a:1:{s:2:\"es\";s:15:\"DISCO PATINADOR\";}s:32:\"df8fdf675ab34d2d54799add01afb550\";a:1:{s:2:\"es\";s:17:\"DIVISOR LP Y MAXI\";}s:32:\"ff76bbe8be52bc8ef39c8e35a2285ca2\";a:1:{s:2:\"es\";s:28:\"CAJA Y CARTONES ENVIO VINILO\";}s:32:\"6671c6ed8648fbd0ae5ffef0ee329ea3\";a:1:{s:2:\"es\";s:15:\"CUBRE ETIQUETAS\";}s:32:\"13f2bf6748af04b7d40cc9c16cf47c6f\";a:1:{s:2:\"es\";s:18:\"MAQUINA LIMPIADORA\";}s:32:\"a5ec40e1005a951a3a1bc5bd6e6bb7dc\";a:1:{s:2:\"es\";s:20:\"REPARADOR DE VINILOS\";}s:32:\"400beec0c35b59526c6090de606015a0\";a:1:{s:2:\"es\";s:18:\"FUNDAS LP ESTANDAR\";}s:32:\"773b4504f1becd35e881caabe34469ad\";a:1:{s:2:\"es\";s:26:\"CINTA LIMPIADORA CASSETTES\";}s:32:\"de65b25623212f60a8a938541e575dcb\";a:1:{s:2:\"es\";s:17:\"LIMPIADOR VINILOS\";}s:32:\"9d8cd8d0eaf61ec7ce9fea987c221ce7\";a:1:{s:2:\"es\";s:10:\"DIVISOR CD\";}s:32:\"16c13b9d390dc94154fb308d34ce914a\";a:1:{s:2:\"es\";s:23:\"LIQUIDO LIMPIEZA AGUJAS\";}s:32:\"d9929e2947db594731d720269fe5b11d\";a:1:{s:2:\"es\";s:17:\"ALBUM PARA DISCOS\";}s:32:\"767da7d0c9fb7b9388608b21033f766b\";a:1:{s:2:\"es\";s:32:\"CARTON PROTECTOR LP (STIFFENERS)\";}s:32:\"fc269ab9bb1edf39847643f2fd507bd8\";a:1:{s:2:\"es\";s:23:\"DISCO PATINADOR SLIPMAT\";}s:32:\"e5aac93fddeaa40c8fa20c6ea52fd808\";a:1:{s:2:\"es\";s:10:\"SOPORTE LP\";}s:32:\"71fb4e1eeb276b0d8fe636d725d7043f\";a:1:{s:2:\"es\";s:13:\"CAJA ENVIO CD\";}s:32:\"63a417b8b8867d59b60fb618987e37aa\";a:1:{s:2:\"es\";s:15:\"DIVISOR SINGLES\";}s:32:\"56f212b9a58dcb7897bca6cf3c3b0c9c\";a:1:{s:2:\"es\";s:13:\"MALETA DJ PRO\";}s:32:\"ed730a13494ef4b251ceb7fe9ceb070e\";a:1:{s:2:\"es\";s:13:\"CAJON PARA CD\";}s:32:\"b799e619a2723003053044c600b49d37\";a:1:{s:2:\"es\";s:21:\"SOBRE ALCOCHADO ENVIO\";}s:32:\"a091285054601db5cdad718c0e6aa956\";a:1:{s:2:\"es\";s:29:\"FUNDA CD AUTOCIERRE JAPONESAS\";}s:32:\"cc73585246358f369bcbc4bc342f37e4\";a:1:{s:2:\"es\";s:12:\"CAJA CD MAXI\";}s:32:\"ae63be9b0a88f5118e71c6b98d6d2280\";a:1:{s:2:\"es\";s:22:\"CAJA DOBLE CD ESTRECHA\";}s:32:\"a1bfd1a523db4c3a9766ea36a2822648\";a:1:{s:2:\"es\";s:16:\"CAJA CD COMPLETA\";}s:32:\"f0ce2398928af9a75e13c5ed511bb46c\";a:1:{s:2:\"es\";s:16:\"AGUJA TOCADISCOS\";}s:32:\"57ec92bb9746ee068d8ee12d1716e094\";a:1:{s:2:\"es\";s:31:\"FUNDAS LP ANTIESTATICAS NAGAOKA\";}s:32:\"caae384c73809b167e1ac89856dbf38b\";a:1:{s:2:\"es\";s:25:\"ADAPTADOR SINGLES VINTAGE\";}s:32:\"06803f604bf54e72b7798d25fd4cf0e5\";a:1:{s:2:\"es\";s:29:\"FUNDAS SINGLE ANTIDESLIZANTES\";}s:32:\"4e2179cffcc2d4ca57c5b9e986f13413\";a:1:{s:2:\"es\";s:34:\"FUNDA CD DOBLE AUTOCIERRE ADHESIVO\";}s:32:\"44a036adf4b0b3f8c894b9ec5a14b839\";a:1:{s:2:\"es\";s:26:\"FUNDAS SINGLE PICTURE DISC\";}s:32:\"6a8d9eb8f00b3ff13eda3b2a103cd6f9\";a:1:{s:2:\"es\";s:22:\"FUNDAS LP PICTURE DISC\";}s:32:\"3201c8db1c8d8bff455c86b7f120d262\";a:1:{s:2:\"es\";s:15:\"MALETA ALUMINIO\";}s:32:\"9742c4bc095912779c464bed5ba205b4\";a:1:{s:2:\"es\";s:29:\"FUNDAS LP PICTURE DISC CARTON\";}s:32:\"e47843f887d4b52aa5c5b3c860da1836\";a:1:{s:2:\"es\";s:17:\"FUNDAS LP GRUESAS\";}s:32:\"9b7577d695ea62812cf1bd8acf7f11dc\";a:1:{s:2:\"es\";s:13:\"FUNDAS LP PVC\";}s:32:\"bbb2f4e7af92f3457cd13ef6b0d11e7f\";a:1:{s:2:\"es\";s:17:\"CAJA CD / ESTUCHE\";}s:32:\"91ed93e59de37c1f014fc9eae50e2129\";a:1:{s:2:\"es\";s:32:\"FUNDAS LP CARTON NEGRO CUADRADAS\";}s:32:\"58836945e94d302e9660dc059e05b11b\";a:1:{s:2:\"es\";s:29:\"FUNDAS LP AUTOCIERRE ADHESIVO\";}s:32:\"39651f6261bf159e6a41dfa977cc1ec2\";a:1:{s:2:\"es\";s:17:\"FUNDAS SINGLE PVC\";}s:32:\"4e960fb95150f71e34deb593119e5c26\";a:1:{s:2:\"es\";s:28:\"FUNDAS 10\" GRAMOFONO PREMIUM\";}s:32:\"8729bf429dd181dd4b9e8fd10a99cc95\";a:1:{s:2:\"es\";s:21:\"FUNDAS SINGLE GRUESAS\";}s:32:\"71d8cf908b69832dfde16a8c4386b8da\";a:1:{s:2:\"es\";s:17:\"FUNDAS 10\" CARTON\";}s:32:\"e15d3ded64000974a99b00feef767b31\";a:1:{s:2:\"es\";s:23:\"CAJA CD / CD TRAY NEGRO\";}s:32:\"5f9bd9d022d421a86b32fc330f4783d6\";a:1:{s:2:\"es\";s:30:\"CAJA CD / CD TRAY TRANSPARENTE\";}s:32:\"fab5ca1254ce854e414cd8044e2a85b7\";a:1:{s:2:\"es\";s:27:\"LIQUIDO LIMPIADOR UNIVERSAL\";}s:32:\"91ee2511d5674ed89cae6c313e8393c5\";a:1:{s:2:\"es\";s:30:\"FUNDAS DVD AUTOCIERRE ADHESIVO\";}s:32:\"28003f4f9b9c3e8e4cf8a9fd7b15c273\";a:1:{s:2:\"es\";s:36:\"FUNDAS LP PAPEL ANTIESTATICO PREMIUM\";}s:32:\"28015ba206f2183d917a77986c6a7752\";a:1:{s:2:\"es\";s:23:\"FUNDAS LP PAPEL PREMIUM\";}s:32:\"6fe35488e18f77dc71775042a3dabb73\";a:1:{s:2:\"es\";s:19:\"FUNDAS SINGLE PAPEL\";}s:32:\"e1471418fbb966e5c195b7a42531ee0f\";a:1:{s:2:\"es\";s:17:\"ESTUCHE DVD NEGRO\";}s:32:\"6e8c751efae7f3a38a7b038fc9f15567\";a:1:{s:2:\"es\";s:24:\"ESTUCHE DVD TRANSPARENTE\";}s:32:\"4a5d3ac4802c87773729fea77daad2ac\";a:1:{s:2:\"es\";s:29:\"FUNDAS LP ANTIESTATICAS JAPON\";}s:32:\"5d3866189534ee95515b44243ba5b685\";a:1:{s:2:\"es\";s:33:\"FUNDAS SINGLE ANTIESTATICAS JAPON\";}s:32:\"3146e3ffe13801d221b4bff9284823bc\";a:1:{s:2:\"es\";s:12:\"CUBO PARA CD\";}s:32:\"60da714b70aeed50c76b301f8e2ee35f\";a:1:{s:2:\"es\";s:33:\"FUNDAS SINGLE AUTOCIERRE ADHESIVO\";}s:32:\"c900382ec3f488409657ecec38d2ce8b\";a:1:{s:2:\"es\";s:41:\"FUNDAS 10\" ANTIESTATICAS JAPONESAS DELUXE\";}s:32:\"a3823cf705a3f35c22f6ba15fa7d4e48\";a:1:{s:2:\"es\";s:26:\"FUNDAS LP MEDIUM GALGA 400\";}s:32:\"b0fed4b6a694bba18f2498db9445873f\";a:1:{s:2:\"es\";s:27:\"FUNDAS LP CARTON MULTICOLOR\";}s:32:\"a34a76cb610e0a8cbc1bb7f68b2459c6\";a:1:{s:2:\"es\";s:31:\"FUNDAS SINGLE CARTON MULTICOLOR\";}s:32:\"07d07b407bf61e9100bc82fd35af34ea\";a:1:{s:2:\"es\";s:17:\"FUNDAS GRUESAS LP\";}s:32:\"89f63727b98147bb0c4c97ce95e6d9e9\";a:1:{s:2:\"es\";s:31:\"FUNDAS DOBLE LP GATEFOLD MEDIUM\";}s:32:\"3329c5ef59ee56151b83783d56afeab0\";a:1:{s:2:\"es\";s:17:\"FUNDAS LP BLANDAS\";}s:32:\"c324f6eb33e0f06c2b18bb9adf54498f\";a:1:{s:2:\"es\";s:20:\"FUNDA CD PAPEL NEGRO\";}s:32:\"f4590f91f14e5402a256eb902886dc58\";a:1:{s:2:\"es\";s:28:\"FUNDAS LP CARTON SIN AGUJERO\";}s:32:\"12d6e3a668b123bc58690dd41f553576\";a:1:{s:2:\"es\";s:33:\"FUNDAS 7\" AUTOCIERRE JAPON DELUXE\";}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-14 13:12:28','2018-09-14 14:16:53',27),(2,'formato','select','json','a:4:{s:7:\"choices\";a:7:{s:32:\"4144e097d2fa7a491cec2a7a4322f2bc\";a:1:{s:2:\"es\";s:2:\"AC\";}s:32:\"28f4ad3c0abbe0939478ca0a2138891f\";a:1:{s:2:\"es\";s:4:\"Caja\";}s:32:\"308af1860138050ef535ef42dfcdf818\";a:1:{s:2:\"es\";s:6:\"FUNDAS\";}s:32:\"2a6039655313bf5dab1e43523b62c374\";a:1:{s:2:\"es\";s:2:\"MA\";}s:32:\"33a61062aa4da2b795b7f9616c138b89\";a:1:{s:2:\"es\";s:3:\"EST\";}s:32:\"4dba1165757c458d2c1bbd2380ce98d8\";a:1:{s:2:\"es\";s:3:\"EMB\";}s:32:\"e739a427ec6abbcc2fc891dc205f311f\";a:1:{s:2:\"es\";s:3:\"LIM\";}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-14 13:12:28','2018-09-14 13:12:49',26),(3,'proveedor','select','json','a:4:{s:7:\"choices\";a:5:{s:32:\"c74d97b01eae257e44aa9d5bade97baf\";a:1:{s:2:\"es\";i:16;}s:32:\"cfcd208495d565ef66e7dff9f98764da\";a:1:{s:2:\"es\";i:0;}s:32:\"4e732ced3463d06de0ca9a15b6153677\";a:1:{s:2:\"es\";i:26;}s:32:\"1ff1de774005f8da13f42943881c655f\";a:1:{s:2:\"es\";i:24;}s:32:\"37693cfc748049e45d87b8c7d8b9aacd\";a:1:{s:2:\"es\";i:23;}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-14 13:12:28','2018-09-14 13:40:47',25),(4,'manual','checkbox','boolean','a:0:{}','2018-09-14 13:12:28','2018-09-14 13:12:28',24),(5,'profesionales','checkbox','boolean','a:0:{}','2018-09-14 13:12:28','2018-09-14 13:12:28',23),(6,'bultos','select','json','a:4:{s:7:\"choices\";a:8:{s:32:\"cfcd208495d565ef66e7dff9f98764da\";a:1:{s:2:\"es\";i:0;}s:32:\"e4da3b7fbbce2345d7772b0674a318d5\";a:1:{s:2:\"es\";i:5;}s:32:\"8f14e45fceea167a5a36dedd4bea2543\";a:1:{s:2:\"es\";i:7;}s:32:\"c4ca4238a0b923820dcc509a6f75849b\";a:1:{s:2:\"es\";i:1;}s:32:\"98f13708210194c475687be6106a3b84\";a:1:{s:2:\"es\";i:20;}s:32:\"34173cb38f07f89ddbebc2ac9128303f\";a:1:{s:2:\"es\";i:30;}s:32:\"c81e728d9d4c2f636f067f89cc14862c\";a:1:{s:2:\"es\";i:2;}s:32:\"d645920e395fedad7bbbed0eca3fe2e0\";a:1:{s:2:\"es\";i:40;}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-14 13:12:28','2018-09-14 14:03:58',22),(7,'cargo','select','json','a:4:{s:7:\"choices\";a:112:{s:32:\"be55ee58f786d1eaf5da75ae79d51244\";a:1:{s:2:\"es\";s:10:\"2018-04-19\";}s:32:\"0a6ee212ff09d1ae416862a9e1ce18f7\";a:1:{s:2:\"es\";s:10:\"2018-07-12\";}s:32:\"59f43242eec2ca4019abb69f52a77a28\";a:1:{s:2:\"es\";s:10:\"2017-11-23\";}s:32:\"6a8b3dff6a764fe0512a4e31e9b8e133\";a:1:{s:2:\"es\";s:10:\"2016-07-14\";}s:32:\"b6ea379729a9b40304e363fe55603448\";a:1:{s:2:\"es\";s:10:\"2014-08-07\";}s:32:\"69ac0b28c65484ef5737e9867532d1ef\";a:1:{s:2:\"es\";s:10:\"2015-07-16\";}s:32:\"4bec4239f46cc68303599dac7b2d086f\";a:1:{s:2:\"es\";s:10:\"2015-09-04\";}s:32:\"eed2ba7d28cdc2f0cbd2b84c2dbdcf70\";a:1:{s:2:\"es\";s:10:\"2018-09-12\";}s:32:\"d6afa20a2e808516c90ccd2b16b83272\";a:1:{s:2:\"es\";s:10:\"2018-03-27\";}s:32:\"a6e3c7b118e6697cd64be91ff0d77fae\";a:1:{s:2:\"es\";s:10:\"2018-09-10\";}s:32:\"6b5d5cd8a9253415d704906567d6eb1c\";a:1:{s:2:\"es\";s:10:\"2018-07-16\";}s:32:\"ec5b164efaf0501fd1ae229ed595e043\";a:1:{s:2:\"es\";s:10:\"2018-09-14\";}s:32:\"1ff23cbe2f627acbec1d9e460671a441\";a:1:{s:2:\"es\";s:10:\"2017-11-30\";}s:32:\"b8e8bbae8bad752dd5ae0d99c2f5fbaf\";a:1:{s:2:\"es\";s:10:\"2017-03-14\";}s:32:\"609935a4d41b5c73f1ea2e8e4383fb51\";a:1:{s:2:\"es\";s:10:\"2018-02-21\";}s:32:\"18da20094d04e6ff56baf485aac4e9b9\";a:1:{s:2:\"es\";s:10:\"2017-03-29\";}s:32:\"4119fe5438d1533e8f16b68c6d5e4401\";a:1:{s:2:\"es\";s:10:\"2018-08-30\";}s:32:\"d6ab5a0eee939524352092b964d92b84\";a:1:{s:2:\"es\";s:10:\"2013-04-10\";}s:32:\"18bea060239713ee5f865109f63f3a8a\";a:1:{s:2:\"es\";s:10:\"2013-02-28\";}s:32:\"764ac49220d465e2ca57a6273e24062e\";a:1:{s:2:\"es\";s:10:\"2018-01-31\";}s:32:\"00f690edd77311d3ac185f12ac495e9b\";a:1:{s:2:\"es\";s:10:\"2017-12-05\";}s:32:\"75554b5c3d0e64233c7f7bfcce6a7f5f\";a:1:{s:2:\"es\";s:10:\"2018-07-30\";}s:32:\"eb89d333c99026e288ed06f66a27cab7\";a:1:{s:2:\"es\";s:10:\"2018-05-30\";}s:32:\"e52aee50124cded75098d5cc1c197d9b\";a:1:{s:2:\"es\";s:10:\"2014-11-20\";}s:32:\"4f86c05f7bec8b0420ae5e4cd3b59b44\";a:1:{s:2:\"es\";s:10:\"2017-10-30\";}s:32:\"1daf687435ac4ea473f12b805d014048\";a:1:{s:2:\"es\";s:10:\"2014-04-03\";}s:32:\"2ee33866322e39a506debc02ee32ce27\";a:1:{s:2:\"es\";s:10:\"2015-09-02\";}s:32:\"7cc0bd2468c502f13fb08687af6496cd\";a:1:{s:2:\"es\";s:10:\"2015-07-21\";}s:32:\"226d694fb4b7f71d62444f9528be8704\";a:1:{s:2:\"es\";s:10:\"2013-03-19\";}s:32:\"b1528590f4fbd5aa1560cc325e667613\";a:1:{s:2:\"es\";s:10:\"2014-06-03\";}s:32:\"2b4ea963fd3f584aa10de7b5c41a0b9b\";a:1:{s:2:\"es\";s:10:\"2018-01-12\";}s:32:\"96588769670b5feaefa8dbb28cf2a60a\";a:1:{s:2:\"es\";s:10:\"2015-10-20\";}s:32:\"4d1e9474fcbe057024c333a9ea9a4255\";a:1:{s:2:\"es\";s:10:\"2018-02-06\";}s:32:\"5f4dc2bf7af07577c1fe6edc278e065e\";a:1:{s:2:\"es\";s:10:\"2018-09-05\";}s:32:\"3507a25517b52efa43157cb7e83e3d67\";a:1:{s:2:\"es\";s:10:\"2018-04-10\";}s:32:\"6c67c63df4164866098c96600964386c\";a:1:{s:2:\"es\";s:10:\"2014-11-19\";}s:32:\"1581a6ca2776967411359f85b0bad038\";a:1:{s:2:\"es\";s:10:\"2015-04-07\";}s:32:\"6819c41ea6fd696307aab6a248d7394d\";a:1:{s:2:\"es\";s:10:\"2015-09-12\";}s:32:\"4e7764b567cc59c64874e4e4d16bd72e\";a:1:{s:2:\"es\";s:10:\"2017-03-24\";}s:32:\"7a5d5bbc07d7349eb0c864689de08e2d\";a:1:{s:2:\"es\";s:10:\"2018-03-12\";}s:32:\"7b0730955172ecda497d7cca6b1d87a1\";a:1:{s:2:\"es\";s:10:\"2013-04-06\";}s:32:\"66b65ad9d0e4492a9f853c9e0e943671\";a:1:{s:2:\"es\";s:10:\"2016-04-06\";}s:32:\"d963b42254858d2a3cf139e1fe7b055e\";a:1:{s:2:\"es\";s:10:\"2016-07-26\";}s:32:\"9627e13babfbc8bfb64eee3ab105a4ab\";a:1:{s:2:\"es\";s:10:\"2015-09-24\";}s:32:\"299fc60e8196dd9cfe0d918fa37d4016\";a:1:{s:2:\"es\";s:10:\"2017-11-27\";}s:32:\"26732095f33cda7a90c97ae6ba85aa41\";a:1:{s:2:\"es\";s:10:\"2018-08-14\";}s:32:\"84b46daf1c71da009e71ff24668b7582\";a:1:{s:2:\"es\";s:10:\"2018-05-01\";}s:32:\"6239281c21d41e030a4969d4ece3df33\";a:1:{s:2:\"es\";s:10:\"2014-03-12\";}s:32:\"a980d486392824a3e2e13dadb04d651a\";a:1:{s:2:\"es\";s:10:\"2015-06-04\";}s:32:\"af374093ad1290ec47a6be843cd5e4e1\";a:1:{s:2:\"es\";s:10:\"2014-08-05\";}s:32:\"cb36a77fa8bd313566146c90ddbb5c15\";a:1:{s:2:\"es\";s:10:\"2014-04-11\";}s:32:\"a1029dc7ac52140d028b068e3d3f52b8\";a:1:{s:2:\"es\";s:10:\"2014-12-17\";}s:32:\"1443b23802e83bb311e5a36af7bd4f3a\";a:1:{s:2:\"es\";s:10:\"2018-02-14\";}s:32:\"db2c9403b50a0e74f6f682a05c0ad8c9\";a:1:{s:2:\"es\";s:10:\"2017-09-21\";}s:32:\"836d2fe7661c0c3a66f38b376a1954a6\";a:1:{s:2:\"es\";s:10:\"2017-01-12\";}s:32:\"9717a39cc59777b30c78fd9f843311bf\";a:1:{s:2:\"es\";s:10:\"2015-04-01\";}s:32:\"4c432c46a756fc5ff42ee634db7e8593\";a:1:{s:2:\"es\";s:10:\"2018-06-19\";}s:32:\"f1b4916104e2f0b78d07a58d88b4d107\";a:1:{s:2:\"es\";s:10:\"2018-09-06\";}s:32:\"63cb485da37d82a741d485c57323acd7\";a:1:{s:2:\"es\";s:10:\"2018-07-03\";}s:32:\"867c10b3465f16ce084c2ab672f96710\";a:1:{s:2:\"es\";s:10:\"2016-04-07\";}s:32:\"c2616bf543a10e817b80e80f32956292\";a:1:{s:2:\"es\";s:10:\"2018-09-13\";}s:32:\"04d425c2072b28e3a3b36ff0858ea825\";a:1:{s:2:\"es\";s:10:\"2017-11-22\";}s:32:\"51d8431ea74bcd5f2b58d6783cc7931d\";a:1:{s:2:\"es\";s:10:\"2017-07-31\";}s:32:\"f44aed243dfb7dbf8b947e8f3048fc91\";a:1:{s:2:\"es\";s:10:\"2016-06-13\";}s:32:\"9a714bb09086624c8f0bdb9ccfa560de\";a:1:{s:2:\"es\";s:10:\"2017-10-16\";}s:32:\"d69d5137102461b560d829e677b972db\";a:1:{s:2:\"es\";s:10:\"2011-10-09\";}s:32:\"41a406960161f25c4c7553c2d8480dd2\";a:1:{s:2:\"es\";s:10:\"2018-07-04\";}s:32:\"2e25ef007f9c49477d242408bcb36c46\";a:1:{s:2:\"es\";s:10:\"2017-06-05\";}s:32:\"b7295dcb73e8cefec8ff3efaeb22d16c\";a:1:{s:2:\"es\";s:10:\"2018-07-13\";}s:32:\"70d8463bb30c2ffc16d98e505ce1d4be\";a:1:{s:2:\"es\";s:10:\"2018-03-06\";}s:32:\"7b44b6b392dba1b08ef742c158164877\";a:1:{s:2:\"es\";s:10:\"2018-01-17\";}s:32:\"a0de9e5b7cb0409d0b6a3b409eb3d565\";a:1:{s:2:\"es\";s:10:\"2017-07-03\";}s:32:\"c560a4c73b56a5706f678385843509b9\";a:1:{s:2:\"es\";s:10:\"2018-01-25\";}s:32:\"545935c037db840b063cab70fc2cc3ef\";a:1:{s:2:\"es\";s:10:\"2015-07-28\";}s:32:\"0e0438a8bdbea53929bd664be8421837\";a:1:{s:2:\"es\";s:10:\"2011-10-10\";}s:32:\"ddb42f46f96f9e6cff404ed309f79051\";a:1:{s:2:\"es\";s:10:\"2011-09-06\";}s:32:\"a6338d490fae397a47815d72badac9ff\";a:1:{s:2:\"es\";s:10:\"2017-09-14\";}s:32:\"fc46573127f7b29b9059b1c00a6a20ac\";a:1:{s:2:\"es\";s:10:\"2017-04-07\";}s:32:\"a281184550a212fd0a896d68f16f236e\";a:1:{s:2:\"es\";s:10:\"2017-07-17\";}s:32:\"80cb8bae3b3846a4e3fcccc28c8388d8\";a:1:{s:2:\"es\";s:10:\"2018-02-15\";}s:32:\"dc2d76a1c9f2cbefb9f6fd448d1d8dc4\";a:1:{s:2:\"es\";s:10:\"2017-07-19\";}s:32:\"ee7b4e75b13596004256c5044792aa3c\";a:1:{s:2:\"es\";s:10:\"2011-09-05\";}s:32:\"e13ba2316d1d6812c68d51b86194f1a4\";a:1:{s:2:\"es\";s:10:\"2015-09-23\";}s:32:\"2e019d185d2427ec22d51d683361d775\";a:1:{s:2:\"es\";s:10:\"2017-05-04\";}s:32:\"4b5c832405bbeefbdc9f9ca0f87ae3bf\";a:1:{s:2:\"es\";s:10:\"2016-10-13\";}s:32:\"52f549d2124ed4c8e6f7574b021d96ab\";a:1:{s:2:\"es\";s:10:\"2018-01-15\";}s:32:\"03888dfcb7b9487cb091efca88130424\";a:1:{s:2:\"es\";s:10:\"2017-02-06\";}s:32:\"33bb645b03aae761f9be0eb064f0c46f\";a:1:{s:2:\"es\";s:10:\"2017-10-27\";}s:32:\"bd3d9c8557adeb5c2e5054565058650e\";a:1:{s:2:\"es\";s:10:\"2017-12-12\";}s:32:\"f68e25767f2d70ac6893f1f15244c8e2\";a:1:{s:2:\"es\";s:10:\"2017-08-03\";}s:32:\"013a28fce062010f1185e357c4c0d2b0\";a:1:{s:2:\"es\";s:10:\"2018-01-16\";}s:32:\"92a138de802159d301284b95ef5a3a0d\";a:1:{s:2:\"es\";s:10:\"2016-09-21\";}s:32:\"6a98156d9aad5c7ca324267d73f9c9ca\";a:1:{s:2:\"es\";s:10:\"2012-08-23\";}s:32:\"fbcc61737cad8ea3f42667eb2c78eeb3\";a:1:{s:2:\"es\";s:10:\"2017-10-20\";}s:32:\"8b24d7b1e3a62dfb6e8ab9d1c2c9dd58\";a:1:{s:2:\"es\";s:10:\"2018-08-10\";}s:32:\"295e8946f8eebae9e19b7f01f4d58c0b\";a:1:{s:2:\"es\";s:10:\"2015-10-05\";}s:32:\"ecff69cf427a1426edf1a3d11b9809e4\";a:1:{s:2:\"es\";s:10:\"2017-10-09\";}s:32:\"7011f4eec05dacd65250cfb993875e9a\";a:1:{s:2:\"es\";s:10:\"2018-06-28\";}s:32:\"ad929adfcbf473017d246d24fbb9657d\";a:1:{s:2:\"es\";s:10:\"2017-06-08\";}s:32:\"e15fde437fed6897f70af6497e08b9aa\";a:1:{s:2:\"es\";s:10:\"2017-08-02\";}s:32:\"78ab611d1a46511bdc668051d93ad232\";a:1:{s:2:\"es\";s:10:\"2016-05-04\";}s:32:\"6a5fbaa6dc3c2e58f4e79a971525023f\";a:1:{s:2:\"es\";s:10:\"2016-02-25\";}s:32:\"d03e16412779845e645567e9ce8be164\";a:1:{s:2:\"es\";s:10:\"2017-02-24\";}s:32:\"69b5310658a32abbfd398b843489a7e9\";a:1:{s:2:\"es\";s:10:\"2015-11-20\";}s:32:\"227f55616092649127a5841ef4ab7972\";a:1:{s:2:\"es\";s:10:\"2018-01-26\";}s:32:\"2de17ffd25af2e6f0e311d65f9f1dcb5\";a:1:{s:2:\"es\";s:10:\"2018-01-09\";}s:32:\"f18a5976e5770c3a50996aacb1a6b414\";a:1:{s:2:\"es\";s:10:\"2015-03-16\";}s:32:\"6048d4f58d2857d9ee1f668f7ff25951\";a:1:{s:2:\"es\";s:10:\"2017-12-28\";}s:32:\"094ae3a1f3415b29c50441aee4c2cbef\";a:1:{s:2:\"es\";s:10:\"2017-07-24\";}s:32:\"b0a28b9424a894b803da41df596f0291\";a:1:{s:2:\"es\";s:10:\"2012-08-02\";}s:32:\"0588ea82729dd9faf3c0f69b2daae81b\";a:1:{s:2:\"es\";s:10:\"2016-11-25\";}s:32:\"ac60f81b9193ef03d39391d5b05f216a\";a:1:{s:2:\"es\";s:10:\"2016-10-31\";}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-14 13:12:28','2018-09-14 14:16:24',21),(8,'gastos','select','json','a:4:{s:7:\"choices\";a:13:{s:32:\"cfcd208495d565ef66e7dff9f98764da\";a:1:{s:2:\"es\";i:0;}s:32:\"c81e728d9d4c2f636f067f89cc14862c\";a:1:{s:2:\"es\";i:2;}s:32:\"804066a6a5042090a2a0b25c55f38e72\";a:1:{s:2:\"es\";d:3.5;}s:32:\"8f14e45fceea167a5a36dedd4bea2543\";a:1:{s:2:\"es\";i:7;}s:32:\"a87ff679a2f3e71d9181a67b7542122c\";a:1:{s:2:\"es\";i:4;}s:32:\"c33ab40f1472ef16492879f9a7bbf170\";a:1:{s:2:\"es\";d:4.5;}s:32:\"e4da3b7fbbce2345d7772b0674a318d5\";a:1:{s:2:\"es\";i:5;}s:32:\"c20ad4d76fe97759aa27a0c99bff6710\";a:1:{s:2:\"es\";i:12;}s:32:\"eccbc87e4b5ce2fe28308fd9f2a7baf3\";a:1:{s:2:\"es\";i:3;}s:32:\"c4ca4238a0b923820dcc509a6f75849b\";a:1:{s:2:\"es\";i:1;}s:32:\"1679091c5a880faf6fb5e6087eb1b2dc\";a:1:{s:2:\"es\";i:6;}s:32:\"45c48cce2e2d7fbdea1afc51c7c6ad26\";a:1:{s:2:\"es\";i:9;}s:32:\"8e296a067a37563370ded05f5a3bf3ec\";a:1:{s:2:\"es\";i:25;}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-14 13:12:28','2018-09-14 13:52:43',20),(9,'referencia_proveedor','text','text','a:0:{}','2018-09-21 08:29:05','2018-09-21 08:29:05',19),(10,'pelicula','select','json','a:4:{s:7:\"choices\";a:18:{s:32:\"6eb2dc222c508599d75e211d16556af8\";a:1:{s:2:\"es\";s:12:\"Harry Potter\";}s:32:\"8a0aeb09444a2791c9f32bf063312d97\";a:2:{s:2:\"es\";s:15:\"Los Increíbles\";s:5:\"ca_ES\";s:15:\"Los Increíbles\";}s:32:\"8d8affa79bf43d621d39e5ac97b59d14\";a:2:{s:2:\"es\";s:24:\"Guardianes de la Galaxia\";s:5:\"ca_ES\";s:24:\"Guardianes de la Galaxia\";}s:32:\"071dbd416520d14b2e3688145801de41\";a:2:{s:2:\"es\";s:5:\"Venom\";s:5:\"ca_ES\";s:5:\"Venom\";}s:32:\"01901b07f92e9c67ce8c3bde06b23e79\";a:2:{s:2:\"es\";s:12:\"Blade Runner\";s:5:\"ca_ES\";s:12:\"Blade Runner\";}s:32:\"607cf407c1ec1582849e374324e76d48\";a:2:{s:2:\"es\";s:9:\"Star Wars\";s:5:\"ca_ES\";s:9:\"Star Wars\";}s:32:\"527d60cd4715db174ad56cda34ab2dce\";a:2:{s:2:\"es\";s:8:\"Superman\";s:5:\"ca_ES\";s:8:\"Superman\";}s:32:\"3804e50fede158e4ea518188046c4757\";a:2:{s:2:\"es\";s:35:\"Alicia en el Pais de las Maravillas\";s:5:\"ca_ES\";s:35:\"Alicia en el Pais de las Maravillas\";}s:32:\"9d524072a3b457032654afb42aa4ea61\";a:2:{s:2:\"es\";s:17:\"Regreso al futuro\";s:5:\"ca_ES\";s:17:\"Regreso al futuro\";}s:32:\"3a5f3a4432a441a0e16d926f54af3417\";a:2:{s:2:\"es\";s:5:\"Alien\";s:5:\"ca_ES\";s:5:\"Alien\";}s:32:\"72ed55d0c22ec2f703fa5dbf1cb38d1e\";a:2:{s:2:\"es\";s:8:\"Deadpool\";s:5:\"ca_ES\";s:8:\"Deadpool\";}s:32:\"341693bef3b260750b1d10ec418ef95c\";a:2:{s:2:\"es\";s:17:\"Capitán América\";s:5:\"ca_ES\";s:17:\"Capitán América\";}s:32:\"97a7fe93d5d794a772c9236cf5fed1f8\";a:2:{s:2:\"es\";s:24:\"El Señor de los Anillos\";s:5:\"ca_ES\";s:24:\"El Señor de los Anillos\";}s:32:\"5be14b463314ea922303376ac9d45d78\";a:2:{s:2:\"es\";s:21:\"Animales fantásticos\";s:5:\"ca_ES\";s:21:\"Animales fantásticos\";}s:32:\"2e9c93fbb6d97749a93167651c9f053e\";a:2:{s:2:\"es\";s:7:\"Ant-Man\";s:5:\"ca_ES\";s:7:\"Ant-Man\";}s:32:\"cd071dd03df633ad8d1dba30ed705240\";a:2:{s:2:\"es\";s:26:\"Pesadilla antes de Navidad\";s:5:\"ca_ES\";s:26:\"Pesadilla antes de Navidad\";}s:32:\"cbebc71f88ddbdd67b6efba48499d7e7\";a:2:{s:2:\"es\";s:14:\"Justice League\";s:5:\"ca_ES\";s:14:\"Justice League\";}s:32:\"eb7b5971af9ad6b5f5ac20c60e34f3fb\";a:2:{s:2:\"es\";s:10:\"Scooby Doo\";s:5:\"ca_ES\";s:10:\"Scooby Doo\";}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-21 08:29:05','2018-09-21 13:14:13',18),(11,'licencia_oficial','checkbox','boolean','a:0:{}','2018-09-21 08:29:05','2018-09-21 08:29:05',17),(12,'fabricante','select','json','a:4:{s:7:\"choices\";a:15:{s:32:\"58e9ae93f7d06c05477025814694b392\";a:1:{s:2:\"es\";s:8:\"Bioworld\";}s:32:\"29312794b652144562be6f75da017f09\";a:1:{s:2:\"es\";s:7:\"Difuzed\";}s:32:\"90d8f6e83c4b327506fe723a1903bc20\";a:1:{s:2:\"es\";s:15:\"PHD Merchandise\";}s:32:\"dd395d6201581ad212d782d571f0ad64\";a:2:{s:2:\"es\";s:3:\"CID\";s:5:\"ca_ES\";s:3:\"CID\";}s:32:\"d703a0fa5b43ef3070c3007032401e5d\";a:2:{s:2:\"es\";s:5:\"Otros\";s:5:\"ca_ES\";s:5:\"Otros\";}s:32:\"e6afeaf5076efc0d7798eca329c89dd5\";a:2:{s:2:\"es\";s:18:\"Gaya Entertainment\";s:5:\"ca_ES\";s:18:\"Gaya Entertainment\";}s:32:\"90a4581a91cf835de4f2b2676d31c07d\";a:2:{s:2:\"es\";s:15:\"Cotton Division\";s:5:\"ca_ES\";s:15:\"Cotton Division\";}s:32:\"1088fbc901dc88b6c18085220cc33de9\";a:2:{s:2:\"es\";s:3:\"PCM\";s:5:\"ca_ES\";s:3:\"PCM\";}s:32:\"c4fa7e96d505e1ac2ed05b38ba0f5dae\";a:2:{s:2:\"es\";s:4:\"J!NX\";s:5:\"ca_ES\";s:4:\"J!NX\";}s:32:\"d84b4a133662f8935b3a03ff3670b64a\";a:2:{s:2:\"es\";s:9:\"Logoshirt\";s:5:\"ca_ES\";s:9:\"Logoshirt\";}s:32:\"0b9ccba514c5885cee09ea37861fa624\";a:2:{s:2:\"es\";s:3:\"THG\";s:5:\"ca_ES\";s:3:\"THG\";}s:32:\"c70aa2b5b4d9ad95e8d799f4275a8637\";a:2:{s:2:\"es\";s:10:\"Geek Store\";s:5:\"ca_ES\";s:10:\"Geek Store\";}s:32:\"4fa7df131a1c68f13148c5061d3e9af0\";a:2:{s:2:\"es\";s:17:\"Nastrovje Potsdam\";s:5:\"ca_ES\";s:17:\"Nastrovje Potsdam\";}s:32:\"d9b5ae1d7c5079455bfa02df0aeff274\";a:2:{s:2:\"es\";s:10:\"Loot Crate\";s:5:\"ca_ES\";s:10:\"Loot Crate\";}s:32:\"4537f6ee88112bc0d4e15d379a53c3e6\";a:2:{s:2:\"es\";s:8:\"Rock Off\";s:5:\"ca_ES\";s:8:\"Rock Off\";}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-21 08:29:05','2018-09-21 13:09:57',16),(13,'productor_de_videojuegos','select','json','a:4:{s:7:\"choices\";a:2:{s:32:\"073b7e4ff1d153a52b07eadb5898cb92\";a:1:{s:2:\"es\";s:8:\"Nintendo\";}s:32:\"ac8fe873bc90b3779dd13935dd6f29f2\";a:2:{s:2:\"es\";s:5:\"Atari\";s:5:\"ca_ES\";s:5:\"Atari\";}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-21 08:29:06','2018-09-21 13:05:44',15),(14,'productor_audiovisual','select','json','a:4:{s:7:\"choices\";a:3:{s:32:\"a77450f87def43cbe79f3f494d0c332a\";a:1:{s:2:\"es\";s:6:\"Disney\";}s:32:\"8fbc7ff7b6ed792ab5e02b014c54332d\";a:2:{s:2:\"es\";s:6:\"Marvel\";s:5:\"ca_ES\";s:6:\"Marvel\";}s:32:\"e3d9377b36729e7ce22b678a36fc97d3\";a:2:{s:2:\"es\";s:9:\"DC Comics\";s:5:\"ca_ES\";s:9:\"DC Comics\";}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-21 08:29:06','2018-09-21 13:06:31',14),(15,'otros','select','json','a:4:{s:7:\"choices\";a:10:{s:32:\"3203571a03c3e25bffc5ae3e4ee2083a\";a:2:{s:2:\"es\";s:10:\"Viernes 13\";s:5:\"ca_ES\";s:10:\"Viernes 13\";}s:32:\"96407ff0f2171305556432c8a7031bb8\";a:2:{s:2:\"es\";s:7:\"Destiny\";s:5:\"ca_ES\";s:7:\"Destiny\";}s:32:\"7bbecae69864f9bbfd4f2d21062df665\";a:2:{s:2:\"es\";s:7:\"Pac-Man\";s:5:\"ca_ES\";s:7:\"Pac-Man\";}s:32:\"1f99771bc3e23e6097509a331544ab65\";a:2:{s:2:\"es\";s:4:\"NASA\";s:5:\"ca_ES\";s:4:\"NASA\";}s:32:\"ec901c288697bd66eddf7dc348120723\";a:2:{s:2:\"es\";s:19:\"Magic the Gathering\";s:5:\"ca_ES\";s:19:\"Magic the Gathering\";}s:32:\"7e2a40aab12e702f5be52d0420b944ea\";a:2:{s:2:\"es\";s:12:\"Rick y Morty\";s:5:\"ca_ES\";s:12:\"Rick y Morty\";}s:32:\"bb08323a60a07e40fd04df27a509d89e\";a:2:{s:2:\"es\";s:15:\"Buscando a Nemo\";s:5:\"ca_ES\";s:15:\"Buscando a Nemo\";}s:32:\"11d8d0afe2b16c187c5b72bf1716ae6e\";a:2:{s:2:\"es\";s:13:\"Power Rangers\";s:5:\"ca_ES\";s:13:\"Power Rangers\";}s:32:\"6f9e08c59ea3639e8077568a451d4cb4\";a:2:{s:2:\"es\";s:19:\"Activision Classics\";s:5:\"ca_ES\";s:19:\"Activision Classics\";}s:32:\"6f2de25ee6c0202bdb25f1b4fc64279f\";a:2:{s:2:\"es\";s:12:\"Transformers\";s:5:\"ca_ES\";s:12:\"Transformers\";}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-21 10:31:45','2018-09-21 13:09:03',13),(16,'videojuego','select','json','a:4:{s:7:\"choices\";a:8:{s:32:\"895216944d2ca6af10b1783e5a8ed546\";a:2:{s:2:\"es\";s:37:\"Playerunknown´s Battlegrounds (PUBG)\";s:5:\"ca_ES\";s:37:\"Playerunknown´s Battlegrounds (PUBG)\";}s:32:\"b8aa653990ab9b4c8762d6dc7a8dfce6\";a:2:{s:2:\"es\";s:12:\"Call of Duty\";s:5:\"ca_ES\";s:12:\"Call of Duty\";}s:32:\"721b6a835eea9e1453dfc36ed1441bbb\";a:2:{s:2:\"es\";s:7:\"Far Cry\";s:5:\"ca_ES\";s:7:\"Far Cry\";}s:32:\"bf8d01be0dae05e4e457a3f4049c8606\";a:2:{s:2:\"es\";s:7:\"Fallout\";s:5:\"ca_ES\";s:7:\"Fallout\";}s:32:\"148163bbb93177631ed3644e6f786efa\";a:2:{s:2:\"es\";s:15:\"Crash Bandicoot\";s:5:\"ca_ES\";s:15:\"Crash Bandicoot\";}s:32:\"d8f5f07ee5fe62c27a47ff7b700b5e79\";a:2:{s:2:\"es\";s:17:\"Assassin´s Creed\";s:5:\"ca_ES\";s:17:\"Assassin´s Creed\";}s:32:\"4b1b2d38309d985308559dae13853235\";a:2:{s:2:\"es\";s:12:\"Witcher, The\";s:5:\"ca_ES\";s:12:\"Witcher, The\";}s:32:\"3ff5ac72a84dd5412eb07e59cda54100\";a:2:{s:2:\"es\";s:10:\"God of War\";s:5:\"ca_ES\";s:10:\"God of War\";}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-21 12:32:48','2018-09-21 13:14:22',12),(17,'serie','select','json','a:4:{s:7:\"choices\";a:4:{s:32:\"df6ec13dd394a766974e547054fc013d\";a:2:{s:2:\"es\";s:15:\"Juego de tronos\";s:5:\"ca_ES\";s:15:\"Juego de tronos\";}s:32:\"9473408d814743efc7c203eb79782f8b\";a:2:{s:2:\"es\";s:21:\"American Horror Story\";s:5:\"ca_ES\";s:21:\"American Horror Story\";}s:32:\"3bf99d9b7476fa9f8d74ccb7322229ca\";a:2:{s:2:\"es\";s:12:\"Walking Dead\";s:5:\"ca_ES\";s:12:\"Walking Dead\";}s:32:\"0b318b4d5c4f72fe6911f03d6f6f5bd9\";a:2:{s:2:\"es\";s:15:\"Sons of Anarchy\";s:5:\"ca_ES\";s:15:\"Sons of Anarchy\";}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-21 12:32:51','2018-09-21 13:10:41',11),(18,'dibujos_animados','select','json','a:4:{s:7:\"choices\";a:1:{s:32:\"b82f67142d00a836f6d965be1f892de9\";a:2:{s:2:\"es\";s:8:\"Mega Man\";s:5:\"ca_ES\";s:8:\"Mega Man\";}}s:8:\"multiple\";b:0;s:3:\"min\";N;s:3:\"max\";N;}','2018-09-21 13:05:37','2018-09-21 13:05:37',10);
/*!40000 ALTER TABLE `sylius_product_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_product_attribute_translation`
--

LOCK TABLES `sylius_product_attribute_translation` WRITE;
/*!40000 ALTER TABLE `sylius_product_attribute_translation` DISABLE KEYS */;
INSERT INTO `sylius_product_attribute_translation` VALUES (1,1,'Marca','es'),(2,2,'Formato','es'),(3,3,'Proveedor','es'),(4,4,'Manual','es'),(5,5,'Profesionales','es'),(6,6,'Bultos','es'),(7,7,'Cargo','es'),(8,8,'Gastos','es'),(9,9,'Referencia Proveedor','es'),(10,10,'Película','es'),(11,11,'Licencia Oficial','es'),(12,12,'Fabricante','es'),(13,13,'Productor de videojuegos','es'),(14,14,'Productor audiovisual','es'),(15,15,'Otros','es'),(16,16,'Videojuego','es'),(17,17,'Serie','es'),(18,18,'Dibujos animados','es');
/*!40000 ALTER TABLE `sylius_product_attribute_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_product_option`
--

LOCK TABLES `sylius_product_option` WRITE;
/*!40000 ALTER TABLE `sylius_product_option` DISABLE KEYS */;
INSERT INTO `sylius_product_option` VALUES (1,'color',11,'2018-09-21 08:29:05','2018-09-21 08:29:05'),(2,'tallas',10,'2018-09-21 08:29:05','2018-09-21 08:29:05');
/*!40000 ALTER TABLE `sylius_product_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_product_option_translation`
--

LOCK TABLES `sylius_product_option_translation` WRITE;
/*!40000 ALTER TABLE `sylius_product_option_translation` DISABLE KEYS */;
INSERT INTO `sylius_product_option_translation` VALUES (1,1,'Color','es'),(2,2,'Tallas','es');
/*!40000 ALTER TABLE `sylius_product_option_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_product_option_value`
--

LOCK TABLES `sylius_product_option_value` WRITE;
/*!40000 ALTER TABLE `sylius_product_option_value` DISABLE KEYS */;
INSERT INTO `sylius_product_option_value` VALUES (1,1,'origen'),(2,2,'m'),(3,2,'xl'),(4,2,'s'),(5,2,'l'),(6,2,'xxl'),(7,2,'xs');
/*!40000 ALTER TABLE `sylius_product_option_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_product_option_value_translation`
--

LOCK TABLES `sylius_product_option_value_translation` WRITE;
/*!40000 ALTER TABLE `sylius_product_option_value_translation` DISABLE KEYS */;
INSERT INTO `sylius_product_option_value_translation` VALUES (1,1,'Origen','es'),(2,2,'M','es'),(3,3,'XL','es'),(4,4,'S','es'),(5,5,'L','es'),(6,6,'XXL','es'),(7,7,'XS','es');
/*!40000 ALTER TABLE `sylius_product_option_value_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_province`
--

LOCK TABLES `sylius_province` WRITE;
/*!40000 ALTER TABLE `sylius_province` DISABLE KEYS */;
INSERT INTO `sylius_province` VALUES (91,3,'ES-AL','Álava','Álava'),(92,3,'ES-AB','Albacete','Albacete'),(93,3,'ES-AI','Alicante','Alicante'),(94,3,'ES-AM','Almería','Almería'),(95,3,'ES-AS','Asturias','Asturias'),(96,3,'ES-AV','Ávila','Ávila'),(97,3,'ES-BA','Badajoz','Badajoz'),(98,3,'ES-BR','Barcelona','Barcelona'),(99,3,'ES-BU','Burgos','Burgos'),(100,3,'ES-CA','Cáceres','Cáceres'),(101,3,'ES-CD','Cádiz','Cádiz'),(102,3,'ES-CN','Cantabria','Cantabria'),(103,3,'ES-CS','Castellón','Castellón'),(104,3,'ES-CI','Ciudad Real','C. Real'),(105,3,'ES-CO','Córdoba','Córdoba'),(106,3,'ES-LC','La Coruña','La Coruña'),(107,3,'ES-CU','Cuenca','Cuenca'),(108,3,'ES-GI','Girona','Girona'),(109,3,'ES-GR','Granada','Granada'),(110,3,'ES-GD','Guadalajara','Guadalajara'),(111,3,'ES-GP','Gipuzkoa','Gipuzkoa'),(112,3,'ES-HU','Huelva','Huelva'),(113,3,'ES-HE','Huesca','Huesca'),(114,3,'ES-IB','Illes Balears','Illes Balears'),(115,3,'ES-JA','Jaén','Jaén'),(116,3,'ES-LE','León','León'),(117,3,'ES-LL','Lleida','Lleida'),(118,3,'ES-LU','Lugo','Lugo'),(119,3,'ES-MA','Madrid','Madrid'),(120,3,'ES-ML','Málaga','Málaga'),(121,3,'ES-MU','Murcia','Murcia'),(122,3,'ES-NA','Navarra','Navarra'),(123,3,'ES-OU','Ourense','Ourense'),(124,3,'ES-PA','Palencia','Palencia'),(125,3,'ES-LP','Las Palmas','Las Palmas'),(126,3,'ES-PO','Pontevedra','Pontevedra'),(127,3,'ES-RI','La Rioja','La Rioja'),(128,3,'ES-SA','Salamanca','Salamanca'),(129,3,'ES-SE','Segovia','Segovia'),(130,3,'ES-SV','Sevilla','Sevilla'),(131,3,'ES-SO','Soria','Soria'),(132,3,'ES-TA','Tarragona','Tarragona'),(133,3,'ES-ST','Santa Cruz de Tenerife','St. C. de Tenerife'),(134,3,'ES-TE','Teruel','Teruel'),(135,3,'ES-TO','Toledo','Toledo'),(136,3,'ES-VA','Valencia','Valencia'),(137,3,'ES-VL','Valladolid','Valladolid'),(138,3,'ES-BL','Bizkaia','Bizkaia'),(139,3,'ES-ZA','Zamora','Zamora'),(140,3,'ES-ZR','Zaragoza','Zaragoza'),(141,3,'ES-CE','Ceuta','Ceuta'),(142,3,'ES-ME','Melilla','Melilla');
/*!40000 ALTER TABLE `sylius_province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_shipping_method`
--

LOCK TABLES `sylius_shipping_method` WRITE;
/*!40000 ALTER TABLE `sylius_shipping_method` DISABLE KEYS */;
INSERT INTO `sylius_shipping_method` VALUES (1,NULL,20,NULL,'correos_estandar_peninsula','a:1:{s:7:\"default\";a:1:{s:6:\"amount\";i:1200;}}',2,'flat_rate',1,10,NULL,'2018-08-20 13:37:38','2018-08-20 13:37:38'),(2,NULL,21,NULL,'correos_estandar_no_peninsula','a:1:{s:7:\"default\";a:1:{s:6:\"amount\";i:2000;}}',2,'flat_rate',1,20,NULL,'2018-08-20 13:40:54','2018-08-20 13:40:54');
/*!40000 ALTER TABLE `sylius_shipping_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_shipping_method_channels`
--

LOCK TABLES `sylius_shipping_method_channels` WRITE;
/*!40000 ALTER TABLE `sylius_shipping_method_channels` DISABLE KEYS */;
INSERT INTO `sylius_shipping_method_channels` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `sylius_shipping_method_channels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_shipping_method_translation`
--

LOCK TABLES `sylius_shipping_method_translation` WRITE;
/*!40000 ALTER TABLE `sylius_shipping_method_translation` DISABLE KEYS */;
INSERT INTO `sylius_shipping_method_translation` VALUES (1,1,'Correos Estándar','La más alta calidad de servicio a un precio muy ajustado.\r\n\r\n48-72 horas, dependiendo de origen-destino.','es'),(2,1,'Correus Estàndard','La qualitat més alta a un preu ajustat.\r\n\r\n48-72 hores, depenent del origen y el destí.','ca_ES'),(3,2,'Correos estándar','La más alta calidad de servicio a un precio muy ajustado.\r\n\r\n48-72 horas, dependiendo de origen-destino.','es'),(4,2,'Correus Estàndard','La qualitat més alta a un preu ajustat.\r\n\r\n24-72 hores, segons origen y destí.','ca_ES');
/*!40000 ALTER TABLE `sylius_shipping_method_translation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_tax_category`
--

LOCK TABLES `sylius_tax_category` WRITE;
/*!40000 ALTER TABLE `sylius_tax_category` DISABLE KEYS */;
INSERT INTO `sylius_tax_category` VALUES (2,'general','General','Este es el tipo de IVA por defecto y se aplicará a la mayoría de productos y servicios: ropa, bricolaje, tabaco, servicios de fontanería, hostelería, electrodomésticos, etc. Para hacerse una idea, se aplica el tipo de iva general a todo producto y servicio que no se incluya en los tipos reducido y superreducido y los que están exentos de IVA.','2018-08-20 12:57:04','2018-08-20 12:57:04'),(3,'reducido','Reducido','En este tipo entran una gran variedad de productos. Los más notorios incluyen productos alimenticios, agua, productos farmacéuticos para consumidor final, la compra de viviendas, bienes de uso agrícola, forestal y ganadero, obras de rehabilitación y renovación de vivienda, compra de plantas, servicios deportivos con carácter de aficionado, asistencia social, ferias y exposiciones comerciales, entre otros.','2018-08-20 12:58:15','2018-08-20 12:58:15'),(4,'superreducido','Superreducido','El tipo de IVA superreducido se aplica a los bienes y servicios que se consideren de primera necesidad:\r\nAlimentos básicos de la cesta de la compra (leche, pan, arroz, etc.).\r\nLibros y prensa (revistas y periódicos).\r\nMedicamentos para uso humano.\r\nPrótesis, implantes internos, órtesis y vehículos para personas con discapacidad.','2018-08-20 12:59:07','2018-08-20 12:59:07'),(5,'exento','Exento','De entre las actividades exentas de IVA, a continuación están expuestas las más relevantes dentro del sector empresarial:\r\nOperaciones médicas: cualquier servicio médico que no sea de cirugía estética, acupuntura, digitopuntura y derivados; estará exenta de IVA.\r\nActividades educativas: cualquier actividad tanto de escuelas públicas como privadas. No se exime de IVA los cursos a distancia, las actividades extraescolares ni las clases particulares.\r\nActividades de carácter social: las actividades sociales, culturales y deportivas realizadas por organizaciones sin ánimo de lucro y en las que el presidente no cobre por su trabajo (bibliotecas, museos, zoológicos, etc.)\r\nOperaciones financieras y de seguro: cualquier actividad relacionado con el mundo de la banca, la financiación y los seguros.\r\nOperaciones inmobiliarias: entregas inmobiliarias o de terrenos rústicos para uso público o no edificables.','2018-08-20 13:01:13','2018-08-20 13:01:14'),(6,'especial_incrementado_igic','Especial Incrementado IGIC','Islas Canarias. Se aplica sobre los productos tabaqueros que tienen un precio superior a 1,8€, el alcohol, joyería, cartuchos y perdigones y perfumería.','2018-08-20 13:03:51','2018-08-20 13:03:51');
/*!40000 ALTER TABLE `sylius_tax_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_tax_rate`
--

LOCK TABLES `sylius_tax_rate` WRITE;
/*!40000 ALTER TABLE `sylius_tax_rate` DISABLE KEYS */;
INSERT INTO `sylius_tax_rate` VALUES (1,2,22,'iva_general','IVA General',0.21000,1,'default','2018-08-20 13:09:17','2018-08-20 13:20:44'),(2,2,4,'igic_general','IGIC General',0.07000,1,'default','2018-08-20 13:22:32','2018-08-20 13:22:32'),(3,3,22,'iva_reducido','IVA Reducido',0.10000,1,'default','2018-08-20 13:24:11','2018-08-20 13:24:11'),(4,3,4,'igic_reducido','IGIC Reducido',0.03000,1,'default','2018-08-20 13:25:48','2018-08-20 13:26:31'),(5,4,22,'iva_superreducido','IVA Superreducido',0.04000,1,'default','2018-08-20 13:27:44','2018-08-20 13:27:45'),(6,5,22,'iva_excento','IVA Excento',0.00000,1,'default','2018-08-20 13:28:48','2018-08-20 13:28:48'),(7,5,4,'igic_tipo_cero','IGIC Tipo Cero',0.00000,1,'default','2018-08-20 13:30:58','2018-08-20 13:30:58');
/*!40000 ALTER TABLE `sylius_tax_rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_zone`
--

LOCK TABLES `sylius_zone` WRITE;
/*!40000 ALTER TABLE `sylius_zone` DISABLE KEYS */;
INSERT INTO `sylius_zone` VALUES (1,'andalucia','Andalucía','province','shipping'),(2,'aragon','Aragón','province','shipping'),(3,'asturias','Asturias','province','shipping'),(4,'canarias','Canarias','province','tax'),(5,'cantabria','Cantabria','province','shipping'),(6,'castilla_leon','Castilla y León','province','shipping'),(7,'castilla_la_mancha','Castilla La Mancha','province','shipping'),(8,'cataluna','Cataluña','province','shipping'),(9,'comunidad_madrid','Comunidad de Madrid','province','shipping'),(10,'comunidad_valenciana','Comunidad Valenciana','province','shipping'),(11,'extremadura','Extremadura','province','shipping'),(12,'galicia','Galicia','province','shipping'),(13,'islas_baleares','Islas Baleares','province','shipping'),(14,'la_rioja','La Rioja','province','shipping'),(15,'navarra','Navarra','province','shipping'),(16,'pais_vasco','País Vasco','province','shipping'),(17,'region_de_murcia','Región de Murcia','province','shipping'),(18,'ceuta','Ceuta','province','shipping'),(19,'melilla','Melilla','province','shipping'),(20,'peninsula','Península','zone','shipping'),(21,'islas_ceuta_melilla','Islas, Ceuta o Melilla','zone','shipping'),(22,'peninsula_baleares_ceuta_melilla','Península, Islas Baleares, Ceuta o Melilla','zone','tax');
/*!40000 ALTER TABLE `sylius_zone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sylius_zone_member`
--

LOCK TABLES `sylius_zone_member` WRITE;
/*!40000 ALTER TABLE `sylius_zone_member` DISABLE KEYS */;
INSERT INTO `sylius_zone_member` VALUES (1,1,'ES-AM'),(2,1,'ES-CD'),(3,1,'ES-CO'),(4,1,'ES-GR'),(5,1,'ES-HU'),(6,1,'ES-JA'),(7,1,'ES-ML'),(8,1,'ES-SV'),(9,2,'ES-HE'),(10,2,'ES-TE'),(11,2,'ES-ZR'),(12,3,'ES-AS'),(13,4,'ES-LP'),(14,4,'ES-ST'),(15,5,'ES-CN'),(16,6,'ES-AV'),(17,6,'ES-BU'),(18,6,'ES-LE'),(19,6,'ES-PA'),(20,6,'ES-SA'),(21,6,'ES-SE'),(22,6,'ES-SO'),(23,6,'ES-VL'),(24,6,'ES-ZA'),(25,7,'ES-AB'),(26,7,'ES-CI'),(27,7,'ES-CU'),(28,7,'ES-GD'),(29,7,'ES-TO'),(30,8,'ES-BR'),(31,8,'ES-GI'),(33,8,'ES-LL'),(32,8,'ES-TA'),(34,9,'ES-MA'),(35,10,'ES-AI'),(36,10,'ES-CS'),(37,10,'ES-VA'),(38,11,'ES-BA'),(39,11,'ES-CA'),(40,12,'ES-LC'),(41,12,'ES-LU'),(42,12,'ES-OU'),(43,12,'ES-PO'),(44,13,'ES-IB'),(45,14,'ES-RI'),(46,15,'ES-NA'),(47,16,'ES-AL'),(49,16,'ES-BL'),(48,16,'ES-GP'),(50,17,'ES-MU'),(51,18,'ES-CE'),(52,19,'ES-ME'),(53,20,'andalucia'),(54,20,'aragon'),(55,20,'asturias'),(56,20,'cantabria'),(58,20,'castilla_la_mancha'),(57,20,'castilla_leon'),(59,20,'cataluna'),(60,20,'comunidad_madrid'),(61,20,'comunidad_valenciana'),(62,20,'extremadura'),(63,20,'galicia'),(64,20,'la_rioja'),(65,20,'navarra'),(66,20,'pais_vasco'),(67,20,'region_de_murcia'),(69,21,'canarias'),(70,21,'ceuta'),(68,21,'islas_baleares'),(71,21,'melilla'),(74,22,'ceuta'),(73,22,'islas_baleares'),(75,22,'melilla'),(72,22,'peninsula');
/*!40000 ALTER TABLE `sylius_zone_member` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-09 12:10:25
