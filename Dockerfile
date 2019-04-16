FROM ubuntu:16.04

# Install, PHP
RUN apt-get clean && apt-get -y update && apt-get install -y locales curl software-properties-common git \
  && locale-gen en_US.UTF-8
RUN LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php
RUN apt-get update
RUN apt-get install -y --force-yes php7.2-bcmath php7.2-bz2 php7.2-cli php7.2-common php7.2-curl \
    php7.2-cgi php7.2-dev php7.2-fpm php7.2-gd php7.2-gmp php7.2-imap php7.2-intl \
    php7.2-json php7.2-ldap php7.2-mbstring php7.2-mysql \
    php7.2-odbc php7.2-opcache php7.2-pgsql php7.2-phpdbg php7.2-pspell \
    php7.2-readline php7.2-recode php7.2-soap php7.2-sqlite3 \
    php7.2-tidy php7.2-xml php7.2-xmlrpc php7.2-xsl php7.2-zip \
    php-tideways php-mongodb

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN apt-get -y --force-yes install nginx supervisor

# install nodejs, npm, bower
# Install Nodejs
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g gulp-cli bower eslint babel-eslint eslint-plugin-react yarn

RUN apt-get update
RUN apt-get -y install git vim curl
RUN apt-get -y install supervisor
RUN npm install -g bower
RUN npm install --global gulp-cli
RUN apt-get install -y ruby-full rubygems
RUN gem install sass

# Install "php-curl"
RUN apt-get -y install php-curl

# Install PM2
RUN npm install -g pm2

# We want the "add-apt-repository" command
RUN apt-get update && apt-get install -y software-properties-common

# Install "ffmpeg"
RUN add-apt-repository ppa:mc3man/trusty-media
RUN apt-get install -y ffmpeg

# RUN pecl install mongodb
#ADD conf.d/mongodb.ini /etc/php/7.0/apache2/conf.d/30-mongodb.ini
#ADD conf.d/mongodb.ini /etc/php/7.0/cli/conf.d/30-mongodb.ini
#ADD conf.d/mongodb.ini /etc/php/7.0/mods-available//mongodb.ini

RUN apt-get install -y libpng16-dev

WORKDIR /var/www/html

# Expose apache.
EXPOSE 80 443 8890

ADD conf.d/laravel-worker.conf /etc/supervisor/conf.d/laravel-worker.conf
ADD conf.d/startup.sh /usr/bin/startup.sh
RUN chmod +x /usr/bin/startup.sh

COPY conf.d/default.conf /etc/nginx/sites-available/default
COPY conf.d/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Default command
CMD ["/usr/bin/supervisord"]
