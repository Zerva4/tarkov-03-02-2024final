# Tarkov.town

## Требования

- PHP 8.x
- NodeJS 21.x
- PostgreSQL 15.x или выше
- ImageMagic 7.x
- Symfony 6.3

## Установка

- Склонируйте репозиторий в необходимую папку
- Устанвите пакеты PHP

```
composer install
```
- Установите пакеты NodeJS
```
yarn install
```
- Соберите JS фалйы
```
yarn run build
```

## Настройка

- Скопируйте файл .env.dist в файл .env.local и настройте переменные окружения
- Пропишите домен сайта и доступ к БД
- Создайте БД
```
bin/console doctrine:database:create
```
- Выполните миграции для создания таблиц БД
```
bin/console doctrine:migrations:migrate
```
- Создайте администратора сайта
```
bin/console app:admin:create -l логин -m эл.почта -p пароль
```
- Настройте веб сервер указывающий на папку public, примеры конфигураций можно найти на сайте https://symfony.com/doc/current/setup/web_server_configuration.html


## Импорт данных

Для импорта данных существует единая команда
```
bin/console app:import:all
```
Но так же можно по отдельности импортировать элементы данных, более детально можно ознакомится с помощью комманды
```
bin/console app:import list
```
При первом импорте данных важно соблюдать очередность импорта элементов:
- app:import:traders
- app:import:bosses
- app:import:maps
- app:import:items-materials
- app:import:items
- app:import:items-properties
- app:import:quests-items
- app:import:quests
- app:import:barters
- app:import:places
- app:import:crafts
- app:import:traders:cash-offers

После первого импорта в дальнейшем блоки можно обновлять по отдельности

