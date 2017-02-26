<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="container">

    <table class="table table-hover">
        <tbody>
        <tr>
            <td>id</td>
            <td>username</td>
            <td>password</td>
        </tr>
        <!-- Volist循环嵌套输出tags标签 -->
        <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($user['id']); ?></td>
                <td><?php echo ($user['username']); ?></td>
                <td><?php echo ($user['password']); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

        </tbody>
    </table>

</div>
</body>
</html>