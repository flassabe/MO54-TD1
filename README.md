# Bonnes pratiques du développement web

Ce sujet sera mis à jour en fonction des avancées faites pendant la première séance.

## TD 1

Dans ce TD, un mauvais script PHP vous est fourni. Vous devrez l'améliorer, puis modifier l'architecture de l'application pour la rendre plus flexible et modulaire.

### Ressources de l'exercice

Le dépôt du TD contient les éléments suivants :

- ce fichier README.md
- le fichier avec le code de départ `bad-query.php`
- le Dockerfile pour déployer le serveur et les ressources
- le fichier pour le déploiement de votre code et le démarrage du serveur
- le fichier avec les données de la base de données.

### Comment démarrer le serveur

Pour commencer, il faut construire l'image du conteneur avec la commande (dans le dossier contenant le dockerfile) :

```bash
# Pour podman
podman build -f Dockerfile -t web_server:latest
# Pour docker
sudo docker build -f Dockerfile -t web_server:latest
```

Pour démarrer le serveur, et y accéder, il vous est nécessaire de spécifier des options à l'exécution de podman ou docker :

- Mapper un port disponible de votre navigateur sur le port 80 (exposé par le conteneur) avec l'option `-p`
- Mapper les fichiers nécessaires au déploiement (start.sh, database.sql) contenus dans le dossier `resources` sur le dossier `/home` du conteneur, avec l'option `-v`
- Mapper le code PHP contenu dans le dossier `php` sur le dossier `/var/www/html` du conteneur avec l'option `-v`

En admettant que les dossiers précités soient dans votre répertoire actuel, la commande pour lancer le conteneur doit ressembler à :

```bash
# Pour podman
podman run --rm -p 8080:80 -v "$PWD/php:/var/www/html:O" -v "$PWD/resources:/home:O" web_server:latest
# Pour docker
sudo docker run --rm -p 8080:80 -v "$PWD/php:/var/www/html:O" -v "$PWD/resources:/home:O" web_server:latest
```

Vous accéderez ensuite à votre page par l'URL `http://localhost:8080/bad-query.php`

### Description du fichier `bad-query.php`

Ce fichier contient le code PHP pour obtenir des informations depuis une base de données contenant plusieurs tables. Ces informations sont obtenues par des requêtes successives, très lourdes pour le serveur. Par ailleurs, l'environnement utilisé est un serveur monolithique intégrant le serveur Web Apache 2, PHP et son module Apache, ainsi que MariaDB avec le contenu de la BDD.

### Tâche 1 : tester l'application

Pour tester les performances du site, vous utiliserez l'outil WRK. Il est disponible à l'adresse suivante : [https://github.com/wg/wrk/tree/master](https://github.com/wg/wrk/tree/master). Il se compile simplement avec la commande `make`, en évitant d'être dans un chemin contenant des espaces (vérfiez avec la commande `pwd`, et déplacer le dossier de wrk ailleurs si nécessaire).

Utilisez WRK pour tester les performances de la version fournie. Pour ce TD, la commande utilisée sera la suivante :

```bash
./wrk -c400 -t`nproc` -d30s http://localhost:8080/bad-query.php
```

Vous sauvegarderez le résultat en le copiant dans un fichier.

### Tâche 2 : suppression des requêtes multiples

Cette tâche consiste à supprimer les requêtes multiples et à les remplacer par une seule requête utilisant des clauses de jointure. N'écrasez pas le code de `bad-query.php` mais créez un fichiers `good-query.php` avec le code optimisé.

Utiliser WRK pour tester les performances de la version optimisée.

### Tâche 3 : modularisation du serveur

Dans cette partie, vous allez scinder l'environnement de production en 3 services :

- Le serveur Web (vous en déploierez 2 - Nginx et Apache 2 - pour comparer les performances)
- Le serveur MariaDB
- Le serveur gérant le PHP (avec PHP-FPM en tant que service accessible par IP)

Il est conseillé d'utiliser podman-compose ou docker-compose pour réaliser le déploiement. Testez le déploiement avec Nginx et celui avec Apache 2, en mesurant les performances toujours grâce à l'outil WRK.

### Tâche 4 : Séparation front/back

À venir