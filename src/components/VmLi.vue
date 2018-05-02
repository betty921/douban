<template>
<!-- 对电影打星写短评或短评 --> 
<div class="container" :mid="mid" :uid="uid">
	<div class="pinjia" v-if="xs===1">
		<div class="zh" v-for="items in bs">
			<button class="bt">想看</button><button class="bt">看过</button><button class="bt">在看</button>
    		<span class="wdpj">评价:</span>
    		<ul class="ul">
				<li v-for="(item,index) in gs" :key="index" @mouseover="change(index,gs,bs)" @mouseout="w(gs,bs)" @click="px(index)"><router-link :to="lj" target="nm_iframe"><img :src="item.img" height="15px" width="15px;"></router-link></li>
			</ul>
			<span class="chengdu" v-show="items.showtishi">{{items.tishi}}</span>
		</div>
	</div>
	<div v-else>
		<div class="kg">我看过这部电视剧<span class="time">{{time}}</span>
        <button class="bt" @click="cx">修改</button>
        <button class="bt" @click="sc">删除</button></div>
        <span class="wdpj">我的评价:</span>
        <div class="zh" v-for="items in bsss">
        	<ul class="ul">
            	<li v-for="(item,index) in hss" :key="index" @click="pxx(index)" @mouseover="change(index,hss,bsss)" @mouseout="a(hss,bsss)"><img :src="item.img" height="15px" width="15px;"></li>
        	</ul>
        	<span class="chengdu" v-show="items.showtishi">{{items.tishi}}</span>
        </div>
        <div class="ytbq">{{ytbq}}</div>
        <div>{{brief}}</div>
	</div>
	<div class="pinju" v-show="hh">
        	<div class="head-kg"><p>{{tjsc}}</p><span class="cha" @click="cha">x</span></div>
        	<div class="zhong">
            	<div class="kx">给个评价吧?(可选):</div>
            	<div class="zh" v-for="items in bss">
                	<ul class="ul">
                    	<li v-for="(item,index) in hs" :key="index" @mouseover="change(index,hs,bss)" @mouseout="a(hs,bss)" @click="px(index)"><img :src="item.img" height="15px" width="15px;"></li>
               		</ul>
                	<span class="chengdu" v-show="items.showtishi">{{items.tishi}}</span>
            	</div>
            	<span class="suo" @click="b">{{sq}}</span>
       	 	</div>
            <div v-if="xsf==1">
        	<div class="xia" v-show="bb">
            	<p>标签(多个标签用空格分隔):</p>
            	<input type="text" v-model="biaoqian" @keyup="ky"><br>
            	<div class="bq"><span>我的标签:</span></div>
            	<div class="wd">
                	<ul class="wdbq" :bq="bq">
                    	<li class="qian" v-for="(item,index) in bq" :class="{'hou':item.cc}" :key="index" @click="dj(index,bq)">{{item.nr}}</li>
                	</ul>
            	</div>
            	<div class="bq"><span>常用标签:</span></div>
            	<div class="wd">
                	<ul class="wdbq" :cybq="cybq">
                    	<li class="qian" v-for="(item,index) in cybq" :class="{'hou':item.cc}" :key="index" @click="dj(index,cybq)">{{item.nr}}</li>
               		</ul>
            	</div>   
            	<div class="pl">
                    <span style="float:right;">少于140字</span>
                	<p>简短评论:</p>
                	<textarea v-model="duanp" cols="50" rows="2"></textarea>
            	</div>
            	<div class="jin"><input id="jzj" type="checkbox" name=""><span> 仅自己可见</span></div>          
        	</div>
            <div class="foot">
                <span>分享到  <input id="fx" type="checkbox" name="fx" checked=""> 豆瓣广播</span>
                <button id="bc" type="submit" @click="bc">保存</button>
            </div>
            </div>
            <div v-else>
            <div class="xia" v-show="bb">
                <p>添加标题</p>
                <input type="text" v-model="biaoti"><br>
                <div class="pl">
                    <span style="float:right;">不少于140字</span>
                    <p>简短评论:</p>
                    <textarea v-model="changp" cols="50" rows="8" style="font-size:12px;"></textarea>
                </div>
                <div class="jin"><input id="jzj" type="checkbox" name=""><span> 仅自己可见</span></div> 
            </div>
        	<div class="foot">
            	<span>分享到  <input id="fx" type="checkbox" name="fx" checked=""> 豆瓣广播</span>
            	<button id="bc" type="submit" @click="bccp">保存</button>
        	</div>
            </div>
    </div>
    <div class="xyp">
        <ul class="dpyp">
            <li><img src="../../static/xx/dp.gif"><a href="javascript:;" @click="xdp">写短评</a></li><li><img src="../../static/xx/xyp.gif"><a href="javascript:;" @click="xcp">写影评</a></li>
        </ul>
    </div>
</div>
</template>

<style scoped>
    @import "../assets/css/vmli.css";
</style>

