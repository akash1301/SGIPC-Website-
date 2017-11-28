
<?php
include "main_page.php";

$user=$_SESSION['name'];


if(isset($_POST['submit']))
{
    $target="images/".basename($_FILES['image']['name']); //the path to store the uploaded image

    $image=$_FILES['image']['name'];
    $sql="UPDATE login_info SET image='$image' WHERE user_name='$user'";
    mysql_query($sql);
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
    {
        header('location:profile.php');
    }

}

if(isset($_POST['rule_submit']))
{
    // $cf_rating=0;
    // $cf_prob=0;
    // $uva_prob=0;
    $sql="SELECT * FROM point_rule";
    $result=mysql_query($sql);
    while($row=mysql_fetch_array($result))
    {
        $cf_rating=$row['cf_rating'];
        $cf_prob=$row['cf_solve'];
        $uva_prob=$row['uva_solve'];
        break;
    }
    if($_POST['cf_rating']>0)
        $cf_rating=$_POST['cf_rating'];
    if($_POST['cf_prob']>0)
        $cf_prob=$_POST['cf_prob'];
    if($_POST['uva_prob']>0)
        $uva_prob=$_POST['uva_prob'];
    $sql="UPDATE point_rule SET cf_rating='$cf_rating',cf_solve='$cf_prob',uva_solve='$uva_prob'";
    if(mysql_query($sql))
        header("location:profile.php");
}

// if(isset($_POST['button1']))
// {
//     header("location:cf_connection.php");
// }

// if(isset($_POST['button2']))
// {
//     header("location:uva_connection.php");
// }


$xx=0;
if(isset($_GET['action']) && $_GET['action']=="cf_exist")
{
    //nothing;
}

else{

$temp_flag=0;

$sql="SELECT * FROM codeforces_id WHERE user_name='$user'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
    if($row['user_name']==$user)
    {
        $temp_flag=1;
        // header("location:profile.php?action=cf_exist");
    }
}


$temp_flag2=0;

$sql="SELECT * FROM uva_id WHERE user_name='$user'";
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
    if($row['user_name']==$user)
    {
        $temp_flag2=1;
    }
}


if($temp_flag==0){
$sql="SELECT * FROM cf_random WHERE user_name='$user'";
$flag=0;
$result=mysql_query($sql);
while($row = mysql_fetch_array($result))
{
    if($flag==1)
        break;
    // echo $row['user_name'];
    if($row['user_name']==$user)
    {
        // echo $row['user_name'];
        $handle=$row['handle'];
        $code='<div class="ttypography"><p>'.$row['code'].'</p></div>';
        $url="http://codeforces.com/api/blogEntry.comments?blogEntryId=49355";
        $get_data=file_get_contents($url);
        $data=json_decode($get_data,true);
        $val= $data['result'];
        $size=count($val);
        for($i=0;$i<$size;$i++)
        {
            $cm_handle=$val[$i]['commentatorHandle'];
            $text=$val[$i]['text'];
            if($handle==$cm_handle && $code==$text)
            {
                $sql2="INSERT INTO codeforces_id VALUES('','$user','$handle')";
                $sql3="DELETE FROM cf_random WHERE user_name='$user'";
                if(mysql_query($sql2) && mysql_query($sql3))
                {
                    // header("location:profile.php?action=cf_exist");
                    $flag=1;
                    break;
                }
            }
        }
    }
}
}


if($temp_flag2==0)
{
    $sql="SELECT * FROM uva_random WHERE user_name='$user'";
    $flag=0;
    $result=mysql_query($sql);
    while($row=mysql_fetch_array($result))
    {
        if($flag==1)
            break;
        if($row['user_name']==$user){
        $judge=$row['uid'];
        $handle=$row['handle'];
        include_once "simple_html_dom.php";
        require_once "class.html2text.inc";
        $html = file_get_html('https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&page=show_authorstats&userid='.$judge.'');
        $element=$html->find('div.contentheading');
        $val=$element[0]->outertext;
        $h2t =& new html2text($val);
        $text = $h2t->get_text();
        $handle2=$handle." (".$handle.")";
        $handle2=trim($handle2," ");
        $text=trim($text," ");
        if($text==$handle2)
        {
            $sql2="INSERT INTO uva_id VALUES('','$user','$judge')";
            $sql3="DELETE FROM uva_random WHERE user_name='$user'";
            if(mysql_query($sql2) && mysql_query($sql3))
            {
                $flag=1;
                break;
            }
        }
    }
    }
}

