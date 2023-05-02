#!/bin/bash

composer update
composer install
cp ".env.example" .env
php artisan key:generate
php artisan config:cache
php artisan migrate:fresh --seed
tput clear

tput setaf 2
echo "Projeto instalado com sucesso!"
tput setaf 6

echo "Iniciar servidor? (s/n)"
read run_serve;

if [ $run_serve == "s" ];
then
    php artisan serve
else
    tput setaf 8
    echo "Para iniciar o servidor, execute \"php artisan serve\""
fi