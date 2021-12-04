FROM php:7.4-apache

WORKDIR /var/www/html/ 
# Defining the /var/www/html/ path as workdir to facilitate file transfers

RUN docker-php-ext-install pdo pdo_mysql
#installing the PDO driver for mysql 

EXPOSE 80