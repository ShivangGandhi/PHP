<!DOCTYPE html>
<html>
<head>
	<title>PHP CRUD</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
	<?php require_once 'process.php'; ?>

	<?php 

	if(isset($_SESSION['message'])): ?>

		<div class="alert alert-<?=$_SESSION['msg_type']?>">
			
			<?php 
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			 ?>

		</div>	
	<?php endif ?>
		
	<div class="container">

		<?php 
			$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

			$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
		?>	

		<div class="row justify-content-center">
			<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Location</th>
						<th colspan="2">Action</th>
					</tr> 
				</thead>
				<?php 
					while($row = $result->fetch_assoc()): 
				 ?>
				 <tr>
				 	<td><?php echo $row['name'] ?></td>
				 	<td><?php echo $row['location'] ?></td>
				 	<td>
				 		<a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">
				 			Edit
				 		</a>
				 		<a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">
				 			Delete
				 		</a>
				 	</td>
				 </tr>
				<?php endwhile; ?> 
			</table>
		</div>

		<?php 
			//pre_r($result);
			pre_r($result->fetch_assoc());

			function pre_r( $array ) {
				echo '<pre>';
				print_r($array);
				echo '</pre>';
			}
		 ?>

		<div class="row justify-content-center">
			<form action="process.php" method="POST">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" class="form-control" autocomplete="off" 
					value="<?php echo $name; ?>" placeholder="Enter your name">
				</div>
				<div class="form-group">
					<label>Location</label>
					<input type="text" name="location" class="form-control" autocomplete="off" 
					value="<?php echo $location; ?>" placeholder="Enter your location">
				</div>
				<div class="form-group">
					
					<?php if($update === true): ?>
						<button class="btn btn-info" type="submit" name="update">Update</button>
					
					<?php else: ?>	
						<button class="btn btn-success" type="submit" name="save">Save</button>
					<?php endif; ?>	
				</div>
			</form>
		</div>
	</div>	
</body>
</html>