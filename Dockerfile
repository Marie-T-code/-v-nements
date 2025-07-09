FROM php:8.3-apache

# Installer les extensions nécessaires
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

EXPOSE 80