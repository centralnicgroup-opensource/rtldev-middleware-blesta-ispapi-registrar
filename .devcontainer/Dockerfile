FROM composer:lts as composer
FROM node:lts as nodejs
FROM mcr.microsoft.com/devcontainers/base:ubuntu

ENV DOCKER_USER_ID 501 
ENV DOCKER_USER_GID 20

ENV BOOT2DOCKER_ID 1001
ENV BOOT2DOCKER_GID 50

ARG PHP_VERSION=7.4
ENV PHP_VERSION=$PHP_VERSION

#Environment variables to configure php
ENV PHP_UPLOAD_MAX_FILESIZE 10M
ENV PHP_POST_MAX_SIZE 10M

ARG MYSQL_SOCKET_DIRECTORY='/var/run/mysqld'
ENV DEBIAN_FRONTEND noninteractive

ENV TZ=Europe/Berlin
ENV DEBIAN_FRONTEND noninteractive

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_WWW_DIR /var/www/html
ENV CONFIGURATION_DIR_PATH supporting_files/configuration
ENV ARCHIVES_DIR_PATH supporting_files/archives
ENV SCRIPTS_DIR_PATH supporting_files/scripts
ENV MYSQL_DUMP_DIR_PATH supporting_files/mysql-dump


ENV APT_KEY_DONT_WARN_ON_DANGEROUS_USAGE=DontWarn
ENV DEBIAN_FRONTEND noninteractive
# Set a default value for ZSH_CUSTOM if it's not already set
ENV ZSH_CUSTOM=/home/vscode/.oh-my-zsh/custom

# Tweaks to give Apache/PHP write permissions to the app
# Step 1: Update the UID of the "www-data" user to the value of $BOOT2DOCKER_ID
# This ensures consistency of the user's ID across different systems
# The "-eux" flags enable strict error checking and debugging during script execution
# The "-e" option causes the script to exit immediately if any command fails (returns non-zero exit status)
# The "-u" option stands for "errexit"
# The "-u" option treats unset variables as errors and causes the script to exit
# The "-x" option stands for "xtrace" or "debug mode" and prints each command before execution
# This helps with debugging and tracing the flow of the script
RUN set -eux; \
    usermod -u ${BOOT2DOCKER_ID} www-data && \
# Step 2: Add a new system user "mysql" with a default (system) shell
    useradd -r mysql && \
# Step 3: Add the "www-data" user to the supplementary group "www-data"
# This allows the "www-data" user to belong to multiple groups
    usermod -G www-data,www-data mysql && \
# Step 4: Calculate the new GID by adding 10000 to $BOOT2DOCKER_GID
    new_gid=$((${BOOT2DOCKER_GID} + 10000)) && \
# Step 5: Get the group name associated with $BOOT2DOCKER_GID
# The command substitution $(...) retrieves the group name by looking up the GID in the group database
# The "cut" command extracts the first field (group name) from the output
    group_name=$(getent group ${BOOT2DOCKER_GID} | cut -d: -f1) && \
# Step 6: Modify the group with the new GID and its existing name
    groupmod -g ${new_gid} ${group_name} && \
# Step 7: Change the GID of the "www-data" group to the value of $BOOT2DOCKER_GID
    groupmod -g ${BOOT2DOCKER_GID} www-data

# ------ APT PKG MANAGER --------------------------------------------
# update installed apt packages
RUN apt update
RUN apt upgrade -y

# make add-apt-repository command available
RUN apt install --no-install-recommends -y software-properties-common

# add git repository for latest git
RUN add-apt-repository ppa:git-core/ppa && apt install --no-install-recommends -y git

# install further apt packages
RUN apt update && apt install --no-install-recommends -y make cron supervisor postfix python3-setuptools wget jq sudo apache2 pwgen mysql-server zip unzip tar curl 

# install php apt packages
RUN apt install --no-install-recommends -y php-pear php${PHP_VERSION}-dev php${PHP_VERSION}-xdebug libapache2-mod-php${PHP_VERSION} php${PHP_VERSION}-mysql php${PHP_VERSION}-apcu php${PHP_VERSION}-gd php${PHP_VERSION}-xml php${PHP_VERSION}-mbstring php${PHP_VERSION}-zip php${PHP_VERSION}-curl

## INSTALL XDEBUG STABLE VERSION
RUN pecl install xdebug-3.2.2
# -------------------------------------------------------------------

    # Cleanup
