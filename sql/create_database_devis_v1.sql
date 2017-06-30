drop database if exists devis_v1;
create database devis_v1;
use devis_v1;

create table demande(
id_demande int not null auto_increment,
nom_entreprise varchar(70),
nom_contact varchar(70),
prenom_contact varchar(70),
email_contact varchar(120),
adresse_contact varchar(150),
cp_contact varchar(5),
ville_contact varchar(70),
sexe_contact varchar(3),
fonction_contact varchar(70),
CONSTRAINT pk_demande PRIMARY KEY(id_demande)
);

create table certification(
id_certification int not null,
nom_certification varchar(60),
prix_unit_certif decimal(6,2),
CONSTRAINT pk_certification PRIMARY KEY(id_certification)
);

create table formation_atlas(
id_formation_a int not null auto_increment,
nom_formation_a varchar(70),
nb_jours_formation_a int,
theme_formation_a varchar(80),
niveau_formation_a varchar(80),
version_formation_a varchar(30),
pers_maxi_a int,
CONSTRAINT pk_formation_atlas PRIMARY KEY(id_formation_a)
);

create table formation_mrp(
id_formation_mrp int not null auto_increment,
nom_formation_mrp varchar(70),
nb_jours_formation_mrp int,
theme_formation_mrp varchar(80),
niveau_formation_mrp varchar(80),
version_formation_mrp varchar(30),
pers_maxi_mrp int,
CONSTRAINT pk_formation_mrp PRIMARY KEY(id_formation_mrp)
);

create table devis_formation_atlas(
id_formation_a int not null,
id_demande int not null,
date_creation_devis_a datetime,
type_session_a varchar (5),
lieu_formation_a varchar(30),
nb_pers_formation_a int,
cadre_cpf ENUM('true','false'),
id_certification int,
nb_certif int,

CONSTRAINT pk_devis_formation_atlas PRIMARY KEY (id_formation_a, id_demande, date_creation_devis_a),
CONSTRAINT fk_devis_formation_atlas FOREIGN KEY(id_formation_a) REFERENCES formation_atlas(id_formation_a),
CONSTRAINT fk_devis_formation_atlas_demande FOREIGN KEY(id_demande) REFERENCES demande(id_demande),
CONSTRAINT fk_devis_formation_atlas_certification FOREIGN KEY(id_certification) REFERENCES certification(id_certification)
);

create table devis_formation_mrp(
id_formation_mrp int not null,
id_demande int not null,
date_creation_devis_mrp datetime,
version_formation_a varchar(30),
type_session_a varchar (5),
lieu_formation_a varchar(30),
nb_pers_formation_mrp int,

CONSTRAINT pk_devis_formation_mrp PRIMARY KEY(id_formation_mrp,id_demande,date_creation_devis_mrp),
CONSTRAINT fk_devis_formation_mrp FOREIGN KEY(id_formation_mrp) REFERENCES formation_mrp(id_formation_mrp),
CONSTRAINT fk_devis_formation_mrp_demande FOREIGN KEY(id_demande) REFERENCES demande(id_demande)
);

create table tarif_atlas(
id_formation_a int not null,
nb_pers_a int not null,
prix_inter_a decimal(6,2),
prix_intra_a_atlas decimal(6,2),
prix_intra_a_client decimal(6,2),
CONSTRAINT pk_tarif_atlas PRIMARY KEY(id_formation_a,nb_pers_a),
CONSTRAINT fk_tarif_atlas_id_formation_a FOREIGN KEY(id_formation_a) REFERENCES formation_atlas(id_formation_a)
);

create table tarif_mrp(
id_formation_mrp int not null,
nb_pers_mrp int not null,
prix_inter_mrp decimal(6,2),
prix_intra_mrp_atlas decimal(6,2),
prix_intra_mrp_client decimal(6,2),
CONSTRAINT pk_tarif_atlas PRIMARY KEY(id_formation_mrp,nb_pers_mrp),
CONSTRAINT fk_tarif_mrp_id_formation_mrp FOREIGN KEY(id_formation_mrp) REFERENCES formation_mrp(id_formation_mrp)
);

create table formation_cpf(
id_formation int not null,
cadre_cpf ENUM('oui','non'),
code_cpf_regional varchar(25),
code_cpf_national varchar(25),
CONSTRAINT pk_formation_cpf PRIMARY KEY(id_formation),
CONSTRAINT fk_formation_cpf_id_formation FOREIGN KEY(id_formation) REFERENCES formation_atlas(id_formation_a)
);



create table certifier(
id_certification int not null,
id_formation_a int not null,
CONSTRAINT pk_certifier PRIMARY KEY(id_certification,id_formation_a),
CONSTRAINT fk_certifier_id_certification FOREIGN KEY(id_certification) REFERENCES certification(id_certification),
CONSTRAINT fk_certifier_id_formation FOREIGN KEY(id_formation_a) REFERENCES formation_atlas(id_formation_a)
);

create table admin(
id_admin int not null,
login varchar(50),
mdp varchar(50),
CONSTRAINT pk_admin PRIMARY KEY(id_admin)
);