# syntax=docker/dockerfile:1

# 1) Imagem base com PHP 8.3
FROM php:8.3-cli-bullseye

# 2) Dependências do sistema + Node.js
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# 3) Extensões PHP usadas pelo Laravel
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    mbstring \
    zip \
    bcmath \
    pcntl

# 4) Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
      --install-dir=/usr/local/bin --filename=composer

# 5) Diretório de trabalho dentro do container
WORKDIR /var/www/html

# 6) Copia TODO o projeto (já estamos dentro de src/moeda_estudantil no build)
COPY . .

# 7) Instala dependências PHP (sem rodar scripts que chamam artisan aqui)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# 8) Instala dependências JS e builda assets (Tailwind / TailstackUI / Vite)
RUN npm install && npm run build

# 9) Permissões de storage e cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# 10) Variáveis padrão (Render vai sobrescrever)
ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    LOG_LEVEL=info

# 11) Porta que o app vai ouvir
EXPOSE 8000

# 12) Comando de inicialização no Render
CMD php artisan migrate --force && \
    php artisan package:discover --ansi && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
