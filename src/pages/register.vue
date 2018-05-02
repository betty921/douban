<template>
<!-- 注册页面 --> 
    <div class="container">
        <div class="wrapper">
            <div class="side">
                <ul class="dlxz">
                    <li>>已经拥有豆瓣账号？<router-link to="/login">直接登录</router-link></li>
                </ul>
            </div>
            <div class="main">
                <h1>欢迎加入豆瓣</h1>
                <div class="biaodan">
                    <div><label>邮箱</label><input type="email" v-model="email"></div>
                    <div><label>密码</label><input type="password" v-model="newpassword" @focus="ts" @blur="jg"><span class="ys" :class="{ 'active':zs }" v-show="showtishi2">{{tishi2}}</span></div>
                    <div><label>确认密码</label><input type="password" name="repwd" v-model="repassword" @blur="jgg"><span class="ys" v-show="showtishi3">{{tishi3}}</span></div>
                    <div class="minghao"><label>名号</label><input type="text" v-model="newusername"><span class="ys" v-show="showtishi5">{{tishi5}}</span></div>
                    <div class="jieshi"><span>第一印象很重要，起个响亮的名号吧</span></div>
                    <div class="shouji"><label>手机号</label><div class="phone"><span id="hao">+86 |</span><div><input type="text" v-model="tel"></div></div><span class="ys" v-show="showtishi4">{{tishi4}}</span></div>
                    <div><label>QQ</label><input type="text" v-model="qq"></div>
                    <div><label></label><button class="btn" type="submit" v-on:click="register">注册</button><span class="ys" v-show="showtishi">{{tishi}}</span></div>  
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    @import "../assets/css/dlzc.css";
    @import "../assets/css/zc.css";
</style>

<script>
    import {setCookie,getCookie} from '../assets/cookie.js'
    export default{
        data(){
            return{
                showtishi: false,
                tishi: '',
                showtishi1: false,
                tishi1: '',
                showtishi2: false,
                tishi2: '',
                showtishi3: false,
                tishi3: '',
                showtishi4: false,
                tishi4: '',
                showtishi5: false,
                tishi5: '',
                zs: false,
                email: '',
                newpassword: '',
                repassword: '',
                newusername: '',
                tel: '',
                qq: ''
            }
        },
        methods:{
            //提示用户如何正确注册
            register(){
                if(this.newusername == "" || this.newpassword == "" || this.repassword == "" || this.tel == ""){
                    if(this.newusername == ""){
                        this.showtishi5=true
                        this.tishi5="名号不能为空"
                    }
                    if(this.newpassword == ""){
                        this.zs=false
                        this.showtishi2=true
                        this.tishi2="密码不能为空"
                    }
                    if(this.repassword == ""){
                        this.showtishi3=true
                        this.tishi3="请再次确认密码"
                    }
                    if(this.tel == ""){
                        this.showtishi4=true
                        this.tishi4="手机号不能为空"
                    }
                    if(this.email == ""){
                        this.showtishi1=true
                        this.tishi1="邮箱不能为空"
                    }
                }
                else{                 
                    let data = {'email':this.email,'newpassword':this.newpassword,'newusername':this.newusername,'tel':this.tel,'qq':this.qq}
                    /*接口请求*/
                    this.$http.post('http://localhost/douban/dengluzc/zc.php',data,{emulateJSON:true})
                    .then((res)=>{
                        console.log(res)
                        if(res.body.data.post==0){
                            this.showtishi = true
                            this.tishi="账号已注册，请直接登录"
                        }
                        else{
                            this.tishi = "注册成功"
                            this.showtishi = true
                            setTimeout(function(){
                                this.$router.push('/login')
                            }.bind(this),1000)
                        }
                    }); 
                }
            },
            ts(){
                this.zs=true
                this.showtishi2=true
                this.tishi2="至少包含字母和数字，最短8个字符，区分大小写"
            },
            jg(){
                if (this.newpassword.length>7) {
                    var str=this.newpassword;
                    var ret1=/^(?![a-zA-Z]+$)(?!\d+$)(?![!@#$%^&*]+$)[a-zA-Z\d!@#$%^&*]+$/;
                    var ret2=/^(?![a-zA-Z]+$)(?!\d+$)(?![!@#$%^&*]+$)(?![a-zA-Z\d]+$)(?![a-zA-Z!@#$%^&*]+$)(?![\d!@#$%^&*]+$)[a-zA-Z\d!@#$%^&*]+$/;
                    if (ret1.test(str)||ret2.test(str)) {
                        if(ret1.test(str)){
                            this.zs=true
                            this.showtishi2=true
                            this.tishi2="中"
                        }       
                        if(ret2.test(str)) {
                            this.zs=true
                            this.showtishi2=true
                            this.tishi2="强"
                        }
                    } else{
                        this.zs=false
                        this.showtishi2=true
                        this.tishi2="密码强度不够，请包含字母和数字"   
                    }
                }else{
                    this.zs=false
                    this.showtishi2=true
                    this.tishi2="密码长度不足8个字符"
                }
            },
            jgg(){
                if(this.repassword!==this.newpassword){
                    this.showtishi3=true
                    this.tishi3="两次密码不一致"
                }
                else{
                    this.showtishi3=false
                }
            }
        },       
        mounted(){
            if(getCookie('username')){
                this.$router.push('/home')
            }
        }   
    }
</script>