
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
              <div class="jqjj"><h2 class="lv">阳光姐妹淘的剧情简介· · · · · ·</h2><p v-for="(item,index) in jj" :key="index">{{item.nr}}</p></div>  
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
        mid:8,
        qian:true,
        hou:false,
        usename:"",
        name:"阳光姐妹淘",
        year:"2011",
        img:"../../static/dy/p1374786017.jpg",
        bq:[{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哦哦",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"都得",cc:false,aa:2},{nr:"嗯嗯",cc:false,aa:2}],
        cybq:[{nr:"往往",cc:false,aa:2},{nr:"不被",cc:false,aa:2},{nr:"天天",cc:false,aa:2},{nr:"日本动画",cc:false,aa:2},{nr:"日本",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2}],
        jj:[{nr:""},{nr:""},{nr:""}],
        xb: [{name:"导演",nr:[]},{name:"编剧",nr:[]},{name:"主演",nr:[]},{name:"类型",nr:[]},{name:"制片国家/地区",nr:["韩国"]},{name:"语言",nr:["韩语"]},{name:"上映日期",nr:["2011-05-04"]},{name:"片长",nr:["124分钟"]},{name:"又名",nr:["永远的七公主"]}],
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
            this.xx=res.body.data.xx; 
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
      this.a("姜炯哲",0);
      this.a("姜炯哲",1);
      this.a("沈恩京 闵孝琳 姜素拉 南宝拉 陈熙京",2);
      this.a("剧情 喜剧",3);
      this.b("动画 日本动画 哈尔的移动城堡 爱情 动漫 日本 宫崎骏 电影");
      this.c("25年前，高中生任娜美（沈恩京 饰）一家从全罗道搬到汉城，娜美入读真德女子高中，因方言浓重怯于开口的娜美幸运的得到了同班大姐头夏春花（姜索拉 饰）的维护，并与围绕在夏春花周围的执着于双眼皮的金玫瑰、满嘴脏话的黄珍熙、梦想成为作家的徐金玉、要成为韩国小姐的俞福姬以及沉默傲慢的美人郑秀智等五人结识。在一次和不良少女团对决之后，春花和娜美等七人组成了“Sunny”团体……  多年以后，家庭主妇娜美在去医院探望母亲时偶然重逢了身患绝症住院的春花，后者希望在生命的最后两个月内，能够再见当年的Sunny成员。娜美找到金玫瑰，两人委托私家侦探寻找当年的同伴，而那些关于青春的回忆，也在一个个熟悉的名姓后面再次被唤醒。");
    }
  }
</script>