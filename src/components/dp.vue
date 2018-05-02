<template>   
<!-- 电影详情页的短评组件 -->
    <div class="contanier" :mid="mid" :uid="uid">   
        <div v-show="xsm">
            <h2 class="lv" :name="name">{{name}}的短评· · · · · ·</h2>
            <button v-for="(item,index) in bt" class="bt" :class="{'hou':item.cc}" :key="index" @click="dj(index)">{{item.name}}</button>
            <div v-if="xsf==1" class="lb">
                <dpul :lb="lb" :uid="uid"></dpul>
                <a href="javascript:;" class="show" @click="gd" v-show="qbdp">>更多短评{{gs}}条</a>
            </div>
            <div v-else class="wbc">该电影暂无短评</div>
        </div>
    </div>   
</template>

<style scoped>
.hou{
    background: #f2fbf2;
}
.wbc{
    border: 1px solid #aaffaa;
    background: #f2fbf2;
    border-left: 0;
    border-right: 0;
    text-align: center;
    padding: 4px 0 3px;
    color: #494949;
    margin: 15px 0;
}
</style>

<script>
    import {setCookie,getCookie} from '../assets/cookie.js'
    import dpul from './dpul'
    export default{
        components: {  
            dpul
        },
        props: ['name','mid','uid'],
        data(){
            return{
                xsm:true,
                qbdp:false,
                xsf:1,
                gs:"",
                bt:[{name:"热门",cc:true},{name:"最新",cc:false},{name:"好友",cc:false}],
                lb:[],
                gjc:"热门",
            }
        },
        methods:{
            //短评按热门或是最新排序
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
            },
            //该电影短评超过电影详情页长评限制数，点击至该电影全部短评页面
            gd(){
                this.$router.push({path:'/qbdp',query:{gjc:'热门',name:this.name,mid:this.mid,uid:this.uid,dp:0}});
            },
            //将后台传来的数据呈现在页面
            hh(){
                let data={'gjc':this.gjc,'mid':this.mid,'ks':0,'qq':5};
                this.$http.post('http://localhost/douban/pl/dp.php',data,{emulateJSON:true})
                .then((res)=>{
                    console.log(res);
                    if(res.body.data.post==0){
                        this.xsf=2;
                    } 
                    else{
                        this.xsf=1;
                        if(res.body.data.gs<6){
                        for(var i=0;i<res.body.data.gs;i++){
                            this.$set(this.lb,i,{lj:res.body.data.lj[i],name:res.body.data.name[i],sj:res.body.data.sj[i],fenshu:res.body.data.fenshu[i],content:res.body.data.content[i],hzs:res.body.data.hzs[i],xx:true});
                        }
                        }
                        else{
                            for(var i=0;i<5;i++){
                                this.$set(this.lb,i,{lj:res.body.data.lj[i],name:res.body.data.name[i],sj:res.body.data.sj[i],fenshu:res.body.data.fenshu[i],content:res.body.data.content[i],hzs:res.body.data.hzs[i],xx:true});
                            }
                            this.qbdp=true;
                            this.gs=res.body.data.gs;
                        }
                    }     
                });
            }
        },
        created(){
            this.hh();
        }
    }
</script>