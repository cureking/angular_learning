<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>index</title>
</head>
<body>
	<?php
	$comments = array(
		'0' => array(
			'user' => 'aosnow',
			'title' => '第一条留言',
			'content' => '第一条留言的正文内容。。。',
			'date' => time()
		),
		'1' => array(
			'user' => 'aosnow',
			'title' => '第二条留言',
			'content' => '第二条留言的正文内容。。。',
			'date' => time()
		),
		'2' => array(
			'user' => 'aosnow',
			'title' => '第三条留言',
			'content' => '第三条留言的正文内容。。。',
			'date' => time()
		)
	);

	foreach( $comments as $key => $val )
	{
		?>
		<div>
			<h3><?php echo $val[ 'title' ] ?></h3>
			<div><?php echo $val[ 'content' ] ?></div>
			<hr>
		</div>
		<?php
	}
	?>
</body>
</html>