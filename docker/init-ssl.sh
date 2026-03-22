#!/bin/bash
set -e

DOMAIN="helpamate.chris-sa.com"
EMAIL="helpamate@chris-sa.com"
COMPOSE_DIR="$(cd "$(dirname "$0")" && pwd)"

cd "$COMPOSE_DIR"

echo "==> Step 1: Starting Nginx with HTTP-only config (no SSL yet)..."
cp nginx/nginx.conf nginx/nginx.conf.bak
cp nginx/nginx-initial.conf nginx/nginx.conf

docker compose up -d --build

echo "==> Waiting for services to start..."
sleep 5

echo "==> Step 2: Requesting certificate from Let's Encrypt..."
docker compose run --rm certbot certonly \
  --webroot \
  --webroot-path=/var/www/certbot \
  --email "$EMAIL" \
  --agree-tos \
  --no-eff-email \
  -d "$DOMAIN"

echo "==> Step 3: Switching to SSL-enabled Nginx config..."
cp nginx/nginx.conf.bak nginx/nginx.conf
rm -f nginx/nginx.conf.bak

echo "==> Step 4: Reloading Nginx with SSL..."
docker compose exec nginx nginx -t
docker compose exec nginx nginx -s reload

echo ""
echo "====================================="
echo "  SSL setup complete!"
echo "  https://$DOMAIN"
echo "====================================="
echo ""
echo "To set up automatic renewal, add this cron job:"
echo "  crontab -e"
echo "  0 */12 * * * cd $COMPOSE_DIR && ./renew-ssl.sh >> /var/log/certbot-renew.log 2>&1"
