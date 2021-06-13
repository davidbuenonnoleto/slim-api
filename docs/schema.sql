CREATE TABLE `phoenix_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `migration_datetime` varchar(255) NOT NULL,
  `classname` varchar(255) NOT NULL,
  `executed_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_id` int(11) DEFAULT '2',
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `created_user_id` (`created_user_id`),
  KEY `updated_user_id` (`updated_user_id`),
  KEY `user_role_id` (`user_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

CREATE TABLE `route` (
  `id` int NOT NULL AUTO_INCREMENT,
  `areacode` int NOT NULL,
  `description` varchar(45) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`,`arecode`),
  KEY `fk_routes_users_idx` (`user_id`),
  CONSTRAINT `fk_route_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

CREATE TABLE `package` (
  `id` int NOT NULL AUTO_INCREMENT,
  `weight` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `route_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_packages_routes_idx` (`route_id`),
  CONSTRAINT `fk_package_route` FOREIGN KEY (`route_id`) REFERENCES `route` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
