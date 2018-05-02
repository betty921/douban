<template>  
<!-- 头部组件 -->
    <header>
        <div class="header-nav">
            <ul class="nav">
                <li><a href="">豆瓣</a></li>
            </ul>
            <ul class="login" v-show="qian">
                <li><router-link to="/login" class="lp_li_a">登录</router-link></li>
                <li><router-link to="/register" class="lp_li_a">注册</router-link></li>
            </ul>
            <ul class="login" v-show="hou">
                <li class="yi" @mouseover="to" @mouseout="go"><router-link to="/detail" class="lp_li_a">{{usename}}</router-link><div class="yc" v-show="sf" @click="quit"><a href="">注销</a></div></li>
            </ul>
        </div>
        <div class="wrapper">
            <div class="side"></div>
            <div class="main">
                <h1 class="logo">
                    豆瓣电影
                </h1>
                <div class="form">
                    <input type="text" v-model="sous" placeholder="搜索电影、影人、导演" @keyup="ss">
                    <input type="submit" @click="dss">
                    <div v-show="xsm" class="lb">
                        <ul class="lbul">
                            <li v-for="(item,index) in lb" :key="index" v-show="item.xx">
                                <router-link :to="item.lj" class="lp_li_a">
                                    <div>
                                        <img :src="item.img" class="img">
                                        <div style="display:inline; margin-right:5px;">{{item.name}}</div><span>{{item.sj}}</span>
                                        <span style="display:block;margin:5px;">{{item.ym}}</span>
                                </div>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="main-nav">
                    <li v-for="(item,index) in nav" :key="index"><router-link :to="item.lj" class="lp_li_a">{{item.name}}</router-link></li>
                </ul>
            </div>
        </div>
    </header>
</template>  
  
<style scoped>
    @import "../assets/css/head.css";
</style>

<script>
import {getCookie,delCookie} from '../assets/cookie.js'
    export default{
        data(){
            return{
                sf:false,
                qian:true,
                hou:false,
                usename:'',
                sous:'',
                jz:"",
                xsm:true,
                nav:[{name:"主页",lj:"/home"},{name:"分类",lj:"/fl"},{name:"影评",lj:"/zshy"},{name:"我看",lj:"/detail"},{name:"选电影",lj:"/xys"}],
                lb:[{lj:"",img:"",name:"",sj:"",ym:"",xx:false},{lj:"",img:"",name:"",sj:"",ym:"",xx:false},{lj:"",img:"",name:"",sj:"",ym:"",xx:false},{lj:"",img:"",name:"",sj:"",ym:"",xx:false},{lj:"",img:"",name:"",sj:"",ym:"",xx:false},{lj:"",img:"",name:"",sj:"",ym:"",xx:false}]
            }
        },
        methods:{
            //鼠标悬停用户名，弹出注销内容
            to(){
                this.sf=true;
            },
            //鼠标离开用户名，注销内容消失
            go(){
                this.sf=false;
            },
            //点击注销，用户注销
            quit(){
                delCookie('username');
            },
            //用户在输入搜索关键词时，在搜索框下异步呈现搜索到的电影列表，点击进入电影详情页
            ss(){
                this.xsm=true;
                let data = {'sous':this.sous};
                this.$http.post('http://localhost/douban/pl/sous.php',data,{emulateJSON:true})
                    .then((res)=>{
                        console.log(res);
                        if(res.body.data.post==0){
                            for(var i=0;i<6;i++){
                                this.lb[i].xx=false;
                            }
                        }else{
                        if(res.body.data.gs>0){
                            for(var i=0;i<res.body.data.gs;i++){
                                this.lb[i].xx=true;
                                this.lb[i].img=res.body.data.img[i];
                                this.lb[i].name=res.body.data.name[i];
                                this.lb[i].sj=res.body.data.sj[i];
                                this.lb[i].ym=res.body.data.ym[i];
                                this.lb[i].lj="/Ym"+res.body.data.mid[i];
                            }
                            for(var i=res.body.data.gs;i<6;i++){
                                this.lb[i].xx=false;
                            }
                        }}
                    });
            },
            //点击搜索框，进入搜索到的电影列表页面
            dss(){
                this.$router.push({path:'/query',query:{cx:this.sous}});
                this.xsm=false;
            }
        },
        mounted(){
            //页面挂载获取cookie，如果存在username的cookie，则头部导航呈现用户名
            if(getCookie('username')){
                this.qian=false;
                this.hou=true;
                this.usename=getCookie('username');
            }
        }
    }
</script> 