header("location:profile.php?action=cf_exist");
// if($flag==1)
// {
//     $sql2="INSERT INTO codeforces_id VALUES('','$user','$handle')";
//     $sql3="DELETE FROM cf_random WHERE user_name='$user'";
//     if(mysql_query($sql2) && mysql_query($sql3))
//     {
//             header("location:profile.php?action=cf_exist");
//             break;
//     }
// }


// if(isset($_POST['submit']) && $flag==0)
// {
//     $target="images/".basename($_FILES['image']['name']); //the path to store the uploaded image

//     $image=$_FILES['image']['name'];
//     $sql="UPDATE login_info SET image='$image' WHERE user_name='$user'";
//     mysql_query($sql);
//     if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
//     {
//         header('location:profile.php');
//     }

// }

// if(isset($_POST['button1']) && $flag==0)
// {
//     header("location:cf_connection.php");
// }

}

// header("location:profile.php");

?>

<?php
$user=$_SESSION['name'];
$cf_id="";
$ff=0;

$accepted=0;
$wa=0;
$tle=0;
$rte=0;
$compile=0;
$mle=0;
$pe=0;

$sql="SELECT * from codeforces_id WHERE user_name='$user'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
    if($row['user_name']==$user)
    {
        $cf_id=$row['cf_id'];
        $ff=1;
        break;
    }
}

if($ff==1){

 $localJSONCache = "json_cache/".$user."_cf_solve.json.cache";

$lfm = null;
$flag=0;
if (file_exists($localJSONCache)) {
   if (time() - filemtime($localJSONCache) < 2*24*60*60) {
         $lfm = file_get_contents($localJSONCache);
      }
 }
    if (empty($lfm)) {
        $lfm = file_get_contents('http://codeforces.com/api/user.status?handle='.$cf_id.'&from=1&count=10000');
        file_put_contents($localJSONCache, $lfm);
        $flag=1;
    }
    $data=json_decode($lfm,true);
    $val= $data['result'];
    $size=count($val);

// $url="http://codeforces.com/api/contest.list?gym=true";
// $get_data=file_get_contents($url);

if($flag==1){
    for($i=0;$i<$size;$i++)
    {
        if(isset($val[$i]['verdict'])){
            $verdict=$val[$i]['verdict'];
            if($verdict=="OK")
                $accepted++;
            if($verdict=="COMPILATION_ERROR")
                $compile++;
            if($verdict=="RUNTIME_ERROR")
                $rte++;
            if($verdict=="WRONG_ANSWER")
                $wa++;
            if($verdict=="PRESENTATION_ERROR")
                $pe++;
            if($verdict=="TIME_LIMIT_EXCEEDED")
                $tle++;
            if($verdict=="MEMORY_LIMIT_EXCEEDED")
                $mle++;
        }   
    }
    // $sql="DELETE FROM user_solve WHERE user_name='$user'";
    // $sql2="INSERT INTO user_solve VALUES('','$user','$accepted','$wa','$tle','$rte','$compile','$mle','$pe')";
    // if(mysql_query($sql) && mysql_query($sql2))
    // {
    //     //
    // }
}
else
{
    $sql="SELECT * FROM user_solve WHERE user_name='$user'";
    $result=mysql_query($sql);
    while($row=mysql_fetch_array($result))
    {
        if($row['user_name']==$user)
        {
            $accepted=$row['ac'];
            $wa=$row['wa'];
            $compile=$row['compile'];
            $rte=$row['rte'];
            $tle=$row['tle'];
            $mle=$row['mle'];
            $pe=$row['pe'];
            break;
        }
    }

}

}

// echo $accepted;

$accepted2=0;
$wa2=0;
$tle2=0;
$rte2=0;
$compile2=0;
$mle2=0;
$pe2=0;


$sql="SELECT * from uva_id WHERE user_name='$user'";
$result=mysql_query($sql);
$uva_id=0;
$ff=0;
while($row=mysql_fetch_array($result))
{
    if($row['user_name']==$user)
    {
        $uva_id=$row['handle'];
        $ff=1;
        break;
    }
}

