FROM ubuntu:22.04

# ARGS
ARG USERNAME=dev
ARG PASSWORD=dev
ARG USER_UID=1000
ARG USER_GID=$USER_UID

# Update && upgrade
RUN apt -y update
RUN apt -y upgrade
RUN apt install software-properties-common -y

# Install
RUN apt install -y sudo git zip
RUN echo 'tzdata tzdata/Areas select Europe' | debconf-set-selections
RUN echo 'tzdata tzdata/Zones/Europe select Paris' | debconf-set-selections
RUN DEBIAN_FRONTEND="noninteractive" apt install -y tzdata

# Install PHP
RUN add-apt-repository ppa:ondrej/php -y
RUN apt update
RUN apt install php7.4 -y
RUN apt install php7.4-sqlite3 -y
RUN apt install php7.4-xml -y
RUN apt install php7.4-mbstring -y

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/bin/composer
RUN chmod 777 /usr/bin/composer

# Create user
RUN groupadd --gid $USER_GID $USERNAME
RUN useradd --uid $USER_UID --gid $USER_GID -m $USERNAME
RUN usermod -aG sudo $USERNAME
RUN echo "${USERNAME}:${PASSWORD}" | chpasswd

USER $USERNAME

ENTRYPOINT ["tail", "-f", "/dev/null"]
