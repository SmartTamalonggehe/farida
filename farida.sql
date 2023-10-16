-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: farida
-- ------------------------------------------------------
-- Server version	8.0.34-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `berita_acara`
--

DROP TABLE IF EXISTS `berita_acara`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `berita_acara` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `berita_acara_jadwal_id_foreign` (`jadwal_id`),
  CONSTRAINT `berita_acara_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `berita_acara`
--

LOCK TABLES `berita_acara` WRITE;
/*!40000 ALTER TABLE `berita_acara` DISABLE KEYS */;
/*!40000 ALTER TABLE `berita_acara` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `det_berita_acara`
--

DROP TABLE IF EXISTS `det_berita_acara`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `det_berita_acara` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `berita_acara_id` bigint unsigned NOT NULL,
  `tgl` date NOT NULL,
  `materi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jmlh_mhs` int NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `det_berita_acara_berita_acara_id_foreign` (`berita_acara_id`),
  CONSTRAINT `det_berita_acara_berita_acara_id_foreign` FOREIGN KEY (`berita_acara_id`) REFERENCES `berita_acara` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `det_berita_acara`
--

LOCK TABLES `det_berita_acara` WRITE;
/*!40000 ALTER TABLE `det_berita_acara` DISABLE KEYS */;
/*!40000 ALTER TABLE `det_berita_acara` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dosen`
--

DROP TABLE IF EXISTS `dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dosen` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `prodi_id` bigint unsigned NOT NULL,
  `NIDN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenkel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dosen_prodi_id_foreign` (`prodi_id`),
  CONSTRAINT `dosen_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dosen`
--