if($ff==1){

 $localJSONCache = "json_cache/".$user."_uva_solve.json.cache";

$lfm = null;
$flag=0;
if (file_exists($localJSONCache)) {
   if (time() - filemtime($localJSONCache) < 2*24*60*60) {
         $lfm = file_get_contents($localJSONCache);
      }
 }
    if (empty($lfm)) {
        $lfm = file_get_contents("http://uhunt.felix-halim.net/api/subs-user/".$uva_id."");
        file_put_contents($localJSONCache, $lfm);
        $flag=1;
    }
    $data=json_decode($lfm,true);
    $val= $data['subs'];
    $size=count($val);

// $url="http://codeforces.com/api/contest.list?gym=true";
// $get_data=file_get_contents($url);

if($flag==1){
    for($i=0;$i<$size;$i++)
    {
        if(isset($val[$i][2])){
            $ver=$val[$i][2];
            if($ver==30)
                $compile2++;
            else if($ver==40)
                $rte2++;
            else if($ver==50)
                $tle2++;
            else if($ver==60)
                $mle2++;
            else if($ver==70)
                $wa2++;
            else if($ver==80)
                $pe2++;
            else if($ver==90)
                $accepted2++;
        }   
    }
    // $sql="DELETE FROM user_solve WHERE user_name='$user'";
    // $sql2="INSERT INTO user_solve VALUES('','$user','$accepted','$wa','$tle','$rte','$compile','$mle','$pe')";
    // if(mysql_query($sql) && mysql_query($sql2))
    // {
    //     //
    // }
}

else
{
    $sql="SELECT * FROM user_solve WHERE user_name='$user'";
    $result=mysql_query($sql);
    while($row=mysql_fetch_array($result))
    {
        if($row['user_name']==$user)
        {
            $accepted2=$row['accepted2'];
            $wa2=$row['wa2'];
            $compile2=$row['compile2'];
            $rte2=$row['rte2'];
            $tle2=$row['tle2'];
            $mle2=$row['mle2'];
            $pe2=$row['pe2'];
            break;
        }
    }

}

}



$sql="DELETE FROM user_solve WHERE user_name='$user'";
$sql2="INSERT INTO user_solve VALUES('','$user','$accepted','$wa','$tle','$rte','$compile','$mle','$pe','$accepted2','$wa2','$tle2','$rte2','$compile2','$mle2','$pe2')";
if(mysql_query($sql) && mysql_query($sql2))
{
    //
}


$sql="SELECT * FROM user_solve WHERE user_name='$user'";
$result=mysql_query($sql);
$check=0;
while($row=mysql_fetch_array($result))
{
    if($row['ac']+$row['accepted2']>0)
        $check=1;
    if($row['wa']+$row['wa2']>0)
        $check=1;
    if($row['tle']+$row['tle2']>0)
        $check=1;
    if($row['mle']+$row['mle2']>0)
        $check=1;
    if($row['compile']+$row['compile2']>0)
        $check=1;
    if($row['rte']+$row['rte2']>0)
        $check=1;
    if($row['pe']+$row['pe2']>0)
        $check=1;
}

$myurl[]="['Topic','Value']";
if($check==1){
$sql="SELECT * FROM user_solve WHERE user_name='$user'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
    if($row['user_name']==$user)
    {
        $aac=$row['ac']+$row['accepted2'];
        $wwa=$row['wa']+$row['wa2'];
        $ttle=$row['tle']+$row['tle2'];
        $mmle=$row['mle']+$row['mle2'];
        $ccc=$row['compile']+$row['compile2'];
        $rrte=$row['rte']+$row['rte2'];
        $ppe=$row['pe']+$row['pe2'];
        $myurl[]="['Accepted',".$aac."]";
        $myurl[]="['Wrong Answer',".$wwa."]";
        $myurl[]="['Time Limit Exceeded',".$ttle."]";
        $myurl[]="['Memory Limit Exceeded',".$mmle."]";
        $myurl[]="['Compilation Error',".$ccc."]";
        $myurl[]="['Runtime Error',".$rrte."]";
        $myurl[]="['Presentation Error',".$ppe."]";
        break;
    }
}
}

if($check==0)
{
    $myurl[]="['Nothing',100]";
}

?>


