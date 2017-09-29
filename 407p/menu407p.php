<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Модуль 407-П</title>
    <script type="text/javascript">
        $(function() {
          if ($.browser.msie && $.browser.version.substr(0,1)<7)
          {
			$('li').has('ul').mouseover(function(){
				$(this).children('ul').show();
				}).mouseout(function(){
				$(this).children('ul').hide();
				})
          }
        });        
    </script>
</head>
<body>
<?php

// проверка авторизации и полномочий

if (!CheckLogin()){
echo '<ul id="menu">
	<li><a href="\">Главная страница</a></li>
    </ul>
<br>
<br>';
}
else {
if ($_SESSION['type'] == 0){
    echo "<ul id='menu'>
	<li><a href='\'>Главная страница</a></li>
	<li>
            <a id='name' href='files.php'>Работа с файлами</a>
        </li>
        <li>
            <a href='exit.php'>Выход</a>
	</li>
        <li>
            <a>".$_SESSION['last_name']." ".$_SESSION['name']." ".$_SESSION['second_name']."</a>
        </li>
	
</ul>
<br>
<br>";
}    
else {
echo "<ul id='menu'>
	<li><a href='\'>Главная страница</a></li>
	<li>
            <a href='settings_main.php'>Настройки</a>
                <ul>
                    <li>
                        <a href='settings_main.php'>Общие</a>
                    </li>
                    <li>
                        <a href='settings_user.php'>Настройки пользователей</a>
                    </li>
                    <li>
                        <a href='settings_dir.php'>Настройки папок обмена</a>
                    </li>
                </ul>
	</li>
        <li>
            <a href='exit.php'>Выход</a>
	</li>
        <li>
            <a>".$_SESSION['last_name']." ".$_SESSION['name']." ".$_SESSION['second_name']."</a>
        </li>
	
</ul>
<br>
<br>";    
}
}
?>
</body>
</html>