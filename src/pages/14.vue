
  <template>   
        <!-- 由于html不区分大小写，所以js中驼峰命名方式在html中要改成用短横线连接的形式 --> 
    <div class="contanier">   
        <home-header :qian="qian" :hou="hou" :usename="usename"></home-header> 
        <iframe id="id_iframe" name="nm_iframe" style="display: none;"></iframe>
        <div class="wrapper">
            <div class="side"></div>
            <div class="main">
              <div class="dybt"><h1>{{name}}</h1><span>({{year}})</span></div>
              <div class="gydy">
                <div class="tp"><a href=""><img :src="img" width="135px" height="190px" style="margin-top:2px;"></a><br><span>更新描述或海报</span></div>
                <div class="dbpf"><pf :fs="fs" :xx="xx" :rs="rs" :fz="fz" :xsf="xsf"></pf></div>
                <div class="dybj">
                  <vue-li :xb="xb"></vue-li>
                </div>
              </div>
              <vm-li :bq="bq" :cybq="cybq" :mid="mid" :uid="uid"></vm-li>   
              <div class="jqjj"><h2 class="lv">我的野蛮女友的剧情简介· · · · · ·</h2><p v-for="(item,index) in jj" :key="index">{{item.nr}}</p></div> 
              <dp :name="name" :mid="mid" :uid="uid"></dp>  
              <cp :name="name" :mid="mid" :uid="uid"></cp>            
            </div>
        </div>
    </div>
</template>

<style scoped>
  @import "../assets/css/xq.css";
</style>

<script>
  import {setCookie,getCookie} from '../assets/cookie.js'
  import HomeHeader from '../components/HomeHeader' 
  import VueLi from '../components/VueLi'
  import VmLi from '../components/VmLi'
  import pf from '../components/pf'
  import dp from '../components/dp'
  import cp from '../components/cp'
  export default { 
    data(){
      return{
        uid:-1,
        mid:14,
        qian:true,
        hou:false,
        usename:"",
        name:"我的野蛮女友",
        year:"2001",
        img:"../../static/dy/p489336497.jpg",
        bq:[{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哦哦",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"都得",cc:false,aa:2},{nr:"嗯嗯",cc:false,aa:2}],
        cybq:[{nr:"往往",cc:false,aa:2},{nr:"不被",cc:false,aa:2},{nr:"天天",cc:false,aa:2},{nr:"日本动画",cc:false,aa:2},{nr:"日本",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2}],
        jj:[{nr:""},{nr:""},{nr:""}],
        xb: [{name:"导演",nr:[]},{name:"编剧",nr:[]},{name:"主演",nr:[]},{name:"类型",nr:[]},{name:"制片国家/地区",nr:["韩国"]},{name:"语言",nr:["韩语"]},{name:"上映日期",nr:["2001-07-27"]},{name:"片长",nr:["123分钟"]},{name:"又名",nr:["我的淘气女友"]}],
        fs:[{kd:"width:20px",x:"5星",bfb:"14%"},{kd:"width:20px",x:"4星",bfb:"14%"},{kd:"width:20px",x:"3星",bfb:"14%"},{kd:"width:20px",x:"2星",bfb:"14%"},{kd:"width:20px",x:"1星",bfb:"14%"}],
        xx:"xx05",
        rs:2222,
        fz:7.3,
        xsf:1,
      }
    },
    components: {  
      HomeHeader,VueLi,VmLi,pf,dp,cp
    },
    methods: {
      a(c,i){
        var dy=c.split(" ");
          for(var b=0;b<dy.length;b++){
            this.xb[i].nr[b]=dy[b];
          }
      },
      b(c){
        var dy=c.split(" ");
        for(var d=0;d<10;d++){
            this.cybq[d].nr=dy[d];
        }
      },
      c(c){
        var dy=c.split("  ");
        for(var d=0;d<3;d++){
            this.jj[d].nr=dy[d];
        }
      }
    },
    created(){
      /*页面挂载获取cookie，如果存在username的cookie，则跳转到主页，不需登录*/
      if(getCookie('username')){
        this.qian=false;
        this.hou=true;
        this.usename=getCookie('username');
        this.uid=getCookie('userid');
      }
      let data = {"mid":this.mid};
      this.$http.post('http://localhost/douban/pl/js.php',data,{emulateJSON:true})
        .then((res)=>{
          console.log(res);
          if(res.body.data.rs==0){
            this.xsf=2;
          }
          else{
            this.rs=res.body.data.rs;
            this.fz=res.body.data.fs;
            if(this.fz>=2&&this.fz<2.5){
              this.xx="xx10";
            }
            if(this.fz>=2.5&&this.fz<3.5){
              this.xx="xx15";
            }
            if(this.fz>=3.5&&this.fz<4.5){
              this.xx="xx20";
            }
            if(this.fz>=4.5&&this.fz<5.5){
              this.xx="xx25";
            }
            if(this.fz>=5.5&&this.fz<6.5){
              this.xx="xx30";
            }
            if(this.fz>=6.5&&this.fz<7.5){
              this.xx="xx35";
            }
            if(this.fz>=7.5&&this.fz<8.5){
              this.xx="xx40";
            }
            if(this.fz>=8.5&&this.fz<9.5){
              this.xx="xx45";
            }
            if(this.fz>=9.5&&this.fz<=10){
              this.xx="xx50";
            }  
            this.fs[0].bfb=res.body.data.lj+"%";  
            this.fs[0].kd="width:"+res.body.data.lj+"px";   
            this.fs[1].bfb=res.body.data.tj+"%";  
            this.fs[1].kd="width:"+res.body.data.tj+"px"; 
            this.fs[2].bfb=res.body.data.hx+"%";  
            this.fs[2].kd="width:"+res.body.data.hx+"px"; 
            this.fs[3].bfb=res.body.data.jc+"%";  
            this.fs[3].kd="width:"+res.body.data.jc+"px"; 
            this.fs[4].bfb=res.body.data.hc+"%";  
            this.fs[4].kd="width:"+res.body.data.hc+"px";
          }  
        });
      this.a("郭在容",0);
      this.a("郭在容 金浩植",1);
      this.a("车太贤 全智贤 金仁文 金太贤 李武英",2);
      this.a("剧情 喜剧 爱情",3);
      this.b("动画 日本动画 哈尔的移动城堡 爱情 动漫 日本 宫崎骏 电影");
      this.c("牵牛（车太贤饰）第一次与她（全智贤饰）邂逅，就毫无浪漫感可言。在地铁上她就语出惊人，喝的醉醺醺的她大声训斥不自觉给老人让座的人，吐完之后就软趴趴地倒了下来。善良的牵牛上前接住，于是就只好背着她到旅馆投宿了。但是好心不一定有好报，牵牛正在好好洗澡时就被冲进来的警察带走了。  然而这两个人却从此开始约会了。她很霸道很任性，然而当她用那张可爱的面孔对着你笑时，你也忍不住心软。于是牵牛也心甘情愿地被她折磨。渐渐的，牵牛感觉到她的内心受伤了，他用尽全力去呵护去保护，她仍然缺乏安全感。虽然在一起很快乐也很感动，她却仍然提出了一个难以接受的约定：让我们先分开吧……");
    }
  }
</script>