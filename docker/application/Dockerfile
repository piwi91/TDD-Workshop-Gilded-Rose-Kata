FROM php:5.6-cli

# Install Curl, Git
RUN apt-get update && apt-get install -y curl git unzip zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

COPY php.ini /usr/local/etc/php/php.ini

VOLUME /var/www

WORKDIR /var/www

CMD ["/bin/bash"]