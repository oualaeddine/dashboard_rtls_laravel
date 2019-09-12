# dashboard_rtls_laravel

__avant de demarrer l'application il faut s'assurer de :__

* la derniere version de composer est installée."https://getcomposer.org/download/"
* l'extension zmq est installée."https://serverpilot.io/docs/how-to-install-the-php-zeromq-extension"
* le brocker mqtt est installé et configuré. "https://www.vultr.com/docs/how-to-install-mosquitto-mqtt-broker-server-on-ubuntu-16-04"
* les ports sont ouverts "https://docs.ovh.com/fr/dedicated/firewall-network/"

__apres ça on configure notre projet:__

* creer une bdd vide
* modifier le fichier .env
* executer la commande composer install
* executer la commande php artisan migrate
* executer la commande php artisan seed
* installer le service du websocket

__l'appli est prete a etre utilisé!__



__configuration supervisor:__
* copy rtls-websocket.conf to /etc/supervisor/conf.d
* sudo supervisorctl reread
* sudo supervisorctl update
* sudo supervisorctl start rtls-websocket:*
