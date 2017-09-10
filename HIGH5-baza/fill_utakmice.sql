DROP PROCEDURE IF EXISTS fill_utakmice;
DELIMITER ;;
CREATE PROCEDURE fill_utakmice()
BEGIN
	DECLARE n INT;
	DECLARE i INT DEFAULT 1;
	DECLARE j INT DEFAULT 2;
	
	DECLARE id INT DEFAULT 1;
	DECLARE tim1_id INT DEFAULT 1;
	DECLARE tim2_id INT DEFAULT 2;

	DECLARE poeni INT DEFAULT 0;
	
	SELECT COUNT(*) INTO n FROM tim;
	
	WHILE i <= n DO
		WHILE j <= n DO
			INSERT INTO utakmica(id, br_kola, prvi_tim_id, drugi_tim_id, poeni_prvog_tima, poeni_drugog_tima, timeout_t1, btimeout_t1, timeout_t2, btimeout_t2, minuti, sekunde, cetvrtina) VALUES(id, NULL, i, j, 0, 0, false, 0, false, 0, 10, 0, 0);
			SET id = id + 1;

			INSERT INTO utakmica(id, br_kola, prvi_tim_id, drugi_tim_id, poeni_prvog_tima, poeni_drugog_tima, timeout_t1, btimeout_t1, timeout_t2, btimeout_t2, minuti, sekunde, cetvrtina) VALUES(id, NULL, j, i, 0, 0, false, 0, false, 0, 10, 0, 0);
			SET id = id + 1;
			
			SET j = j + 1;
		END WHILE;
		SET i = i + 1;
		SET j = i + 1;
	END WHILE;
END;
