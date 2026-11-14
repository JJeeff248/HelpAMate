FROM mysql:8.4

ENV MYSQL_ROOT_PASSWORD=example
ENV MYSQL_DATABASE=fundraiser

COPY ./mysql/fundraiser.sql /init.sql

CMD ["mysqld", "--init-file=/init.sql"]
