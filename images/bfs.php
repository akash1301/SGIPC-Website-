<!DOCTYPE html >


<?php
include "main_page.php";

?>

<?php
include 'connect.php';
if(isset($_POST['com_submit']))
{
	$user=$_SESSION['name'];
	$comment=$_POST['comm'];
	$sql="INSERT INTO comment VALUES('','$user','$comment')";
	if(mysql_query($sql))
	{
		header('location:bfs.php');
	}
}


?>


<html>
	<head>
		<title>
			ব্রেথড ফার্স্ট সার্চ (বিএফএস)
		</title>
		<script type="text/javascript" src="jquery00.js"></script>
	<script type="text/javascript" src="ticker00.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#slide').list_ticker({
			speed:6000,
			effect:'slide'
		});		
	})
	</script>
	</head>	
	<body>


		<div id="body_des_bfs">
			<br>
			<h1 style="margin-left:20px;color:#003300;"><?php  $xml=simplexml_load_file("show_tag.xml"); echo $xml->algo[0]->name; ?> </h1>
			<p><?php $xml=simplexml_load_file("show_tag.xml");  echo $xml->algo[0]->tag->val.": ".$xml->algo[0]->tag->tag_name[0].", ".$xml->algo[0]->tag->tag_name[1]  ?></p>
			<br>
			<p>বিএফএস এর কাজ হলো গ্রাফে একটা নোড থেকে আরেকটা নোডে যাবার শর্টেস্ট পাথ বের করা। বিএফএস কাজ করবে শুধুমাত্র আন-ওয়েটেড গ্রাফের ক্ষেত্রে, তারমানে সবগুলো এজের কস্ট হবে ১। বিএফএস অ্যালগোরিদমটা কাজ করে নিচের ধারণারগুলোর উপর ভিত্তি করে:</p>
			<div>
				<pre style="margin-left:20px; background:#CCCC66;margin-right:20px;">১. কোনো নোডে ১ বারের বেশি যাওয়া যাবেনা
