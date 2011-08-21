        <!-- Left Dark Bar Start -->
    <div id="leftside">
    	<div class="user">
        	<img SRC="images/avatar.png" width="44" height="44" class="hoverimg" alt="Avatar" />
            <p>Вы зашли, как:</p>
            <p class="username"><?=$_SESSION['login']?></p>
            <p class="userbtn"><a href="edituser.php?login=<?=$_SESSION['admin_id']?>" title="">Настройки</a></p>
            <p class="userbtn"><a href="login.php?act=del" title="">Выход</a></p>
        </div>
        <ul id="nav">
        	<li>
                <ul class="navigation">
                    <li class="heading selected">Редактирование</li>
                    <li><a href="editpost.php" title=""></a></li>
                    <li><a href="editpost.php" title="">Новостей</a></li>
                    <li><a href="editpage.php" title="">Страниц</a></li>
                    <li><a href="editconfig.php" title="">Сайта</a></li>
                    <li><a href="editcomm.php" title="">Комментариев</a></li>
                    <li><a href="editblock.php" title="">Блоков</a></li>
                    <li><a href="editcat.php" title="">Категорий</a></li>
                    <li><a href="editmod.php" title="">Модулей</a></li>
                </ul>
            </li>
		</ul>
    </div>
    <!-- Left Dark Bar End --> 