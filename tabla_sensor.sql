SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `tabla_sensor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `presion` float(3) NOT NULL,
  `humedad` int(2) NOT NULL,
  `temperatura` int(2) NOT NULL,
  `distancia` varchar(10) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;