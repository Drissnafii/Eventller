# Utiliser l'image officielle PHP avec Apache
FROM php:8.2-apache
    
# Installer les dépendances nécessaires pour PostgreSQL et compiler les extensions
RUN apt-get update && apt-get install -y libpq-dev

# Installer les extensions PHP pour PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql

# Activer mod_rewrite pour Apache
RUN a2enmod rewrite

# Autoriser .htaccess à modifier la configuration d’Apache
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Changer le DocumentRoot pour pointer vers le dossier public/
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Définir le répertoire de travail
WORKDIR /var/www/html

# Exposer le port 80 d’Apache
EXPOSE 80