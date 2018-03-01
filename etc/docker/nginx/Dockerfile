FROM debian:jessie

RUN apt-get update && apt-get install -y nginx

ADD nginx.conf /etc/nginx/
ADD nektcub.conf /etc/nginx/sites-available/

RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf
RUN usermod -u 1000 www-data
RUN ln -s /etc/nginx/sites-available/nektcub.conf /etc/nginx/sites-enabled/nektcub
RUN rm /etc/nginx/sites-enabled/default

CMD ["nginx"]

EXPOSE 80
EXPOSE 443