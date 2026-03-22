#!/bin/bash
set -e

COMPOSE_DIR="$(cd "$(dirname "$0")" && pwd)"
cd "$COMPOSE_DIR"

echo "[$(date)] Starting certificate renewal..."

docker run --rm \
  -v /var/run/docker.sock:/var/run/docker.sock \
  -v "$COMPOSE_DIR:$COMPOSE_DIR" \
  -w "$COMPOSE_DIR" \
  -e COMPOSE_PROJECT_NAME=docker \
  docker/compose:1.29.2 run --rm certbot renew

echo "[$(date)] Reloading Nginx..."
docker exec docker_nginx_1 nginx -t
docker exec docker_nginx_1 nginx -s reload

echo "[$(date)] Renewal complete."
