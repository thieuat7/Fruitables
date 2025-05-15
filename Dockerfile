FROM php:8.0-fpm

# Cài extension PHP và các tool cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Đặt thư mục làm việc
WORKDIR /var/www

# Copy mã nguồn Laravel vào container
COPY . .

# Cài các dependency Laravel
RUN composer install --no-interaction --prefer-dist

# Set quyền cho Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copy file .env
COPY .env .env

# Expose cổng 80 (không bắt buộc nhưng để chuẩn)
EXPOSE 80

# Copy script start.sh vào container
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Khi container khởi động, chạy start.sh
CMD ["/start.sh"]
