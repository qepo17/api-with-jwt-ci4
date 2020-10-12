-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table mdquiz-api.masterakademi
CREATE TABLE IF NOT EXISTS `masterakademi` (
  `akademiid` int(11) NOT NULL AUTO_INCREMENT,
  `kelasid` int(11) NOT NULL,
  `guruid` int(11) NOT NULL,
  `mapelid` int(11) NOT NULL,
  KEY `akademiid` (`akademiid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table mdquiz-api.masterakademi: ~2 rows (approximately)
/*!40000 ALTER TABLE `masterakademi` DISABLE KEYS */;
INSERT INTO `masterakademi` (`akademiid`, `kelasid`, `guruid`, `mapelid`) VALUES
	(1, 1, 1, 1),
	(2, 2, 1, 1);
/*!40000 ALTER TABLE `masterakademi` ENABLE KEYS */;

-- Dumping structure for table mdquiz-api.masterclassgroup
CREATE TABLE IF NOT EXISTS `masterclassgroup` (
  `kelasid` int(11) NOT NULL AUTO_INCREMENT,
  `kelasname` varchar(255) NOT NULL,
  `gradeid` int(11) NOT NULL,
  `jurusanid` int(11) NOT NULL,
  `walikelas_guruid` int(11) NOT NULL,
  KEY `kelasid` (`kelasid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table mdquiz-api.masterclassgroup: ~2 rows (approximately)
/*!40000 ALTER TABLE `masterclassgroup` DISABLE KEYS */;
INSERT INTO `masterclassgroup` (`kelasid`, `kelasname`, `gradeid`, `jurusanid`, `walikelas_guruid`) VALUES
	(1, 'A', 1, 1, 1),
	(2, 'B', 1, 1, 1);
/*!40000 ALTER TABLE `masterclassgroup` ENABLE KEYS */;

-- Dumping structure for table mdquiz-api.mastergrade
CREATE TABLE IF NOT EXISTS `mastergrade` (
  `gradeid` int(11) NOT NULL AUTO_INCREMENT,
  `gradename` varchar(255) NOT NULL,
  KEY `gradeid` (`gradeid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table mdquiz-api.mastergrade: ~3 rows (approximately)
/*!40000 ALTER TABLE `mastergrade` DISABLE KEYS */;
INSERT INTO `mastergrade` (`gradeid`, `gradename`) VALUES
	(1, '10'),
	(2, '11'),
	(3, '12');
/*!40000 ALTER TABLE `mastergrade` ENABLE KEYS */;

-- Dumping structure for table mdquiz-api.masterguru
CREATE TABLE IF NOT EXISTS `masterguru` (
  `guruid` varchar(255) NOT NULL DEFAULT '',
  `nickname` varchar(500) NOT NULL DEFAULT 'CURRENT_TIMESTAMP',
  `nama` varchar(500) NOT NULL,
  `tempat_lahir` varchar(500) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(500) NOT NULL DEFAULT '',
  `alamat` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `no_hp` varchar(500) NOT NULL,
  `foto` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `guruid` (`guruid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mdquiz-api.masterguru: ~1 rows (approximately)
/*!40000 ALTER TABLE `masterguru` DISABLE KEYS */;
INSERT INTO `masterguru` (`guruid`, `nickname`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `email`, `no_hp`, `foto`, `created_at`, `updated_at`) VALUES
	('1', '08862f0326261fd5b97994082094f0df830964239b862e758cce482e141637427798b525405662a6c7b429e74b51ed02305c75f66e883105698821721b1c81d1b94f8f80d2edb73a170992b624af1020f4d180057cfcc045c80bfad8136495b7', 'ed3172975602b262e8e4fccf0f7e169ef974471aa17e2603dfc6067970991b368159d01f6ec95441cd973ef4906b6e84c1530a8c05d2605bf6eba4b521f3f024646ca8c74ebd1ce3615da16de5fb6775462ad95ac44e', '8eae0af32a63fc9b778f6edec62e3a1712e64fc6b12b95faa54a22de1c2835f2842c1c4b472c7240e7e6c13d992c69009ec8d8bc0335a07f8c640eb0e3c24aec24d4f229ed882b7c796224d6c8765c8bb2005a1a190f', '1997-09-17', 'Laki-Laki', '8b6833fa873864014b5571f238af38a222d2c053efe153d02d610772ec90fd379c42075fb1f6a20efd494dee2bd8769b6f6bfdaad6a893e56b8a8718741bad79b839a7ada963e73a87d113869bf8058f71c72e2e15', '1bd00168a6e2087b60931b61c79266de65ce531ee42b4c847db49a5beec76c5524b085d99dbf5be493921bd729c7c1d9c2ce01fd9622166554153a76c4d3a7bd9c571f0e799f3c749ad808dc25980a5e7d367dc5db21e60c5ec904d66303', 'fa98c2b4cbcdae1db6a1ac3fa08b352a8a11afa22be3f86028d0ac73b072af76c9d91c05f96d4084ec701da57db135a037fb8976a74eee75a96110a47eab499ef8cb9c7165e73ef57fcba50afbc2f211eca647c2efb73e1611139cd7', 'default.png', '2020-09-29 10:30:07', '2020-09-29 13:10:14');
/*!40000 ALTER TABLE `masterguru` ENABLE KEYS */;

-- Dumping structure for table mdquiz-api.masterjurusan
CREATE TABLE IF NOT EXISTS `masterjurusan` (
  `jurusanid` int(11) NOT NULL AUTO_INCREMENT,
  `jurusanname` varchar(255) NOT NULL,
  KEY `jurusanid` (`jurusanid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table mdquiz-api.masterjurusan: ~3 rows (approximately)
/*!40000 ALTER TABLE `masterjurusan` DISABLE KEYS */;
INSERT INTO `masterjurusan` (`jurusanid`, `jurusanname`) VALUES
	(1, 'IPA'),
	(2, 'IPS'),
	(3, 'Bahasa Indonesia');
/*!40000 ALTER TABLE `masterjurusan` ENABLE KEYS */;

-- Dumping structure for table mdquiz-api.masterlogin
CREATE TABLE IF NOT EXISTS `masterlogin` (
  `no_induk` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`no_induk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mdquiz-api.masterlogin: ~9 rows (approximately)
/*!40000 ALTER TABLE `masterlogin` DISABLE KEYS */;
INSERT INTO `masterlogin` (`no_induk`, `password`, `last_login`) VALUES
	('1', '$2y$10$QYMbV0VQ3WWCV.pV/H34duVKvqhcOAHVOWSZvCg90bBkCyE3uUgGm', NULL),
	('2', '$2y$10$sN5yDj7U74r61besTzdAPe50XHFn53zr/oaSp61qNapFgN3Y.vDUe', NULL),
	('3', '$2y$10$Cf9wboPfsgAbo89xkZhfOOPkUmusQJ.C3nRqXJupU8ZJ5FhvXSe0S', NULL),
	('4', '$2y$10$ypiPiL24KbxANLo5SEBnDOlfYXfyxcBtwDMF99y9JN2uT6JGAFEim', NULL),
	('5', '$2y$10$lqDJp8ZshQhTMP5zG1vN4eRbwVUZfcrqnEclwHxdHC5Xay30b4ODC', NULL),
	('6', '$2y$10$VV27nm2rd/T/uDe7C37ghe04KP6xl3CcL02AIe3NfmtLw9XtfenfO', NULL),
	('7', '$2y$10$hqi76gmFD0VCt/s570G.xu2rjz7hfEDPNZLGuiWC.qxaX8liDTB1y', NULL),
	('8', '$2y$10$utiLEbTZHFZYterhxAMcYeL6HOxnCWn2KJDnJYtn3YDX5fBBOKDni', NULL),
	('9', '$2y$10$h9T5YCbFCZ2F5DWAuKPe/.tvxbII0S7qjIB8k0MzvzwrpVl99ABUG', NULL);
/*!40000 ALTER TABLE `masterlogin` ENABLE KEYS */;

-- Dumping structure for table mdquiz-api.masterlogin_guru
CREATE TABLE IF NOT EXISTS `masterlogin_guru` (
  `guruid` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  KEY `guruid` (`guruid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mdquiz-api.masterlogin_guru: ~2 rows (approximately)
/*!40000 ALTER TABLE `masterlogin_guru` DISABLE KEYS */;
INSERT INTO `masterlogin_guru` (`guruid`, `password`, `last_login`) VALUES
	('1', '$2y$10$YxzakEbm1MlbE4VqW/seLekoL7o78Y3Dp2drQHw7yGuAqzVX2nawi', NULL),
	('2', '$2y$10$5nYtEigDN.YcGULI.z/DwefUInRCXqXxKWsePNucE0lyoLkv6pW7q', NULL);
/*!40000 ALTER TABLE `masterlogin_guru` ENABLE KEYS */;

-- Dumping structure for table mdquiz-api.mastermapel
CREATE TABLE IF NOT EXISTS `mastermapel` (
  `mapelid` int(11) NOT NULL AUTO_INCREMENT,
  `mapelname` varchar(255) NOT NULL,
  KEY `mapelid` (`mapelid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table mdquiz-api.mastermapel: ~5 rows (approximately)
/*!40000 ALTER TABLE `mastermapel` DISABLE KEYS */;
INSERT INTO `mastermapel` (`mapelid`, `mapelname`) VALUES
	(1, 'Bahasa Indonesia'),
	(2, 'Matematika'),
	(3, 'Bahasa Inggris'),
	(4, 'IPA'),
	(5, 'Olahraga');
/*!40000 ALTER TABLE `mastermapel` ENABLE KEYS */;

-- Dumping structure for table mdquiz-api.mastersiswa
CREATE TABLE IF NOT EXISTS `mastersiswa` (
  `no_induk` varchar(255) NOT NULL DEFAULT '',
  `kelasid` int(11) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `tempat_lahir` varchar(500) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `no_hp` varchar(500) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`no_induk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table mdquiz-api.mastersiswa: ~8 rows (approximately)
/*!40000 ALTER TABLE `mastersiswa` DISABLE KEYS */;
INSERT INTO `mastersiswa` (`no_induk`, `kelasid`, `nama`, `tempat_lahir`, `tanggal_lahir`, `agama`, `jenis_kelamin`, `alamat`, `email`, `no_hp`, `foto`, `created_at`, `updated_at`) VALUES
	('1', 1, 'bf13e4427729aee779b41e6a425e676e81039848910dab983ddc5bfca069a8865ac2c2d707e6a192d254b973216aacebb99f5ee760d1e03d7c4d825490cef3c5b4a919e406bb3d6f132fd7095c25630005ea5f9b0a24', '81fb897b54fa367c3b27ae276617373ecfa49151079f478895b3f59bbad10fdf2ffb56c4d2698f1bcba5e5034048d6a6f2748b25f424dda284e9bb220236557d6314975ceef2a756bd507a1c28ca194125fb3b37dd3e', '1997-09-17', 'Islam', 'Laki-Laki', 'fe2a1b89318a8bb735ff8edbb26409c792fdc6ac186811305dd7d0232fcf00b0ab2fc9f2478f939989d72f018b251b0f143de02c4a69ae4110ff003ab549daa0bdb647add7fa59683d03b163307470ca2856d293ae', '4c93f957126518fce8f4f31817aec2f16666707282ce7ecc92e56f75f3d696c67181417589189ebe1b056a921f80cb3ebee9215e76943076d8b04f59573bc986376e1ba32de7b423a48d60f925372bda6d5280c8318386bb0c2b412854ef', '39e06d53b4f81a321e1b678c2bc3efab28e1fdf249a19e38a1cf882acc0a6ea5b0b62a8c6d326f8a5d3b49f351dfd542fca8e336fbd8dfc884b46790cc65e511fc46cea2935590b31ec6de8afc0ce77c7cb4e0a177211459feda740b', 'default.png', '2020-09-23 18:01:17', '2020-09-29 13:33:01'),
	('2', 1, '9647819f1c92fe415529273117f341af61708b1f90b9e8fe8c0b1e92131e90efb916bae29c263c6dbf1746f5e9ec561a58dea1e6cf0ee34d9058bed53d1ec437cb7ee0390e183583a27b77ead6eb2ddd0453054a54d697ebfda8f36064468bfa', '30623614c8a1a8b1540a9e8bf55578b7265ede6a975d88bfde9b9c65f325b64089d1b6fbfae700a716d5a17c0c1b7a6ae02264a249077a03512d1f8640c5b1801378fd65f1f2e4330d4f6b6104145e831403b7888e04', '1997-09-17', 'Islam', 'Laki-Laki', 'c7bbc5d62ae5bfc249fd07832ee807403fdf5b853d1c652db4475ac36de403444234a8fb7f858ba813bd9a1022b7bdeb1a1635a316d0409a4356775845a26d2d3bb6d2374a55333d668921012bb2338f6e89eb3637', '4fed0e48488db4fdfea167d81e4b3a31b4ead421034d831b267cb4d852aecc125dd1f08dfabd976ca6bd250b44e8706a63a9fc7c246fecce9896cac206572225d8cdeedffbc6ed54b3d0a26fe44d6f0689ea0fcc35874a41bc694714365e', '7bbd8a0f663a66450f918cc482e75a5406c3184b1df7d6e247ccf7ffc6ab2a84d95e75d96160bae9bc7f222b3ffd98abaa2fc8449bc10507dcb3e0815e669fb65e17e2d8d8b60a81c10c60c86309db905c455263b9412c69f3025fee', 'default.png', '2020-09-23 18:02:59', '2020-09-23 18:02:59'),
	('3', 1, 'b4abca5bfdfe798e05ddd6efe1ae454b4861dcb013a9e178fd23b49f565d7fef436bf7b86754a8ef685a80912d019dcc0b1250760e18c56245756210da6650728b0426fa020bff57612e4fd4080e6cffa2cb8fa6806aff047be9b62092aa9ae0', 'eefccde3622d53d135221ce51401be7433e703de1ee1836c5e8b46e04da95e501b83e82f864e70ab1b76105b86e0225e13b827b83b28aefa3d60d907cc7ac80394607aeaba39dc7941b94f76e5c819d45da7b7ac0e85', '1997-09-17', 'Islam', 'Laki-Laki', '40a321c824f16761f45f8c3f70bbe724493bbc898039b48ecbc17d04e19782b7886e582c8bee4ab09cc171da52db73b1f0bbd66ad116902e87ce19acfae9edc6bff7b746f73f10dab28f34d70a55ec12e8b7dbf601', '3ff7ed30584ce0490d94764e8108223d313422080ba0b5128a90e9f8e81e7e3722c448c25ed8d23c312dc16e15739fbf61f25e836b0d6d08845a6e2bd783fa064e8b5050d3ebea4353d529740aeb60afc72957a4ba3495ecfd54a8ef1f4a', '41dcefc5a639f46db05143e6206b305df4a356e9d43871dee6dfa4f6a0341423540a7184b33564d3ca2bccccc4d715f43d98165dac9fc66cda1b9b2e158387c8e2fda64c8e6e61259b4b9217777886ebb7d04272ecb943820447c67b', 'default.png', '2020-09-23 18:05:04', '2020-09-23 18:05:04'),
	('4', 1, '514da6527b1901426896780f879ff0960238f6f05a3867385976d021b63052dd5122ef148f4e00956ab2043813c46c35a6608c71b4199ba649cb3282d3a0ccebe96aab122be1f6faf5199f5c7f390e23f429c3eeab582cfd2beeb04e7212e564', '973f571c75ac59e712486c3c6c25f7df530ce0f44ac5ffd0ffc9849756d1fa0eb2da6ebc0c0f7f95b31d183fd2fb91caaccfea976eb8d977fa6b386d581a003eefa7dc2d7cfdd7616588105fef86afc5da916e4a5ea0', '1997-09-17', 'Islam', 'Laki-Laki', 'f9bda0bd1c18562742be7c571f1bb2abf1ad92c582a10f8a64b4d87964b4179b96ba6b20d44b3ee7ff87cdcd3654a194a14779108ed4840aeeec532ba2fb1c359782e0d49e9b146bad735e916708e9d876e4fc8ebf', '642dcf44925ae09df2b435460679f1a5ef847be85088c2244cac3a84f5c9fd0c0737603c75dac33855a42140ab5c17161e1e594872d6d913a4952471159aadde746fef3c49bcc6cb75689441a72339d08c8cbd4bb9ec4ef4ab3b8267b9bb', '0653874c0f153d2d0028bd02b2affc082f27a09ecce3c0f586812c2efacf59e8017ab70cbf6f209803084ddcb4ff35671151b5b1b0d518019d4953e43d38cf5ac8e623e7e16740eba88f392de1b5be03caa591a6b7b4ee239f0619c2', 'default.png', '2020-09-23 18:13:15', '2020-09-23 18:13:15'),
	('5', 1, '100442a975fca2019a3245a1930b3350b3db5f6488fb33360067a13234f215ee2e43a7d032408105e0f923b23744a7ffe9721d143ffa0cb19d6a9a1cdb2c2b9e01949ffa7809a65e37fdbb482121e65910a36a79d5945bdc3043999efd450897', 'fb8a2b9f143e38d88fb1068dc5c432bcf123f9439ae90d67be7d456b021a031cedcb2fa8c6b2b07a9e2a6c365bca313295c8c7f162ff8f48d37cb040fd4edceed3c9455f0c9a9d06633bfdd72de1dfa806d79a85c740', '1997-09-17', 'Islam', 'Laki-Laki', '923997280b58e36330dc178004c0df2dae5d690b22f9364349f638a4527404c190ffb7fb79d5a2b4b905904d62986b964031a65e95fd38f83592bd694f8c3066f41f3b3bcbc927ab58139688f8f2aa2b2f20d154fe', '51855d2d1d53f055e037ed867fb24bdea21b22ab690fb7d17e9e18239deb2a8955d8af02a21487315b0a78c5c8416a47cbd4dbf6f2c2d36f3223269d338939b83beecc6aa1f93745612745ec52529b64cf0899c1e6ff236d32d01c05afca', '337b2bfd05fd6ffec4df46ee56833b20d77516529aaeb5e296aa34e7e1a03da08e3dad54c7e22fde79e2f97a7f17ac96295376ea898a0d3832b6064318d83a3573ccf461a92439b1f16e2bfda33a9ee9fdd3d82f867e8aefc6fb72e1', 'default.png', '2020-09-23 17:59:39', '2020-09-23 17:59:39'),
	('6', 1, '92939972f23a7638e4055665b401ef52be03f5ed6278091fd20bcd7abbbffdc1ab25417b88ca377cf8d04628c9100be913ab5f8c15fa35f37f27d63e46bd26ff8cad4758430078cb781668c7b87191f7a9cbd1e44aa4d112def37e269c6574c9', '9cc3cbd0c22224538b1230221ea310a5b52ed1c39e3225aa7c854c86ff719299c1b984adf233c50fb1a5504dd77ab2dfce54e4034485e6a1749101f1e53abe5267ceb1780c732d011bc7bac5a5c9bb9179bda5693daf', '1997-09-17', 'Islam', 'Laki-Laki', 'f98bd65c05165b5ea3a2841567621a067395a733d0e78527a0d9ce93f97315ad6073f3074fddb3983da8a9e9a284c4c22e4e05468ac2f9381dea2a0823289b957e7639d7973f8d666b2ff4f263d5d0b52062f3cf5f', 'e6897e321ab007123b592b3befd7e8a532fb45d9ff88311d145835542f8aaae71ae4b25bb7662d9737cff7c89d3b8335b147282f217b560ca06254116a847a6f4e4fd3ed6d68dbfac9a74148e708de0ff23bc57904b09d3d68f56657516f', 'e208db8d2ce2e627e6e6c1024502d9cab5a8a37cd6dea32e4d1ebeab8ecf77950f83137d34743c1e8bb702b67dab7897d4a714dea951117b5af0c32c03e7ce5473fb6b270192b89c539eaa7f52ac4429b408f3d2243b07616f711127', 'default.png', '2020-09-24 09:51:07', '2020-09-24 09:51:07'),
	('7', 1, '1ea2c0ab2f372fdaea0ae16f282b5648043ae83f958ef5c362f7eaaa528b7e2b35a9a562fd6e553ea6abd14e56770414f2a65fc862f21504accf81d80871ce65202bb214abd474eb60b27f98f0237e4f63b3cfb60b87193b96450c4b81276390', 'e699292adb01592a717fa5076e98193fc7f7072149e2e801cb621a4c8d3e95e054344620c7932a63e2ddb7385bbf135b18b13c100a0edeab77e75cd7ca374e9b138b3881864cdbfe345c2a738a5945916efb885679f8', '1997-09-17', 'Islam', 'Laki-Laki', '9d97100f1040e644a8a347de47961ba726128fd2483fb36297ab944f68fecca231a21cf103cf1d3d429205abbdb9c3e29e48c9a81ad4fd1119abf1079548a4e5fa7dc0e43442671c57cec72e093f7a7ce510d25b57', 'de8be8a4cf22f213b832e407398b8897a59a5f2d6041eac2c7df1424a2d3656cc94abb12b63a9024d1a12c814d20c2eee6317251fd8efac73baefe6da15e79856fee4e07aeba433509a1eb1596c471035db639da3f2077d6f014dfac82c9', 'aa949a8f7c3a7fd593a27f5728d4a3a3126bee8997ed3322bc33431a2dd6c5d2f0fa17f35cd291879f86190d6c15114bda14064dee97ef7e5144ffd11271e596ca47def12f33fbe1d3fa7f6b53b0adefc9f76bfb5c141ea42bb403f6', 'default.png', '2020-09-24 23:32:29', '2020-09-24 23:32:29'),
	('8', 1, '84df974d09ae49051ab1b6e6cbe9a3f25b12764cf5ec774a9251b2fa7a39a53d6b3d360bd67b56cebc754c1f1bf94a298ec8f62d17c8ea3845bf20a9f384411ffb8af6a720b8b2838db1ca1bcf3da6666ba0752606cbee09109b1881235958ac', '8b53675f51d92960d39bcffb95ec7328b073aa0e9938d144fec73d3dad5a1fd0a2d4c9459c677ee5368702d166a0ee00e1ba1b7dc1c4b59d14fbdeda30534f34c2e4bdcacc2c4ae86d08338ed68a76b18a02e4c5defc', '1997-09-17', 'Islam', 'Laki-Laki', '8f309989ff7cb85e16a8dac6618a68476dc6eb96bbc759396a65ef0a6dd86e6fd2fa32d11f1a7d2eb6d58e4850de7a21fc2f26ad7ac136e3384e87f83e5270bb128c564db2266cfe71ca35fce3850c60e6b3ae5052', '9f577b1bddc77eaece3962647877c7ec5fd71f4c920c774775d63109a8c14a2d66e9654ce753d5fafe1e28f074797db8a248f3e7ac99334d4455d9412d9f12b82dda4a42898b164f379d27f346acef71a250a8378c294bcbc249538d4a39', '09984abab29249869fa70cb9d5ca1c7e19ea851355251b2f4221f75d3e678e3c8ec026ad793766457f6375e545fe7e9e7f2d5b7ebf7ef891efa683a80df603b9861bffa77bfb23b7fcc468ba163667b3d7f045982eaec38db66ae7f9', 'default.png', '2020-09-25 09:45:41', '2020-09-25 09:45:41');
/*!40000 ALTER TABLE `mastersiswa` ENABLE KEYS */;

-- Dumping structure for table mdquiz-api.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table mdquiz-api.migrations: ~9 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2020-09-22-075929', 'App\\Database\\Migrations\\Mastersiswa', 'default', 'App', 1600762287, 1),
	(2, '2020-09-22-080656', 'App\\Database\\Migrations\\MasterLogin', 'default', 'App', 1600762287, 1),
	(3, '2020-09-27-025154', 'App\\Database\\Migrations\\Mastergrade', 'default', 'App', 1601175481, 2),
	(4, '2020-09-27-025428', 'App\\Database\\Migrations\\Masterjurusan', 'default', 'App', 1601175481, 2),
	(5, '2020-09-27-025616', 'App\\Database\\Migrations\\Masterguru', 'default', 'App', 1601175482, 2),
	(6, '2020-09-29-024721', 'App\\Database\\Migrations\\MasterloginGuru', 'default', 'App', 1601347696, 3),
	(7, '2020-09-29-071654', 'App\\Database\\Migrations\\Masterclassgroup', 'default', 'App', 1601363909, 4),
	(8, '2020-09-30-025146', 'App\\Database\\Migrations\\Masterakademi', 'default', 'App', 1601434476, 5),
	(9, '2020-09-30-025322', 'App\\Database\\Migrations\\Mastermapel', 'default', 'App', 1601434476, 5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
