create table people(n_document int(25),
	                  type_document_people varchar(10),
	                  first_name varchar(20) not null,
	                  second_name varchar(20),
	                  first_lastname varchar(20)not null,
	                  second_lastname varchar(20),
	                  birth_date date not null,
	                  age int(3) not null,
	                  address varchar(30),
	                  number_phone varchar(15)not null,
	                  email varchar(30) not null,
	                  rol_user varchar(10),
	                  routines_user varchar(20),
	                  history_clinic_user int);

CREATE TABLE `admon` (
  `usuario` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admon` (`usuario`, `password`) VALUES
('frost', '123456789');

create table role (name_rol varchar(10),
	                state_rol boolean not null);

create table type_document(code_document varchar(10),
	                        desc_document varchar(15) not null);

create table routine (cod_routine varchar(20),
	                  desc_routine varchar(50) not null);

create table routine_exercise(re_nom_exercise varchar(10),
	                           re_cod_routine varchar(20) not null,
	                           rep_time varchar(35) not null);	

create table exercise (name_ejr varchar(50),
	                     state_ejr boolean not null,
	                     machines_maqac varchar (50) not null );	

create table machines_accessories (name_maq varchar(50),
	                              state_mac boolean not null);

create table measurement (cod_measurement int,
                      back decimal not null,
                      chest decimal not null,
                      abdomen decimal not null,
                      leg decimal not null,
                      calf_muscle decimal not null,
                      arm decimal not null,
                      forearm decimal not null,
                      weight float not null);

create table history_clinic (cod_history int auto_increment primary key,
	                         date_history varchar(45)not null,
	                         user_n_document int(25),
	                         user_type_document varchar(10));

create table history_clinic_measurement (history_cod_measurement int,
	                                   history_cod_history int);

create table disease (name_disease varchar(50),
	                     state_disease boolean not null);

create table history_clinic_disease (disease_cod_disease varchar(50),
	                                 history_cod_disease int);

alter table people add primary key (n_document,type_document_people);
alter table role add primary key (name_rol);
alter table type_document add primary key(code_document);
alter table routine add primary key(cod_routine);
alter table exercise add primary key(name_ejr);
alter table machines_accessories add primary key(name_maq);
alter table routine_exercise add primary key(re_cod_routine,re_nom_exercise);
alter table measurement add primary key(cod_measurement);
-- alter table history_clinic add primary key(cod_history);
alter table history_clinic_measurement add primary key(history_cod_measurement,history_cod_history);
alter table disease add primary key(name_disease);
alter table history_clinic_disease add primary key(disease_cod_disease,history_cod_disease);


alter table people add foreign key (type_document_people) references type_document(code_document)
on update cascade on delete cascade;
alter table people add foreign key (rol_user) references role(name_rol)
on update cascade on delete cascade;
alter table people add foreign key (routines_user) references routine(cod_routine)
on update cascade on delete cascade;
alter table routine_exercise add foreign key (re_cod_routine) references routine(cod_routine)
on update cascade on delete cascade;
alter table routine_exercise add foreign key (re_nom_exercise) references exercise(name_ejr)
on update cascade on delete cascade;
alter table exercise add foreign key (machines_maqac) references machines_accessories(name_maq)
on update cascade on delete cascade;
alter table history_clinic_measurement add foreign key (history_cod_history) references history_clinic(cod_history)
on update cascade on delete cascade;
alter table history_clinic_measurement add foreign key (history_cod_measurement) references measurement(cod_measurement)
on update cascade on delete cascade;
alter table history_clinic_disease add foreign key (disease_cod_disease) references disease(name_disease)
on update cascade on delete cascade;
alter table history_clinic_disease add foreign key (history_cod_disease) references history_clinic(cod_history)
on update cascade on delete cascade;
alter table people add foreign key (history_clinic_user) references history_clinic(cod_history)
on update cascade on delete cascade;
alter table history_clinic add foreign key (user_n_document,user_type_document) references people(n_document,type_document_people)
on update cascade on delete cascade;