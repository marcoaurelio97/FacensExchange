###################
Installation
###################

***************
Create a "public_html" folder
***************

mkdir public_html

***************
Install docker
***************

sudo apt install docker.io

***************
Give permission for your account
***************

sudo usermod -a -G docker nomeusuario

***************
Download the docker php image
***************

docker pull lhuggler/php-xdebug

***************
Mapping the port with the folder
***************

docker run -p 80:80 -v /home/nomeusuario/public_html:/var/www/html --name phpx -ti lhuggler/php-xdebug

***************
Give permission for the folder
***************

sudo chown -R nomeusuario:nomeusuario public_html/
