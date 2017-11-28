
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
            <h1 style="text-align: center;margin-top:15px;font-size:50px;">Upcoming Contests</h1>
            <div style="background-color:#00cccc; width:800px;/*height:10px;*/margin-left:35px;border-radius: 5px;margin-top:40px;">
                <?php
                    $sql="DELETE FROM contest_table";
                    mysql_query($sql);

                    define("MAX_CACHE_LIFETIME", 2*24*60*60); //1 hour

                    $localJSONCache = "json_cache/audioscrobbler1.json.cache";

                    $lfm = null;
                    if (file_exists($localJSONCache)) {
                        if (time() - filemtime($localJSONCache) < MAX_CACHE_LIFETIME) {
                            $lfm = file_get_contents($localJSONCache);
                        }
                    }
                    if (empty($lfm)) {
                        $lfm = file_get_contents('http://codeforces.com/api/contest.list?gym=false');
                        file_put_contents($localJSONCache, $lfm);
                    }

                     // $url="http://codeforces.com/api/contest.list?gym=false";
                     // $get_data=file_get_contents($url);
                     $data=json_decode($lfm,true);
                     $val= $data['result'];
                     $size=count($val);
                     for($i=0;$i<$size;$i++)
                     {
                        $contest=$val[$i]['name'];
                        $contest_id=$val[$i]['id'];
                        $duration=0;
                        if(isset($val[$i]['durationSeconds']))
                            $duration=$val[$i]['durationSeconds'];
                        $start=0;
                        if(isset($val[$i]['startTimeSeconds']))
                            $start=$val[$i]['startTimeSeconds'];
                        $phase=$val[$i]['phase'];
                        $link="http://codeforces.com/contests/".$contest_id;
                        if($phase=="FINISHED")
                            break;
                        else
                        {
                            $sql="INSERT INTO contest_table VALUES('','$contest_id','$contest','$start','$duration','$link')";
                            mysql_query($sql);
                        }

                     }


                    // define("MAX_CACHE_LIFETIME", 60*60); //1 hour

                    $localJSONCache = "json_cache/audioscrobbler2.json.cache";

                    $lfm = null;
                    if (file_exists($localJSONCache)) {
                        if (time() - filemtime($localJSONCache) < MAX_CACHE_LIFETIME) {
                            $lfm = file_get_contents($localJSONCache);
                        }
                    }
                    if (empty($lfm)) {
                        $lfm = file_get_contents('http://codeforces.com/api/contest.list?gym=true');
                        file_put_contents($localJSONCache, $lfm);
                    }


                     // $url="http://codeforces.com/api/contest.list?gym=true";
                     // $get_data=file_get_contents($url);
                     $data=json_decode($lfm,true);
                     $val= $data['result'];
                     $size=count($val);
                     for($i=0;$i<$size;$i++)
                     {
                        $contest=$val[$i]['name'];
                        $contest_id=$val[$i]['id'];
                        $duration=0;
                        if(isset($val[$i]['durationSeconds']))
                            $duration=$val[$i]['durationSeconds'];
                        $start=0;
                        if(isset($val[$i]['startTimeSeconds']))
                            $start=$val[$i]['startTimeSeconds'];
                        $phase=$val[$i]['phase'];
                        $link="http://codeforces.com/gym/".$contest_id;
                        if($phase=="FINISHED")
                            break;
                        else
                        {
                            $sql="INSERT INTO contest_table VALUES('','$contest_id','$contest','$start','$duration','$link')";
                            mysql_query($sql);
                        }

                     }


                    $result=mysql_query("SELECT * FROM contest_table");
                    $rows=mysql_num_rows($result);
                    if($rows!=0){
                        
                        echo '<table id="tab_contest" style="width:700px;margin-right:30px;color:#4d0000;font-size:20px;border-collapse:collapse;border-spacing:0px;margin-top:30px;">
                                <tr>
                                    <th style="text-align:center;border:none;padding:18px;font-size:25px;">Contest</th>
                                    <th style="text-align:center;border:none;padding:18px;font-size:25px;">Start time</th>
                                    <th style="text-align:center;border:none;padding:18px;font-size:25px;">Duration</th>
                                </tr>';

                        $sql="SELECT * FROM contest_table ORDER BY start";
                        $result=mysql_query($sql);
                        while($row=mysql_fetch_array($result))
                        {
                            $contest_id=$row['contest_id'];
                            $contest=$row['contest'];
                            $start=$row['start'];
                            $duration=$row['duration'];
                            $link=$row['link'];
                            $st="-";
                            $dur="-";
                            if($start!=0)
                            {
                                $epoch = $start;
                                $dt = new DateTime("@$epoch");  // convert UNIX timestamp to PHP DateTime
                                $st=$dt->format('Y-m-d H:i:s');
                            }
                            if($duration!=0)
                            {
                                $duration=$duration/3600;
                                $dur=$duration.' Hr';
                            }
                            echo '<tr>
                                    <td style="text-align:center;border:none;padding:18px;"><a href="'.$link.'" style="font-size:17px;color:#4d0000;font-size:20px;">'.$contest.'</a></th>
                                    <td style="text-align:center;border:none;padding:18px;">'.$st.'</th>
                                    <td style="text-align:center;border:none;padding:18px;">'.$dur.'</th>
                                </tr>';
                        }
                        echo '</table>';


                    }
                    

                ?>

            </div>

            <div style="text-align: center;margin-top:110px;">
                <?php
                    $result=mysql_query("SELECT * FROM contest_table");
                    $rows=mysql_num_rows($result);
                    if($rows==0){
                        echo '<p style="font-size:25px;color:#804000">There is no contest to show</p>';
                    }
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