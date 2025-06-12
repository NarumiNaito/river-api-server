FROM mysql:8.0.33

ADD .docker/mysql/my.cnf /etc/mysql/my.cnf

RUN apt-get update && apt-get install -y tzdata

RUN chmod 644 /etc/mysql/my.cnf