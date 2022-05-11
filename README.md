# Esfera

## 💻 Pré-requisitos

* PHP 7.4
* MySQL 8

## ☕ Rodando o projeto

Para rodar o projeto, siga estas etapas:

1. Crie na raiz do projeto um arquivo `.env` seguindo o `.env.example`

2. Instale as dependencias do projeto
```
composer install
```
```
php artisan migrate
```
```
php artisan db:seed
```
```
php artisan storage:link
```
3. Rode o projeto localmente
```
php artisan serve
```