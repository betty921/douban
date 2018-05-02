
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
              <div class="jqjj"><h2 class="lv">那些年，我们一起追过的女孩的剧情简介· · · · · ·</h2><p v-for="(item,index) in jj" :key="index">{{item.nr}}</p></div>  
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
        mid:5,
        qian:true,
        hou:false,
        usename:"",
        name:"那些年，我们一起追过的女孩",
        year:"2012",
        img:"../../static/dy/p1062824805.jpg",
        bq:[{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哦哦",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"都得",cc:false,aa:2},{nr:"嗯嗯",cc:false,aa:2}],
        cybq:[{nr:"往往",cc:false,aa:2},{nr:"不被",cc:false,aa:2},{nr:"天天",cc:false,aa:2},{nr:"日本动画",cc:false,aa:2},{nr:"日本",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2}],
        jj:[{nr:""},{nr:""},{nr:""}],
        xb: [{name:"导演",nr:[]},{name:"编剧",nr:[]},{name:"主演",nr:[]},{name:"类型",nr:[]},{name:"制片国家/地区",nr:["台湾"]},{name:"语言",nr:["汉语普通话"]},{name:"上映日期",nr:["2012-01-06"]},{name:"片长",nr:["110分钟"]},{name:"又名",nr:["You Are the Apple of My Eye"]}],
        fs:[{kd:"width:20px",x:"5星",bfb:"14%"},{kd:"width:20px",x:"4星",bfb:"14%"},{kd:"width:20px",x:"3星",bfb:"14%"},{kd:"width:20px",x:"2星",bfb:"14%"},{kd:"width:20px",x:"1星",bfb:"14%"}],
        xx:"",
        rs:"",
        fz:"",
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
      let data = {"mid":this.mid}
      this.$http.post('http://localhost/douban/pl/js.php',data,{emulateJSON:true})
        .then((res)=>{
          console.log(res)
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
      this.a("九把刀",0);
      this.a("九把刀",1);
      this.a("柯震东 陈妍希 敖犬 郝劭文 蔡昌宪",2);
      this.a("剧情 喜剧 爱情",3);
      this.b("台湾 2011 成长 青春 感动 爱情 校园 文艺 温情 剧情");
      this.c("青春是一场大雨。即使感冒了，还盼望回头再淋它一次。人生就是不停的战斗，在还没有获得女神青睐时，左手永远都只是辅助！！！  柯景腾（柯震东 饰）和他的一群好友，爱耍帅却老是情场失意的老曹（敖犬 饰），停止不了勃起所以叫勃起的勃起（鄢胜宇 饰），想用搞笑致胜却总是失败的该边（蔡昌宪 饰），胖界的夺爱高手阿和（赦绍文 饰），从国中到高中，一直是不离不弃的死党。他们都对班花沈佳宜（陈妍希 饰）有着一种纠结的感情。一方面，他们瞧不起这种只会用功读书的女生，另一方面他们又为她的美好气质倾倒。因为学习成绩较差，柯景腾被老师安排坐在沈佳宜前面。因为他的一次英雄救美，她开始用强制的方式帮他补习功课。此事令其他兄弟羡慕嫉妒恨，但是大家都未说破。毕业后，柯景腾和沈佳宜在各自大学保持恋人般的联系。直到他举办自由格斗赛，事情才出现了变化…… 这一连串下，原本按兵不动的好友也都纷纷加入女神争夺战！但是麻吉诚可贵，青春价更高，若为女神故，是否二者皆可抛哩？！");
    }
  }
</script>