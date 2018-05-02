
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
              <div class="jqjj"><h2 class="lv">情书的剧情简介· · · · · ·</h2><p v-for="(item,index) in jj" :key="index">{{item.nr}}</p></div> 
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
        mid:10,
        qian:true,
        hou:false,
        usename:"",
        name:"情书",
        year:"1999",
        img:"../../static/dy/p449897379.jpg",
        bq:[{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哦哦",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"都得",cc:false,aa:2},{nr:"嗯嗯",cc:false,aa:2}],
        cybq:[{nr:"往往",cc:false,aa:2},{nr:"不被",cc:false,aa:2},{nr:"天天",cc:false,aa:2},{nr:"日本动画",cc:false,aa:2},{nr:"日本",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2},{nr:"哈哈",cc:false,aa:2}],
        jj:[{nr:""},{nr:""},{nr:""}],
        xb: [{name:"导演",nr:[]},{name:"编剧",nr:[]},{name:"主演",nr:[]},{name:"类型",nr:[]},{name:"制片国家/地区",nr:["日本"]},{name:"语言",nr:["日语"]},{name:"上映日期",nr:["1999-03-25"]},{name:"片长",nr:["117分钟"]},{name:"又名",nr:["When I Close My Eyes"]}],
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
      this.a("岩井俊二",0);
      this.a("岩井俊二",1);
      this.a("中山美穗 丰川悦司 酒井美纪 柏原崇",2);
      this.a("剧情 爱情",3);
      this.b("动画 日本动画 哈尔的移动城堡 爱情 动漫 日本 宫崎骏 电影");
      this.c("日本神户某个飘雪的冬日，渡边博子（中山美穗）在前未婚夫藤井树的三周年祭日上又一次悲痛到不能自已。正因为无法抑制住对已逝恋人的思念，渡边博子在其中学同学录里发现“藤井树” 在小樽市读书时的地址时，依循着寄发了一封本以为是发往天国的情书。  不想不久渡边博子竟然收到署名为“藤井树（中山美穗）”的回信，经过进一步了解，她知晓此藤井树是一个同她年纪相仿的女孩，且还是男友藤井树（柏原崇）少年时代的同班同学。为了多了解一些昔日恋人在中学时代的情况，渡边博子开始与女性藤井树书信往来。而藤井树在不断的回忆中，渐渐发现少年时代与她同名同姓的那个藤井树曾对自己藏了一腔柔情");
    }
  }
</script>