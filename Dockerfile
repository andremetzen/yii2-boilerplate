FROM jwilder/dockerize AS dockerize

FROM andremetzen/alpine-php-fpm
MAINTAINER Andre Metzen <metzen@conceptho.com>

COPY --from=dockerize /usr/local/bin/dockerize /usr/local/bin

RUN composer config -g github-oauth.github.com 75bb250d8aeedf8a5a4aede1d06da25dde75d77b
RUN composer global require "fxp/composer-asset-plugin:~1.3.1"

RUN npm install -g bower

ADD src/docker/files /src
RUN cp -rf /src/* /
RUN rm -rf /src

ADD src/www /srv/www

RUN composer --working-dir=/srv/www install --no-dev -v --prefer-dist && composer clear-cache
RUN composer --working-dir=/srv/www dumpautoload -o
RUN chmod 0777 /srv/www/runtime /srv/www/web/assets

ENV PATH /root/.composer/vendor/bin:$PATH

WORKDIR /srv/www

ENTRYPOINT ["dockerize", "-template", "/vhost.tmpl:/etc/nginx/conf.d/vhost.conf"]
CMD ["sh", "/start.sh"]