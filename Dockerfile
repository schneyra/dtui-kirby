FROM php:8.3-apache

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
ENV COMPOSER_HOME=/.composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="$PATH:/var/www/html/vendor/bin"

COPY --from=node:latest /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node:latest /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm
RUN ln -s /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx

RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    zlib1g-dev \
    libzip-dev \
    libicu-dev \
    unzip

RUN docker-php-ext-configure intl \
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) intl exif gd

RUN a2enmod headers rewrite
EXPOSE 80

CMD [ "/usr/sbin/apache2ctl", "-DFOREGROUND" ]
