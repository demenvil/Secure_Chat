# SECURE CHAT #

Chat crypté en **RSA** (implémentation maison) en **PHP** et **JavaScript** *(jQuery)*
réalisé dans le cadre du cours "Modélisations Mathématiques" afin d'appliquer le système de cryptage
**RSA** et favoriser le travail en équipe.

Crypted chat in **RSA** (implementation by ourselves) in **PHP** and **JavaScript** *(jQuery)*
achieved in the "Mathematics Modeling" course to apply the **RSA** encryption system and promote teamwork.

### Requirements ###
* PHP 5.4
* PHP5 GMP
* MySQL: 5.5

### Database ###


```
#!sql

CREATE TABLE IF NOT EXISTS `messages` (
  `idE` int(11) NOT NULL,
  `idR` int(11) NOT NULL,
  `message` longtext COLLATE utf8_bin NOT NULL,
  `date` varchar(25) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idE`,`idR`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `public_key` text NOT NULL,
  `private_key` text NOT NULL,
  `modulus` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

```
