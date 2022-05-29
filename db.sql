CREATE TABLE comics(
id varchar(255) PRIMARY KEY, 
nome varchar(255),
price varchar(255),
immagine varchar(255)
)Engine = InnoDB;

CREATE TABLE iscritto(
nome varchar(255),
cognome varchar(255),
username varchar(255) PRIMARY KEY,
email varchar(255),
password varchar(255)
)Engine = InnoDB;

CREATE TABLE likes(
 id int AUTO_INCREMENT PRIMARY KEY,
 username_utente varchar(255),
 id_comic varchar(255),
 FOREIGN KEY(username_utente) REFERENCES iscritto(username), 
 FOREIGN KEY(id_comic) REFERENCES comics(id)
)Engine = InnoDB;