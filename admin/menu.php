        <!-- Left Dark Bar Start -->
    <div id="leftside">
    	<div class="user">
        	<img SRC="images/avatar.png" width="44" height="44" class="hoverimg" alt="Avatar" />
            <p>�� �����, ���:</p>
            <p class="username"><?=$_SESSION['login']?></p>
            <p class="userbtn"><a href="edituser.php?login=<?=$_SESSION['admin_id']?>" title="">���������</a></p>
            <p class="userbtn"><a href="login.php?act=del" title="">�����</a></p>
        </div>
        <ul id="nav">
        	<li>
                <ul class="navigation">
                    <li class="heading selected">��������������</li>
                    <li><a href="editpost.php" title=""></a></li>
                    <li><a href="editpost.php" title="">��������</a></li>
                    <li><a href="editpage.php" title="">�������</a></li>
                    <li><a href="editconfig.php" title="">�����</a></li>
                    <li><a href="editcomm.php" title="">������������</a></li>
                    <li><a href="editblock.php" title="">������</a></li>
                    <li><a href="editcat.php" title="">���������</a></li>
                    <li><a href="editmod.php" title="">�������</a></li>
                </ul>
            </li>
		</ul>
    </div>
    <!-- Left Dark Bar End --> 