<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## deployment guide

Note:you need to install docker on the machine first

## First time commands
clone the project from GitHub

<code> git clone https://github.com/ahmedeltokhy/foodlableTest.git</code>

then install the project using composer 

<code>composer install</code>

add the environment file (.env) attached to the email

run the docker build command (using laravel sail)

<code>vendor/bin/sail up -d</code>

run the migration command under the sail

<code>vendor/bin/sail artisan migrate --seed</code>

## Next times running command

run the sail up command

<code>vendor/bin/sail up -d</code>

