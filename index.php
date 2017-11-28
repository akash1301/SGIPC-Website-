
<?php
include "main_page.php";

if(isset($_POST['com_submit']))
{
    $user=$_SESSION['name'];
    $comment=$_POST['comm'];
    $sql="INSERT INTO comment_table VALUES('','$user','$comment')";
    if(mysql_query($sql))
    {
        header('location:index.php');
    }
}

?>


<body>

<div id="tooplate_outer_wrapper">
	<div id="tooplate_wrapper">
    	<?php
            include "header_desc.php";

        ?>
    
        <div id="tooplate_middle">

            <div id="index_middle" style="margin-left:50px;font-size:20px;color:#4d0026">
                <h1 style="font-size:50px;">Welcome to SGIPC</h1><br>
                <p>By admin</p><br>
                <p>In the modern world technology is advancing fast. And computer programming has become</p><p> inevitable. To practice computer programming there are many online judge website such as,</p><p> codeforces.com uva.onlinejudge.org. The students of Khulna University of Engineering & </p><p> Technology are very interested in programming. The have a group for programming SGIPC</p><p> (Special Group for Interested in Programming Contest) and this website is used to measure</p><p> the performance of the students in those online judge site.</p><br>
                <p>Students have their own account in this website. They must have to verify their email</p><p> address to open the account. They can add their codeforces and UVa account in this</p><p> website. After adding their account they can see their their recent submissions and also</p><p> other’s submissions from those website. They have a point according to their performance</p><p> in those online judge. They can see the leaderboard which defines the point of the users.</p><p> They also can see the recent contest schedule here.  This website is for the welfare of the</p><p> students of Khulna University of Engineering & Technology. If you had any query then you</p><p> can ask and also if you have any suggestion for us to improve then you are welcome to give</p><p> us. Thank you. Happy Coding !!!</p>
            </div>
            <br><br>

            <div style="margin-left:50px; font-size:20px;color:#4d0026">
            <form action="index.php" method="POST">
                <table cellspacing="5" cellpadding="5">
                    <tr>
                        <td><a href="#" style="text-decoration: none;"><p style="margin-left:0px; margin-right:0px;font-size:20px;color:#4d0026" ><?php echo $_SESSION['name']; ?></p></a> </td>
                        <td><textarea name="comm" rows="7" cols="50" placeholder="Add comment here..."></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input name="com_submit" value="Post" type="submit" style="margin-left:330px"></td>
                    </tr>
                </table>
            </form>
            </div>
            <div style="width:700px;margin-left:50px">
            <?php

            $getquery=mysql_query("SELECT * FROM comment_table ORDER BY user_id ASC");
            while($row=mysql_fetch_array($getquery))
            {
                $username=$row['user_name'];
                $comm=$row['comment'];
                echo "<p style=\"font-size:20px;color:#4d0026;\">".$username.":</p><p style=\"font-size:18px;color:#4d0026;margin-left:50px;\">".$comm."<br/></p>"."<hr width=800px/>"."<br/>";

            }?>
            </div>


            
        </div> <!-- end of tooplate_middle -->
        
        <!-- <div id="tooplate_main">
        	
            
            
        </div> -->

        <!-- <div id="tooplate_main_bottom"></div> -->
    
    	<div id="tooplate_footer">
		
            
            
        </div>
    
    </div> <!-- end of tooplate_wrapper -->
</div> <!-- end of tooplate_outer_wrapper -->

</body>
</html>