<?php
include('functions.php');
$obj = new functions();
$id = $_GET['itemid'];
$result = $obj->select('items','itemid='.$id);
$items = $obj->fetch($result);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Item Page</title>
	<link rel="stylesheet" type="text/css" href="/bootstrap.css">
</head>
<body>
	
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1>Edit Item</h1>
				<form action="update_items.php" method="post">
					<input type="hidden" name="itemid" value="<?php echo $items->itemid;?>">
					<div class="form-group">
						<input type="text" name="itemname" value="<?php echo $items->item_name;?>" class="form-control" placeholder="Name">
					</div>
					<div class="form-group">
						<input type= "radio" name="lostorfound" value= "<?php echo ($items->lostorfound == 1)? 'Lost':'Found';?>" class = "form-control" placeholder="Lost or Found">
					</div>
					<div class="form-group">
						<textarea placeholder="Description" class="form-control" name="description"><?php echo $items->itemdescription;?></textarea>
					</div>
					<div class="form-group">
						<input placeholder="username" value="<?php echo $items->username;?>" type="text" name="author" class="form-control">
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-info" value="Submit" >
					</div>
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</body>
</html>