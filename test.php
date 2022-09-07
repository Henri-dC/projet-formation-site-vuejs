<?php

$dbh = new PDO('mysql:host=db.3wa.io;dbname=henridecargouet_projet', 'henridecargouet', 'ca9e88646dd136996bfac1501ca085db');
    $sth = $dbh->prepare('CREATE TABLE `Articles`(
        `id` char(36) NOT NULL,
        `title` varchar(30) NOT NULL,
        `picture` varchar(30),
        `content` varchar(255) NOT NULL,
        `category` char(36),
        `author` char(36)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;'); 
      $sth->execute();
    