<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          <?php echo (implode(",",$myurl)) ?>
        ]);

        var options = {
          title: 'Solving Statistics',
          backgroundColor:'#00cccc',
          is3D:true
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>
  </head>


<body>

<div id="tooplate_outer_wrapper">
    <div id="tooplate_wrapper">
        <?php
            include "header_desc.php";

        ?>
    
        <div id="tooplate_middle">
            <div style="width:900px;">
                <div style="float:left;height:100px; width:300px;margin-left:50px;margin-top:20px;">
                    <h1 style="color:#4d0026"><?php echo $_SESSION['name'];?></h1>
                    <div style="margin-top:10px;font-size:15px">
                    <!-- <p style="color:#660033"> -->
                        <?php
                            $user=$_SESSION['name'];
                            $sql="SELECT * FROM login_info WHERE user_name='$user'";
                            while($row=mysql_fetch_array(mysql_query($sql)))
                            {
                                if($row['user_name']==$user)
                                {
                                    echo '<p style="color:#660033">'.$row['city'].','.$row['country'].'</p>';
                                    echo '<p style="color:#660033">Batch: '.$row['batch'].'</p>';
                                    break;
                                }
                            }
                        ?>
                    <!-- </p> -->
                    <br>
                    
                    <?php
                        $user=$_SESSION['name'];
                        $sql="SELECT * FROM point_table WHERE user_name='$user'";
                        $result=mysql_query($sql);
                        while($row=mysql_fetch_array($result))
                        {
                            if($row['user_name']==$user)
                            {
                                echo '<p style="color:#660033; font-size:20px">Points: '.$row['point'].'</p>';
                            }
                        }

                    ?>
                    </div>
                </div>
                <div style="float:left;height:100px; width:400px;margin-right:60px;margin-top:10px;">
                    <?php
                        $user=$_SESSION['name'];
                        $sql="SELECT user_name,image FROM login_info WHERE user_name='$user'";
                        $result=mysql_query($sql);
                        while($row=mysql_fetch_array($result))
                        {
                            if($row['user_name']==$user)
                            {
                                if($row['image']=="")
                                    echo '<img src="images/default_image.jpg" style="height:200px;width:230px;">';
                                else
                                    echo '<img src="images/'.$row['image'].'" style="height:200px;width:230px;">';
                            }
                        }
                    ?>
                    <form method="POST" action="profile.php" enctype="multipart/form-data">
                        <div style="margin-left:170px;float:left;width:133px;">
                        <input type="file" name="image">
                        </div>
                        <div style="margin-left:0px;float:left">
                        <input type="submit" value="Upload Image" name="submit">
                        </div>
                    </form>

                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <div style="width:900px;margin-top:200px;">
                <div style="float:left;margin-top:20px;margin-left:100px;/*border:1px solid black;*/width:270px;height:115px;background-color:#00cccc;border-radius:5px">
                    <div style="font-size:25px;color:#4d0026;margin-left:10px;margin-right:auto;margin-top:10px">
                        Codeforces
                    </div>
                    <p>_______________________________________</p>
                    <?php 
                        $val=$_SESSION['name'];
                        $sql="SELECT * FROM codeforces_id WHERE user_name='$val'";
                        $result=mysql_query($sql);
                        $flag=0;
                        while($row = mysql_fetch_array($result))
                        {
                            if($row['user_name']==$val)
                            {

                                define("MAX_CACHE_LIFETIME", 2*24*60*60); //1 hour

                                $localJSONCache = "json_cache/audioscrobblerprofile".$_SESSION['name'].".json.cache";

                                $lfm = null;
                                if (file_exists($localJSONCache)) {
                                    if (time() - filemtime($localJSONCache) < MAX_CACHE_LIFETIME) {
                                        $lfm = file_get_contents($localJSONCache);
                                    }
                                }
                                if (empty($lfm)) {
                                    $lfm = file_get_contents("http://codeforces.com/api/user.info?handles=".$row['cf_id']."");
                                        file_put_contents($localJSONCache, $lfm);
                                }

                                // $url="http://codeforces.com/api/user.info?handles=".$row['cf_id']."";
                                // $get_data=file_get_contents($url);
                                $data=json_decode($lfm,true);
                                $val= $data['result'];
                                $user=$_SESSION['name'];
                                $pp=$val[0]['rating'];
                                $sql="DELETE FROM cf_rating WHERE user_name='$user'";
                                $sql2="INSERT INTO cf_rating VALUES('','$user','$pp')";
                                mysql_query($sql);
                                mysql_query($sql2);
                                echo '<a href="http://codeforces.com/profile/'.$row['cf_id'].'" style="color:#4d0026; font-size:20px; text-decoration:none;margin-left:10px;">'.$row['cf_id'].'</a>';
                                echo '<p style="color:#4d0026; font-size:20px;margin-left:10px;margin-top:10px;">Rating:'.$val[0]['rating'].'</p>';
                                $flag=1;                                  
                                break;
                            }
                        }
                        if($flag==0)
                        {
                            echo '<form method="POST" action="cf_connection.php" >
                                    <button type="submit" name="button1"  class="id_button" style="vertical-align:middle;margin-left:70px;"><span>Connect </span></button>
                                    </form>';
                            // echo '<script>
                            //         var btn = document.getElementsByClassName("id_button");
                            //         btn.addEventListener("click", function() {
                            //             document.location.href = "google.com";
                            //         });
                            //         </script>';
                        }

                     ?>                    
                </div>


                <div style="float:left;margin-top:20px;margin-left:50px;/*border:1px solid black;*/width:270px;height:115px;background-color:#00cccc;border-radius:5px">
                    <div style="font-size:25px;color:#4d0026;margin-left:10px;margin-right:auto;margin-top:10px">
                        UVa Online Judge 
                    </div>
                    <p>_______________________________________</p>
                    <?php 
                        $val=$_SESSION['name'];
                        // define("MAX_CACHE_LIFETIME", 60*60); //1 hour

                        $sql="SELECT * FROM uva_id WHERE user_name='$val'";
                        $result=mysql_query($sql);
                        $flag=0;
                        while($row = mysql_fetch_array($result))
                        {
                            if($row['user_name']==$val)
                            {

                                $localJSONCache = "json_cache/problem_solve_".$_SESSION['name'].".json.cache";

                                $lfm = null;
                                if (file_exists($localJSONCache)) {
                                    if (time() - filemtime($localJSONCache) < 2*24*60*60) {
                                        $lfm = file_get_contents($localJSONCache);
                                    }
                                }
                                if (empty($lfm)) {
                                    $lfm = file_get_contents("http://uhunt.felix-halim.net/api/ranklist/".$row['handle']."/0/0");
                                        file_put_contents($localJSONCache, $lfm);
                                }

                                // $url="http://codeforces.com/api/user.info?handles=".$row['cf_id']."";
                                // $get_data=file_get_contents($url);
                                $data=json_decode($lfm,true);

                                $problem_solved=$data[0]['ac'];

                                $sql2="DELETE FROM uva_solve WHERE user_name='$val'";
                                $sql3="INSERT INTO uva_solve VALUES('','$val','$problem_solved')";
                                mysql_query($sql2);
                                mysql_query($sql3);

                                echo '<a href="https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&page=show_authorstats&userid='.$row['handle'].'" style="color:#4d0026; font-size:20px; text-decoration:none;margin-left:10px;">'.$row['handle'].'</a>';
                                echo '<p style="color:#4d0026; font-size:20px;margin-left:10px;margin-top:10px;">Problem Solved: '.$problem_solved.'</p>';
                                $flag=1;                                  
                                break;
                            }
                        }
                        if($flag==0)
                        {
                             echo '<form method="POST" action="uva_connection.php" >
                                    <button type="submit" name="button2"  class="id_button" style="vertical-align:middle;margin-left:70px;"><span>Connect </span></button>
                                    </form>';
                        }

                     ?>                    
                </div>

            </div>

            <br><br><br><br><br><br><br><br><br><br><br>

            <div style="width:500px;height:300px;background-color: #009999;margin-left:150px;" id="chart_div">

            </div>
            <br><br>

            <div style="margin-left:210px;font-size:20px;color:#4d0026">
                <?php
                    $user=$_SESSION['name'];
                    if($user=="admin")
                    {
                        echo '<form name="rule" method="POST" action="profile.php">
                                <table cellpadding="10" cellspacing="5">
                                    <tr>
                                        <td>Codeforces Rating Weight:</td>
                                        <td><input style="border-radius: 5px; height: 20px; width: 80px;"  name="cf_rating" type="number" placeholder="" ></td>
                                    </tr>
                                    <tr>
                                        <td>Codeforces Problem Weight:</td>
                                        <td><input style="border-radius: 5px; height: 20px; width: 80px;"  name="cf_prob" type="number" placeholder="" ></td>
                                    </tr>
                                    <tr>
                                        <td>UVa Problem Weight:</td>
                                        <td><input style="border-radius: 5px; height: 20px; width: 80px;"  name="uva_prob" type="number" placeholder="" ></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input style="border-width:0px;  display:block; height:30px; width:80px;" name="rule_submit" type="submit" value="Submit" "> </td>
                                    </tr>
                                </table>
                        </form>';
                    }

                ?>
            </div>

            
        </div> <!-- end of tooplate_middle -->
        
<!--         <div id="tooplate_main">
            
            
            
        </div> -->

<!--         <div id="tooplate_main_bottom"></div>
    
        <div id="tooplate_footer">
        
            
            
        </div> -->
    
    </div> <!-- end of tooplate_wrapper -->
</div> <!-- end of tooplate_outer_wrapper -->

</body>
</html>