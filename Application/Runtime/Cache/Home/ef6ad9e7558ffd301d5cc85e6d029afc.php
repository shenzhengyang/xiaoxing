<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div class="container">
    	<<table class="table table-hover">
    		<thead>
    			<tr>
    				<th>id</th>
					<th>time</th>
					<th>uid</th>
					<th>desc</th>
					<th>hasrepaired</th>
    			</tr>
    		</thead>

    		<tbody>
				<?php if(is_array($feedback)): $i = 0; $__LIST__ = $feedback;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$feedback): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($feedback['id']); ?></td>
						<td><?php echo ($feedback['time']); ?></td>
						<td><?php echo ($feedback['uid']); ?></td>
						<td><?php echo ($feedback['desc']); ?></td>
						<td><?php echo ($feedback['hasrepaired']); ?></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
    		</tbody>
    	</table>
    </div>
</body>
</html>