<h1><?= $_SESSION['school_id']; ?> 的志願序</h1>
<a href="../login/logout">登出</a>
<p>下面會列出資料庫中，您所完成排序的課程。（已選但未排的不算）</p>
<? foreach($params as $course_name => $list){ ?>
<h2><?= $course_name ;?></h2>
<?= $list; ?>
<? } ?>
<hr />
<p>如果上面列出的志願序有任何問題，請嘗試：</p>
<ul>
  <li>登入<a href="http://course.ntuee.org">預選系統</a>再來一次。</li>
  <li>聯絡負責人：b97901125@ntu.edu.tw | MrOrz@批兔</li>
</ul>