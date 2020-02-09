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
.row {  
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
  .row {   
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
  <a href="/mylostandfoundproject/searchitems.php" class = "right" id= "search" type = "searchbox"> Search</a>
  <a href="/mylostandfoundproject/logout.php" class="middle" id="logout" type = "button">Logout</a> 
</div>
<div class="comment_list"></div>
<div class="row">
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
	<title>News Listing</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body>
	<div class="container">
		<?php
  //	$result = $obj->select('items',"(username = $_SESSION[username])");
  $result = mysqli_query($_link,"SELECT * FROM items WHERE (username = '$_SESSION[username]')");
    if(!is_bool($result))
    {
      if($obj->check_num($result)>0)
      {
        ?>
        <h1>Your Items </h1>
        <a href="success.php" class="btn btn-info">MOS E MBAJ PER VETE PO E GJETE</a>
        
        <hr>
        <table class="table table-bordered">
          <tr>
            <th>Item Id</th>
            <th>Item Name</th>
            <th>Item Description</th>
            <th>Lost or Found</th>
            <th>User</th>
            <th>Image</th>
          </tr>
          <?php
          while($row = $obj->fetch($result))
          {
            ?>
            <tr>
              <td><?php echo $row->itemid;?></td>
              <td><?php echo $row->item_name ?></td>
              <td><?php echo substr($row->itemdescription,0,50).'...';?></td>
              <td><?php echo ($row->lostorfound == 1) ? "Lost":"Found";?></td>
              <td><?php echo $row->username;?></td>
              <td><img src=<?php echo"uploads/".$row->imagename;?> alt="" style="width:100px; height:auto;"></td>
              <td><a href="edit_items_form.php?itemid=<?php echo $row->itemid;?>" class="btn btn-primary">Edit</a> <a href="delete_items.php?itemid=<?php echo $row->itemid;?>" class="btn btn-danger">Delete</a></td>
            </tr>
            <?php
          }
          ?>
        </table>
        <?php
      }
    }
    else
    {
      echo"<h4 align=middle>Ju nuk keni futur asnje send.</h4>";
    }
		?>
  </div>
  <div id ="form-submit"class="main"style="height:60px; visibility:show" >
    <h2>Add Lost/Found item </h2>
    <div class="wrapper">
        <p>Please fill in your information here</p>
        <form action="itemsubmit.php" method="POST" class = "form-control" style="height:60px"  enctype="multipart/form-data" >
            <div class="itemsform">
                <label>Check if Lost (Leave unchecked if Found )</label>
                <input type="radio" name="lostorfound" class="form-control" style="height:20px;" value="">
                <span class="help-block"></span>
                <br>
                <br>
                
                <label>Item Name</label>
                <input type="text" name="itemname" class="form-control"  value="">
                <span class="help-block"></span>
                
                <br>
                <br>   
                <label>Date Found/Lost</label>
                <input type="date" name="date"  class="form-control">
                <span class="help-block"></span>
                <br>
                <br>

                <label>Upload Photo of Item</label>
                <input type="file" name="file" class= "form-control">
                <span class="help-block"></span>
                <br>
                <br>

                <label>Description</label>
                <textarea maxlength="200" name="description" style="resize:none;height:100px;width:500px"></textarea>
                <br>
                <br>

            <div class="form-group">
                <input type="submit"name="itemsubmit"class="btn btn-primary" value="Submit">
            </div>
            <div class="container">
    <p>&nbsp;</p>
            </div>           
        </form>
    </div>
 </div>
</body>
</html>