LOCK TABLES `dosen` WRITE;
/*!40000 ALTER TABLE `dosen` DISABLE KEYS */;
/*!40000 ALTER TABLE `dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dosen_login`
--

DROP TABLE IF EXISTS `dosen_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dosen_login` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dosen_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dosen_login_dosen_id_foreign` (`dosen_id`),
  KEY `dosen_login_user_id_foreign` (`user_id`),
  CONSTRAINT `dosen_login_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dosen_login_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dosen_login`
--

LOCK TABLES `dosen_login` WRITE;
/*!40000 ALTER TABLE `dosen_login` DISABLE KEYS */;
/*!40000 ALTER TABLE `dosen_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `prodi_id` bigint unsigned NOT NULL,
  `matkul_id` bigint unsigned NOT NULL,
  `dosen_id` bigint unsigned NOT NULL,
  `ruangan_id` bigint unsigned NOT NULL,
  `hari` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mulai` time NOT NULL,
  `seles` time NOT NULL,
  `semester` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` year NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwal_prodi_id_foreign` (`prodi_id`),
  KEY `jadwal_matkul_id_foreign` (`matkul_id`),
  KEY `jadwal_dosen_id_foreign` (`dosen_id`),
  KEY `jadwal_ruangan_id_foreign` (`ruangan_id`),
  CONSTRAINT `jadwal_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jadwal_matkul_id_foreign` FOREIGN KEY (`matkul_id`) REFERENCES `matkul` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jadwal_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `jadwal_ruangan_id_foreign` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal`
--

LOCK TABLES `jadwal` WRITE;
/*!40000 ALTER TABLE `jadwal` DISABLE KEYS */;
/*!40000 ALTER TABLE `jadwal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matkul`
--

DROP TABLE IF EXISTS `matkul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matkul` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `prodi_id` bigint unsigned NOT NULL,
  `kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks` smallint NOT NULL,
  `semester` smallint NOT NULL,
  `singkat` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `matkul_kode_unique` (`kode`),
  KEY `matkul_prodi_id_foreign` (`prodi_id`),
  CONSTRAINT `matkul_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matkul`
--

LOCK TABLES `matkul` WRITE;
/*!40000 ALTER TABLE `matkul` DISABLE KEYS */;
INSERT INTO `matkul` VALUES (1,1,'SI601','Tata Kelola SI/TI',3,6,'TatKel SI/TI','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(2,1,'SI402','Analisis dan Desain Perangkat Lunak',4,4,'ADPL','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(3,1,'SI829','Sistem Informasi Geografis',3,8,'SIG','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(4,1,'SI827','Pemrograman Multimedia',3,8,'Multimedia','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(5,1,'SI210','Arsitektur SI/TI Perusahaan',3,2,'Arsitektur','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(6,1,'SI607','Manajemen & Administrasi basis data',3,6,'MABD','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(7,1,'SI418','Pemrograman Visual II',3,4,'Visual II','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(8,1,'SI815','Kecerdasan Bisnis',3,8,'K.Bisnis','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(9,1,'SI733','ERP Finance',3,7,'ERP','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(10,1,'SI406','Keamanan Aset Informasi',3,4,'Keamanan','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(11,1,'SI623','Proyek Aplikasi SI',3,6,'Proyek Apk','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(12,1,'SI202','Statistik & Probabilitas',4,2,'Statistik','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(13,1,'SI726','Pemrograman Perangkat Bergerak',3,7,'PPB','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(14,1,'SI606','Riset Operasi',3,6,'RO','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(15,1,'SI404','Interaksi Manusia dan Komputer',3,4,'IMK','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(16,1,'SI209','Sistem Operasi',3,2,'SO','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(17,1,'SI621','Manajemen Rantai Suplay',3,6,'MRS','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(18,1,'SI204','Algoritma dan Struktur Data',4,2,'Algoritma','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(19,1,'SI405','Desain Basis Data',4,4,'DBD','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(20,1,'SI206','Bahasa Inggris II',2,2,'BE II','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(21,1,'OG103SI','Bahasa Indonesia',2,6,'BI','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(22,1,'SI622','Manajemen Resiko TI',3,6,'MRTI','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(23,1,'SI407','Pemrograman Berbasis Web',3,4,'WEB','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(24,1,'SI313','Analisa & Desain Proses Bisnis',3,3,'ADPB','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(25,1,'OG201SI','Kewarganegaraan',2,2,'KN','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(26,1,'SI826','Sistem Pendukung Keputusan',3,8,'SPK','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(27,1,'SI708','Metode Penelitian',2,7,'MetoPen','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(28,2,'OG206BI','Kewarganegaraan',2,2,'KN','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(29,2,'BI605','Biologi Molekuler',3,6,'B.Molekuler','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(30,2,'BI207','Fisika Dasar',3,2,'Fisika','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(31,2,'BI002','Iktiologi',2,8,'Iktiologi','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(32,2,'BI401','Sistematika Tumbuhan Tingkat Tinggi',3,4,'STTT','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(33,2,'BI205','Biologi Sel',3,2,'BioSel','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(34,2,'BI024','Biologi Mangrove',2,6,'BioMang','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(35,2,'Bi601','Sanitasi Lingkungan',2,6,'SL','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(36,2,'BI203','Kimia Organik',3,2,'KimOrg','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(37,2,'BI022','Limnologi',2,6,'Limnologi','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(38,2,'BI021','Biologi Laut',2,6,'BioLaut','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(39,2,'BI406','Biometri',2,4,'Biometri','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(41,2,'BI201','Pengetahuan Lingkungan',3,2,'Pengetahuan L','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(42,2,'BI402','Sistematika Vertebrata',3,4,'SisVerte','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(43,2,'BI008','Pencemaran Lingkungan',2,6,'Pencemaran L','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(44,2,'BI204','Mikrobiologi Dasar',3,2,'MikDas','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(45,2,'BI606','Penulisa Karya Ilmiah',2,6,'Karya Ilmiah','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(46,2,'BI404','Perkembangan Hewan',3,4,'Pkmbngn Hwn','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(47,2,'BI208','Biostatistik',3,2,'Biostatistik','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(48,2,'BI603','Metode Penelitian',2,6,'MetPen','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(49,2,'BI604','Manajemen Lingkungan',3,6,'Man.Ling','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(50,2,'BI405','Perkembangan Tumbuhan',3,4,'PerTum','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(51,2,'BI607','Inggris Biologi',3,6,'Eng Biologi','aktif','2023-10-16 01:34:21','2023-10-16 01:34:21'),(52,2,'BI407','Evolusi',2,4,'Evolusi','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(53,2,'BI403','Biosefty',2,4,'Biosefty','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(54,2,'BI015','Kultur Jaringan',2,8,'KulJar','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(55,2,'BI003','Bakteriologi',2,8,'Bakteriologi','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(56,2,'BI016','Fitohormon',2,6,'Fitohormon','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(57,2,'BI703','Rekayasa Genetika',3,8,'RekGen','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(58,2,'Abcd','Keanekaragaman Hayati',3,6,'Kean.Hayati','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(59,3,'OG2103TG','Kewarganegaraan',2,2,'KN','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(60,3,'OG6207TG','Metode Penelitian',2,6,'MetoPen','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(61,3,'OG2106TG','Bahasa Inggris I',3,2,'B Ing I','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(62,3,'TG6330','Geologi Eksplorasi',2,6,'GeoEkplo','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(63,3,'TG2452','Kimia Fisika + Praktikum',2,2,'KFP','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(64,3,'TG6332','Geologi Panas Bumi',2,6,'Geothermal','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(65,3,'TG4334','Ilmu Ukur Tanah + Praktikum',3,4,'IUT+P','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(66,3,'TG4455','Geohidrologi + Praktikum',3,4,'Geohidro','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(67,3,'TG6214','Geokimia Eksplorasi+Praktikum',3,6,'Geokimia Ekp','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(68,3,'OG2220','Matematika Dasar II',2,2,'MTK Dasar II','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(69,3,'TG4461','Geokomputasi + Praktikum',3,4,'Geokom','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(70,3,'TG2327','Fisika Dasar II + Praktikum',2,2,'Fisika II','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(71,3,'TG4208','Geotektonik',3,4,'GeoTek','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(72,3,'TG6333','Geologi Kelautan',2,6,'GeoKel','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(73,3,'TG2451','Geologi Sejarah',3,2,'GeoSeja','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(74,3,'TG6331','Geologi Migas',3,6,'GeoMigas','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(75,3,'TG4209','Geologi Pengindraan Jauh',3,4,'GeoPeng','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(76,3,'TG2453','Kristalografi & mineralogi + Praktikum',3,2,'Kristalog','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(77,3,'TG4450','Mineral Optik + Praktikum',3,4,'Min Opt','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(78,3,'TG2329','Geologi Fisik',2,2,'Geo Fisik','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(79,3,'TG4217','Petrografi',3,4,'Petro','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(80,3,'TG6221','Pemetaan Geologi',3,6,'Pemetaan Geo','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(83,1,'OG102SI','Pancasila',2,1,'PCL','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(84,1,'FS501','Ilmu Budaya Dasar',2,5,'IBD','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(85,1,'SI112','Organisasi & manajemen',3,1,'AM','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(86,1,'SI705','Technopreneuship',3,7,'TPS','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(87,1,'SI301','Dasar Pengembangan Perangkat Lunak',3,3,'DPPL','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(88,1,'OG101','Agama Kristen',2,1,'AK','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(89,1,'SI521','Manajemen Layanan TI',3,5,'ML TI','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(90,1,'SI303','kepemimpinan & Ketrampilan  Interpersonal',3,3,'KKP','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(91,1,'SI706','Etika Profesi',2,7,'EP','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(92,1,'SI725','Perencanaan Strategi SI/TI',3,7,'PS SI/TI','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(93,1,'SI101','Matematika Diskrit',3,1,'MD','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(94,1,'SI808','Penggalian Data  & Analitika Bisnis',3,6,'PDAB','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(95,1,'SI305','Pemrograman Berorientasi Obyek',3,3,'PBO','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(96,2,'OG102','Pancasila',2,1,'GSG','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(97,2,'BI001','Entomologi',2,7,'Entomologi','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(98,1,'SI514','E-Commerce',3,4,'EC','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(99,2,'BI307','Struktur Tumbuhan',3,3,'ST','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(100,1,'SI117','Sistem Dan Teknologi',3,3,'ST','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(101,1,'SI103','Dasar Pemrograman',3,1,'DP','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(102,1,'SI311','Desain & Manajemen Jaringan Komputer',3,3,'DMJK','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(103,1,'SI531','Perencanaan Sumber Daya Perusahaan',3,5,'PSDP','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(104,1,'SI304','Pengantar Basis Data',3,3,'PBD','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(105,1,'OG104','Bahasa Inggris I',3,1,'BI 1','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(106,1,'SI723','pengukuran kinerja TI',2,7,'PK TI','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(107,1,'SI520','Manajemen Proyek TI',3,5,'MP TI','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(108,1,'SI318','Pemrograman Visual I',3,3,'PV I','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(109,1,'SI503','Konstruksi  Dan Pengujian perangkat Lunak',3,5,'KPPL','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(110,3,'OG1107TG','Pancasila',2,1,'P.Sila','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(111,3,'OG1101TG','Agama Kristen',2,1,'Ag Kristen','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(112,3,'OG1105TG','Bahasa Indonesia',2,1,'Bhs Indo','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(113,3,'OG1445','Matematika Dasar I',3,1,'MTK I','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(114,3,'FS1446','Kimia Dasar + Praktikum',3,1,'Kimia Dsr','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(115,3,'FS1447','Fisika Dasar I + Praktikum',3,1,'Fsk Dsr I','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(116,3,'TG1448','Geologi Dasar',3,1,'Geo Dsr','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(117,3,'OG1104TG','Ilmu Budaya Dasar',2,1,'IBD','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(118,3,'TG3460','Geostatistik',3,3,'Geos','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(119,3,'TG3326','Matematika Geologi',2,3,'Mtk Geo','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(120,2,'FS104','Ilmu Budaya Dasar',2,1,'IBD','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(121,3,'TG3328','Kimia Analitik + Praktikum',3,3,'Kma Analitik','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(122,2,'BI017','Ekologi Hutan Tropis',2,1,'EHT','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(123,3,'TG3454','Petrologi + Praktikum',3,3,'Petrolg','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(124,3,'TG3457','Sedimentologi',3,3,'Sedimen','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(125,3,'TG3210','Geologi Struktur',3,3,'Geo Struktr','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(126,3,'TG3449','Geomorfologi',2,3,'Geomor','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(127,3,'TG3344','Bahasa Inggris II',2,3,'Bhs Ing 2','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(128,2,'BI301','Sistemantika Tumbuhan Tingkat Rendah',3,3,'STTT','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(129,3,'TG5213','Geologi Teknik + Praktikum',3,5,'Geo Teknik','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(130,3,'TG5458','Paleontologi & Mikropaleontologi + Praktikum',3,5,'Paleon & Mikro','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(131,3,'TG5212','Geofisika Eksplorasi + Praktikum',3,5,'Geofisik Eks','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(132,2,'BI503','Ekologi Tumbuhan',2,5,'Ektum','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(133,2,'BI304','Genetika',3,3,'Gen','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(134,3,'TG5456','Vulkanologi',2,5,'Vulkano','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(135,2,'BI504','Ekologi Hewan',1,1,'EH','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(136,3,'TG5211','Prinsip Statigrafi',3,5,'Prinsip Statig','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(137,2,'OG103','Bahasa Indonesia',2,1,'BI','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(138,3,'TG5459','Metode Pemetaan Geologi + Praktikum',3,5,'Mtd Pemet Geo','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(139,3,'TG5215','Geologi Ekonomi',3,5,'Geo Eko','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(140,2,'BI505','Fisiologi Tumbuhan',3,5,'Fistum','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(141,3,'TG5216','Geologi Batubara + Praktikum',3,5,'Geo Batubr','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(142,2,'BI108','Matematika',3,1,'MTK','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(143,3,'TG6218','Geoteknik + Praktikum',3,6,'Geotek','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(144,2,'BI305','Biokimia',3,3,'BioKim','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(145,2,'BI501','Kewirausahaan',3,5,'Kewirausahan','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(146,2,'BI106','Biologi Umum',3,1,'BU','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(147,2,'BI023','Planktonologi',2,7,'Plank','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(148,2,'BI107','Kimia Dasar',3,1,'KD','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(149,3,'TG7222','Geologi Lingkungan',3,7,'Geo Ling','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(150,2,'BI027','Entografi Papua',2,7,'EP','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(151,3,'TG7335','Geologi Ekonomi Lanjutan',2,7,'Geo Eko Lanjtn','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(152,3,'TG7336','Eksplorasi Endapan Mineral',2,7,'Eks Edp Min','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(153,3,'TG7337','Pengolahan Citra Geologi',2,7,'Peng Citra Geo','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(154,2,'BI306','Struktur Hewan',3,3,'SH','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(155,3,'TG7219','Manajement SDM & Wirausaha',2,7,'Man. SDM','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(156,2,'BI502','Fisiologi Mikrobia',3,5,'FM','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(157,3,'TG7338','Geokimia Migas',2,7,'Geo Migas','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(158,2,'BI309','Sistematika Invertebrata',3,3,'SI','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(159,3,'TG7339','Teknologi Batubara',2,7,'Tekno Batubara','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(160,2,'BI507','Fisiologi Hewan',3,3,'FH','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(161,3,'TG7340','Geokimia Panas Bumi',2,7,'GPB','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(162,3,'TG7341','Hidrogeologi',2,7,'Hidrogeo','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(163,2,'BI030','Biokimia Bahan Alam',2,7,'BBA','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(164,3,'TG7342','Mitigasi Bencana Geologi',2,7,'Mit Bencana Ge','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(165,2,'OG105','Bahasa Inggris 1',3,1,'BI','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(166,2,'BI308','Aplikasi Komputer',3,1,'Aplikom','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(168,3,'TG7343','Geologi Lingkungan & Geologi Pengembangan Wilayah',2,7,'G.Ling&Peng Wi','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(169,2,'OG101BI','Agama Kristen',2,1,'AK','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(170,2,'BI026','Pengendali Hayati',2,7,'PH','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(171,2,'BI013','Rancangan Percobaan',2,7,'Raper','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(172,2,'BI010','Manajemen Sampah Perkotaan',2,4,'MSP','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22'),(173,2,'BI011','Etnobotani',2,6,'Etno','aktif','2023-10-16 01:34:22','2023-10-16 01:34:22');
/*!40000 ALTER TABLE `matkul` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2019_12_14_000001_create_personal_access_tokens_table',1),(3,'2023_09_01_063316_create_prodi_table',1),(4,'2023_09_01_063317_create_matkul_table',1),(5,'2023_09_01_063318_create_dosen_table',1),(6,'2023_09_01_063334_create_ruangan_table',1),(7,'2023_09_01_063502_create_jadwal_table',1),(8,'2023_09_02_224218_create_dosen_login_table',1),(9,'2023_09_29_061043_create_upload_absen_table',1),(10,'2023_09_29_061054_create_upload_nilai_table',1),(11,'2023_09_29_061112_create_berita_acara_table',1),(12,'2023_09_29_061142_create_det_berita_acara_table',1),(13,'2023_10_02_204716_create_user_tokens_table',1),(14,'2023_10_05_004147_create_upload_rps_table',1),(15,'2023_10_06_200543_create_upload_berita_acara_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prodi`
--

DROP TABLE IF EXISTS `prodi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prodi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkat` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prodi`
--

LOCK TABLES `prodi` WRITE;
/*!40000 ALTER TABLE `prodi` DISABLE KEYS */;
INSERT INTO `prodi` VALUES (1,'5720','Sistem Informasi','SI','2023-10-16 01:34:09','2023-10-16 01:34:09'),(2,'4620','Biologi','BI','2023-10-16 01:34:09','2023-10-16 01:34:09'),(3,'3420','Teknik Geologi','TG','2023-10-16 01:34:09','2023-10-16 01:34:09');
/*!40000 ALTER TABLE `prodi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ruangan`
--

DROP TABLE IF EXISTS `ruangan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ruangan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ruangan`
--

LOCK TABLES `ruangan` WRITE;
/*!40000 ALTER TABLE `ruangan` DISABLE KEYS */;
INSERT INTO `ruangan` VALUES (1,'RK-1','Ruang Kuliah 1',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(2,'RK-2','Ruang Kuliah 2',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(3,'RK-3','Ruang Kuliah 3',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(4,'RK-4','Ruang Kuliah 4',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(5,'RK-5','Ruang Kuliah 5',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(6,'RK-6','Ruang Kuliah 6',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(7,'RK-7','Ruang Kuliah 7',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(8,'RK-8','Ruang Kuliah 8',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(9,'Lab-Kom-A','Laboratorium Komputer A',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(10,'Lab-Kom-B','Laboratorium Komputer B',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(11,'GSG','Gedung Serba Guna',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(12,'LAB-TG','Laboratorium Teknik Geologi',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(13,'LAB-BI','Laboratorium Biologi',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(14,'RB','Ruang Baca',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(15,'LAB-Kimia','Laboratorium Kimia',NULL,'2023-10-16 01:34:11','2023-10-16 01:34:11'),(16,'AULA-FST','Aula Fakultas Sains & Teknologi',100,'2023-10-16 01:34:11','2023-10-16 01:34:11');
/*!40000 ALTER TABLE `ruangan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_absen`
--

DROP TABLE IF EXISTS `upload_absen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upload_absen` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_id` bigint unsigned NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_absen_jadwal_id_foreign` (`jadwal_id`),
  CONSTRAINT `upload_absen_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_absen`
--

LOCK TABLES `upload_absen` WRITE;
/*!40000 ALTER TABLE `upload_absen` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_absen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_berita_acara`
--

DROP TABLE IF EXISTS `upload_berita_acara`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upload_berita_acara` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `berita_acara_id` bigint unsigned NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_berita_acara_berita_acara_id_foreign` (`berita_acara_id`),
  CONSTRAINT `upload_berita_acara_berita_acara_id_foreign` FOREIGN KEY (`berita_acara_id`) REFERENCES `berita_acara` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_berita_acara`
--

LOCK TABLES `upload_berita_acara` WRITE;
/*!40000 ALTER TABLE `upload_berita_acara` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_berita_acara` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_nilai`
--

DROP TABLE IF EXISTS `upload_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upload_nilai` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_id` bigint unsigned NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_nilai_jadwal_id_foreign` (`jadwal_id`),
  CONSTRAINT `upload_nilai_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_nilai`
--

LOCK TABLES `upload_nilai` WRITE;
/*!40000 ALTER TABLE `upload_nilai` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_rps`
--

DROP TABLE IF EXISTS `upload_rps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upload_rps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jadwal_id` bigint unsigned NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_rps_jadwal_id_foreign` (`jadwal_id`),
  CONSTRAINT `upload_rps_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_rps`
--

LOCK TABLES `upload_rps` WRITE;
/*!40000 ALTER TABLE `upload_rps` DISABLE KEYS */;
/*!40000 ALTER TABLE `upload_rps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_tokens`
--

DROP TABLE IF EXISTS `user_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_tokens_user_id_foreign` (`user_id`),
  CONSTRAINT `user_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_tokens`
--

LOCK TABLES `user_tokens` WRITE;
/*!40000 ALTER TABLE `user_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@fstuogp.com',NULL,'$2y$10$lcAp/Ke86rBu4u5eiX.4hewA.8jESvUNsVSQUTFLUbemSkl1BdvI2','12345','admin',NULL,'2023-10-16 01:34:08','2023-10-16 01:34:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-16 19:34:57
