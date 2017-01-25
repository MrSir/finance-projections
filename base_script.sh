#!/bin/bash
ln -s /opt/VBoxGuestAdditions-4.3.10/lib/VBoxGuestAdditions /usr/lib/VBoxGuestAdditions

# shits and giggles #
alias fucking=sudo

apt-get update
apt-get -y install python-software-properties

# add needed repos and update #
apt-add-repository --yes ppa:ondrej/apache2
apt-add-repository --yes ppa:ondrej/php5-5.6
apt-add-repository --yes ppa:chris-lea/node.js
apt-get update

# basic tools #
apt-get -y install vim curl

# APACHE STUFF should be v2.2.22#
apt-get -y install apache2

# ADD the virtual host #
cp /var/www/finances/site.conf /etc/apache2/sites-available/finances.conf
ln -s /etc/apache2/sites-available/finances.conf /etc/apache2/sites-enabled/finances.conf

# give apache some settings #
echo "ServerName engagepeople.com" >> /etc/apache2/apache2.conf
echo "DocumentRoot /var/www" >> /etc/apache2/apache2.conf

# enable mod_rewrite #
a2enmod rewrite

# install php5 and enable it should be v5.4.3#
apt-get -y install php5 php5-mcrypt php5-curl php5-gd php5-imap
php5enmod mcrypt
php5enmod gd
php5enmod imap

apt-get -y install libapache2-mod-php5
a2enmod php5

# restart apache2 #
service apache2 restart

# install mysql-server #
debconf-set-selections <<< 'mysql-server mysql-server/root_password password war0662'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password war0662'
apt-get -y install mysql-server php5-mysql
apt-get -y install libapache2-mod-auth-mysql

# add root user to specific IP to differentiate between vagrant boxes #
mysql -uroot -pwar0662 -e "CREATE USER 'root'@'%' IDENTIFIED BY 'war0662'; GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;"
# add rawdev users #
mysql -uroot -pwar0662 -e "CREATE USER 'dev'@'localhost' IDENTIFIED BY 'Test1234'; GRANT ALL PRIVILEGES ON *.* TO 'dev'@'localhost';"

# create tdrewards related databases #
mysql -uroot -pwar0662 -e "CREATE DATABASE finances CHARSET utf8 COLLATE utf8_unicode_ci;"

# add permissions to rawdev, rawdev2, rawdev3 for the tdrewards tables #
mysql -uroot -pwar0662 -e "GRANT ALL PRIVILEGES ON finances.* TO 'dev'@'localhost';"

# restart apache2 #
service apache2 restart

# change mysql config to allow connections to it #
sed -i "s/bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/my.cnf

# restart mysql #
service mysql restart

# install composer globally #
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

# install nodejs v0.10.29 #
apt-get -y install nodejs

# install npm v1.4.14 #
apt-get -y install npm

# install bower v1.3.8 globally #
npm install bower -g

# install git #
apt-get -y install git

apt-get autoclean