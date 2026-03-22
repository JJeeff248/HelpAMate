#!/bin/bash
# Startup script to configure systemd timer for Let's Encrypt renewal

cat << 'EOF' > /etc/systemd/system/certbot-renew.service
[Unit]
Description=Renew Let's Encrypt certificates

[Service]
Type=oneshot
ExecStart=/bin/bash /home/Chris/fundraiser/docker/renew-ssl.sh
EOF

cat << 'EOF' > /etc/systemd/system/certbot-renew.timer
[Unit]
Description=Run certbot renew twice a day

[Timer]
OnCalendar=*-*-* 00/12:00:00
RandomizedDelaySec=1h
Persistent=true

[Install]
WantedBy=timers.target
EOF

systemctl daemon-reload
systemctl enable --now certbot-renew.timer
systemctl start certbot-renew.timer