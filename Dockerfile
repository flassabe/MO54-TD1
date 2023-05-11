FROM debian:latest

WORKDIR /home/

RUN apt update
RUN apt upgrade -y
RUN apt install apache2 libapache2-mod-php php php-mysql mariadb-server mariadb-client --no-install-recommends -y

EXPOSE 80

CMD bash /home/start.sh
