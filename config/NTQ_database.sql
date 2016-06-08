
CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL UNIQUE,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `avatar` text NOT NULL,
  `activate` tinyint(1) NOT NULL DEFAULT '1' COMMENT '2-deactivate, 1-activate',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `item_delete` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-deleted, 1-notDelete',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `categories` (
`id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `category_name` varchar(100) NOT NULL UNIQUE,
  `activate` tinyint(1) NOT NULL DEFAULT '1' COMMENT '2-deactivate, 1-activate',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `item_delete` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-deleted, 1-notDelete',
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `products` (
`id` int(10) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL UNIQUE,
  `category_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `activate` tinyint(1) NOT NULL DEFAULT '1' COMMENT '2-deactivate, 1-activate',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `item_delete` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-deleted, 1-notDelete',
  PRIMARY KEY (id),
  FOREIGN KEY (category_id) REFERENCES categories(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
