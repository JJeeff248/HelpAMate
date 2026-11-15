#!/bin/bash
set -euo pipefail

mysql --protocol=socket --user=root --password="$MYSQL_ROOT_PASSWORD" <<SQL
CREATE USER IF NOT EXISTS 'public'@'${MYSQL_APP_HOST}' IDENTIFIED BY '${MYSQL_PUBLIC_PASSWORD}';
GRANT SELECT ON fundraiser.* TO 'public'@'${MYSQL_APP_HOST}';

CREATE USER IF NOT EXISTS 'admin'@'${MYSQL_APP_HOST}' IDENTIFIED BY '${MYSQL_ADMIN_PASSWORD}';
GRANT ALL PRIVILEGES ON fundraiser.* TO 'admin'@'${MYSQL_APP_HOST}';

DROP USER IF EXISTS 'root'@'%';
FLUSH PRIVILEGES;
SQL
