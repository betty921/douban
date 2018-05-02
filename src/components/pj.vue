<template>   
        <!-- 由于html不区分大小写，所以js中驼峰命名方式在html中要改成用短横线连接的形式 --> 
    <div class="contanier" :mid="mid" :uid="uid">   
            <div class="head-kg"><p>{{tjsc}}</p><span class="cha" @click="cha">x</span></div>
            <div class="zhong">
                <div class="kx">给个评价吧?(可选):</div>
                <div class="zh" v-for="items in bss">
                    <ul class="ul">
                        <li v-for="(item,index) in hs" :key="index" @mouseover="change(index,hs,bss)" @mouseout="a(hs,bss)" @click="px(index)"><img :src="item.img" height="15px" width="15px;"></li>
                    </ul>
                    <span class="chengdu" v-show="items.showtishi">{{items.tishi}}</span>
                </div>
                <span class="suo" @click="b">{{sq}}</span>
            </div>
            <div class="xia" v-show="bb">
                <p>标签(多个标签用空格分隔):</p>
                <input type="text" v-model="biaoqian" @keyup="ky"><br>
                <div class="bq"><span>我的标签:</span></div>
                <div class="wd">
                    <ul class="wdbq" :bq="bq">
                        <li class="qian" v-for="(item,index) in bq" :class="{'hou':item.cc}" :key="index" @click="dj(index,bq)">{{item.nr}}</li>
                    </ul>
                </div>
                <div class="bq"><span>常用标签:</span></div>
                <div class="wd">
                    <ul class="wdbq" :cybq="cybq">
                        <li class="qian" v-for="(item,index) in cybq" :class="{'hou':item.cc}" :key="index" @click="dj(index,cybq)">{{item.nr}}</li>
                    </ul>
                </div>   
                <div class="pl">
                    <p>简短评论:</p>
                    <textarea v-model="duanp" cols="50" rows="2"></textarea>
                </div>
                <div class="jin"><input id="jzj" type="checkbox" name=""><span> 仅自己可见</span></div>          
            </div>
            <div class="foot">
                <span>分享到  <input id="fx" type="checkbox" name="fx" checked=""> 豆瓣广播</span>
                <button id="bc" type="submit" @click="bc">保存</button>
            </div>
    </div>   
</template>

<style scoped>
@import "../assets/css/dp.css";
</style>

<script>
    import {setCookie,getCookie} from '../assets/cookie.js'
    export default{
        props: ['name','mid','uid'],
        data(){
            return{
                xsm:true,
                xsf:1,
                bt:[{name:"热门",cc:true},{name:"最新",cc:false},{name:"好友",cc:false}],
                lb:[{lj:"",name:"w",fenshu:"xx40",sj:"2017-09-21",content:"很好看",hzs:"55",xx:true},{lj:"",name:"",fenshu:"",sj:"",content:"",hzs:"",xx:false},{lj:"",name:"",fenshu:"",sj:"",content:"",hzs:"",xx:false},{lj:"",name:"",fenshu:"",sj:"",content:"",hzs:"",xx:false},{lj:"",name:"",fenshu:"",sj:"",content:"",hzs:"",xx:false}]
            }
        },
        methods:{
            dj(i){
                this.bt[i].cc=true;
                switch(i){
                    case (0):
                        this.bt[1].cc=false;
                        this.bt[2].cc=false;
                        break;
                    case (1):
                        this.bt[0].cc=false;
                        this.bt[2].cc=false;
                        break;
                    case (2):
                        this.bt[1].cc=false;
                        this.bt[0].cc=false;
                        break;                      
                }
                let data={'gjc':this.bt[i].name,'mid':this.mid};
                this.$http.post('http://localhost/douban/pl/dp.php',data,{emulateJSON:true})
                .then((res)=>{
                    console.log(res)
                    if(res.body.data.post==0){
                        this.xsf=2;
                    } 
                    else{
                        this.xsf=1;
                        for(var i=0;i<res.body.data.gs;i++){
                            this.$set(this.lb,i,{lj:res.body.data.lj[i],name:res.body.data.name[i],sj:res.body.data.sj[i],fenshu:res.body.data.fenshu[i],content:res.body.data.content[i],hzs:res.body.data.hzs[i],xx:true});
                        }
                        for(var j=res.body.data.gs;j<5;j++){
                            this.lb[j].xx=false;
                        }
                    }     
                });
            },
            yy(a,i){
                let data={'cid':a,'uid':this.uid};
                this.$http.post('http://localhost/douban/pl/yy.php',data,{emulateJSON:true})
                .then((res)=>{
                    console.log(res);
                    if(res.data.post==0){
                    alert("这条短评您已经投过票了");
                    }else{
                    this.lb[i].hzs=res.data.hz;}
                });
            }
        },
        created(){
            let data={'gjc':'热门','mid':this.mid};
                this.$http.post('http://localhost/douban/pl/dp.php',data,{emulateJSON:true})
                .then((res)=>{
                    console.log(res);
                    if(res.body.data.post==0){
                        this.xsf=2;
                    } 
                    else{
                        this.xsf=1;
                        for(var i=0;i<res.body.data.gs;i++){
                            this.$set(this.lb,i,{lj:res.body.data.lj[i],name:res.body.data.name[i],sj:res.body.data.sj[i],fenshu:res.body.data.fenshu[i],content:res.body.data.content[i],hzs:res.body.data.hzs[i],xx:true});
                        }
                        for(var j=res.body.data.gs;j<5;j++){
                            this.lb[j].xx=false;
                        }
                    }     
                });
        }
    }
</script>