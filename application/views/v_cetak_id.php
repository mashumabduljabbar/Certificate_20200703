<html>
<head>
<meta name="subject" content="Certificate">
<meta name="copyright"content="Created by Ma'shum Abdul Jabbar">
<title>Certificate</title>
</head>
<body>
<style>
table,tr,td{
	width: 100%;
	text-align:center;
}
</style>
<table>
	<tr>
		<td style="padding-top:110px; padding-left:80px; font-family:'Courier New'; font-size:11pt;">
			<?php echo $attenders->attenders_number; ?>
		</td>
	</tr>
	<tr>
		<td style="padding-top:75px; font-family:'Arial'; font-size:26pt; font-weight:bold;">
			<?php echo strtoupper($attenders->attenders_name);?>
		</td>
	</tr>
	<tr>
		<td style="padding-top:14px; padding-right:83px; font-family:'Courier New'; font-size:12pt; font-weight:bold;">
			<?php echo strtoupper($attenders->attenders_as);?>
		</td>
	</tr>
	<tr>
		<td style="padding-top:330px; padding-left:850px;">
			<img src="assets/<?php echo $attenders->attenders_qr."?".strtotime("now");?>" width="100px" height="">
		</td>
	</tr>
</table>
</body>
</html>