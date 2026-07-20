# Commande pour php spark migration et php spark db:serve
Avoir une base de donné avec aucune table de préférence <br>
Éxecutez ces commandes dans le terminal dans la racine du projet
```bash 
php spark make:migration CreateChose
#exemple: voici la création de la migration CreateTypesConge pour la table types_conges
php spark make:migration CreateTypesConge


#lister les migrations créer
php spark migrate:status

# rollback d'une migration créer : cela permet de modifier le dernier fichier dans app/Database/Migrations/ tu le modifie et puis php spark migrate et c'est bon 
php spark migrate:rollback
# toi:modifier les fichier que tu désire puis
php spark migrate:refresh
# rollback total  relance de toute les migrations
# la même chose que la commande précédente 
php spark migrate:refresh && php spark db:seed MainSeeder # il rafraichit tout après les modifs des tables et insert automatiquement les donnée que tu as introduite par 
php spark db:seed

#lancement pour transformer les fichier php en tables mysql après modifier les fichier dans App/Database/Migrations
#aussi un moyen de voir si la base est connecter au projet
php spark migrate


# creation des donnés de test 
php spark make:seeder MainSeeder #fichier apparu dans App/Database/Seeds
# pour inserer les donnés de test faites maintenant 
php spark db:seed MainSeeder

#changement de base: 
php spark migrate:refresh --seed
php spark migrate:rollback -b 0
```
avant le lancement tu dois voir et éditer les fichiers créer dans App\Database\Migrations il porterons le nom de chaque<br>
php spark make:migration CreateDepartemens par exemple<br>
ne modifie pas directement la base sinon TOUT FOUT LE CAMP IDIOT

```bash
php spark serve
```

## Dans docker lorsque tu configure le .env si sqlite: 
```bash
database.default.database = /var/www/html/writable/import_csv.sqlite
```

et donnez les droits d'administration en 
```bash
chmod 771 *.sqlite
chown www-data:www-data *.sqlite
```

## Intégration de javascript dans le tout 
en intégration de javascript dans chaque projet pour la première fois seulement ou si tu a fait docker compose down -v
```bash
npm install # ajout  de bibliothèque ou pour la relance du projet dans le cas où tu mets -v dans le compose down 
```

et ne pas oublier le ``package.json`` dans la racine du projet
```json
{
  "name": "import-codeigniter",
  "version": "1.0.0",
  "description": "Projet CodeIgniter S4",
  "main": "index.js",
  "scripts": {
    "dev": "echo 'Pas de build front-end configuré pour le moment'"
  },
  "dependencies": {},
  "devDependencies": {}
}
```

dans ce devoir consiste a ce que la colonne solde n'apparaît pas mais est gérer par une variable 
