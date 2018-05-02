<template>
<!-- 登录页面 --> 
    <div class="container">
        <div class="wrapper">
            <div class="side">
                <ul class="dlxz">
                    <li>>还没有豆瓣账号？<router-link to="/register">立即注册</router-link></li>
                </ul>
            </div>
            <div class="main">
                <h1>登录豆瓣</h1>
                <div class="biaodan">
                    <div><label>账号</label><input type="text" placeholder="邮箱/手机号/用户名" v-model="username"></div>
                    <div><label>密码</label><input type="password" placeholder="请输入密码" v-model="password"></div>
                    <div><label></label><button v-on:click="login" class="btn">登录</button><span style="font-size: 13px;color: red;" v-show="showtishi">{{tishi}}</span></div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    @import "../assets/css/dlzc.css";
</style>

<script>
    import {setCookie,getCookie} from '../assets/cookie.js'
    export default{
        data(){
            return{
                showtishi: false,
                tishi: '',
                username: '',
                password: '',
                newusername: '',
                newpassword: ''
            }
        },
        methods:{
            //提示用户
            login(){
                if(this.username == "" || this.password == ""){
                    this.showtishi=true
                    this.tishi="账号密码不能为空"
                }else{                  
                    let data = {'username':this.username,'password':this.password}
                    /*接口请求*/
                    this.$http.post('http://localhost/douban/dengluzc/dl.php',data,{emulateJSON:true})
                    .then((res)=>{
                        console.log(res)
                        if(res.body.data.post==0){
                            this.showtishi = true
                            this.tishi="账号或密码错误"
                        }
                        else{
                            this.tishi = "登录成功"
                            this.showtishi = true
                            setCookie('username',res.body.data.name,1000*60)
                            setCookie('userid',res.body.data.uid,1000*60)
                            setTimeout(function(){
                                this.$router.go(-1)
                            }.bind(this),1000)
                        }
                    }); 
                }
            }
        },       
        mounted(){
            //页面挂载获取cookie，如果存在username的cookie，则跳转到主页，不需登录
            if(getCookie('username')){
                this.$router.push('/home')
            }
        }   
    }
</script>

