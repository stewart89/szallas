
# 1. Leirás

A feladat [Docker](https://www.docker.com/) környezetben [Laravel](https://www.google.com) 10.11 keretrendszerven készült, PHP 8.2 -t használva.
Az adatbázis: mysql.

A migration fájlok tartalmazzák az adatbázis létrehozásához szükséges adatokat.
Megtalálható egy seeder fájl is, amely az adatbázist feltölti adatokkal, ennek követelménye a már kapott csv public könyvtárba való bemásolása, mivel ezt a git nem tartalmazza.

A migration fájl tartalmazza azt a `triggert` amely nem engedi módosítani a létrehozás dátumát.

#### API végpontok:
1. `GET: /company/{ids}`
2. `POST: /company`
3. `PUT vagy PATCH /company/{id}`

Az API végpontok csak json tipusú kérést fogadnak el.

#### Lekérdezések:
A két külön kért lekérdezés a model fájlban található meg, ezek is ki vannak vezetve API végpontra, akár igy is tesztelhető.

#### Feature test
Érdemes lefuttatni a migrationt a test adatbázisra is, igy a meglevő négy feature teszt függvény futtatható:
1. Lekérdezés 1 azonosítóra
2. Lekérdezés több azonosítóra
3. Adatbázisba beillesztés
4. Adatbázis sor módosítása