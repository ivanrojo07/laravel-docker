# --- Dockerfile ---
FROM php:8.3-fpm

# Instalar dependencias del sistema necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# --- NUEVA SECCIÓN: Instalar Node.js y NPM ---
# Instalamos la versión 20 (LTS actual)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Instalar Composer (desde la imagen oficial de Composer)
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Definir el directorio de trabajo
WORKDIR /var/www/html

# Copiar (si ya existe el proyecto Laravel localmente)
# COPY . .

# Exponer el puerto del PHP-FPM
EXPOSE 9000

# 🟢 Este comando asegura que las carpetas existen y tienen permisos correctos
# antes de iniciar PHP-FPM. Evita errores de "Permission denied" o "No such file".
CMD ["bash", "-c", "mkdir -p storage bootstrap/cache && chown -R www-data:www-data storage bootstrap/cache && chmod -R 777 storage bootstrap/cache && php-fpm"]

# Asegura permisos antes de iniciar
CMD ["bash", "-c", "mkdir -p storage bootstrap/cache && chown -R www-data:www-data storage bootstrap/cache && chmod -R 777 storage bootstrap/cache && php-fpm"]