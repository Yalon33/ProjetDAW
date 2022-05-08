# ProjetDAW
Ce répertoire GitHub contient le travail que nous avons effectué pour répondre au projet du module DAW. Nous avons créé un site web de formation permettant la création et le suivi de cours. Pour faire fonctionner ce site, une configuration de XAMPP est nécessaire (voir ci-dessous).

## Configuration du projet
### Configuration de XAMPP
Veuillez vérifier que vous ayez bien la dernière version de XAMPP installée sur votre machine.
#### Sous Windows
Allez dans le fichier `xampp\apache\conf\extra\httpd-vhosts.conf` et ajoutez les lignes suivantes à la fin du fichier :
```
<VirtualHost 127.0.0.1:80>
    DocumentRoot "my-custom-route"
    DirectoryIndex index.php
    <Directory "my-custom-route">
        AllowOverride None
        Order Allow,Deny
        Allow from All
        FallbackResource /index.php
    </Directory>
</VirtualHost>
```
Modifiez les lignes contenant `"my-custom-route"` en remplaçant ce texte avec le chemin absolu menant au fichier `Public` du projet (ce dossier se trouve à la racine du projet GitHub), un exemple de chemin peut être : `"C:\xampp\htdocs\ProjetDAW\Public"`.
Redémarrez votre serveur XAMPP, vous devriez pouvoir accéder au site à l'adresse `127.0.0.1:80/login`.
#### Sous MacOS
Allez dans le fichier `XAMPP/etc/extra/httpd-vhosts.conf ` et ajoutez les lignes suivantes à la fin du fichier :
```
<VirtualHost 127.0.0.1:80>
    DocumentRoot "my-custom-route"
    DirectoryIndex index.php
    <Directory "my-custom-route">
        AllowOverride None
        Order Allow,Deny
        Allow from All
        FallbackResource /index.php
    </Directory>
</VirtualHost>
```
Modifiez les lignes contenant `"my-custom-route"` en remplaçant ce texte avec le chemin absolu menant au fichier `Public` du projet (ce dossier se trouve à la racine du projet GitHub), un exemple de chemin peut être : `"/Applications/XAMPP/xamppfiles/htdocs/ProjetDAW/Public"`.
Ensuite, allez dans le fichier `XAMPP/etc/httpd.conf` et décommentez la ligne 488 :
```
Include etc/extra/httpd-vhosts.conf
```
Redémarrez votre serveur XAMPP, vous devriez pouvoir accéder au site à l'adresse `127.0.0.1:80/login`.
### Configuration de la base de données
Vous trouverez à la racine du projet un fichier nommé `projet.sql`, ce fichier contient les instructions SQL permettant la création des tables et l'insertion des données dans la base de données. Veuillez lancer `phpMyAdmin` et créer une base de données nommée "projet". Cliquez sur cette base et allez dans l'onglet "Importer", vous avez la possibilité d'importer un fichier. Importez le fichier `projet.sql` et cliquez sur "Exécuter" en bas de la page. Les tables et les données sont créées, à partir de ce moment là le site est entièrement opérationnel.
