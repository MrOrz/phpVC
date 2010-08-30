<?
/// a typical view.
?>
<h1>Test page of phpVC</h1>
<?
/**
  here inside the view, the variables $params and $__script_path, which are
  defined in the scope of Controller::render, are available. Just use them 
  when needed.
*/
?>
<tt>$params</tt> from <tt>TestController</tt>: <? print_r($params); ?> <br />
<tt>$__script_path</tt> from <tt>Controller</tt>: <?= $__script_path ?> <br />
<tt>$_GET[]</tt>: <? print_r($_GET); ?> <br />
<?
/**
  layouts and views are included into the body of Controller::render(), 
  thus self:: should be used when invoking the helper functions defined in controller.php
*/
?>
<tt>path_to('controller_A', 'action_A')</tt>: <?= self::path_to('controller_A','action_A') ?>
