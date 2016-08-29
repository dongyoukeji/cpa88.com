<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Tag</title>
</head>
<body>
    <?php $_list_news=M("Article")->field("*")->where("cid = 6 and status=0")->limit(12)->order("")->select();$_column=M("Column")->find("");$column=$_column;$list=$_list_news; if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="#/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</body>
</html>