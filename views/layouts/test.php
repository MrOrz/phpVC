<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  <title>測試！</title> 

<?= self::javascript_include_tag('test.js') ?>
<?= self::stylesheet_link_tag('test2.css') ?>
</head> 
<body> 
<? require($__view__); ?>
</body>
</html>
