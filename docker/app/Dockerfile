FROM php:8.1-apache

MAINTAINER Sarasov Matvey <sarasovmatvej@gmail.com> 

RUN a2enmod rewrite

RUN apt-get update && \
    apt-get install apt-file -y && \
    apt-file update && \
    apt-get install vim -y && \
    docker-php-ext-install mysqli pdo pdo_mysql  

