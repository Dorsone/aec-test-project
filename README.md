# AEC Test Project

## Technique task of test project
Два компонента:
PHP скрипт, который генерирует JWT токен авторизации на основе приватного ключа и делает http запрос ```/v1/foo``` с хедером авторизации, который содержит этот токен. Ответ должен быть получен с http кодом 200 OK. Максимальное время запроса и ответа не должно превышать 100мс. Скрипт должен выводить информацию сколько ушло времени на запрос и получение ответа.

Реализовать один метод котроллера по роуту /v1/foo, который отдает ответ 200 OK, если к нему постучаться с правильным хедером авторизации. JWT токен должен проверяться с помощью публичного ключа.

## Installation

1) Set up your .env file
2) Run docker with command below: 
```bash
docker compose up -d 
```
3) Geneate app key
```bash
php artisan key:generate
```

## Usage
1) Run the test with command below in the docker container(for more information about docker container check [docs](https://docs.docker.com/engine/reference/commandline/exec/)):
```bash
php artisan test 
```
