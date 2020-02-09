<?php
include("config.php");

session_start();
if(isset($_SESSION['username'])){
    $result = mysqli_query($_link,"SELECT * FROM items WHERE(username = '$_SESSION[username]') ORDER BY itemid DESC LIMIT 3");

    if(mysqli_num_rows($result)>0)
    {
        while($row=mysqli_fetch_object($result))
        {
            $resultcomments = mysqli_query($_link,"SELECT comment,comment_user FROM comments WHERE (comment_image = '$row->imagename') ORDER BY id DESC");
            ?>
            <div style="border:1px solid black;"class= "side" style ="width:30%;height:auto">
            <div style="border:1px solid black;" class="col-md-7"style ="width:30%;height:auto"><img src="<?php echo "uploads/".$row->imagename?> " width="40%"height="auto"></div>
            <div style="border:1px solid black;"class="col-md-7"style ="width:30%;height:auto"><i><?php echo "Description:".$row->itemdescription;?></i></div>
            <div style="border:1px solid black;"class="clearfix"style ="width:30%;height:auto"> <?php echo "ItemId:".$row->itemid;?> </div>
            <?php
            while($rowcomments=mysqli_fetch_object($resultcomments))
            {
                ?> 
                <div style="border:1px solid black;"class="usercomment"> <?php echo "User:".$rowcomments->comment_user ?></div>
                <div style="border:1px solid black;"class="comment"> <?php echo "Comment:".$rowcomments->comment?> </div>
                <br>
        <?php } ?>
            <br>
            <?php
        }
        
    }

?>    
<label><b> Your comment here:</b> </label>
<br>
<input class = "itemid_comment form-control" type="text "placeholder="Item Id">   
<br>
<textarea class = "commenttext form-control" name = "commenttext"></textarea>
<a href="javascript:void(0)" class="btn btn-primary submitcomment">Submit</a>

<?php
}
?>
</div>

<style>
    .col-md-3{
    -ms-flex: 60%; /* IE10 */
    flex: 30%;
    background-color: #f1f1f1;
    padding: 20px;
    }
    .col-md-7{
    -ms-flex: 50%; /* IE10 */
    flex: 30%;
    background-color: #f1f1f1;
    padding: 20px;
    }
    .clearfix{
        -ms-flex: 50%; /* IE10 */
    flex: 30%;
    background-color: #f1f1f1;
    padding: 20px;
    } 
    
</style>
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