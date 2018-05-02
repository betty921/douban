<template>
<!-- 根据相关检索条件检索电影页面 -->   
    <div class="contanier">  
        <home-header></home-header> 
        <div class="wrapper">
            <div class="side"></div>
            <div class="main"> 
                <h2 class="h2">选影视</h2>
                <div class="zheng">
                    <ul v-for="(item,index) in ul" :key="index" class="fl">
                        <li v-for="(items,index) in item.a" :class="{'hh':items.cc}">
                            <span :class="{'hou':items.cc}" :key="index" @click="dj(index,item.a)">{{items.name}}</span>
                        </li>
                    </ul>
                </div>
                <button v-for="(item,index) in bt" class="bt" :class="{'hou1':item.cc}" :key="index" @click="rm(index)">{{item.name}}</button>
                <xysdy :dy="dy"></xysdy>
                <div class="jzgd" v-show="aa">
                    <a class="gd" href="javascript:;" @click="jzgd">加载更多</a>
                </div>
            </div>
        </div>
        <foot></foot>
    </div>   
</template>
<style scoped>
	@import "../assets/css/fl.css";
</style>
<script>
    import HomeHeader from '../components/HomeHeader'
    import Foot from '../components/Foot'
    import xysdy from '../components/xysdy'
    export default{
        components: {  
            HomeHeader,Foot,xysdy
        },
        data(){
            return{
                ul:[{a:[{name:"热门",cc:true},{name:"经典",cc:false},{name:"豆瓣高分",cc:false},{name:"华语",cc:false},{name:"欧美",cc:false},{name:"韩国",cc:false},{name:"日本",cc:false},{name:"动作",cc:false},{name:"喜剧",cc:false},{name:"爱情",cc:false},{name:"科幻",cc:false},{name:"悬疑",cc:false},{name:"恐怖",cc:false},{name:"治愈",cc:false}]}],
                bt:[{name:"评价",cc:true},{name:"热门",cc:false},{name:"最新",cc:false}],
                dy:[],
                gjc:"评价",
                lx:"热门",
                aa:true,
                offset:0,
                limit:5
            }
        },
        methods:{   
            gg(){
                this.offset=0;
                this.dy=[];
                this.aa=true;
                let data = {'lx':this.lx,'gjc':this.gjc,'ks':this.offset,'js':this.offset+this.limit};
                this.$http.post('http://localhost/douban/pl/fl.php',data,{emulateJSON:true})
                    .then((res)=>{
                        console.log(res);
                        if(res.body.data.po==0){
                        	this.aa=false;
                    	}
                        if(res.body.data.gs==0){
                            this.aa=false;
                        }
                        else{
                        	for(var i=0;i<this.limit;i++){
                            	this.$set(this.dy,i,{lj:"Ym"+res.body.data.mid[i],name:res.body.data.name[i],fs:res.body.data.fen[i],img:res.body.data.img[i]});
                        	}
                        	this.offset+=this.limit;
                        }
                    });
            },       
            dj(i,b){
                for(var j=0;j<b.length;j++){
                    b[j].cc=false;
                }
                b[i].cc=true;
                this.lx=b[i].name;
                this.gg();
            },
            jzgd(){
                let data = {'lx':this.lx,'gjc':this.gjc,'ks':this.offset,'js':this.limit+this.offset};
                this.$http.post('http://localhost/douban/pl/fl.php',data,{emulateJSON:true})
                .then((res)=>{
                    console.log(res);
                    if(res.body.data.po==0){
                        this.aa=false;
                    }
                    for(var i=this.offset;i<this.offset+this.limit;i++){
                        this.$set(this.dy,i,{lj:"Ym"+res.body.data.mid[i],name:res.body.data.name[i],fs:res.body.data.fen[i],img:res.body.data.img[i]});
                    }
                    this.offset+=this.limit;
                });
            },
            rm(i){
                this.bt[i].cc=true;
                switch(i){
                    case (0):
                        this.bt[1].cc=false;
                        this.bt[2].cc=false;
                        this.gjc='评价';
                        break;
                    case (1):
                        this.bt[0].cc=false;
                        this.bt[2].cc=false;
                        this.gjc='热门';
                        break; 
                    case (2):
                        this.bt[0].cc=false;
                        this.bt[1].cc=false;
                        this.gjc='最新';
                        break;                     
                }
                this.gg(); 
            },
        },
        created(){
            this.gg();
        }
    }
</script>