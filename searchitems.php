<?php 
session_start();
//require("showItems.php");
require("config.php");
include('functions.php');
$obj = new functions();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  echo"<div class=page-header width = device-width text-align center >
  <h1>Hi, <b> $_SESSION[username]</b>. Welcome to our school site.</h1>
</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Page Title</title>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Style the body */
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color:#f1f1f1;
  margin: 0;
}

/* Header/logo Title */
.header {
  padding: 80px;
  text-align: center;
  background: #1abc9c;
  color: white;
}

/* Increase the font size of the heading */
.header h1 {
  font-size: 40px;
}

/* Sticky navbar - toggles between relative and fixed, depending on the scroll position. It is positioned relative until a given offset position is met in the viewport - then it "sticks" in place (like position:fixed). The sticky value is not supported in IE or Edge 15 and earlier versions. However, for these versions the navbar will inherit default position */
.navbar {
  overflow: hidden;
  background-color: #333;
  position: sticky;
  position: -webkit-sticky;
  top: 0;
}

/* Style the navigation bar links */
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}


/* Right-aligned link */
.navbar a.right {
  float: right;
}

/* Change color on hover */
.navbar a:hover {
  background-color: #ddd;
  color: black;
}

/* Active/current link */
.navbar a.active {
  background-color: #666;
  color: white;
}

#logout{
  display:none;
}

/* Column container */
.items {  
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
}

/* Create two unequal columns that sits next to each other */
/* Sidebar/left column */
.side {
  -ms-flex: 50%; /* IE10 */
  flex: 48.3%;
  background-color: #f1f1f1;
  padding: 20px;
}

/* Main column */
.main {   
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
  background-color: whitesmoke;
  padding: 20px;
  text-align:justify;
}

/* Fake image, just for this example */
.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}

/* Footer */


/* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 700px) {
  .items {   
    flex-direction: column;
  }
}

/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
  .navbar a {
    float: none;
    width: 100%;
  }
}
</style>
</head>
<body onload="javascript:loginlogout()">

<div class="header">
  <h1>Lost & Found Service</h1>
  <p>Created by <b>Vianej Shyti III-A</b> </p>
</div>

<div class="navbar">
  <a href="lostnfoundapp.php" class="active">Home</a>
  <a href="/mylostandfoundproject/login.php" class="middle"  id="login"type = "button">Login</a>
  <a href="/mylostandfoundproject/success.php" class="middle" id="additem" type = "button">Add Item</a> 
  <a href="/mylostandfoundproject/logout.php" class="middle" id="logout" type = "button">Logout</a> 

</div>
<div class="comment_list"></div>
<div class="items">
  <div class="side">
    <h3>Lost & Found items:</h3>

  </div>

<?php
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true)
{
  echo" You are not signed in, sign in or create an account before you continue";
}
?>
<script> function loginlogout() 
  {
    var buttonlogin = document.getElementById('login');
    var buttonlogout = document.getElementById('logout');
    var loggedin = <?php echo $_SESSION['loggedin'];?> 
    if(loggedin)
    {
      buttonlogin.style.display="none";
      buttonlogout.style.display = "block";
    }
    else
    {
       buttonlogin.style.display ="block";
       buttonlogout.style.display = "none";
    }    
  }
</script>
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>News</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body>
	<div class="container">
		<h1>Search Items</h1>
		<form method="get" action="">
			



			<div class="items">
				<div class="col-md-5">
					<input type="text" name="keyword" class="form-control">
				</div>
				<div class="col-md-3">
					<input type="submit" value="Search" class="btn btn-default">
				</div>
				<div class="clearfix"></div>
			</div>
 
		</form>
		<hr>
		<table class="table table-bordered table-striped">
			<tr>
                <th>Item Id</th>
                <th>Item Name</th>
                <th>Item Description</th>
                <th>Lost or Found</th>
                <th>User</th>
                <th>Image</th>
			</tr>
			<?php
				if(isset($_GET['keyword']))
				{
					$keyword = $_GET['keyword'];
				}
				else
				{
					$keyword = '';
				}
				$link = mysqli_connect("localhost","root","","projectdb");
				if(!$keyword)
				{
					$q = "SELECT * FROM items
                             JOIN comments ON items.username = comments.comment_user  GROUP BY items.itemid";
				}
				else
				{
					$q = "SELECT * FROM items
                             JOIN comments ON items.username = comments.comment_user
                                WHERE items.itemid LIKE '%".$keyword."%' 
                                        OR items.itemdescription LIKE '%".$keyword."%' 
                                        OR items.item_name LIKE '%".$keyword."%'
                                        OR items.imagename LIKE '%".$keyword."%'
                                        OR items.lostorfound LIKE '%".$keyword."%'
                                        OR comments.comment LIKE '%".$keyword."%' 
                                        OR comments.comment_user LIKE '%".$keyword."%'
                                        OR comments.comment_image LIKE '%".$keyword."%'  GROUP BY items.itemid";
				}
				$result = mysqli_query($link,$q);
				while($items = mysqli_fetch_object($result))
				{
					?>
					<tr>
                    <td><?php echo $items->itemid;?></td>
                    <td><?php echo $items->item_name ?></td>
                    <td><?php echo substr($items->itemdescription,0,50).'...';?></td>
                    <td><?php echo ($items->lostorfound == 1)? "Lost":"Found";?></td>
                    <td><?php echo $items->username;?></td>
                    <td><img src=<?php echo"uploads/".$items->imagename;?> alt="" style="width:100px; height:auto;"></td>
                    </tr>
					<?php
				}
			?>
        </table>

        <table class="table table-bordered table-striped">
			<tr>
                <th>Item Name</th>
                <th>Lost or Found</th>
                <th>User</th>
                <th>Image</th>
                <th>Comments</th>
			</tr>
        <?php
        if(!$keyword)
				{
					$q = "SELECT * FROM comments
                             INNER JOIN items ON items.username = comments.comment_user ";
				}
				else
				{
					$q = "SELECT * FROM comments
                             JOIN items ON comments.comment_user = items.username
                                WHERE items.itemid LIKE '%".$keyword."%' 
                                        OR items.itemdescription LIKE '%".$keyword."%' 
                                        OR items.item_name LIKE '%".$keyword."%'
                                        OR items.imagename LIKE '%".$keyword."%'
                                        OR items.lostorfound LIKE '%".$keyword."%'
                                        OR comments.comment LIKE '%".$keyword."%' 
                                        OR comments.comment_user LIKE '%".$keyword."%'
                                        OR comments.comment_image LIKE '%".$keyword."%'";
                   /* $q = "SELECT * FROM comments WHERE id LIKE '%".$keyword."%'
                                OR comment LIKE '%".$keyword."%'
                                OR comment_user LIKE '%".$keyword."%'
                                OR comment_image LIKE '%".$keyword."%'
                            UNION SELECT * FROM i "*/
                    
				}
				$result = mysqli_query($link,$q);
				while($items = mysqli_fetch_object($result))
				{
                    
                    if($items->imagename == $items->comment_image){
                        ?>
					<tr>
                    <td><?php echo $items->item_name ?></td>
                    <td><?php echo ($items->lostorfound == 1)? "Lost":"Found";?></td>
                    <td><?php echo $items->username;?></td>
                    <td><img src=<?php echo"uploads/".$items->imagename;?> alt="" style="width:100px; height:auto;"></td>
                    <td><?php echo $items->comment;?></td>
                    </tr>
                    <?php
                    }
				}
			?>
        </table>
        <label><b> Your comment here:</b> </label>
        <br>
        <input class = "itemid_comment form-control" type="text "placeholder="Item Id">   
        <br>
        <textarea class = "commenttext form-control" name = "commenttext"></textarea>
        <a href="javascript:void(0)" class="btn btn-primary submitcomment">Submit</a>

	</div>
</body>
</html>
<script>
            $(function(){
            $('.submitcomment').click(function(){
                var itemid = $('.itemid_comment').val();
                var username = "<?php echo $_SESSION['username'];?>";
                var comment = $('.commenttext').val();
                $.ajax({
                    url:'submit_comment.php',
                    data:'comment='+comment+'&username='+username+'&itemid='+itemid,
                    type:'post',
                    success:function()
                    {
                        alert("Your comment has been posted");
                        listComments();
                    }
                })
            })
        })
        </script>