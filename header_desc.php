

<div id="tooplate_header">
		      <div class="faka" ></div>
            <div class="site">SGIPC</div>
            
            <div id="tooplate_menu" class="ddsmoothmenu">
                <ul>
                    <li><a href="index.php" <?php  if(basename($_SERVER['PHP_SELF'])=="index.php") echo "class='selected'"; ?> ><span></span>Home</a></li>
                    <li><a href="contest.php"  <?php  if(basename($_SERVER['PHP_SELF'])=="contest.php") echo "class='selected'"; ?> ><span></span>Contests</a></li>
                    <li><a href="leaderboard.php"  <?php  if(basename($_SERVER['PHP_SELF'])=="leaderboard.php") echo "class='selected'"; ?>  ><span></span>Leaderboard</a></li>
                    <li><a href="submission.php"  <?php  if(basename($_SERVER['PHP_SELF'])=="submission.php") echo "class='selected'"; ?>  ><span></span>Submission</a></li>
                    <li><a href="profile.php"  <?php  if(basename($_SERVER['PHP_SELF'])=="profile.php") echo "class='selected'"; ?>  ><span></span>Profile</a>
                        <ul>
                            <li><a href="profile.php"><?php echo $_SESSION['name'];?></a></li>
                            <li><a href="index.php?action=logout">Log-out</a></li>
                        </ul>
                    </li>
                </ul>
				
                <br style="clear: left" />
            </div> <!-- end of tooplate_menu -->
			
            <div class="cleaner"></div>
        </div> <!-- end of forever header -->