CREATE TABLE liga
(
  id DOUBLE PRIMARY KEY AUTO_INCREMENT,
  naziv VARCHAR(20) NOT NULL,
  tr_kolo DOUBLE,
  br_odigranih_meceva_u_kolu DOUBLE
);

CREATE TABLE arena
(
  id DOUBLE PRIMARY KEY AUTO_INCREMENT,
  naziv VARCHAR(20) NOT NULL,
  seatsLvl DOUBLE NOT NULL,
  snacksLvl DOUBLE NOT NULL,
  parkingLvl DOUBLE NOT NULL,
  drinksLvl DOUBLE NOT NULL,
  seats DOUBLE NOT NULL,
  snacks DOUBLE NOT NULL,
  parking DOUBLE NOT NULL,
  drinks DOUBLE NOT NULL,
  cena_karte DOUBLE NOT NULL
);

CREATE TABLE tim
(
  id DOUBLE PRIMARY KEY AUTO_INCREMENT,
  naziv VARCHAR(15) UNIQUE NOT NULL,
  pozicija DOUBLE NOT NULL,
  br_odigranih DOUBLE NOT NULL,
  pobede DOUBLE NOT NULL,
  porazi DOUBLE NOT NULL,
  kos_kolicnik DOUBLE NOT NULL,
  br_bodova DOUBLE NOT NULL,
  forma VARCHAR(5) NOT NULL,
  logo VARCHAR(200) NOT NULL,
  balance DOUBLE NOT NULL,
  br_osvojenih_titula DOUBLE NOT NULL,
  stil VARCHAR(12) NOT NULL,
  sponzor VARCHAR(20),
  
  arena_id DOUBLE UNIQUE NOT NULL,
  FOREIGN KEY (arena_id) REFERENCES arena(id)
  /*liga_id DOUBLE UNIQUE NOT NULL,
  FOREIGN KEY (liga_id) REFERENCES liga(id),*/
);

CREATE TABLE korisnik
(
  id DOUBLE PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(20) UNIQUE NOT NULL,
  password VARCHAR(20) NOT NULL,
  
  tim_id DOUBLE NOT NULL UNIQUE,
  FOREIGN KEY (tim_id) REFERENCES tim(id)
);

CREATE TABLE utakmica
(
  id DOUBLE PRIMARY KEY AUTO_INCREMENT,
  br_kola DOUBLE,
  prvi_tim_id DOUBLE NOT NULL,
  drugi_tim_id DOUBLE NOT NULL,
  poeni_prvog_tima DOUBLE,
  poeni_drugog_tima DOUBLE,
  datum_i_vreme DATETIME,
  status VARCHAR(1),
  poruka VARCHAR(200),
  timeout_t1 DOUBLE NOT NULL,
  btimeout_t1 DOUBLE NOT NULL,
  timeout_t2 DOUBLE NOT NULL,
  btimeout_t2 DOUBLE NOT NULL,
  minuti DOUBLE NOT NULL, 
  sekunde DOUBLE NOT NULL, 
  cetvrtina DOUBLE NOT NULL,
  
  FOREIGN KEY (prvi_tim_id) REFERENCES tim(id),
  FOREIGN KEY (drugi_tim_id) REFERENCES tim(id) 
);

CREATE TABLE igrac
(
  id DOUBLE PRIMARY KEY AUTO_INCREMENT,
  broj_na_dresu DOUBLE,
  ime VARCHAR(20) NOT NULL,
  prezime VARCHAR(20) NOT NULL,
  starost DOUBLE NOT NULL,
  stamina DOUBLE NOT NULL,
  moral DOUBLE NOT NULL,
  visina DOUBLE NOT NULL,
  pozicija VARCHAR(2) NOT NULL,
  brzina DOUBLE NOT NULL,
  agresivnost DOUBLE NOT NULL,
  -- statovi za napad
  sut_za_2 DOUBLE NOT NULL,
  sut_za_3 DOUBLE NOT NULL,
  sut_za_slobodna DOUBLE NOT NULL,
  skok_u_napadu DOUBLE NOT NULL,
  asistencija DOUBLE NOT NULL,
  dribling DOUBLE NOT NULL,
  -- statovi za odbranu
  skok_u_odbrani DOUBLE NOT NULL,
  blokada DOUBLE NOT NULL,
  presecen_pas DOUBLE NOT NULL,
  ukradena_lopta DOUBLE NOT NULL,
  
  next_level DOUBLE NOT NULL,
  cost DOUBLE NOT NULL,
  
  salary DOUBLE,
  contract_length DOUBLE,
  aktivan DOUBLE,
  
  indeks DOUBLE DEFAULT '0',
  broj_poena DOUBLE DEFAULT '0',
	
  tim_id DOUBLE,
  FOREIGN KEY (tim_id) REFERENCES tim(id)
);
