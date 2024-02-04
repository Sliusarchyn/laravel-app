FROM nginx:1.21.3-alpine

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/nginx.vh.default.conf /etc/nginx/conf.d/default.conf
COPY public /var/www/public
