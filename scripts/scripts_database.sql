CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_password` varchar(45) NOT NULL,
  `user_date_of_birth` datetime DEFAULT NULL,
  `user_rg` varchar(45) DEFAULT NULL,
  `user_cpf` varchar(45) DEFAULT NULL,
  `user_profile_pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `address_id_user` int(11) NOT NULL,
  `address_street` varchar(45) NOT NULL,
  `address_number` varchar(45) NOT NULL,
  `address_zip_code` varchar(45) NOT NULL,
  `address_city` varchar(45) NOT NULL,
  `address_neighborhood` varchar(45) NOT NULL,
  `address_uf_state` varchar(45) NOT NULL,
  `address_complement` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `fk_address_id_user_idx` (`address_id_user`),
  CONSTRAINT `fk_address_id_user` FOREIGN KEY (`address_id_user`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `favorite_users` (
  `fav_id` int(11) NOT NULL,
  `fav_id_user` int(11) NOT NULL,
  `fav_id_fav_user` int(11) NOT NULL,
  PRIMARY KEY (`fav_id`),
  KEY `fk_favorite_users_id_user_idx` (`fav_id_user`),
  KEY `fk_favorite_users_id_fav_user_idx` (`fav_id_fav_user`),
  CONSTRAINT `fk_favorite_users_id_fav_user` FOREIGN KEY (`fav_id_fav_user`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_favorite_users_id_user` FOREIGN KEY (`fav_id_user`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `phones` (
  `phone_id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_id_user` int(11) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `cellphone` varchar(45) NOT NULL,
  PRIMARY KEY (`phone_id`),
  KEY `fk_phone_id_user_idx` (`phone_id_user`),
  CONSTRAINT `fk_phone_id_user` FOREIGN KEY (`phone_id_user`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `trades` (
  `trade_id` int(11) NOT NULL AUTO_INCREMENT,
  `trade_id_user_from` int(11) NOT NULL,
  `trade_id_user_to` int(11) NOT NULL,
  `trade_status` varchar(45) NOT NULL,
  `trade_title` varchar(45) NOT NULL,
  `trade_description` varchar(255) NOT NULL,
  `trade_id_category` int(11) NOT NULL,
  PRIMARY KEY (`trade_id`),
  KEY `fk_trades_id_category_idx` (`trade_id_category`),
  KEY `fk_trades_id_user_to_idx` (`trade_id_user_to`),
  KEY `fk_trades_id_user_from_idx` (`trade_id_user_from`),
  CONSTRAINT `fk_trades_id_category` FOREIGN KEY (`trade_id_category`) REFERENCES `categories` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trades_id_user_from` FOREIGN KEY (`trade_id_user_from`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trades_id_user_to` FOREIGN KEY (`trade_id_user_to`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `trade_pictures` (
  `trade_pic_id` int(11) NOT NULL,
  `trade_pic_idtrade` int(11) NOT NULL,
  `trade_pic_picture` varchar(255) NOT NULL,
  PRIMARY KEY (`trade_pic_id`),
  KEY `fk_trade_pictures_id_trade_idx` (`trade_pic_idtrade`),
  CONSTRAINT `fk_trade_pictures_id_trade` FOREIGN KEY (`trade_pic_idtrade`) REFERENCES `trades` (`trade_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wishes` (
  `wish_id` int(11) NOT NULL AUTO_INCREMENT,
  `wish_name` varchar(45) NOT NULL,
  PRIMARY KEY (`wish_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `trade_wishes` (
  `trade_wishes_id_trade` int(11) NOT NULL,
  `trade_wishes_id_wish` int(11) NOT NULL,
  PRIMARY KEY (`trade_wishes_id_trade`,`trade_wishes_id_wish`),
  KEY `fk_trade_wishes_id_wish_idx` (`trade_wishes_id_wish`),
  CONSTRAINT `fk_trade_wishes_id_trade` FOREIGN KEY (`trade_wishes_id_trade`) REFERENCES `trades` (`trade_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trade_wishes_id_wish` FOREIGN KEY (`trade_wishes_id_wish`) REFERENCES `wishes` (`wish_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;