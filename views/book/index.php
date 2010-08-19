<h1>Book</h1>
<div id="infobox">
<p><span class="txtSchoolId"></span>[<a href="<?= self::path_to('login', 'logout') ?>">登出</a>]</p>
<p>
<?
  if($is_member){
?>
系學會會員，享用<span>優惠價</span>。
<?
  }else{
?>
非系學會會員，使用<span>原價</span>。
<? } ?>
</p>

<a href="javascript:;" id="btnCart">$ <span class="txtTotalCost"></span> -</a>

</div>

<div id="main">
<?
// TODO: do the listing here.

?>
</div>

<div id="footer">
2010 臺灣大學電機系學會資訊部.
</div>