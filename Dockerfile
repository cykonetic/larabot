FROM bitnami/laravel:6-debian-9

RUN sudo apt-get update &&\
    sudo apt-get install --no-install-recommends -y git autoconf build-essential pkg-config unzip &&\
    sudo pecl channel-update pecl.php.net &&\
    sudo pecl install xdebug

RUN printf "\
[xdebug]\n\
zend_extension=/opt/bitnami/php/lib/php/extensions/xdebug.so\n\
xdebug.remote_enable=1\n\
xdebug.remote_autostart=1\n\
xdebug.remote_connect_back=0\n\
xdebug.remote_host=docker.for.mac.localhost\n\
xdebug.remote_handler=dbgp\n\
xdebug.max_nesting_level=1500\n" | sudo tee -a /opt/bitnami/php/conf/php.ini

WORKDIR /app
