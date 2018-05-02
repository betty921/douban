<template>   
<!-- 按照关键词检索相关电影页面 --> 
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
                ul:[{a:[{name:"全部类型",cc:true},{name:"剧情",cc:false},{name:"喜剧",cc:false},{name:"动作",cc:false},{name:"爱情",cc:false},{name:"科幻",cc:false},{name:"悬疑",cc:false},{name:"惊悚",cc:false},{name:"恐怖",cc:false},{name:"犯罪",cc:false},{name:"同性",cc:false},{name:"音乐",cc:false},{name:"歌舞",cc:false},{name:"传记",cc:false},{name:"历史",cc:false},{name:"战争",cc:false},{name:"西部",cc:false},{name:"奇幻",cc:false},{name:"冒险",cc:false},{name:"灾难",cc:false},{name:"武侠",cc:false},{name:"情色",cc:false}]},{a:[{name:"全部地区",cc:true},{name:"中国大陆",cc:false},{name:"美国",cc:false},{name:"香港",cc:false},{name:"台湾",cc:false},{name:"日本",cc:false},{name:"韩国",cc:false},{name:"英国",cc:false},{name:"法国",cc:false},{name:"德国",cc:false},{name:"意大利",cc:false},{name:"西班牙",cc:false},{name:"印度",cc:false},{name:"泰国",cc:false},{name:"俄罗斯",cc:false},{name:"伊朗",cc:false},{name:"加拿大",cc:false},{name:"澳大利亚",cc:false},{name:"爱尔兰",cc:false},{name:"瑞典",cc:false},{name:"巴西",cc:false},{name:"丹麦",cc:false}]},{a:[{name:"全部特色",cc:true},{name:"经典",cc:false},{name:"青春",cc:false},{name:"文艺",cc:false},{name:"搞笑",cc:false},{name:"励志",cc:false},{name:"魔幻",cc:false},{name:"感人",cc:false},{name:"女性",cc:false},{name:"黑帮",cc:false}]}],
                bt:[{name:"评价",cc:true},{name:"热门",cc:false},{name:"最新",cc:false}],
                dy:[],
                lx:"全部类型",
                dq:"全部地区",
                ts:"全部特色",
                gjc:"评价",
                aa:true,
                offset:0,
                limit:5
            }
        },
        methods:{ 
            //将后台传来的json数据渲染至相关dom  
            gg(){
                this.offset=0;
                this.dy=[];
                this.aa=true;
                let data = {'lx':this.lx,'dq':this.dq,'ts':this.ts,'gjc':this.gjc,'ks':this.offset,'js':this.offset+this.limit};
                this.$http.post('http://localhost/douban/pl/xys.php',data,{emulateJSON:true})
                    .then((res)=>{
                        console.log(res);
                        if(res.body.data.po==0){
                        this.aa=false;
                    }
                        if(res.body.data.gs==0){
                            this.aa=false;
                        }else{
                        for(var i=0;i<this.limit;i++){
                            this.$set(this.dy,i,{lj:"Ym"+res.body.data.mid[i],name:res.body.data.name[i],fs:res.body.data.fen[i],img:res.body.data.img[i]});
                        }
                        this.offset+=this.limit;
                        }
                    });
            },
            //排序方式       
            dj(i,b){
                for(var j=0;j<b.length;j++){
                    b[j].cc=false;
                }
                b[i].cc=true;
                if(b==this.ul[0].a){
                    this.lx=b[i].name;
                }
                if(b==this.ul[1].a){
                    this.dq=b[i].name;
                }
                if(b==this.ul[2].a){
                    this.ts=b[i].name;
                }
                this.gg();
            },
            //异步加载更多
            jzgd(){
                let data = {'lx':this.lx,'dq':this.dq,'ts':this.ts,'gjc':this.gjc,'ks':this.offset,'js':this.limit+this.offset};
                this.$http.post('http://localhost/douban/pl/xys.php',data,{emulateJSON:true})
                .then((res)=>{
                    console.log(res);
                    if(res.body.data.po==0){
                        this.aa=false;
                    }
                    for(var i=this.offset;i<this.offset+this.limit;i++){
                        this.$set(this.dy,i,{lj:"Ym"+res.body.data.mid[i],name:res.body.data.name[i],fs:res.body.data.fen[i],img:res.body.data.img[i]});
                    }
                    this.offset+=this.limit;
                })
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