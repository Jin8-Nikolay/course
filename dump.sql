DROP TABLE IF EXISTS `rental_description`;
CREATE TABLE `rental_description`
(
    `id_rental`   INT (11) NOT NULL,
    `photos`      TEXT,
    `description` TEXT,
    `conditions`  TEXT,
    `notes`       TEXT
);

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews`
(
    `id_rental` INT (11) NOT NULL,
    `id_user`   INT (11) NOT NULL,
    `appraisal` INT(2) NOT NUll,
    `text`      TEXT,
    `date`      INT(11) NOT NULL
);