<template>   
<!-- 搜索到的电影页面 --> 
    <div class="contanier">   
        <home-header></home-header> 
        <div class="wrapper">
            <div class="side"></div>
            <div class="main">
                <h2>搜索 {{this.$route.query.cx}}</h2>
                <div v-if="xsm==1" class="lb">
                    <ul class="lbul">
                        <li v-for="(item,index) in lb" :key="index" v-show="item.xx">
                            <router-link :to="item.lj" class="lp_li_a"><img :src="item.img" class="img"></router-link>
                            <router-link :to="item.lj" class="lp_li_a"><div class="name">{{item.name}}</div>({{item.sj}})</router-link>
                            <div class="rating">
                                <span class="xing" :class="item.fenshu"></span><i>{{ item.fen }}</i><span>({{item.rs}}人评价)</span>
                            </div>
                            <span style="display:block;margin:5px;">{{item.ym}}/{{item.lx}}/{{item.sc}}</span>
                            <span>{{item.dy}}/{{item.zy}}</span>
                        </li>
                    </ul>
                </div>
                <div v-else style="margin-bottom:20px;">没有找到关于“{{this.$route.query.cx}}”的电影，换个搜索词试试吧</div> 
            </div>
        </div>
        <foot></foot>
    </div>   
</template>

<style scoped>
 @import "../assets/css/query.css";
</style>

<script>
    import HomeHeader from '../components/HomeHeader'
    import Foot from '../components/Foot'
    export default {
        components: {  
            HomeHeader,Foot
        },
        data(){
            return{
                xsm:1,
                lb:[]
            }
        },
        methods:{
            //将后台传来的json数据渲染至相关dom
            sx(){
                let data = {'sous':this.$route.query.cx};
                this.$http.post('http://localhost/douban/pl/dsous.php',data,{emulateJSON:true})
                    .then((res)=>{
                        console.log(res);
                        this.lb=[];
                        if(res.body.data.post==0){
                                this.xsm=2;
                        }else{
                        this.xsm=1;
                        if(res.body.data.gs>0){
                            for(var i=0;i<res.body.data.gs;i++){
                                this.$set(this.lb,i,{lj:"/Ym"+res.body.data.mid[i],img:res.body.data.img[i],name:res.body.data.name[i],sj:res.body.data.sj[i],ym:res.body.data.ym[i],fenshu:res.body.data.fenshu[i],fen:res.body.data.fen[i],rs:res.body.data.rs[i],lx:res.body.data.lx[i],sc:res.body.data.sc[i],dy:res.body.data.dy[i],zy:res.body.data.zy[i],xx:true});
                            }
                        }}
                    });
            }
        },
        created(){
             this.sx();
        },
        watch:{
            '$route':'sx'
        }
    }
</script>