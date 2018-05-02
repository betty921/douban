<template>   
<!-- 所有电影中最受欢迎的长评页面 -->
    <div class="contanier">  
        <home-header></home-header> 
        <div class="wrapper">
            <div class="side"></div>
            <div class="main"> 
                <div>
                    <h2 class="h2">豆瓣最受欢迎的影评</h2>
                    <button v-for="(item,index) in bt" class="bt" :class="{'hou':item.cc}" :key="index" @click="dj(index)">{{item.name}}</button>
                    <div class="lb">
                        <ul class="lbul">
                            <li v-for="(item,index) in lb" :key="index" v-show="item.xx">                               
                                <router-link :to="item.ljt" style="font-size:0px;display:block;">
                                    <img :src="item.img" width="75px" style="float:left;margin-right:20px;">
                                </router-link>
                                <div style="padding-left:95px;">
                                    <router-link to="" class="lp_li_a">{{item.name}}</router-link>
                                    <span class="xing" :class="item.fenshu"></span><span class="sj">{{item.sj}}</span>
                                    <p style="color: #3388c4;">{{item.biaoti}}</p>
                                    <p class="msg" style="display:inline;font-size:13px">{{item.fold?maxSlice(item.content):item.content}}</p>
                                    <div v-show="item.content.length>maxLength" style="display:inline;">
                                        <a href="javascript:;" class="show" @click="item.fold=false" v-show="item.fold" style="vertical-align:1px;">展开</a>
                                        <a href="javascript:;" class="show" @click="item.fold=true" v-show="!item.fold" style="vertical-align:1px;">收起</a>
                                    </div>
                                    <div class="yymy">
                                        <a href="javascript:;" class="ym-btn" @click="ymy(item.lj,index,1,item.up)">
                                            <img :src="item.up" width="12px">
                                            <span>{{item.hzs}}</span>
                                        </a>
                                        <a href="javascript:;" class="ym-btn" @click="ymy(item.lj,index,2,item.down)">
                                            <img :src="item.down" width="12px">
                                            <span>{{item.mys}}</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="qyhy">
                        <fy :num='num' :limit='limit' :offset='offset' :uid='uid' :name='name' :mid='mid' :path="path" :gjc="gjc"></fy>
                    </div>
                </div>
            </div>
        </div>
        <foot></foot>
    </div>   
</template>

<style scoped>
    @import "../assets/css/plgy.css";
    @import "../assets/css/cp.css";
    @import "../assets/css/xiaox.css";
</style>

<script>
    import {setCookie,getCookie} from '../assets/cookie.js'
    import HomeHeader from '../components/HomeHeader'
    import Foot from '../components/Foot'
    import fy from '../components/fy'
    export default{
        components: {  
            HomeHeader,Foot,fy
        },
        data(){
            return{
                num: 0,
                limit: 5,
                offset:0, 
                uid:-1, 
                mid:-1,
                name:"",
                path:"/zshy",  
                maxLength:120, 
                gjc:"热门",          
                bt:[{name:"热门",cc:true},{name:"最新",cc:false}],
                lb:[],
            }
        },
        methods:{
            maxSlice(v){
                return v.length>this.maxLength?v.slice(0,this.maxLength)+'...':v;
            },
            ymy(a,i,j,b){
                if(this.uid!=-1){
                    if(j==1&&b=="../../static/xx/up.png"){
                        let data={'dpid':a,'uid':this.uid,'ymy':j};
                        this.$http.post('http://localhost/douban/pl/ymy.php',data,{emulateJSON:true})
                        .then((res)=>{
                            console.log(res);
                            this.lb[i].hzs=res.data.hzs;
                            this.lb[i].mys=res.data.mys;
                            this.lb[i].up="../../static/xx/uph.png";
                            this.lb[i].down="../../static/xx/down.png";
                        });
                    }
                    if(j==2&&b=="../../static/xx/down.png"){
                        let data={'dpid':a,'uid':this.uid,'ymy':j};
                        this.$http.post('http://localhost/douban/pl/ymy.php',data,{emulateJSON:true})
                        .then((res)=>{
                            console.log(res);
                            this.lb[i].hzs=res.data.hzs;
                            this.lb[i].mys=res.data.mys;
                            this.lb[i].down="../../static/xx/downh.png";
                            this.lb[i].up="../../static/xx/up.png";
                        });
                    }
                }
            },
            gg(){
                this.uid=getCookie('userid');
                if(this.$route.query.dp>=0){
                    this.offset=parseInt(this.$route.query.dp);
                }else{this.offset=0;}
                let data={'gjc':this.gjc,'uid':this.uid,'ks':this.offset,'qq':this.offset+this.limit};
                this.$http.post('http://localhost/douban/pl/cp.php',data,{emulateJSON:true})
                .then((res)=>{
                    console.log(res);
                    this.num=res.body.data.gs;
                    var sz=this.offset+this.limit;
                    if(sz>res.body.data.gs){
                        sz=res.body.data.gs-this.limit;
                    }
                    if(this.offset==0){
                        for(var i=0;i<sz;i++){
                            this.$set(this.lb,i,{lj:res.body.data.lj[i],name:res.body.data.name[i],sj:res.body.data.sj[i],fenshu:res.body.data.fenshu[i],content:res.body.data.content[i],hzs:res.body.data.hzs[i],mys:res.body.data.mys[i],biaoti:res.body.data.biaoti[i],xx:true,fold:true,up:res.body.data.up[i],down:res.body.data.down[i],ljt:"/Ym"+res.body.data.ljt[i],img:res.body.data.img1[i]});
                        }
                    }
                    else{
                    this.lb=[];
                    for(var i=0;i<sz;i++){
                        this.$set(this.lb,i,{lj:res.body.data.lj[i+this.limit],name:res.body.data.name[i+this.limit],sj:res.body.data.sj[i+this.limit],fenshu:res.body.data.fenshu[i+this.limit],content:res.body.data.content[i+this.limit],hzs:res.body.data.hzs[i+this.limit],mys:res.body.data.mys[i+this.limit],biaoti:res.body.data.biaoti[i+this.limit],xx:true,fold:true,up:res.body.data.up[i+this.limit],down:res.body.data.down[i+this.limit],ljt:"/Ym"+res.body.data.ljt[i+this.limit],img:res.body.data.img1[i+this.limit]});
                    }}
                });
            },
            dj(i){
                this.bt[i].cc=true;
                switch(i){
                    case (0):
                        this.bt[1].cc=false;
                        this.gjc="热门";
                        break;
                    case (1):
                        this.bt[0].cc=false;
                        this.gjc="最新";
                        break;                     
                }
                this.gg();
            }
        },
        created(){
            this.gg();
        },
        watch:{
            '$route':'gg'
        }
    }
</script>