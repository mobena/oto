<?php

/**
database tests
table news
* Field     | Type                 | Null | Key | Default | Extra          |
+-----------+----------------------+------+-----+---------+----------------+
| id        | smallint(5) unsigned | NO   | PRI | NULL    | auto_increment |
| auteur    | varchar(30)          | NO   |     | NULL    |                |
| titre     | varchar(100)         | NO   |     | NULL    |                |
| contenu   | text                 | NO   |     | NULL    |                |
| dateAjout | datetime             | NO   |     | NULL    |                |
| dateModif | datetime             | NO   |     | NULL    |                |

insert into tests.news(auteur,titre,contenu,dateAjout) values('momo','symfony','blablabla',now());
insert into tests.news(auteur,titre,contenu,dateAjout) values('momo','symfony2','blablacar',now());
*/

$db = new PDO('mysql:host=localhost;dbname=tests','root','root');

var_dump('$db',$db);

$q = $db->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif FROM tests.news');
$q->execute();

var_dump('$q',$q);

while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
{
    var_dump('$donnees',$donnees);
}

