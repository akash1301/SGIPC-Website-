
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
            <h1 style="text-align: center;margin-top:15px;font-size:50px;">Recent Submissions</h1>
            <div style="background-color:#00cccc; width:800px;/*height:10px;*/margin-left:35px;border-radius: 5px;margin-top:40px;">
                <?php
                    
                    $sql="DELETE FROM submission_table";
                    mysql_query($sql);

                    $sql="SELECT * FROM codeforces_id";
                    $result=mysql_query($sql);
                    while($row=mysql_fetch_array($result))
                    {
                        $user=$row['user_name'];
                        $user_id=$row['user_name'];
                        $cf_id=$row['cf_id'];
                        // $url="http://codeforces.com/api/user.status?handle=".$row['cf_id']."&from=1&count=1";
                        $localJSONCache = "json_cache/".$user."submission_cf.json.cache";

                                $lfm = null;
                                if (file_exists($localJSONCache)) {
                                    if (time() - filemtime($localJSONCache) < 2*24*60*60) {
                                        $lfm = file_get_contents($localJSONCache);
                                    }
                                }
                                if (empty($lfm)) {
                                    $lfm = file_get_contents("http://codeforces.com/api/user.status?handle=".$row['cf_id']."&from=1&count=3");
                                        file_put_contents($localJSONCache, $lfm);
                                }

                                // $url="http://codeforces.com/api/user.info?handles=".$row['cf_id']."";
                                // $get_data=file_get_contents($url);
                                // $lfm=($lfm);
                                $data=json_decode($lfm,true);
                        // $get_data=file_get_contents($url);
                        // $data=json_decode($get_data,true);
                        $val= $data['result'];
                        $size=count($val);
                        for($i=0;$i<$size;$i++)
                        {
                            $time=$val[$i]['creationTimeSeconds'];
                            $lang=$val[$i]['programmingLanguage'];
                            $verdict="-";
                            if(isset($val[$i]['verdict']))
                                $verdict=$val[$i]['verdict'];
                            if($verdict=="CHALLENGED")
                                $verdict="Hacked";
                            if($verdict=="OK")
                                $verdict="Accepted";
                            if($verdict=="COMPILATION_ERROR")
                                $verdict="Compilation"."<br>"."Error";
                            if($verdict=="RUNTIME_ERROR")
                                $verdict="Runtime"."<br>"."Error";
                            if($verdict=="WRONG_ANSWER")
                                $verdict="Wrong"."<br>"."Answer";
                            if($verdict=="PRESENTATION_ERROR")
                                $verdict="Presentation"."<br>"."Error";
                            if($verdict=="TIME_LIMIT_EXCEEDED")
                                $verdict="Time Limit"."<br>"."Exceeded";
                            if($verdict=="MEMORY_LIMIT_EXCEEDED")
                                $verdict="Memory Limit"."<br>"."Exceeded";
                            if($verdict=="IDLENESS_LIMIT_EXCEEDED")
                                $verdict="Idleness Limit"."<br>"."Exceeded";
                            if($verdict=="SECURITY_VIOLATED")
                                $verdict="Security"."<br>"."Violated";
                            if($verdict=="INPUT PREPARATION CRASHED")
                                $verdict="Input Preparation"."<br>"."Crashed";
                            $problem=$val[$i]['problem']['name'];     // ai ta problem hosse
                            $contest_id=$val[$i]['problem']['contestId'];
                            $index=$val[$i]['problem']['index'];
                            $link="http://codeforces.com/problemset/problem/".$contest_id."/".$index."";
                            $sql2="INSERT INTO submission_table VALUES('','$user','$problem','$time','$lang','$verdict','$link')";
                            mysql_query($sql2);
                        }
                    }

                    $sql="SELECT * FROM uva_id";
                    $result=mysql_query($sql);
                    while($row=mysql_fetch_array($result))
                    {
                        $user=$row['user_name'];
                        $handle=$row['handle'];
                        // $url="http://uhunt.felix-halim.net/api/subs-user-last/".$handle."/1";
                        $localJSONCache = "json_cache/".$user."submission_uva.json.cache";

                                $lfm = null;
                                if (file_exists($localJSONCache)) {
                                    if (time() - filemtime($localJSONCache) < 2*24*60*60) {
                                        $lfm = file_get_contents($localJSONCache);
                                    }
                                }
                                if (empty($lfm)) {
                                    $lfm = file_get_contents("http://uhunt.felix-halim.net/api/subs-user-last/".$handle."/3");
                                        file_put_contents($localJSONCache, $lfm);
                                }

                                // $url="http://codeforces.com/api/user.info?handles=".$row['cf_id']."";
                                // $get_data=file_get_contents($url);
                                $data=json_decode($lfm,true);
                        // $get_data=file_get_contents($url);
                        // $data=json_decode($get_data,true);
                        $val=$data['subs'];
                        $size=count($val);
                        for($i=0;$i<$size;$i++)
                        {
                            $problem=$val[$i][1];
                            $ver=$val[$i][2];
                            $time=$val[$i][4];
                            $lang=$val[$i][5];
                            $language="";
                            if($lang==1)
                                $language="ANSI C";
                            else if($lang==2)
                                $language="Java";
                            else if($lang==3)
                                $language="GNU C++";
                            else if($lang==4)
                                $language="Pascal";
                            else
                                $language="GNU C++11";
                            $verdict="";
                            if($ver==10)
                                $verdict="Submission"."<br>"."Error";
                            else if($ver==15)
                                $verdict="Can't be"."<br>"."Judged";
                            else if($ver==20)
                                $verdict="In Queue";
                            else if($ver==30)
                                $verdict="Compilation"."<br>"."Error";
                            else if($ver==35)
                                $verdict="Restricted"."<br>"."Function";
                            else if($ver==40)
                                $verdict="Runtime"."<br>"."Error";
                            else if($ver==45)
                                $verdict="Output Limit"."<br>"."Exceeded";
                            else if($ver==50)
                                $verdict="Time Limit"."<br>"."Exceeded";
                            else if($ver==60)
                                $verdict="Memory Limit"."<br>"."Exceeded";
                            else if($ver==70)
                                $verdict="Wrong"."<br>"."Answer";
                            else if($ver==80)
                                $verdict="Presentation"."<br>"."Error";
                            else
                                $verdict="Accepted";
                                // define("MAX_CACHE_LIFETIME2", 60*60*24*365); //1 year

                                $localJSONCache = "json_cache/uva_problem".$problem.".json.cache";

                                $lfm = null;
                                if (file_exists($localJSONCache)) {
                                    if (time() - filemtime($localJSONCache) < 60*60*24*365) {
                                        $lfm = file_get_contents($localJSONCache);
                                    }
                                }
                                if (empty($lfm)) {
                                    $lfm = file_get_contents("http://uhunt.felix-halim.net/api/p/id/".$problem."");
                                        file_put_contents($localJSONCache, $lfm);
                                }
                            // $url2="http://uhunt.felix-halim.net/api/p/id/".$problem."";
                            // $get_data2=file_get_contents($url2);
                            $data2=json_decode($lfm,true);
                            $pro=$data2['title'];
                            $link="https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&category=24&page=show_problem&problem=".$problem."";
                            $sql2="INSERT INTO submission_table VALUES('','$user','$pro','$time','$language','$verdict','$link')";
                            mysql_query($sql2);

                        }
                    }


                    echo '<table id="tab_contest" style="width:800px;margin-right:20px;color:#4d0000;font-size:15px;border-collapse:collapse;border-spacing:0px;margin-top:30px;">
                                <tr>
                                    <th style="text-align:center;border:none;padding:18px;font-size:20px;">Name</th>
                                    <th style="text-align:center;border:none;padding:18px;font-size:20px;">Submission time</th>
                                    <th style="text-align:center;border:none;padding:18px;font-size:20px;">Problem name</th>
                                    <th style="text-align:center;border:none;padding:18px;font-size:20px;">Language</th>
                                    <th style="text-align:center;border:none;padding:18px;font-size:20px;">Verdict</th>
                                </tr>';

                    $sql="SELECT * FROM submission_table ORDER BY time DESC";
                    $result=mysql_query($sql);
                    $cnt=0;
                    while($row=mysql_fetch_array($result))
                    {
                        if($cnt==20)
                            break;
                        else{
                        $epoch = $row['time'];
                        $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                        $time=$dt->format('Y-m-d H:i:s');
                        // $time=substr_replace($time, "<br>", 10);
                        $user=$row['user_name'];
                        $problem=$row['problem'];
                        $lang=$row['lang'];
                        $verdict=$row['verdict'];
                        $link=$row['link'];
                        echo '
                                <tr>
                                    <th style="text-align:center;border:none;padding:18px;"><a href="other_profile.php?action='.$user.'"style="color:#4d0000;font-size:15px">'.$user.'</a></th>
                                    <th style="text-align:center;border:none;padding:18px;">'.$time.'</th>
                                    <th style="text-align:center;border:none;padding:18px;"><a href="'.$link.'" style="color:#4d0000;font-size:15px">'.$problem.'</a></th>
                                    <th style="text-align:center;border:none;padding:18px;">'.$lang.'</th>
                                    <th style="text-align:center;border:none;padding:18px;">'.$verdict.'</th>
                                </tr>';
                        $cnt++;
                        }
                    }
                    echo '</table>';
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