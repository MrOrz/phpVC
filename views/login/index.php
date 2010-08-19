<h1>登入</h1>
<? if(isset($params['msg']) || isset($_GET['msg'])){ ?>
<p><?= $params['msg'].$_GET['msg']; ?></p>
<? } ?>
<form method="post" action="login/login">
  <label for="user">帳號</label>：<input type="text" name="user" title="預設為學號，首字小寫"/><br />
  <label for="password">密碼</label>：<input type="password" name="password"  title="預設為身份證字號，首字大寫"/><br />
  <input type="submit" value="登入" />
</form>