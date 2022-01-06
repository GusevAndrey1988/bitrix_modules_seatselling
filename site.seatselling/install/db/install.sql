CREATE TABLE IF NOT EXISTS `site_seat_selling_section` (
    `ID` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `NAME` VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `site_seat_selling_seat` (
    `ID` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `SECTION_ID` INT(11) NOT NULL,
    `ROW` SMALLINT UNSIGNED NOT NULL,
    `COL` SMALLINT UNSIGNED NOT NULL,

    FOREIGN KEY (`SECTION_ID`)
        REFERENCES `site_seat_selling_section`(`ID`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    UNIQUE KEY (`SECTION_ID`, `ROW`, `COL`)
);

CREATE TABLE IF NOT EXISTS `site_seat_selling_price_policy` (
    `ID` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `NAME` VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `site_seat_selling_cost` (
    `SEAT_ID` INT(11) NOT NULL,
    `PRICE_POLICY_ID` INT(11) NOT NULL,
    `VALUE` NUMERIC(6, 2) NOT NULL,

    PRIMARY KEY (`SEAT_ID`, `PRICE_POLICY_ID`),

    FOREIGN KEY (`SEAT_ID`)
        REFERENCES `site_seat_selling_seat`(`ID`)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

        FOREIGN KEY (`PRICE_POLICY_ID`)
        REFERENCES `site_seat_selling_price_policy`(`ID`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `site_seat_selling_event` (
    `ID` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `PRICE_POLICY_ID` INT(11) NOT NULL,
    `DESCRIPTION` TEXT,
    `EVENT_TIME` DATETIME NOT NULL,
    `DURATION` SMALLINT,

    FOREIGN KEY (`PRICE_POLICY_ID`)
        REFERENCES `site_seat_selling_price_policy`(`ID`)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

/* CREATE TABLE IF NOT EXISTS `site_seat_selling_ticket` (
    `ID` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `SEAT` INT(11) NOT NULL,
    `EVENT` INT(11) NOT NULL,

    FOREIGN KEY (`SEAT`)
        REFERENCES `site_seat_selling_seat`(`ID`)
        ON DELETE SET NULL
        ON UPDATE CASCADE,

    FOREIGN KEY (`EVENT`)
        REFERENCES `site_seat_selling_event`(`ID`)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
); */