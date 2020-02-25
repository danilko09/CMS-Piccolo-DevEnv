# CMS-Piccolo-DevEnv
В данном репозитории располагается окружение для разработки и тестирования CMS Piccolo

## Клонирование
Для git версии >= 2.13 `git clone --recurse-submodules https://github.com/danilko09/CMS-Piccolo-DevEnv.git`
В версиях git ниже 2.13 `git clone --recursive https://github.com/danilko09/CMS-Piccolo-DevEnv.git`
Обычный clone клонирует без "подмодулей", то есть подпапки в repos будут пусты.

## Использование
Для запуска достаточно развернуть на каком-нибудь веб-сервере со свежим PHP + все что нужно для работы используемых пакетов.
Желающие могут воспользоваться docker-compose.
### Проверка зависимостей
Запускается с главной страницы, если не имеется развернутой сборки.
Проверяет на доступность все пакеты, указанные в requires из packages.json
### Запуск тестов
Тоже открывается с главной страницы, если не имеется развернутой сборки.
Функции, доступные для тестов можно найти в `utils/testFunctions.php` и `utils/testAsserts`.
