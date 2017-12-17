-- #Creation du schema du projet web


CREATE TABLE enzyme (EC VARCHAR(15), Official_Name VARCHAR(150),	
Other_Name VARCHAR(150), Coefacteur VARCHAR(100), Commentaire VARCHAR(1500), 
Activity VARCHAR(1000), PRIMARY KEY (EC));

CREATE TABLE prosite (Id_P VARCHAR(50), EC VARCHAR(15), PRIMARY KEY (ID_P, EC),
FOREIGN KEY  (EC) REFERENCES enzyme (EC));

CREATE TABLE swissprot (Id_Sp VARCHAR(50), EC VARCHAR(15), PRIMARY KEY (ID_Sp, EC),
FOREIGN KEY  (EC) REFERENCES enzyme (EC));

CREATE TABLE publication (Titre VARCHAR(360), 	
Year_Pub INT, EC VARCHAR(15), Auteurs VARCHAR(670) ,PRIMARY KEY (Titre, Auteurs, EC, Year_Pub), 
FOREIGN KEY (EC) REFERENCES  enzyme (EC));
