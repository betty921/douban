<template>
<!-- 电影长评组件 -->
<div class="container" :lb="lb" :uid="uid">
    <ul class="lbul">
        <li v-for="(item,index) in lb" :key="index" v-show="item.xx">
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
        </li>
    </ul>
</div>
</template>
<style scoped>
    @import "../assets/css/plgy.css";
    @import "../assets/css/xiaox.css";
    @import "../assets/css/cp.css";
</style>
<script>
    export default{
        props: ['lb','uid'],
        data(){
            return{
                maxLength:120,
            }
        },
        methods:{
            //长评字数超过120则缩起，点击展开展现全部
            maxSlice(v){
                return v.length>this.maxLength?v.slice(0,this.maxLength)+'...':v;
            },
            //对相应长评进行投票，是有用还是没用，不能重复投
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
            }}
        }
    }
</script>                        