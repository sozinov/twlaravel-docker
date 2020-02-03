
<p><strong>Установка на Linux:</strong><br />1. Устанавливаем docker и docker-composer для вашего дистрибутива Linux</p>
<p><a href="https://docs.docker.com/install/">https://docs.docker.com/install/</a></p>
<p><a href="https://docs.docker.com/compose/install/">https://docs.docker.com/compose/install/</a></p>
<p><br />2. Переходиv в любую папку пльзователя и клонируем репозиторий проекта с гитхаб<br />&nbsp; &nbsp;<em>git clone <a href="https://github.com/sozinov/twlaravel-docker.git">https://github.com/sozinov/twlaravel-docker.git</a></em></p>
<p><br />3. Переходим в папку с проектом<br />&nbsp;<em> &nbsp;cd twlaravel-docker</em><br />&nbsp; &nbsp;и запускаем сборку и запуск контейнеров в фоне, командой<br />&nbsp; &nbsp;<em>docker-compose up -d</em></p>
<p><br />4. Ждём когда закончится запуск, после чего проект будет доступен по <br />&nbsp; &nbsp; http://185.233.118.114:7080 (везде вместо 185.233.118.114- ip вашего сервера)<br />&nbsp; &nbsp;</p>
<p>&nbsp; &nbsp; админка для управление бд будет доступна по адресу<br />&nbsp; &nbsp; <a href="http://185.233.118.114:6080">http://185.233.118.114:6080</a>&nbsp; (логин root, пароль 123456)</p>
<p>5. Для того, что бы работал поиск на главной странице, необходимо выполнить индексацию elasticsearch в ларавел из папки с проектом (того же пути где остановились)</p>
<p>&nbsp; &nbsp; - выполняем вход в контейнеров<br />&nbsp; &nbsp; docker-compose exec web bash<br />&nbsp; &nbsp; - внутри контейнера необходимо выполнить, создание индекса elasticsearch<br /><em>&nbsp; &nbsp; php artisan elastic:create-index "App\MyIndexConfigurator"</em></p>
<p><br />6. После успешного создания индекса, поиск на главной странице заработает.&nbsp;<br />&nbsp; &nbsp; &nbsp;Для добавление новых данных в бд, необходимо перейти на страницу загрузки документа с данными в формате ".json". пример -&nbsp; document.json</p>
<p>&nbsp; &nbsp; &nbsp;<a href="http://185.233.118.114:7080/api/addDocument">http://185.233.118.114:7080/api/addDocument&nbsp;</a>&nbsp;</p>
<p>, пример содержимого файла</p>
<p>[<br />{<br />"name": "James Charles",<br />"login": "jcharles"<br />},<br />{<br />"name": "James Michael Stone",<br />"login": "jmichaelstone"<br />},<br />{<br />"name": "James Macevoy",<br />"login": "jammacevoy"<br />},<br />{<br />"name": "Mack Donald",<br />"login": "ronald"<br />}<br />]</p>
<ul>
<li>формат файла .json</li>
<li>выбираем файл и нажимаем кнопку upload</li>
<li>после чего если таких логинов не существовало, то такие записи добавятся в базу данных и синхронизируются с elasticsearch</li>
<li>в поиске на главной<br />http://185.233.118.114:7080<br />можно искать новые логины, имена, фамилиии</li>
</ul>
<p><strong>Полезные команды:</strong></p>
<ul>
<li>выход из контейнера<br /><em>&nbsp; &nbsp;exit</em>&nbsp;</li>
<li>останаливаем все контейнеры<br /><em>&nbsp; docker kill $(docker ps -q)</em></li>
<li>удалить все остановленные контейнеры <br /><em>&nbsp; docker rm $(docker ps -a -q)</em><em></em></li>
<li>удаляем все образы<br /><em>sudo docker rmi --force $(docker images -q)</em></li>
</ul>
