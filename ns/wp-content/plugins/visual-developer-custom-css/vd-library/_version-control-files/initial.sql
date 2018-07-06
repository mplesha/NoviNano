CREATE TABLE IF NOT EXISTS visual_developer_page_version (
  id INT NOT NULL AUTO_INCREMENT ,
  page_id INT NOT NULL DEFAULT 0,
  name VARCHAR(1000) NOT NULL DEFAULT '',
  conversionTarget VARCHAR(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (id))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS visual_developer_page_version_assign (
  id INT NOT NULL AUTO_INCREMENT ,
  page_id INT NOT NULL DEFAULT 0,
  page_version_id INT NOT NULL DEFAULT 0,
  ip_address VARCHAR(100) NOT NULL DEFAULT '',
  creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (id))
  CHARACTER SET utf8 COLLATE utf8_general_ci
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS visual_developer_page_version_display (
  id INT NOT NULL AUTO_INCREMENT ,
  page_id INT NOT NULL DEFAULT 0,
  page_version_id INT NOT NULL DEFAULT 0,
  ip_address VARCHAR(100) NOT NULL DEFAULT '',
  creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (id))
  CHARACTER SET utf8 COLLATE utf8_general_ci
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS visual_developer_page_version_conversion (
  id INT NOT NULL AUTO_INCREMENT ,
  page_id INT NOT NULL DEFAULT 0,
  page_version_id INT NOT NULL DEFAULT 0,
  ip_address VARCHAR(100) NOT NULL DEFAULT '',
  creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (id))
  CHARACTER SET utf8 COLLATE utf8_general_ci
ENGINE = InnoDB;