

CREATE DATABASE IF NOT EXISTS mobile_money;

USE mobile_money;




CREATE TABLE prefixe (

    id INT AUTO_INCREMENT PRIMARY KEY,

    valeur VARCHAR(3) NOT NULL UNIQUE,

    actif BOOLEAN DEFAULT TRUE

);




CREATE TABLE client (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nom VARCHAR(100) NOT NULL,

    numero VARCHAR(10) NOT NULL UNIQUE,

    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,

    actif BOOLEAN DEFAULT TRUE

);




CREATE TABLE type_operation (

    id INT AUTO_INCREMENT PRIMARY KEY,

    libelle VARCHAR(50) NOT NULL UNIQUE

);





CREATE TABLE bareme_frais (

    id INT AUTO_INCREMENT PRIMARY KEY,

    id_type_operation INT NOT NULL,

    montant_min DECIMAL(15,2) NOT NULL,

    montant_max DECIMAL(15,2) NOT NULL,

    frais DECIMAL(15,2) NOT NULL,

    actif BOOLEAN DEFAULT TRUE,


    FOREIGN KEY(id_type_operation)
        REFERENCES type_operation(id)

);



CREATE TABLE operation (

    id INT AUTO_INCREMENT PRIMARY KEY,

    id_type_operation INT NOT NULL,

    id_client_source INT NOT NULL,

    id_client_destination INT NULL,

    montant DECIMAL(15,2) NOT NULL,

    frais DECIMAL(15,2) DEFAULT 0,

    date_operation DATETIME DEFAULT CURRENT_TIMESTAMP,


    FOREIGN KEY(id_type_operation)
        REFERENCES type_operation(id),


    FOREIGN KEY(id_client_source)
        REFERENCES client(id),


    FOREIGN KEY(id_client_destination)
        REFERENCES client(id)

);




CREATE TABLE mouvement (

    id INT AUTO_INCREMENT PRIMARY KEY,


    id_operation INT NOT NULL,


    id_client INT NOT NULL,


    sens ENUM('CREDIT','DEBIT') NOT NULL,


    montant DECIMAL(15,2) NOT NULL,


    date_mouvement DATETIME DEFAULT CURRENT_TIMESTAMP,


    FOREIGN KEY(id_operation)
        REFERENCES operation(id),


    FOREIGN KEY(id_client)
        REFERENCES client(id)

);





INSERT INTO prefixe(valeur)
VALUES
('033'),
('037');





INSERT INTO type_operation(libelle)
VALUES
('Depot'),
('Retrait'),
('Transfert');





INSERT INTO client(nom,numero)
VALUES
('Jean','0331234567'),
('Paul','0379876543'),
('Marie','0331111111'),
('OPERATEUR','0000000000');




INSERT INTO bareme_frais
(
id_type_operation,
montant_min,
montant_max,
frais
)

VALUES
(
1,
0,
999999999,
0
);




INSERT INTO bareme_frais
(
id_type_operation,
montant_min,
montant_max,
frais
)

VALUES

(2,0,10000,200),

(2,10001,50000,500),

(2,50001,100000,1000),

(2,100001,999999999,1500);




INSERT INTO bareme_frais
(
id_type_operation,
montant_min,
montant_max,
frais
)

VALUES

(3,0,10000,100),

(3,10001,50000,300),

(3,50001,100000,700),

(3,100001,999999999,1200);