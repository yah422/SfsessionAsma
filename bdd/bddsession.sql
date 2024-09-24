-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage des données de la table sfsessionasma.categorie : ~5 rows (environ)
INSERT INTO `categorie` (`id`, `nom`) VALUES
	(1, 'Developpement web'),
	(2, 'Bureautique'),
	(3, 'Design UI/UX'),
	(4, 'Vente'),
	(5, 'Comptabilité');

-- Listage des données de la table sfsessionasma.doctrine_migration_versions : ~0 rows (environ)

-- Listage des données de la table sfsessionasma.formateur : ~3 rows (environ)
INSERT INTO `formateur` (`id`, `email`, `nom`, `prenom`) VALUES
	(1, 'mickael@gmail.com', 'murmann', 'mickael'),
	(2, 'stephane@gmail.com', 'smail', 'stephane'),
	(3, 'andres@gmail.com', 'andres', 'mathilde');

-- Listage des données de la table sfsessionasma.messenger_messages : ~0 rows (environ)

-- Listage des données de la table sfsessionasma.module : ~7 rows (environ)
INSERT INTO `module` (`id`, `nom`, `categorie_id`) VALUES
	(1, 'PHP', 1),
	(2, 'Symfony', 1),
	(3, 'Initiation à la comptabilité', 5),
	(4, 'Word', 2),
	(5, 'Excel', 2),
	(6, 'Initiation à figma', 3),
	(7, 'Initiation vente', 4);

-- Listage des données de la table sfsessionasma.programme : ~0 rows (environ)

-- Listage des données de la table sfsessionasma.programme_module : ~0 rows (environ)

-- Listage des données de la table sfsessionasma.programme_session : ~0 rows (environ)

-- Listage des données de la table sfsessionasma.session : ~5 rows (environ)
INSERT INTO `session` (`id`, `formateur_id`, `nom`, `nbre_place`, `date_debut`, `date_fin`, `categorie_id`) VALUES
	(1, 3, 'Initiation au design', 11, '2024-09-24 21:49:53', '2024-09-29 21:49:55', 3),
	(2, 1, 'Initiation PHP', 10, '2024-09-18 22:30:45', '2024-09-24 22:30:53', 1),
	(3, 2, 'Initiation vente', 5, '2024-09-24 22:31:21', '2024-09-30 22:31:23', 4),
	(4, 1, 'Initiation Comptabilité', 7, '2024-09-12 22:34:08', '2024-09-20 22:34:16', 5),
	(5, 3, 'Initiation Word', 15, '2024-09-22 22:35:06', '2024-10-24 22:35:13', 2);

-- Listage des données de la table sfsessionasma.session_stagiaire : ~0 rows (environ)

-- Listage des données de la table sfsessionasma.stagiaire : ~1 rows (environ)
INSERT INTO `stagiaire` (`id`, `nom`, `prenom`, `email`, `tel`, `date_naissance`) VALUES
	(1, 'Saidi', 'Asma', 'asma@gmail.com', 'xxxxxx', '2001-09-24 21:50:49');

-- Listage des données de la table sfsessionasma.stagiaire_session : ~0 rows (environ)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