RUN apt autoremove -y \
&& apt clean -y \
&& rm -rf /var/lib/apt/lists/* \
&& update-locale

# copy MySQL & apache utils and other shell scripts
COPY ${SCRIPTS_DIR_PATH}/ /

# Remove pre-installed database
RUN rm -rf /var/lib/mysql

RUN chmod 755 /*.sh

COPY ${CONFIGURATION_DIR_PATH}/supervisord-apache2.conf /etc/supervisor/conf.d/supervisord-apache2.conf
COPY ${CONFIGURATION_DIR_PATH}/supervisord-mysqld.conf /etc/supervisor/conf.d/supervisord-mysqld.conf
COPY ${CONFIGURATION_DIR_PATH}/supervisord.conf /etc/supervisor/supervisord.conf
# Add shell scripts
COPY ${SCRIPTS_DIR_PATH}/setsymlinks.sh /usr/share/setsymlinks.sh
RUN chmod +x /usr/share/*.sh

# Remove pre-installed database
RUN rm -rf /var/lib/mysql

# config to enable .htaccess
COPY ${CONFIGURATION_DIR_PATH}/apache_default /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Time Zone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Add config files
COPY ${CONFIGURATION_DIR_PATH}/php.ini /etc/php/${PHP_VERSION}/cli/php.ini
COPY ${CONFIGURATION_DIR_PATH}/php.ini /etc/php/${PHP_VERSION}/apache2/php.ini
COPY ${CONFIGURATION_DIR_PATH}/php_xdebug.ini /etc/php/${PHP_VERSION}/apache2/conf.d/20-xdebug.ini
COPY ${CONFIGURATION_DIR_PATH}/php_xdebug.ini /etc/php/${PHP_VERSION}/cli/conf.d/20-xdebug.ini
COPY ${CONFIGURATION_DIR_PATH}/php_error_reporting.ini /etc/php/${PHP_VERSION}/apache2/conf.d/20-error_reporting.ini
COPY ${CONFIGURATION_DIR_PATH}/php_error_reporting.ini /etc/php/${PHP_VERSION}/cli/conf.d/20-error_reporting.ini

# IonCube Loader Installation
COPY ${ARCHIVES_DIR_PATH}/ioncube_loaders_lin_x86-64.tar.gz /usr/share/
RUN tar -xzf /usr/share/ioncube_loaders_lin_x86-64.tar.gz -C /usr/local\
    && rm -f /usr/share/ioncube_loaders_lin_x86-64.tar.gz \
    && echo "zend_extension=/usr/local/ioncube/ioncube_loader_lin_${PHP_VERSION}.so" >> /etc/php/${PHP_VERSION}/apache2/php.ini \
    && echo "zend_extension=/usr/local/ioncube/ioncube_loader_lin_${PHP_VERSION}.so" >> /etc/php/${PHP_VERSION}/cli/php.ini

# Blesta Installation
# Prepare Blesta directories and extract tar
ADD ${ARCHIVES_DIR_PATH}/blesta.tar.gz /usr/share/
# Add volumes for the app and MySql
RUN mkdir -p ${APACHE_WWW_DIR}
RUN chown -R ${APACHE_RUN_USER}.${APACHE_RUN_GROUP} \
    ${APACHE_WWW_DIR} \
    /usr/share/blesta \
    /usr/share/uploads

# APACHE2 configs
# apache - blesta
COPY ${CONFIGURATION_DIR_PATH}/apache_blesta.conf /etc/apache2/sites-enabled/001-blesta.conf
RUN a2enmod rewrite

# Preparatory work for MySQL & Apache
COPY ${MYSQL_DUMP_DIR_PATH}/backup.sql /usr/share/000_backup.sql

# Composer 2.x Installation
# Install Composer
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

######################### DEVELOPMENT ENVIRONMENT ADDITIONS ###############################
# install latest git & zsh
RUN add-apt-repository ppa:git-core/ppa \
    && apt-get update \
    && apt-get -y install --no-install-recommends git \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && update-locale

# specifics to user vscode
ARG USERNAME="vscode"
ARG USERHOME="/home/${USERNAME}"
RUN usermod --shell /usr/bin/zsh ${USERNAME} \
    && usermod -a -G www-data ${USERNAME} \
    && usermod -a -G staff ${USERNAME}

# Nodejs Installation
COPY --from=nodejs /usr/local/include/node /usr/local/include/node
COPY --from=nodejs /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=nodejs /usr/local/bin /usr/local/bin

# Set a default value for ZSH_CUSTOM if it's not already set
ENV ZSH_CUSTOM=${USERHOME}/.oh-my-zsh/custom

# Clone the powerlevel10k theme for zsh and change owner
RUN git clone --depth=1 https://github.com/romkatv/powerlevel10k.git $ZSH_CUSTOM/themes/powerlevel10k \
    && chown -R ${USERNAME}:${USERNAME} $ZSH_CUSTOM/themes/powerlevel10k

# Clone the zsh-autosuggestions repository and change owner
RUN git clone https://github.com/zsh-users/zsh-autosuggestions $ZSH_CUSTOM/plugins/zsh-autosuggestions \
    && chown -R ${USERNAME}:${USERNAME} $ZSH_CUSTOM/plugins/zsh-autosuggestions
    
# copy zsh and committizen configuration file
COPY --chown=${USERNAME}:${USERNAME} ${CONFIGURATION_DIR_PATH}/.zshrc ${USERHOME}/.zshrc
COPY --chown=${USERNAME}:${USERNAME} ${CONFIGURATION_DIR_PATH}/.czrc ${USERHOME}/.czrc
# zsh theme powerline10k
COPY --chown=${USERNAME}:${USERNAME} ${CONFIGURATION_DIR_PATH}/.p10k.zsh ${USERHOME}/.p10k.zsh
COPY --chown=${USERNAME}:${USERNAME} ${CONFIGURATION_DIR_PATH}/p10k-instant-prompt-vscode.zsh ${USERHOME}/.cache/p10k-instant-prompt-vscode.zsh

EXPOSE 80 443
VOLUME ["${APACHE_WWW_DIR}", "/var/lib/mysql"]
CMD ["/run.sh"]
