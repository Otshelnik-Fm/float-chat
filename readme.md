## Описание:  

Дополнение для WordPress плагина [WP-Recall](https://wordpress.org/plugins/wp-recall/) - и входящего в его комплект дополнения Rcl Chat (Чат)  

Дополнение Float Chat - всплывающий чат на вашем сайте.  
Спасибо Андрею за помощь, наставления и развитие ядра WP-recall - благодаря чему и появилась такая возможность в реализации.  

Принцип работы: автоматически добавляет кнопку, слева вверху (опция), на вашем сайте. По клику появляется всплывающее окно чата.  
**Внимание!** Этот аддон зависит от дополнения Rcl Chat (Чат).  

Нажав на кнопку закрыть, или по оверлею - чат полностью закрывается и перестает посылать ajax-запросы.   
Так как чат присутствует на всех страницах вашего сайта и начинает работу, только когда он вызван, и заканчивает работу по закрытию -
это выгодно отличает его от простой вставки шорткода rcl-chat, который появился в 15.1 версии WP-Recall.
Это расширяет и упрощает общение ваших пользователей.  

Администратор имеет возможность модерировать чат (не только админ, но и тот кому разрешен доступ к консоли в общих настройках WP-Recall)  

Смайлы, картинки, загрузка файлов, поддержка youtube, soundcloud и других oEmbed сервисов - оживят ваш сайт. Будьте ближе к своим пользователям.  
------------------------------


## Возможности:   

 - Вывод кнопки вызова чата автоматически ли вручную (html или шорткодом)  
 - Настроить положение кнопки (сверху/снизу, отступ)  
 - Указать надпись на кнопке  
 - Указать иконку кнопки  
 - Задать заголовок чата  
 - Возможность загружать файлы в чат  
 - Гостям (не залогиненным) показать последние сообщения чата или скрыть  
 - Система реколл-шаблонов позволит вам кастомизировать вывод сообщения для гостей  
 - По закрытию чата - перестают идти запросы на новые сообщения (а для гостей их и нет совсем)  
 - Поддержка Автобота и его Чат-ботов (смотри FAQ)  
 - Адаптивный дизайн  


------------------------------

## Установка/Обновление  

**Установка:**  
Т.к. это дополнение для WordPress плагина WP-Recall, то оно устанавливается через [менеджер дополнений WP-Recall](https://codeseller.ru/obshhie-svedeniya-o-dopolneniyax-wp-recall/)  

1. В админке вашего сайта перейдите на страницу "WP-Recall" -> "Дополнения" и в самом верху нажмите на кнопку "Обзор", выберите .zip архив дополнения на вашем пк и нажмите кнопку "Установить".  
2. В списке загруженных дополнений, на этой странице, найдите это дополнение, наведите на него курсор мыши и нажмите кнопку "Активировать". Или выберите чекбокс и в выпадающем списке действия выберите "Активировать". Нажмите применить.  


**Обновление:**  
Дополнение поддерживает [автоматическое обновление](https://codeseller.ru/avtomaticheskie-obnovleniya-dopolnenij-plagina-wp-recall/) - два раза в день отправляются вашим сервером запросы на обновление.  
Если в течении суток вы не видите обновления (а на странице дополнения вы видите что версия вышла новая), советую ознакомиться с этой [статьёй](https://codeseller.ru/post-group/rabota-wordpress-krona-cron-prinuditelnoe-vypolnenie-kron-zadach-dlya-wp-recall/) 

------------------------------

## Настройки:  

Имеются настройки в админке: "WP-Recall" -> "Настройки" -> "Настройки Float Chat"

* Возможность вывести кнопку вызова всплывающего чата: автоматически или шорткодом (вручную)
* При выводе кнопки автоматически в опциях задается ее положение: сверху/снизу и отступ от выбранного края
* Возможность задать текст кнопки и иконку кнопки
* Задать заголовок чата
* Вкл/откл возможность обмениваться файлами в чате
* Вкл/откл возможность гостям просматривать чат

И многие другие - смотри скриншоты на [кодеселлер](https://codeseller.ru/products/float-chat/)

При настройках вывода вручную, в нужное место вставьте шорткод [fchat_init]

Еще можно прокачать функционал с помощью Автобота и его Чат-ботов (смотри FAQ)

------------------------------

## FAQ:  
**Так как прокачать его Автоботом и чат-ботами?**  

Чтобы вашим пользователям было веселей если они одни в чате - установите ботов.
- вы можете установить дополнение ["Автобот"](https://codeseller.ru/products/autobot-cabinet/) (обязателен для чат-ботов), а для него доступны [чат-боты](https://codeseller.ru/product_tag/chat-bot/)  

дополнения чат-ботов:  
[Bot AnekBot (анекдоты)](https://codeseller.ru/?p=17441)  
[Bot Bash.org (истории с Bash.org)](https://codeseller.ru/?p=17446)  
[Bot Exchange Rates (курсы доллара и евро)](https://codeseller.ru/?p=17450)  
[Bot Rules (правила чата)](https://codeseller.ru/?p=17454)  
[Bot User Info (информация о пользователе и краткая статистика)](https://codeseller.ru/?p=17458)  
[Bot Weather In The City (Погода в заданном городе)](https://codeseller.ru/?p=17655)  



**Как я могу поменять для гостя сообщение что нужно войти на сайт?**
- в настройках дополнения переключить "Гости могут видеть последние сообщения в чате" на "Нет" и можно кастомизировать шаблон:
- Дополнение использует функционал шаблонов WP-Recall. 
Шаблон `fchat-guest-info.php` - как раз выводящий информацию для гостей. Можете поменять текст, вставить изображение, свою вёрстку.

Как работать с шаблонами описано [здесь](https://codeseller.ru/post-group/ispolzuem-funkcional-shablonov-v-plagine-wp-recall-spisok-shablonov/).
- копируете нужный файл и меняете его.

**Я могу сменить иконку кнопки, положение кнопки, отступ и текст кнопки?**
- да. В настройках всё есть.

**Как вывести кнопку в нужном месте?**
- в настройках выберите "Вывод кнопки чата" -> "Выведу шорткодом или вручную"
и в нужное место вставьте шорткод `[fchat_init]` (в текстовый или html-виджет)

**Как вывести кнопку программно?**
- кнопку также можно вызвать функцией `fchat_button($dop_class)` где `$dop_class`(строка) дополнительный класс кнопки. Если пусто - "fc_manual"

- также можно вписать класс `fc_wrap` в вашу кнопку - по этому классу происходит срабатывание всплывающего окна

**Какой смысл в этом чате? - ведь в реколл уже есть шорткод чата**
- это всплывающий чат. Он доступен на всех страницах вашего сайта.

Даже если вы выведите реколл чат с помощью шорткода [rcl-chat](https://codeseller.ru/api-rcl/rcl-chat/) - в сайдбаре... Да - он будет доступен на всех страницах вашего сайта.
Но! Он будет всегда посылать ajax-запросы на получение новых сообщений со всех страниц вашего сайта. И это увеличит нагрузку на ваш хостинг.
Так что такой подход не рационален. Этот шорткод нужно размещать на отдельной странице.

**Итак, еще раз про Float Chat:**
Ссылка на этот чат присутствует на всех страницах вашего сайта и чат начинает работу, только когда он вызван, и заканчивает работу по закрытию:
Нажав на кнопку закрыть, или по оверлею - чат полностью закрывается и перестает посылать ajax-запросы.   
Это выгодно отличает его от простой вставки шорткода rcl-chat.

Это расширяет и упрощает общение ваших пользователей.  

С версии 2.0 дополнения, чат гостям (не залогиненным) не отправляет ajax-запросы. Они видят просто последние сообщения чата или заглушку. Смотря что вы выбрали в настройках.

- такой вот смысл. Получаем рациональное использование своего сервера. И платим за хостинг меньше))





------------------------------

## Changelog:  
= 2018-10-31 =
v2.0.0
* поддержка WP-Recall 16.16
* доп переписан
* скрипты и стили грузятся в зависимости от ситуации и настроек и минимизированы
* кнопка выводится не через вкладку ЛК, а своим способом (старый способ создавал неверные внутренние урл, которые детектили СЕО утилиты).
* для гостей убрал автоополучение новых сообщений чата и возможность просматривать по страницам
* добавлен js-хук <code>fc_load_chat</code> - срабатывает при загрузке всплывающего чата
* возможность в настройках задать текст кнопки и иконку
* возможность вывести не только шорткодом, но и вставив просто html кнопки в нужное место
* кнопку также можно вызвать функцией <code>fchat_button($dop_class)</code> где <code>$dop_class</code>(строка) дополнительный класс кнопки. Если пусто - "fc_manual"
* опция - автоматический вывод кнопки (если не шорткодом выводим) слева вверху, слева внизу
* опция - отступ кнопки от выбранного края
* плавное появление контента чата
* устранил убегание контента при загрузке чата, если в чате картинки или oEmbed
* проработал адаптивность



**2017-12-03**
v1.4.1
* Устранил "дерганье" кнопки при загрузке. 
Добавил принудительно скрытие кнопки в хедере. Разблокируется после загрузки стилей в подвале сайта и кнопка плавно появляется


**2017-11-23**
v1.4
* Внутренняя анимация переведена на используемый в WP-Recall animate-css
* Стили загружаются в подвале



**2017-10-29**
v1.3.1
* Убрал стили размытия контента при включении всплывающего чата. Возникал конфликт при срабатывании других модальных окнах.


**2017-10-14**
v1.3
* Исправлена ошибка вывода кнопки через шорткод
* Работа с 16-й версией плагина
* Корректировки по стилям
* Добавлена иконка дополнения


**2017-02-16**
v1.2
* Добавлена настройка - "Гости могут просматривать чат"
Вместо чата, гости увидят в всплывающем окне призыв: "Вам нужно войти на сайт, чтобы просматривать чат и общаться в чате!"
* Дополнение использует функционал шаблонов WP-Recall. 
Добавлен шаблон - как раз выводящий информацию для гостей. Можете поменять текст, вставить изображение, свою вёрстку.

Как работать с шаблонами описано <a href="https://codeseller.ru/post-group/ispolzuem-funkcional-shablonov-v-plagine-wp-recall-spisok-shablonov/" target="_blank"><strong>здесь</strong></a>.


**2017-02-16**
v1.1.2
* Исправлен баг - в хроме, при включении ютуб на воспроизведение в полноэкранном режиме


**2016-11-01**
v1.1.1
* Работа с версией WP-Recall 15.4
* Исправлен недочет при работе с новой версией реколл - спиннер загрузки чата выбился из блока.


**2016-09-29**
v1.1. 
* Опция: Задаем заголовок чата
* Опция: Отключаем возможность загрузки файлов (меньше скриптов грузится)
* По клику на кнопке запуска чата, в ожидании всплывающего окна, в кнопке крутится спиннер. Наглядно показывая - что наш клик обрабатывается
* При первой активации дополнение устанавливает свои первоначальные настройки


**2016-09-10**
v1.0
* Release


------------------------------


## Поддержка и контакты:  

* Поддержка осуществляется в рамках текущего функционала дополнения  
* При возникновении проблемы, создайте соотвествующую тему на форуме поддержки товара  
* Если вам нужна доработка под ваши нужды - вы можете обратиться ко мне в [ЛС](https://codeseller.ru/author/otshelnik-fm/?tab=chat) с техзаданием на платную доработку.  

Полный список моих работ опубликован на [моём сайте](https://otshelnik-fm.ru/all-my-addons-for-wp-recall/) и в каталоге магазина [CodeSeller.ru](https://codeseller.ru/author/otshelnik-fm/?tab=publics&subtab=type-products)  

------------------------------

## Author  

**Wladimir Druzhaev** (Otshelnik-Fm)  


