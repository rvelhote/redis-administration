FROM ubuntu:xenial
MAINTAINER Ricardo Velhote "rvelhote+github@gmail.com"

ENV DEBIAN_FRONTEND noninteractive

# TODO For development I prefer to have the commands split. Increases the image size but makes corrections faster.
RUN apt-get update && apt-get -y upgrade && apt-get -y dist-upgrade
RUN apt-get install -y --no-install-recommends php7.0-cli php7.0-xml php7.0-intl php7.0-bz2 php7.0-mbstring php-redis php-xdebug ssh ca-certificates
RUN useradd application

USER application

EXPOSE 22 8000 6379 1025 8025
ENTRYPOINT ["php", "/opt/application/bin/console", "server:run", "172.19.0.4:8000"]