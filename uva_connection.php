
<?php
include "main_page.php";



if(isset($_POST['submit']))
{

    $user=$_SESSION['name'];
    $handle=$_POST['fname'];
    $sql="SELECT * FROM uva_id WHERE handle='$handle'";
    $result=mysql_query($sql);
    $val=0;
    while($row = mysql_fetch_array($result))
    {
        if(($row['handle']==$handle))
        {
            header("location:uva_connection.php?action=handle_exist");
            $val=1;
        }
    }

    if($val==0)
    {
        $_SESSION['handle']=$_POST['fname'];
        header("location:uva_connection.php?action=complete");
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
            <br><br><br><br><br><br>

            <?php

                if(isset($_GET['action']) && $_GET['action']=="complete")
                {
                    if(!isset($_SESSION['handle']))
                        header("location:profile.php");
                    else{
                    $code=rand(100,1000000000);
                    $handle=$_SESSION['handle'];
                    $user=$_SESSION['name'];
                    unset($_SESSION['handle']);
                    $sql="INSERT INTO uva_random VALUES('','$user','$handle','$code')";
                    if(mysql_query($sql))
                    {
                        echo "<p style='font-size:28px;margin-left:70px;color:#DDD'>Now change your UVa Name and User-name to this:".$code."</p>";
                    }
                    }
                    
                }
                else
                {
                    echo '<form name="fff" action="uva_connection.php" method="POST" style="text-align: center; color:#DDD; margin-left:70px">
    <table style="text-align:center; color:#DDD; font-size:28px" cellpadding="5" cellspacing="5"> 
        <tr>
            <td>Enter Your UVa Judge ID</td>
            <td><input style="border-radius: 5px; height: 25px; width: 200px;" name="fname" type="text" placeholder="Judge ID" ></td>
        </tr>
        <tr>
            <td></td>
            <td><input style="border-width:0px; background:#33bbff;  margin-right:130px; display:block; height:30px; width:80px;" name="submit" type="submit" value="Submit" onclick="return vall();"> </td>
        </tr>
    </table>
</form>';
                    if(isset($_GET['action']) && $_GET['action']=="handle_exist")
                    {
                        echo "<br><p style='font-size:20px;margin-left:290px;color:#804000'>This UVa ID is already exist.</p>";
                    }
                }

            ?>

            <!-- <form name="fff" method="POST" style="text-align: center; color:#DDD; margin-left:70px">
    <table style="text-align:center; color:#DDD; font-size:28px" cellpadding="5" cellspacing="5"> 
        <tr>
            <td>Enter Your Codeforces Handle</td>
            <td><input style="border-radius: 5px; height: 25px; width: 200px;" name="fname" type="text" placeholder="Handle" ></td>
        </tr>
        <tr>
            <td></td>
            <td><input style="border-width:0px; background:#33bbff;  margin-right:130px; display:block; height:30px; width:80px;" name="submit" type="submit" value="Submit" onclick="return vall();"> </td>
        </tr>
    </table>
</form> -->
    <br><br><br>

            
        </div> <!-- end of tooplate_middle -->
        
<!--         <div id="tooplate_main">
        	
            
            
        </div>

        <div id="tooplate_main_bottom"></div> -->
    
    	<div id="tooplate_footer">
		
            
            
        </div>
    
    </div> <!-- end of tooplate_wrapper -->
</div> <!-- end of tooplate_outer_wrapper -->

</body>
</html>