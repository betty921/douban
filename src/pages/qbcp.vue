<template>
<!-- 电影全部长评页面 -->    
    <div class="contanier">  
        <home-header></home-header> 
        <div class="wrapper">
            <div class="side">
                <div class="gydy">
                    <router-link :to="ylj">>{{this.name}}</router-link>
                    <router-link :to="ylj" style="font-size:0px;"><img :src="img" width="100px" style="margin-top:2px;display:block;margin-top:20px;"></router-link>
                </div>
            </div>
            <div class="main"> 
                <div>
                    <h2 class="h2">{{this.name}}的剧评({{num}})</h2>
                    <button v-for="(item,index) in bt" class="bt" :class="{'hou':item.cc}" :key="index" @click="dj(index)">{{item.name}}</button>
                    <div class="lb">
                        <gdcul :lb="lb" :uid="uid"></gdcul>
                    </div>
                    <fy :num='num' :limit='limit' :offset='offset' :uid='uid' :name='name' :mid='mid' :path="path" :gjc="gjc"></fy>
                </div>
            </div>
        </div>
        <foot></foot>
    </div>   
</template>

<style scoped>
    .hou{
        background: #f2fbf2;
    }
</style>

<script>
    import HomeHeader from '../components/HomeHeader'
    import Foot from '../components/Foot'
    import gdcul from '../components/gdcul'
    import fy from '../components/fy'
    export default{
        components: {  
            HomeHeader,Foot,gdcul,fy
        },
        data(){
            return{
                num: 0,
                limit: 5,
                offset:0,               
                ylj:"/Ym"+this.$route.query.mid,
                img:"",
                bt:[{name:"热门",cc:true},{name:"最新",cc:false},{name:"好友",cc:false}],
                lb:[],
                gjc:"热门",
                uid:-1,
                mid:-1,
                name:"",
                path:"/qbcp"
            }
        },
        methods:{
            //将后台传来的json数据渲染至相关dom
            hh(){
                this.offset=parseInt(this.$route.query.dp);
                this.uid=this.$route.query.uid;
                this.mid=this.$route.query.mid;
                this.name=this.$route.query.name;
                let data={'gjc':this.gjc,'uid':this.uid,'mid':this.mid,'ks':this.offset,'qq':this.offset+this.limit};
                this.$http.post('http://localhost/douban/pl/cp.php',data,{emulateJSON:true})
                .then((res)=>{
                    console.log(res);
                    this.num=res.body.data.gs;
                    this.img=res.body.data.img;
                    var sz=this.offset+this.limit;
                    if(sz>res.body.data.gs){
                        sz=res.body.data.gs-this.limit;
                    }
                    if(this.offset==0){
                        for(var i=0;i<sz;i++){
                            this.$set(this.lb,i,{lj:res.body.data.lj[i],name:res.body.data.name[i],sj:res.body.data.sj[i],fenshu:res.body.data.fenshu[i],content:res.body.data.content[i],hzs:res.body.data.hzs[i],mys:res.body.data.mys[i],biaoti:res.body.data.biaoti[i],xx:true,fold:true,up:res.body.data.up[i],down:res.body.data.down[i]});
                        }
                    }
                    else{
                        this.lb=[];
                        for(var i=0;i<sz;i++){
                            this.$set(this.lb,i,{lj:res.body.data.lj[i+this.limit],name:res.body.data.name[i+this.limit],sj:res.body.data.sj[i+this.limit],fenshu:res.body.data.fenshu[i+this.limit],content:res.body.data.content[i+this.limit],hzs:res.body.data.hzs[i+this.limit],mys:res.body.data.mys[i+this.limit],biaoti:res.body.data.biaoti[i+this.limit],xx:true,fold:true,up:res.body.data.up[i+this.limit],down:res.body.data.down[i+this.limit]});
                        }
                    }
                });
            },
            //长评排序方式
            dj(i){
                this.bt[i].cc=true;
                switch(i){
                    case (0):
                        this.bt[1].cc=false;
                        this.bt[2].cc=false;
                        this.gjc="热门";
                        break;
                    case (1):
                        this.bt[0].cc=false;
                        this.bt[2].cc=false;
                        this.gjc="最新";
                        break;
                    case (2):
                        this.bt[1].cc=false;
                        this.bt[0].cc=false;
                        this.gjc="好友";
                        break;                      
                }
                this.hh();
            }
        },
        created(){
            this.hh();
        },
        watch:{
            '$route':'hh'
        }
    }
</script>