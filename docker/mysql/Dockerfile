FROM mysql:8.4

COPY ./mysql/fundraiser.sql /docker-entrypoint-initdb.d/01-schema.sql
COPY ./mysql/init-users.sh /docker-entrypoint-initdb.d/02-users.sh
RUN chmod 755 /docker-entrypoint-initdb.d/02-users.sh
