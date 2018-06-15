###################
Installation
###################

***************
Guide
***************

-- CREATE A "public_html" FOLDER --

-- INSTALL DOCKER --
sudo apt install docker.io

-- GIVE PERMISSION FOR YOUR ACCOUNT --
sudo usermod -a -G docker nomeusuario

-- DOWNLOAD THE DOCKER PHP IMAGE --
docker pull lhuggler/php-xdebug

-- MAPPING THE PORT WITH THE FOLDER --
docker run -p 80:80 -v /home/nomeusuario/public_html:/var/www/html --name phpx -ti lhuggler/php-xdebug

-- GIVE PERMISSION FOR THE FOLDER --
sudo chown -R nomeusuario:nomeusuario public_html/
