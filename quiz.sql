-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Gen 03, 2025 alle 01:48
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

DELIMITER $$
--
-- Funzioni
--
CREATE DEFINER=`root`@`localhost` FUNCTION `check_ruolo` (`l` VARCHAR(255)) RETURNS INT(11)  BEGIN
    DECLARE retval INT;
    SELECT utente.ruolo INTO retval FROM utente WHERE utente.login = l;
    RETURN retval;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `check_visibilita_test_studenti` (`i` INT, `l` VARCHAR(255)) RETURNS TINYINT(1)  BEGIN
    DECLARE v INT DEFAULT -1;
  	SELECT COUNT(*) INTO v FROM visibilita_test_classi WHERE i=visibilita_test_classi.id_test AND id_classe = (SELECT classe_id FROM associazioni_classi JOIN utente AS ac ON ac.login = utente_login WHERE utente_login = l AND ac.ruolo = 1);
    
    IF v>0 THEN
    	RETURN true;
	ELSE
    	RETURN false;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `associazioni_classi`
--

CREATE TABLE `associazioni_classi` (
  `classe_id` int(11) NOT NULL,
  `utente_login` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `associazioni_classi`
--

INSERT INTO `associazioni_classi` (`classe_id`, `utente_login`) VALUES
(1, 'docente'),
(1, 'docenteN1'),
(1, 'docenteN2'),
(1, 'studente'),
(4, 'docenteN3'),
(4, 'studente2');

-- --------------------------------------------------------

--
-- Struttura della tabella `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `sezione` varchar(8) NOT NULL,
  `AS_inizio` year(4) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `classe`
--

INSERT INTO `classe` (`id`, `sezione`, `AS_inizio`) VALUES
(3, '4bii', '2024'),
(4, '4cii', '2024'),
(5, '4f', '2024'),
(2, '5aii', '2023'),
(1, '5aii', '2024');

-- --------------------------------------------------------

--
-- Struttura della tabella `risposta_test`
--

CREATE TABLE `risposta_test` (
  `id_test` int(11) NOT NULL,
  `risposte` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`risposte`)),
  `studente` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `data_esecuzione` datetime NOT NULL DEFAULT current_timestamp(),
  `valutazione` float DEFAULT NULL
) ;

--
-- Dump dei dati per la tabella `risposta_test`
--

INSERT INTO `risposta_test` (`id_test`, `risposte`, `studente`, `id`, `data_esecuzione`, `valutazione`) VALUES
(2, NULL, 'studente', 1, '2025-01-02 19:15:32', NULL),
(2, NULL, 'studente', 2, '2025-01-02 19:22:05', NULL),
(2, NULL, 'studente', 3, '2016-01-07 19:22:50', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `ruolo`
--

CREATE TABLE `ruolo` (
  `id` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ruolo`
--

INSERT INTO `ruolo` (`id`, `nome`) VALUES
(1, 'studente'),
(2, 'docente'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Struttura della tabella `test`
--

CREATE TABLE `test` (
  `domande` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`domande`)),
  `id` int(11) NOT NULL,
  `docente` varchar(255) NOT NULL,
  `nome` varchar(64) NOT NULL,
  `data` date DEFAULT current_timestamp(),
  `max_punteggio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `test`
--

INSERT INTO `test` (`domande`, `id`, `docente`, `nome`, `data`, `max_punteggio`) VALUES
('{\"domande\":[{\"hasOptions\":false,\"testo\":\"testo\",\"punteggio\":1},{\"hasOptions\":false,\"testo\":\"testo2\",\"punteggio\":1},{\"hasOptions\":true,\"testo\":\"testo3\",\"punteggio\":1,\"opzioni\":[{\"op1\":\"opzione1\",\"isCorrect\":true},{\"op2\":\"opzione2\",\"isCorrect\":true},{\"op3\":\"opzione3\",\"isCorrect\":false},{\"op4\":\"opzione4\",\"isCorrect\":false}]}]}', 2, 'docente', 'test prova 1', '2024-12-15', NULL),
('{\r\n  \"domande\": [\r\n    {\r\n      \"hasOptions\": false,\r\n      \"punteggio\": 5,\r\n      \"testo\": \"testo\"\r\n    },\r\n    {\r\n      \"hasOptions\": true,\r\n      \"opzioni\": [\r\n        {\r\n          \"isCorrect\": true,\r\n          \"txt\": \"opzione1\"\r\n        },\r\n        {\r\n          \"isCorrect\": true,\r\n          \"txt\": \"opzione2\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione3\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione4\"\r\n        }\r\n      ],\r\n      \"punteggio\": 1,\r\n      \"testo\": \"testo2\"\r\n    },\r\n    {\r\n      \"hasOptions\": true,\r\n      \"opzioni\": [\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione1\"\r\n        },\r\n        {\r\n          \"isCorrect\": true,\r\n          \"txt\": \"opzione2\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione3\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione4\"\r\n        }\r\n      ],\r\n      \"punteggio\": 1,\r\n      \"testo\": \"testo3\"\r\n    },\r\n    {\r\n      \"hasOptions\": true,\r\n      \"opzioni\": [\r\n        {\r\n          \"isCorrect\": true,\r\n          \"txt\": \"opzione1\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione2\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione3\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione4\"\r\n        }\r\n      ],\r\n      \"punteggio\": 1,\r\n      \"testo\": \"testo4\"\r\n    },\r\n    {\r\n      \"hasOptions\": false,\r\n      \"punteggio\": 5,\r\n      \"testo\": \"testo5\"\r\n    }\r\n  ]\r\n}', 3, 'docenteN4', 'test prova 2', '2024-12-15', NULL),
('{\"domande\":[{\"hasOptions\":false,\"punteggio\":5,\"testo\":\"testo\"},{\"hasOptions\":true,\"opzioni\":[{\"isCorrect\":true,\"txt\":\"opzione1\"},{\"isCorrect\":true,\"txt\":\"opzione2\"},{\"isCorrect\":false,\"txt\":\"opzione3\"},{\"isCorrect\":false,\"txt\":\"opzione4\"}],\"punteggio\":1,\"testo\":\"testo2\"},{\"hasOptions\":true,\"opzioni\":[{\"isCorrect\":false,\"txt\":\"opzione1\"},{\"isCorrect\":true,\"txt\":\"opzione2\"},{\"isCorrect\":false,\"txt\":\"opzione3\"},{\"isCorrect\":false,\"txt\":\"opzione4\"}],\"punteggio\":1,\"testo\":\"testo3\"},{\"hasOptions\":true,\"opzioni\":[{\"isCorrect\":true,\"txt\":\"opzione1\"},{\"isCorrect\":false,\"txt\":\"opzione2\"},{\"isCorrect\":false,\"txt\":\"opzione3\"},{\"isCorrect\":false,\"txt\":\"opzione4\"}],\"punteggio\":1,\"testo\":\"testo4\"},{\"hasOptions\":false,\"punteggio\":5,\"testo\":\"testo5\"}]}', 4, 'docenteN1', 'test prova 2', '2024-12-15', NULL),
('{\r\n  \"domande\": [\r\n    {\r\n      \"hasOptions\": false,\r\n      \"punteggio\": 5,\r\n      \"testo\": \"testo\"\r\n    },\r\n    {\r\n      \"hasOptions\": true,\r\n      \"opzioni\": [\r\n        {\r\n          \"isCorrect\": true,\r\n          \"txt\": \"opzione1\"\r\n        },\r\n        {\r\n          \"isCorrect\": true,\r\n          \"txt\": \"opzione2\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione3\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione4\"\r\n        }\r\n      ],\r\n      \"punteggio\": 1,\r\n      \"testo\": \"testo2\"\r\n    },\r\n    {\r\n      \"hasOptions\": true,\r\n      \"opzioni\": [\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione1\"\r\n        },\r\n        {\r\n          \"isCorrect\": true,\r\n          \"txt\": \"opzione2\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione3\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione4\"\r\n        }\r\n      ],\r\n      \"punteggio\": 1,\r\n      \"testo\": \"testo3\"\r\n    },\r\n    {\r\n      \"hasOptions\": true,\r\n      \"opzioni\": [\r\n        {\r\n          \"isCorrect\": true,\r\n          \"txt\": \"opzione1\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione2\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione3\"\r\n        },\r\n        {\r\n          \"isCorrect\": false,\r\n          \"txt\": \"opzione4\"\r\n        }\r\n      ],\r\n      \"punteggio\": 1,\r\n      \"testo\": \"testo4\"\r\n    },\r\n    {\r\n      \"hasOptions\": false,\r\n      \"punteggio\": 5,\r\n      \"testo\": \"testo5\"\r\n    }\r\n  ]\r\n}', 5, 'docente', 'test prova 2', '2024-12-15', NULL);

--
-- Trigger `test`
--
DELIMITER $$
CREATE TRIGGER `check_ruolo_trigger` BEFORE INSERT ON `test` FOR EACH ROW BEGIN
    IF check_ruolo(NEW.docente) < 2 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Ruolo utente non valido';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `nome` varchar(64) NOT NULL,
  `cognome` varchar(64) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `codice_fiscale` varchar(16) DEFAULT NULL,
  `ruolo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`nome`, `cognome`, `login`, `password`, `codice_fiscale`, `ruolo`) VALUES
