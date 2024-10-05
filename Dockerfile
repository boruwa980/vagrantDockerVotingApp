# Use the official PHP image with Apache
FROM php:7.4-apache

# Install the necessary extensions -> mysqli for MySQL
RUN docker-php-ext-install mysqli

# Copy the application code into the container
COPY ./src/ /var/www/html/

# Set permissions for the web directory
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80 for to access web app
EXPOSE 80