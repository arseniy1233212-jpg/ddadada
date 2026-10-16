@echo off
chcp 65001 >nul
echo === Установка зависимостей ===
call composer install
if not exist .env copy .env.example .env
call php artisan key:generate --show >nul
call php artisan optimize:clear
call php artisan route:list
echo === Запуск на http://127.0.0.1:8120 ===
php artisan serve --port=8120