২. সোর্স নোড অর্থাৎ যে নোড থেকে শুরু করছি সেটা ০ নম্বর লেভেলে অবস্থিত।
৩. সোর্স বা ‘লেভেল ০’ নোড থেকে সরাসরি যেসব নোডে যাওয়া যায় তারা সবাই ‘লেভেল ১’ নোড।
৪. ‘লেভেল ১’ নোডগুলো থেকে সরাসরি যেসব নোডে যাওয়া যায় তারা সবাই ‘লেভেল ২’ নোড। এভাবে 
লেভেল এক এক করে বাড়তে থাকবে।
৫. যে নোড যত নম্বর লেভেলে,সোর্স থেকে তার শর্টেস্ট পথের দৈর্ঘ্য তত।</pre>
			</div>

			<p>উপরে লেখাগুলো পুরোপুরি না বুঝলে আমরা একটা উদাহরণ দেখে বাকিটা পরিস্কার করব।</p>

			<div align="center">
				<img src="bfs1.png">
			</div>

			<p>ধর তুমি ১ নম্বর শহর থেকে ১০ নম্বর শহরে যেতে চাও। প্রথমে আমরা সোর্স ধরলাম ১ নম্বর নোডকে। ১ তাহলে একটা ‘লেভেল ০’ নোড। ১ কে ভিজিটেড চিহ্নিত করি।</p>
			<p>১ থেকে সরাসরি যাওয়া যায় ২,৩,৪ নম্বর নোডে। তাহলে ২,৩,৪ হলো ‘লেভেল ১’ নোড। এবার সেগুলোকে আমরা ভিজিটেড চিহ্নিত করি এবং সেগুলো নিয়ে কাজ করি। নিচের ছবি দেখ:</p>

			<div align="center">
				<img src="bfs2.png" width="296" height="300">
			</div>
			<p>লাল নোডগুলো নিয়ে আমরা এখন কাজ করবো। রঙিন সবগুলো নোড ভিজিটেড, এক নোডে ২বার কখনো যাবোনা। ২,৩,৪ থেকে শর্টেস্ট পথে যাওয়া যায় ৬,৭,৮ এ। সেগুলো ভিজিটেড চিহ্নিত করি:</p>
			<div align="center">
				<img src="bfs3.png" width="296" height="300">
			</div>

			<p>লক্ষ কর যে নোডকে যত নম্বর লেভেলে পাচ্ছি,সোর্স থেকে তার শর্টেস্ট পথের দৈর্ঘ্য ঠিক তত। যেমন ২নম্বর লেভেলে ৮কে পেয়েছি তাই ৮ এর দুরত্ব ২। ছবিগুলোকে একেকটা লেভেলের একেক রং দেয়া হয়েছে। আর লাল নোড দিয়ে বুঝানো হয়েছে আমরা এখন ওগুলো নিয়ে কাজ করছি। আমরা ১০ এ পৌছাইনি তাই পরের নোডগুলো ভিজিট করে ফেলি:</p>
			<div align="center">
				<img src="bfs4.png" width="296" height="300">
			</div>

			<p>আমরা দেখতে পাচ্ছে ২টি লেভেল পার হয়ে ৩ নম্বর লেভেলে আমরা ১০ কে পাচ্ছি। তাহলে ১০ এর শর্টেস্ট পথ ৩। লেভেল বাই লেভেল গ্রাফটাকে সার্চ করে আমরা শর্টেস্ট পথ বের করলাম। যেসব এজ গুলো আমরা ব্যবহার করিনি সেগুলোকে বাদ দিয়ে ছবিটিকে নিচের মত করে আকতে পারি:</p>
			<div align="center">
				<img src="bfs5.png" width="296" height="300">
			</div>
			<p>যেসব এজ ব্যবহার করিনি সেগুলো হালকা করে দিয়েছি,এই এজ গুলো বাদ দিলে গ্রাফটি একটি ট্রি হয়ে যায়। এই ট্রি টাকে বলা হয় বিএফএস ট্রি।</p>
			<p>তারমানে আমাদের কাজ গুলো সোর্স থেকে লেভেল ১ নোডগুলোতে যাওয়া, তারপর লেভেল ১ এর নোডগুলো থেকে লেভেল ২ নোডগুলো খুজে বের করা, এভাবে যতক্ষন না গন্তব্যে পৌছে যাচ্ছি অথবা সব নোড ভিজিট করা শেষ হয়ে গিয়েছে ততক্ষণ কাজ চলতে থাকবে।</p>
			<p>কিউ ডাটা স্ট্রাকচারটার সাথে আশা করি সবাই পরিচিত। কিউ হলো হুবুহু বাসের লাইনের মতো ডাটা স্ট্রাকচার। যখন একটা সংখ্যা কিউতে যোগ করা হয় তখন সেটা আগের সবগুলো সংখ্যার পিছে গিয়ে দাড়ায়, যখন কোন একটা সংখ্যা বের করে ফেলা হয় তখন সবার প্রথমের সংখ্যাটা নেয়া হয়। একে বলা ফার্স্ট ইন ফার্স্ট আউট। আমরা বিএফএস এ কিউ কাজে লাগাতে পারি। লেভেল ১ থেকে যখন কয়েকটা নতুন লেভেল ২ নোড পাবো সেগুলোকে কিউতে বা লাইনে অপেক্ষা করিয়ে রাখবো, আর সবসময় প্রথম নোডটা নিয়ে কাজ করবো। তাহলে বড় লেভেলের নোডগুলো সবসময় পিছের দিকে থাকবে, আমরা ছোট লেভেলগুলো নিয়ে কাজ করতে করতে আগাবো। উপরের গ্রাফের জন্য এটা আমরা সিমুলেট করে দেখি:</p>
			<p>প্রথমে কিউতে সোর্স পুশ করবো:</p>
			<p style="background:#CCCC66">কিউ: [১]</p>
			<p>১ এর লেভেল হবে ০ বা লেভেল[১]=০। এবার বিএফএস শুরু করবো। প্রথমে কিউ এর সবার সামনের নোডটাকে নিয়ে কাজ করবো। সবার সামনে আছে ১, সেখান থেকে যাওয়া যায় ২,৩,৪ এ। ২,৩,৪ এ এসেছি ১ থেকে, তাহলে লেভেল[২]=লেভেল[১]+১=১, লেভেল[৩]=লেভেল[১]+১=১, লেভেল[৪]=লেভেল[৩]+১=১। এদেরকে কিউতে পুশ করে রাখি:</p>
			<p style="background:#CCCC66">কিউ: [২,৩,৪,১]</p>
			<p>১ আর কোন কাজে আসবেনা, ১ কে পপ করি বা ফেলে দেই।</p>
			<p style="background:#CCCC66">কিউ: [২,৩,৪]</p>
			<p>এবার ৪ নিয়ে কাজ করি। ৪ থেকে যাওয়া যায় ৭ এ। ৭ এ এসেছি ৪ থেকে, লেভেল[৭]=লেভেল[৪]+১=২। ৭ কে কিউতে পুশ করি:</p>
			<p style="background:#CCCC66">কিউ: [৭,২,৩,৪]</p>
			<p>এখন ৪ কে পপ করি:</p>
			<p style="background:#CCCC66">কিউ: [৭,২,৩]</p>
			<p>৩ থেকে ৭,৮ এ যাওয়া যায়। ৭ কে এরই মধ্যে নিয়েছি, শুধু ৮ পুশ করতে হবে। লেভেল[৮]=লেভেল[৩]+১=২।</p>
			<p style="background:#CCCC66">কিউ: [৮,৭,২,৩]</p>
			<p>৩ পপ করি:</p>
			<p style="background:#CCCC66">কিউ: [৮,৭,২]</p>
			<p>এভাবে যতক্ষণনা কিউ খালি হচ্ছে ততক্ষণ কাজ চলতে থাকবে। লেভেল[] অ্যারের মধ্যে আমরা পেয়ে যাবো সোর্স থেকে সবগুলো নোডের দূরত্ব!</p>
			<p>সুডোকোড:</p>
			<div style="margin-left:20px; margin-right=20px;">
				<textarea readonly  rows="15" cols="100" type="text">1  procedure BFS(G,source):
