
## Формирование путевых листов

Данное веб приложение позволяет формировать путевые листы и скачивать их в формате .xlsx

## Установка

1)скачиваем проект

git clone https://github.com/letniy71/waybills.git

2)Изменяем настройки в файле .env в корне(доступ к БД(ip,логин, пароль и.т.д)

3)Запускаем миграцию php artisian migrate

## Инструкция

Логин пароль по умолчанию L:admin P:12345678
по умолчанию у пользователя с типом учетной записи admin имя бригады 0.

Пользователи с ролью admin имеют возможность заполнять справочники(бригады,автоб водители,механики и.т.д)+заполнять путевые листы любыми данными
Пользователи с ролью user могу просматривать, добавлять, редактировать и скачивать пуетвые листы(Админы могут удалять)

Для добавления нового путевого листа

	1)Выбираем дату

	2)Нажимаем кнопку добавить

	3)Выбираем водителя, номер авто, время по графика и ствим галочку - заполняем следующий петвыой лист

	4)Механик,диспетчер, серия и номер формируются автоматически(серия= дата+№бригады. Номер уникальный в рамках бригады за день, каждый день номер обнуляется). 

	4)нажимаем кнопку добавить

	5)Путевой лист сформирован и можно его скачать

	6)Для скачивания всех путевых листов за день, надимаем кнопку скачать все(скачиается одна книга в которой на каждом листе размещены все пуетвые листы за день).



