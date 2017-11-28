
<?php
include "main_page.php";

?>


<body>

<div id="tooplate_outer_wrapper">
    <div id="tooplate_wrapper">
        <?php
            include "header_desc.php";

        ?>
    
        <div id="tooplate_middle">
            <h1 style="text-align: center;margin-top:15px;font-size:50px;">Leaderboard</h1>
            <div style="background-color:#00cccc; width:800px;/*height:10px;*/margin-left:35px;border-radius: 5px;margin-top:40px;">
                <?php
                    $user=$_SESSION['name'];

                    $sql2="DELETE FROM point_table";
                    mysql_query($sql2);

                    $sql="SELECT user_name FROM login_info ";
                    $result=mysql_query($sql);
                    while($row=mysql_fetch_array($result))
                    {
                        $uu=$row['user_name'];
                        $sql2="SELECT * FROM cf_rating WHERE user_name='$uu'";
                        $result2=mysql_query($sql2);
                        $cf_rating=0;
                        while($row2 = mysql_fetch_array($result2))
                        {
                            if($row2['user_name']==$uu)
                            {
                                $cf_rating=$row2['rating'];
                                break;
                            }
                        }
                        $sql2="SELECT * FROM uva_solve WHERE user_name='$uu'";
                        $result2=mysql_query($sql2);
                        $uva_solve=0;
                        while($row2 = mysql_fetch_array($result2))
                        {
                            if($row2['user_name']==$uu)
                            {
                                $uva_solve=$row2['solve'];
                                break;
                            }
                        }

                        $last_time=0;
                        $sql2="SELECT * FROM last_time_solve WHERE user_name='$uu'";
                        $result2=mysql_query($sql2);
                        while($row2=mysql_fetch_array($result2))
                        {
                            if($row2['user_name']==$uu)
                            {
                                $last_time=$row2['time_'];
                                break;
                            }
                        }


                        $flag=0;
                        $cf_problem=0;
                        $cf_id="";

                        $sql2="SELECT * FROM codeforces_id WHERE user_name='$uu'";
                        $result2=mysql_query($sql2);
                        while($row2=mysql_fetch_array($result2))
                        {
                            if($row2['user_name']==$uu)
                            {
                                $cf_id=$row2['cf_id'];
                                $flag=1;
                                break;
                            }
                        }
                        $recent_action=0;
                        if($flag==1)
                        {
                            // define("MAX_CACHE_LIFETIME", 60*60); //1 hour

                                $localJSONCache = "json_cache/".$uu."_submission.json.cache";

                                $lfm = null;
                                if (file_exists($localJSONCache)) {
                                    if (time() - filemtime($localJSONCache) < 2*24*60*60) {
                                        $lfm = file_get_contents($localJSONCache);
                                    }
                                }
                                if (empty($lfm)) {
                                    $lfm = file_get_contents("http://codeforces.com/api/user.status?handle=".$cf_id."&from=1&count=5");
                                        file_put_contents($localJSONCache, $lfm);
                                }

                                // $url="http://codeforces.com/api/user.info?handles=".$row['cf_id']."";
                                // $get_data=file_get_contents($url);
                                $data=json_decode($lfm,true);
                                $val= $data['result'];
                                $size=count($val);
                                $next_time=2147483647;
                                $last_submit=0;
                                for($i=0;$i<$size;$i++)
                                {
                                    if($i==0)
                                        $last_submit=$val[$i]['creationTimeSeconds'];
                                    $create_time=$val[$i]['creationTimeSeconds'];
                                    $verdict=$val[$i]['verdict'];
                                    if($create_time<=$last_time && $verdict=="OK")
                                    {
                                        $problem_type=$val[$i]['problem']['index'];;
                                        $cf_problem+=($problem_type - 'A')+1;
                                        if($create_time<$next_time)
                                            $next_time=$create_time;
                                    }
                                }
                                $sql2="DELETE FROM last_time_solve WHERE user_name='$uu'";
                                $sql3="INSERT INTO last_time_solve VALUES('','$uu','$next_time')";
                                mysql_query($sql2);
                                mysql_query($sql3);
                                $last_submit=time()-$last_submit;
                                $tmp=60*60*24*5;
                                $recent_action=$last_submit/$tmp;
                        }

                        $sqll="SELECT * FROM point_rule";
                        $resullt=mysql_query($sqll);
                        while($roww=mysql_fetch_array($resullt))
                        {
                            $cf_rat=$roww['cf_rating'];
                            $cf_s=$roww['cf_solve'];
                            $uva_s=$roww['uva_solve'];
                        }

                        $point=($cf_rating*$cf_rat) + ($uva_solve*$uva_s) + ($cf_problem*$cf_s) - ($recent_action*5);
                        if($point>0){
                        $sql2="INSERT INTO point_table VALUES('','$uu','$point')";
                        mysql_query($sql2);
                        }
                    }

                        echo '<table id="tab_contest" style="width:800px;margin-right:20px;color:#4d0000;font-size:20px;border-collapse:collapse;border-spacing:0px;margin-top:30px;">
                                <tr>
                                    <th style="text-align:center;border:none;padding:18px;font-size:25px;">Rank</th>
                                    <th style="text-align:center;border:none;padding:18px;font-size:25px;">Handle</th>
                                    <th style="text-align:center;border:none;padding:18px;font-size:25px;">Point</th>
                                </tr>';

                    $sql="SELECT * FROM point_table ORDER BY point DESC";
                    $result=mysql_query($sql);
                    $cnt=1;
                    while($row=mysql_fetch_array($result))
                    {
                        echo '
                                <tr>
                                    <td style="text-align:center;border:none;padding:18px;">'.$cnt.'</td>
                                    <td style="text-align:center;border:none;padding:18px;"><a href="other_profile.php?action='.$row['user_name'].'"style="color:#4d0000;font-size:20px">'.$row['user_name'].'</a></td>
                                    <td style="text-align:center;border:none;padding:18px;">'.$row['point'].'</td>
                                </tr>';
                        $cnt++;
                    }
                    echo '</table>'


                ?>

            </div>

            <div style="text-align: center;margin-top:110px;">
                <?php
                    
                ?>
            </div>

            
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