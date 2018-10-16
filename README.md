# Инструкция по установке и эксплуатации приложения

## Эксплуатация:

Приложение основано на фрэймворке Yii2. Руководство на русском языке можно найти здесь: https://www.yiiframework.com/doc/guide/2.0/ru

Базовая структура приложения основана на шаблоне приложения Yii2-App-Basic: https://github.com/yiisoft/yii2-app-basic

## Установка

### Скачивание

Клонируем репозиторий в требуемую директорию. Стоит учитывать, что директория, видимая из вэба - web 
 
`git clone [url репозитория]`

### Установка зависимостей

Установка зависиместей произсодится с помощью Composer, менеджера зависимостей для PHP. Инструкции по установке можно найти на официальном сайте :
https://getcomposer.org/doc/00-intro.md

Установка производится по команде:
`composer install`

### Приведение базы данных в начальное состояние

Для создания и настройки начального состояния используются миграции. 
Для того, что бы их использовать, нужно настроить подключаение к базе данных в файле
`config/db.php`

После этого произведите команду в корневой директории проекта:
`php yii migrate`

При этом будет создана учетная запись администратора: admin/admin. Ее необходимо сразу заменить.

## Создание форм

Для создания формы сначала необходимо или создать и выполнить миграцию, или создать таблицу в базе данных, содержащую значения для заполнения файла.
Предпочтительнее первый способ.

Затем, нужно при рабочем окружении для разработки (`YII_ENV = 'dev'`, указывается в файле `web/index.php`):

1. зайти в модуль генерации кода по ссылке `/gii`,
2. создать модель на основе таблицы,
3. создать CRUD контроллер на основе модели.

Внести необходимые изменения в сгенерированный код, основыываясь на контроллере, моделях и шаблонах `document1`.