2      Q=queue(), distance[]=infinity
3      Q.enqueue(source)
4      distance[source]=0
5      while Q is not empty
6         u ← Q.pop()
7         for all edges from u to v in G.adjacentEdges(v) do
8             if distance[v] = infinity:
9                       distance[u]=distance[v]+1;
10                     Q.enqueue(v)
11            end if
12        end for
13       end while
14.   Return distance;
				</textarea>
			</div>
			<p>ঠিক যেভাবে সিমুলেট করেছি সেভাবেই কোডটা লিখেছি, আশা করি বুঝতে সমস্যা হচ্ছেনা।</p>
			<p>শুধু পাথের দৈর্ঘ্য যথেষ্ট না, পাথটাও দরকার হতে পারে। লক্ষ্য করো আমরা u থেকে v তে যাবার সময় parent[v]=u করে দিচ্ছি। আমরা প্রতিটা নোডের জন্য জানি কোন নোড থেকে সেই নোডে এসেছি। তাহলে আমরা যে নোডের জন্য পাথ বের করতে চাই সেই নোড থেকে তার প্যারেন্ট নোডে যেতে থাকবো যতক্ষণনা সোর্সে পৌছে যাই। খুবই সহজ কাজ, পাথ বের করার কোড করা তোমার উপর ছেড়ে দিলাম।</p>
			<br>

			<div style="margin-left:20px; margin-right:20px">
			<form action="bfs.php" method="POST">
				<table cellspacing="5" cellpadding="5">
					<tr>
						<td><a href="#"><p style="margin-left:0px; margin-right:0px;" ><?php echo $_SESSION['name']; ?></p></a> </td>
						<td><textarea name="comm" rows="7" cols="50" placeholder="Add comment here..."></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td><input name="com_submit" value="Post" type="submit" style="margin-left:330px"></td>
					</tr>
				</table>
			</form>
			</div>
			<p>
			<?php

			$getquery=mysql_query("SELECT * FROM comment ORDER BY id ASC");
			while($row=mysql_fetch_array($getquery))
			{
				$username=$row['name'];
				$comm=$row['comment'];
				echo "<p style=\"color:#3300CC;\">".$username.":</p><p>".$comm."<br/></p>"."<hr width=850px/>"."<br/>";

			}


			?>
			</p>



			<br>

			<div id="main" align="center">
				<ul id="slide">
					<li>A real warrior never quits.</li>
					<li>তোমাকে তোমার কাজ দিয়ে নয়,বিচার করা হবে কাজের পেছনের নিয়ত দিয়ে- আল হাদিস। </li>
					<li>Your past does not define you,it is what you choose to be now.</li>
					<li>Journey of thousand miles begins with a single step.</li>
					<li>Dream on!!!</li>
				</ul>
			</div>
			<br>
		</div>


	</body>
	
</html>