<script>
	import {setCookie,getCookie} from '../assets/cookie.js'
	export default{
		props: ['cybq','bq','mid','uid'],
		data(){
			return{
				hh:false,
				bb:true,
				cc:false,
				lj:"",
				biaoqian:"",
				duanp:"",
                biaoti:"",
                changp:"",
				sq:"缩起 ▲",
				mk:2,
				ytjh:-1,
				jhh:"",
				xs:1,
                xsf:1,
                tjsc:"添加收藏：我看过这部电影",
				bs:[{showtishi:false,tishi:''}],
				bss:[{showtishi:false,tishi:''}],
				gs:[{img:"../../static/xx/hui.png"},{img:"../../static/xx/hui.png"},{img:"../../static/xx/hui.png"},{img:"../../static/xx/hui.png"},{img:"../../static/xx/hui.png"}],
				hs:[{img:"../../static/xx/hui.png"},{img:"../../static/xx/hui.png"},{img:"../../static/xx/hui.png"},{img:"../../static/xx/hui.png"},{img:"../../static/xx/hui.png"}],
				hss:[{img:"../../static/xx/hui.png"},{img:"../../static/xx/hui.png"},{img:"../../static/xx/hui.png"},{img:"../../static/xx/hui.png"},{img:"../../static/xx/hui.png"}],
        		bsss:[{showtishi:false,tishi:""}],
        		ytbq:"",
        		brief:"",
        		time:"",
			}
		},
		methods:{
            //鼠标悬停星星由灰色变为橘色，并提示相应打分等级
			change(i,a,b){
				for(var j=0;j<i+1;j++){
					a[j].img="../../static/xx/ll.png";
				}
				for(var c=i+1;c<5;c++){
					a[c].img="../../static/xx/hui.png";
				}
				switch(i){
        			case (0):
        	  			b[0].showtishi=true;
        	  			b[0].tishi="很差";
        	  			break;
        			case (1):
        	  			b[0].showtishi=true;
        	  			b[0].tishi="较差";
        	  			break;
        			case (2):
        	  			b[0].showtishi=true;
        	  			b[0].tishi="还行";
        	  			break;
        			case (3):
        	  			b[0].showtishi=true;
        	  			b[0].tishi="推荐";
        	  			break;
        			case (4):
        	  			b[0].showtishi=true;
        	  			b[0].tishi="力荐";
        	  			break;       	          	  
        		}
			},
            //具体评价表单中的星星组件，鼠标离开
			a(b,c){
				b.forEach(function(a){
                    a.img="../../static/xx/hui.png";
                });
                for(var j=0;j<this.ytjh+1;j++){
                	b[j].img="../../static/xx/ll.png";
                }
                c[0].showtishi=true;
                c[0].tishi=this.jhh;
			},
            //电影详情页面中的星星组件，鼠标离开
			w(b,c){
				b.forEach(function(a){
                    a.img="../../static/xx/hui.png";
                });
                c[0].showtishi=false;
			},
            //具体评价表单标签短评功能的隐藏及呈现
			b(){
				if(this.mk%2==0){
					this.bb=false;
					this.sq="高级(标签和短评) ▼";
					this.mk=3;
				}else{
					this.bb=true;
					this.sq="缩起 ▲";
					this.mk=2;
				}
			},
            //写短评表单保存，将用户填写的数据提交至后台处理，并重新刷新页面
			bc(){
				this.hh=false;
				let data = {'score':this.ytjh,'biaoqian':this.biaoqian,'content':this.duanp,'mid':this.mid,'uid':this.uid};
				this.$http.post('http://localhost/douban/pl/pll.php',data,{emulateJSON:true})
        			.then((res)=>{
          				console.log(res)
          				if(res.body.data.post==1){
            				location.reload();
          				}      
        			});
			},
            //写长评表单保存，将用户填写的数据提交至后台处理，并重新刷新页面。要求必须有标题并字数不少于140字
            bccp(){
                if(this.biaoti.length==0){
                    alert("请输入标题");
                }
                else if(this.changp.length<140){
                    alert("影评不少于140字");
                }else{
                    this.hh=false;
                    let data = {'score':this.ytjh,'biaoti':this.biaoti,'content':this.changp,'mid':this.mid,'uid':this.uid};
                    this.$http.post('http://localhost/douban/pl/plcp.php',data,{emulateJSON:true})
                    .then((res)=>{
                        console.log(res)
                        if(res.body.data.post==1){
                            location.reload();
                        }      
                    });
                }
            },
            //用户选择性为该电影选择标签，第一次点击按钮变淡，按钮中的内容呈现在表单中，第二次点击，恢复，内容消失。标签空格隔开
			dj(i,a){
				if(a[i].aa%2==0){
					a[i].cc=true;
					a[i].aa=3;
					this.biaoqian+=a[i].nr+' ';
				}else{
					var xx=a[i].nr+' ';
					a[i].cc=false;
					a[i].aa=2;
					this.biaoqian=this.biaoqian.replace(xx,"");
				}
			},
            //当用户选择输入标签时，判断标签按钮中是否有用户输入的标签，有则变浅
			ky(){
				var zhi=this.biaoqian;
				this.bq.forEach(function(a){
                    if(zhi.indexOf(a.nr+" ")>=0){
                    	a.cc=true;
                    	a.aa=3;
                    }else{
                    	a.cc=false;
                    	a.aa=2;
                    }
                });
                this.cybq.forEach(function(a){
                    if(zhi.indexOf(a.nr+" ")>=0){
                    	a.cc=true;
                    	a.aa=3;
                    }else{
                    	a.cc=false;
                    	a.aa=2;
                    }
                });
			},
            //电影详情页面点击星星组件，具体评价表单出现，并根据用户点击的星值联动表单中的星星组件
			px(i){
				if(this.hh==false){
					this.hh=true;
				}
				for(var j=0;j<i+1;j++){
					this.hs[j].img="../../static/xx/ll.png";
				}
				for(var b=i+1;b<5;b++){
					this.hs[b].img="../../static/xx/hui.png";
				}
				switch(i){
        			case (0):
        	  			this.bss[0].showtishi=true;
        	  			this.bss[0].tishi="很差";
        	  			this.jhh="很差";
        	  			break;
        			case (1):
        	  			this.bss[0].showtishi=true;
        	  			this.bss[0].tishi="较差";
        	  			this.jhh="较差";
        	  			break;
        			case (2):
        	  			this.bss[0].showtishi=true;
        	  			this.bss[0].tishi="还行";
        	  			this.jhh="还行";
        	  			break;
        			case (3):
        	  			this.bss[0].showtishi=true;
        	  			this.bss[0].tishi="推荐";
        	  			this.jhh="推荐";
        	  			break;
        			case (4):
        	  			this.bss[0].showtishi=true;
        	  			this.bss[0].tishi="力荐";
        	  			this.jhh="力荐";
        	  			break;       	          	  
        		}
				this.ytjh=i;
			},
            //用户已打分，再次点击详情页面的星星组件，则对星值进行修改
			pxx(i){
				this.ytjh=i;
				let data = {'score':this.ytjh,'mid':this.mid,'uid':this.uid};
				this.$http.post('http://localhost/douban/pl/xxx.php',data,{emulateJSON:true})
        			.then((res)=>{
          				console.log(res)
          				if(res.body.data.post==1){
            				location.reload();
          				}      
        			});
			},
            //点击具体表单的叉号，表单消失
			cha(){
				this.hh=false;
			},
            //根据具体表单出现的来源对具体表单进行修改
			cx(){
				this.hh=true;
                this.tjsc="添加收藏：修改";
                this.xsf=1;
				this.ky();
			},
            xdp(){
                if(!getCookie('username')){
                this.$router.push('/login');
                }else{
                this.hh=true;
                this.tjsc="添加收藏：写短评";
                this.xsf=1;
                this.ky();}
            },
            xcp(){
                if(!getCookie('username')){
                this.$router.push('/login');
                }else{
                this.hh=true;
                this.tjsc="添加收藏：写影评";
                this.xsf=2;}
            },
            //删除评价
			sc(){
				let data = {'mid':this.mid,'uid':this.uid};
				this.$http.post('http://localhost/douban/pl/scc.php',data,{emulateJSON:true})
        			.then((res)=>{
          				console.log(res)
          				if(res.body.data.post==1){
            				location.reload();
          				}    
        			});
			}
		},
		created(){
        //根据用户是否对该电影进行过打分，呈现不同页面
			if(!getCookie('username')){
				this.lj="/login";				
			}else{
				let data = {"mid":this.mid,"uid":this.uid}
      			this.$http.post('http://localhost/douban/pl/sc.php',data,{emulateJSON:true})
        			.then((res)=>{
          				console.log(res)
          				if(res.body.data.post!==0){
            				this.xs=2;
            				this.ytjh=parseInt(res.body.data.xz);          
            				switch(this.ytjh){
              					case (0):
                  					this.jhh="很差";
                  					break;
              					case (1):
                  					this.jhh="较差";
                  					break;
              					case (2):
                  					this.jhh="还行";
                  					break;
              					case (3):
                  					this.jhh="推荐";
                  					break;
              					case (4):
                  					this.jhh="力荐";
                  					break;                      
            				};
            				this.time=res.body.data.sj;
                            if(res.body.data.ytbq==null || res.body.data.ytbq==""){this.ytbq="";}else{
            				this.ytbq="标签："+res.body.data.ytbq;}
            				this.biaoqian=res.body.data.ytbq+" ";
            				this.brief=res.body.data.brief;
            				this.duanp=res.body.data.brief;
                            this.changp=res.body.data.changp;
                            this.biaoti=res.body.data.biaoti;
            				for(let j=0;j<this.ytjh+1;j++){
              					this.hss[j].img="../../static/xx/ll.png";
              					this.hs[j].img="../../static/xx/ll.png";
            				}
            				this.bsss[0].showtishi=true;
            				this.bsss[0].tishi=this.jhh; 
            				this.bss[0].showtishi=true;
            				this.bss[0].tishi=this.jhh;        
          				}              
       			});
        	}
		}
	}
</script>