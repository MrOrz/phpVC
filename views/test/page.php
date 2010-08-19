<h1>Test page of phpVC</h1>
<tt>$params</tt> from <tt>TestController</tt>: <? print_r($params); ?> <br />
<tt>$__script_path</tt> from <tt>Controller</tt>: <?= $__script_path ?> <br />
<tt>$_GET[]</tt>: <? print_r($_GET); ?> <br />

<tt>path_to('controller_A', 'action_A')</tt>: <?= self::path_to('controller_A','action_A') ?>