('nome_admin', 'cognome_admin', 'admin', 'admin', NULL, 3),
('nome_docente', 'cognome_docente', 'docente', 'docente', NULL, 2),
('docenteN_nome', 'docenteN_cognome', 'docenteN1', 'docenteN1', NULL, 2),
('docenteN2_nome', 'docenteN2_cognome', 'docenteN2', 'docenteN2', NULL, 2),
('docenteN3_nome', 'docenteN3_cognome', 'docenteN3', 'docenteN3', NULL, 2),
('docenteN4_nome', 'docenteN4_cognome', 'docenteN4', 'docenteN4', NULL, 2),
('nome_studente', 'cognome_studente', 'studente', 'studente', NULL, 1),
('stu2n', 'stu2c', 'studente2', 'studente2', NULL, 1),
('stu3n', 'stu3c', 'studente3', 'studente3', NULL, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `visibilita_test_classi`
--

CREATE TABLE `visibilita_test_classi` (
  `id_test` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `visibilita_test_classi`
--

INSERT INTO `visibilita_test_classi` (`id_test`, `id_classe`) VALUES
(2, 1),
(4, 1),
(5, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `associazioni_classi`
--
ALTER TABLE `associazioni_classi`
  ADD UNIQUE KEY `classe` (`classe_id`,`utente_login`),
  ADD KEY `utente` (`utente_login`);

--
-- Indici per le tabelle `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sezione` (`sezione`,`AS_inizio`);

--
-- Indici per le tabelle `risposta_test`
--
ALTER TABLE `risposta_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkidtest` (`id_test`),
  ADD KEY `fkloginutente` (`studente`);

--
-- Indici per le tabelle `ruolo`
--
ALTER TABLE `ruolo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `docente` (`docente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`login`),
  ADD KEY `ruolo` (`ruolo`);

--
-- Indici per le tabelle `visibilita_test_classi`
--
ALTER TABLE `visibilita_test_classi`
  ADD UNIQUE KEY `id_classe` (`id_classe`,`id_test`),
  ADD KEY `id_test` (`id_test`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `risposta_test`
--
ALTER TABLE `risposta_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `associazioni_classi`
--
ALTER TABLE `associazioni_classi`
  ADD CONSTRAINT `associazioni_classi_ibfk_1` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`),
  ADD CONSTRAINT `associazioni_classi_ibfk_2` FOREIGN KEY (`utente_login`) REFERENCES `utente` (`login`);

--
-- Limiti per la tabella `risposta_test`
--
ALTER TABLE `risposta_test`
  ADD CONSTRAINT `fkidtest` FOREIGN KEY (`id_test`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `fkloginutente` FOREIGN KEY (`studente`) REFERENCES `utente` (`login`);

--
-- Limiti per la tabella `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`docente`) REFERENCES `utente` (`login`);

--
-- Limiti per la tabella `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`ruolo`) REFERENCES `ruolo` (`id`);

--
-- Limiti per la tabella `visibilita_test_classi`
--
ALTER TABLE `visibilita_test_classi`
  ADD CONSTRAINT `visibilita_test_classi_ibfk_1` FOREIGN KEY (`id_test`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `visibilita_test_classi_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
