<!DOCTYPE html>
<html>
<head>
	<title>电影详情</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/base.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/dyxq.css">
	<script src="../js/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
	<script type="text/javascript" src="../js/pinx.js"></script>
</head>
<body>
    <header>
    	<div class="header-nav">
    		<ul class="nav">
    			<li><a href="">豆瓣</a></li>
    			<li><a href="">豆瓣</a></li>
    			<li><a href="">豆瓣</a></li>
    			<li><a href="">豆瓣</a></li>
    			<li><a href="">豆瓣</a></li>
    			<li><a href="">豆瓣</a></li>
    			<li><a href="">豆瓣</a></li>
    			<li><a href="">豆瓣</a></li>
    			<li><a href="">豆瓣</a></li>
    			<li><a href="">豆瓣</a></li>
    			<li><a href="">豆瓣</a></li>
    			<li><a href="">豆瓣</a></li>
    		</ul>
    		<ul class="login">
    			<li class="yi"><a href="">下载豆瓣客户端</a>
    				<div class="yingcang">
    					<p class="tu"><img src="../images/ds/dbapp.png"></p>
    					<p class="da">豆瓣</p>
    					<p class="xiao">我们的精神角落</p>
    					<p class="erweima"><img src="../images/daer.png"></p>
    					<p><a href="">iphone</a>.<a href="">android</a></p>
    				</div>
    			</li>
    			<?php session_start(); 
    			if(!isset($_SESSION['valid_user'])){
    				echo '<li><a href="../dengluzc/denlu.php">登录</a></li>
    					   <li><a href="../dengluzc/register.php">注册</a></li>';
    				}
    			else{
    				require("../conn.php");
    				$uid=$_SESSION['valid_user'];
    				$query="SELECT * FROM users WHERE userID = '$uid'";
    				$result = $conn->query($query);$row=$result->fetch_assoc();
    				$user=$row['userName'];echo '<li><a href="">'.$user.'</a></li>';
    			}
    			?>
    		</ul>
    	</div>
    	<div class="wrapper">
    		<div class="side"></div>
    		<div class="main">
    			<div class="logo">
    				<a href=""><img src="../images/ds/dbds.png"></a>
    			</div>
    			<form><input type="text" name="shusou" placeholder="书名、作者、ISBN"><input type="submit" name="shuti"></form>
    			<ul class="main-nav">
    				<li><a href="">购书单</a></li>
    				<li><a href="">电子图书</a></li>
    				<li><a href="">豆瓣书店</a></li>
    				<li><a href="">2016年度榜单</a></li>
    				<li><a href="">2016读书报告</a></li>
    				<li class="gwc"><img src="../images/ds/gwc.png" height="98px"><a href="">购物车</a></li>
    			</ul>
    		</div>
    	</div>
    </header>
    <main>
      <div class="wrapper">
        <div class="main">
            <div class="dybt"><h1>方法恢复</h1><span>(1995)</span></div>
            <div class="gydy">
            	<div class="tp"><a href=""><img src="../uploads/p2174346180.jpg" width="135px" style="margin-top:2px;"></a><br><span>更新描述或海报</span></div>
            	<div class="dbpf"><span>豆瓣评分</span></div>
            	<div class="dybj">
                	<ul><li><span class="p1">导演：<span>宫崎骏</span></span></li><li><span class="p1">编剧：<span>宫崎骏</span>/<span>吉田玲子</span></span></li><li><span class="p1">主演：<span>倍赏千惠子</span>/<span>木村拓哉</span>/<span>美轮明宏</span>/<span>我修院达也</span>/<span>神木隆之介</span><span class="gd"><a href="">更多</a></span></span></li><li><span class="p1">类型：<span>爱情</span>/<span>动画</span>/<span>奇幻</span>/<span>冒险</span></span></li><li><span class="p1">制片国家/地区：<span>日本</span></span></li><li><span class="p1">语言：<span>日语</span></span></li><li><span class="p1">上映日期：<span>1995-03-25</span></span></li><li><span class="p1">片长：<span>119分钟</span></span></li><li><span class="p1">又名：<span>呼啸山城</span></span></li>
                	</ul>
            	</div>
            </div>
            <div class="pinjia">
                <?php 
                    $url=$_SERVER['PHP_SELF'];
    				$mid=basename($url,".php");
                    if(isset($_SESSION['valid_user'])){
                    	$uid=$_SESSION['valid_user']; 
						$query="SELECT * FROM critis WHERE useID = '$uid' AND mvID='$mid'"; 
    					$result = $conn->query($query); 
    					if(!$result){
            				echo  '<button class="bt">想看</button><button class="bt">看过</button><button class="bt">在看</button>
            						<span class="wdpj">评价:</span>
            						<ul class="rate" id="fu">
              							<li id="one"><a href="" target="nm_iframe"><img src="../images/dyxq/huix.png" height="15px" width="15px;"></a></li><li id="two"><a href="" target="nm_iframe"><img src="../images/dyxq/huix.png" height="15px" width="15px"></a></li><li id="three"><a href="" target="nm_iframe"><img src="../images/dyxq/huix.png" height="15px" width="15px"></a></li><li id="four"><a href="" target="nm_iframe"><img src="../images/dyxq/huix.png" height="15px" width="15px"></a></li><li id="five"><a href="" target="nm_iframe"><img src="../images/dyxq/huix.png" height="15px" width="15px"></a></li>
 									</ul>
            						<span class="chengdu"></span>';
            			}
            			else{ 
            				require("../conn.php");  
    						$query="SELECT * FROM critis WHERE useID = '$uid' AND mvID='$mid'";
    						$result = $conn->query($query); 
    						if(!$result){echo $conn->error;exit;} 
    						$row=$result->fetch_assoc();
    						$xz=$row['rating']; 
    						$sj=$row['ctime']; 
    						$ytbq=$row['userlabel']; 
    						$brief=$row['content'];
    						echo  '<div class="kg">我看过这部电视剧
    									<span class="time">'.$sj.'</span>
    									<a class="xg" href="">修改</a>
    									<a class="sc" href=""><span>删除</span></a>
    								</div>
                    				<span class="wdpj">我的评价:</span>
                    				<div class="close xz">'.$xz.'</div>
                    				<ul class="rate" id="yi">
                        				<li id="one"><a href="../pl/xx.php?score=one"><img src="../images/dyxq/huix.png" height="15px" width="15px;"></a></li><li id="two"><a href="../pl/xx.php?score=two"><img src="../images/dyxq/huix.png" height="15px" width="15px"></a></li><li id="three"><a href="../pl/xx.php?score=three"><img src="../images/dyxq/huix.png" height="15px" width="15px"></a></li><li id="four"><a href="../pl/xx.php?score=four"><img src="../images/dyxq/huix.png" height="15px" width="15px"></a></li><li id="five"><a href="../pl/xx.php?score=five"><img src="../images/dyxq/huix.png" height="15px" width="15px"></a></li>
                    				</ul>
                    				<span class="chengdu"></span>
                    				<div class="ytbq">'.$ytbq.'</div>
                    				<div>'.$brief.'<div>';
                    		}
                    }
                    else{
                    	echo  '<button class="bt">想看</button><button class="bt">看过</button><button class="bt">在看</button>
    							<span class="wdpj">评价:</span>
    							<ul class="rate lj" id="fu">
    								<li id="one"><a href="../dengluzc/denlu.php"><img src="../images/dyxq/huix.png" height="15px" width="15px;"></a></li><li id="two"><a href="../dengluzc/denlu.php"><img src="../images/dyxq/huix.png" height="15px" width="15px"></a></li><li id="three"><a href="../dengluzc/denlu.php"><img src="../images/dyxq/huix.png" height="15px" width="15px"></a></li><li id="four"><a href="../dengluzc/denlu.php"><img src="../images/dyxq/huix.png" height="15px" width="15px"></a></li><li id="five"><a href="../dengluzc/denlu.php"><img src="../images/dyxq/huix.png" height="15px" width="15px"></a></li>
    							</ul>
    							<span class="chengdu"></span>';
    				}
    			?>
            </div>
            <div class="pinju close">
                <form class="px" method="post" action="../pl/pl.php">
            	<div class="head-kg"><p>添加收藏：我看过这部电视剧</p><span class="cha">x</span></div>
            	<div class="zhong">
            		<label><input type="radio" name="kan" value="want">想看</label>
            		<label><input type="radio" name="kan" value="ing" checked="">在看</label>
            		<label><input type="radio" name="kan" value="ed">看过</label>
            		<div class="kx">给个评价吧?(可选):</div>
                    <ul class="rate" id="zi">
                		<li id="one"><img src="../images/dyxq/huix.png" height="15px" width="15px;"></li><li id="two"><img src="../images/dyxq/huix.png" height="15px" width="15px"></li><li id="three"><img src="../images/dyxq/huix.png" height="15px" width="15px"></li><li id="four"><img src="../images/dyxq/huix.png" height="15px" width="15px"></li><li id="five"><img src="../images/dyxq/huix.png" height="15px" width="15px"></li>
              		</ul>
              		<div class="chengdu"></div>
              		<span class="suo">缩起 ▲</span>
              	</div>
				<div class="xia">
              		<p>标签(多个标签用空格分隔):</p>
              		<input type="text" name="biaoqian"><br>
              		<div class="bq"><span>我的标签:</span></div>
              		<div class="wd">
              			<ul class="wdbq">
                			<li class="qian">女性</li><li class="qian">情感</li><li class="qian">金山</li><li class="qian">哈哈</li><li class="qian">呵呵</li><li class="qian">嘻嘻</li><li class="qian">很好</li><li class="qian">啦啦</li><li class="qian">哼哼</li><li class="qian">嘟嘟</li>
              			</ul>
              		</div>
              		<div class="bq"><span>常用标签:</span></div>
              		<div class="wd">
              			<ul class="wdbq"><li class="qian">动画</li><li class="qian">日本动画</li><li class="qian">哈尔的移动城堡</li><li class="qian">爱情</li><li class="qian">动漫</li><li class="qian">日本</li><li class="qian">宫崎骏</li><li class="qian">电影</li></ul>
              		</div>   
                    <div class="pl">
                     	<p>简短评论:</p>
              			<textarea name="content" cols="50" rows="2"></textarea>
              		</div>
              		<div class="jin"><input id="jzj" type="checkbox" name=""><span> 仅自己可见</span></div>          
            	</div>
            	<div class="foot">
              		<span>分享到  <input id="fx" type="checkbox" name="fx" checked=""> 豆瓣广播</span>
              		<button id="bc" type="submit" name="register">保存</button>
            	</div>
          		</form>
          		<iframe id="id_iframe" name="nm_iframe" style="display: none;"></iframe>
          	</div>
          	<div class="xyp">
          		<button class="bt bt1">推荐</button>
          		<ul class="dpyp">
          			<li><img src="../images/dyxq/dp.gif"><a href="">写短评</a></li><li><img src="../images/dyxq/xyp.gif"><a href="">写影评</a></li><li><a href=""><span>分享到</span></a></li>
          		</ul>
          	</div>
          	<div class="jqjj"><h2 class="lv">方法恢复的剧情简介· · · · · ·</h2><p>苏菲</p></div>
        </main>
        <footer>
		    <div class="wrapper">
            <span>yeyu.com，all rights reserved 小天使有限公司</span>
    	    <ul class="dao">
    		  <li><a href="">关于豆瓣</a></li>
    		  <li><a href="">关于豆瓣</a></li>
    		  <li><a href="">关于豆瓣</a></li>
    		  <li><a href="">关于豆瓣</a></li>
    		  <li><a href="">关于豆瓣</a></li>
    		  <li><a href="">关于豆瓣</a></li>
    	    </ul>
            </div>
        </footer>
    </body>
</html>