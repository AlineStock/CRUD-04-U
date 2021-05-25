create database if not exists acs;
use acs;
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `placa` VARCHAR(7) NULL,
  `modelo`VARCHAR (30) NULL,
  `ano` INT NOT NULL,
  `preco` FLOAT NOT NULL,
  `data_inserção` DATE  NOT NULL,
  `estado` BOOL NOT NULL, 
  PRIMARY KEY (`id`))
ENGINE = InnoDB;
insert into vendas values
(Default, 'A49VO12', 'UNO', '2004', '24000', '2020-02-24', '1'),
(Default, 'D12V459', 'PALIO','2017','30000', '2019-03-15', '0'),
(Default, '125FBJ9','GOL','2011','17200','2018-12-12', '1' ),
(Default, 'GF2LK20', 'GOLF', '2007','18000','2019-05-16','1'),
(Default, 'HO302M0', 'TOYOTA', '2016', '56000', '2020-12-09', '0' ),
(Default, 'M63PO01', 'FORD', '2019', '72000', '2019-04-04', '1' ),
(Default, '2POL36C', 'KIA', '2016', '40000', '2018-02-20', '0' ),
(Default, 'OL56AS2', 'BMW', '2018', '80000', '2020-08-30', '0' ),
(Default, '2LM02SX', 'MEGANE', '1999', '20000', '2009-06-06', '1'),
(Default, 'HJ256MN', 'CHANA', '2001', '24000', '2015-03-07', '0' );