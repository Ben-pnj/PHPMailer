FROM php:8.4-apache

# ---------------------------------------------------------
# 1) Dépendances pour extensions (GD, ZIP, etc.)
# ---------------------------------------------------------
RUN apt-get update && apt-get install -y \
      libzip-dev zip unzip \
      libfreetype6-dev \
      libjpeg62-turbo-dev \
      libpng-dev \
      libwebp-dev \
      libxml2-dev \
      libonig-dev \
      libjpeg-dev \
      libxpm-dev \
      libssl-dev

# ---------------------------------------------------------
# 2) Extensions PHP
# ---------------------------------------------------------

# GD (avec freetype, jpeg, webp)
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install gd

# ZIP
RUN docker-php-ext-install zip

# OPCache
RUN docker-php-ext-install opcache


# ---------------------------------------------------------
# 3) Apache : mod_rewrite + Composer
# ---------------------------------------------------------
RUN a2enmod rewrite
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ---------------------------------------------------------
# 4) DocumentRoot /public + AllowOverride All (.htaccess OK)
# ---------------------------------------------------------
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
        /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's/AllowOverride None/AllowOverride All/g' \
        /etc/apache2/apache2.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
        /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf


# ---------------------------------------------------------
# 5) Bash coloré
# ---------------------------------------------------------
COPY bashrc /root/.bashrc
COPY bashrc /var/www/.bashrc
COPY bashrc /var/www/html/.bashrc

# ---------------------------------------------------------
# 6) Dossier de travail
# ---------------------------------------------------------
WORKDIR /var/www/html
