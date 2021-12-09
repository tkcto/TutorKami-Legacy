

CREATE TABLE `1notif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `notif_msg` text NOT NULL,
  `notif_time` datetime DEFAULT NULL,
  `notif_repeat` int(11) DEFAULT '1',
  `notif_loop` int(11) NOT NULL DEFAULT '1',
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


INSERT INTO 1notif VALUES
("1","Title","Message","2021-04-03 05:00:00","1","1","2021-04-03 05:59:17","fadhli"),
("2","Title2","Message2","2021-04-03 06:00:00","2","2","2021-04-03 05:46:14","fadhli"),
("3","Title3","Message3","2021-04-03 07:00:00","3","3","2021-04-03 05:46:25","fadhli"),
("4","Title4","Message4","2021-04-03 08:00:00","4","4","2021-04-03 05:46:32","fadhli");




CREATE TABLE `1notif_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO 1notif_user VALUES
("1","admin","admin"),
("2","fadhli","fadhli");


