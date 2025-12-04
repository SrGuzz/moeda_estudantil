# syntax=docker/dockerfile:1

# Imagem base com PHP 8.3 em Debian
FROM php:8.3-cli-bullseye

# 1) Dependências do sistema + Node.js
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

# 2) Extensões PHP necessárias para Laravel
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    mbstring \
    zip \
    bcmath \
    pcntl

# 3) Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
      --install-dir=/usr/local/bin --filename=composer

# Diretório da aplicação
WORKDIR /var/www/html

# 4) Copia só os manifests para aproveitar cache no build
COPY composer.json composer.lock* ./
COPY package.json package-lock.json* ./
COPY vite.config.* tailwind.config.* postcss.config.* ./

# 5) Instala dependências PHP (sem dev) e JS
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
RUN npm install

# 6) Copia o restante do código da aplicação
COPY . .

# 7) Build dos assets (Vite/Tailwind/TailstackUI)
RUN npm run build

# 8) Ajusta permissões da pasta storage
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# 9) Variáveis padrão (Render vai sobrescrever no painel)
ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    LOG_LEVEL=info

# Porta interna (Render injeta $PORT)
EXPOSE 8000

# 10) Comando de inicialização
# - Roda migrations
# - Gera caches
# - Sobe o servidor embutido do Laravel na porta $PORT
CMD php artisan migrate --force && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
