<template>
<!-- 电影短评组件 -->
    <div class="container" :lb="lb" :uid="uid">
        <ul class="lbul">
            <li v-for="(item,index) in lb" :key="index" v-show="item.xx">
                <div style="float:right;"><i style="color:#e09015;margin-right:5px;vertical-align:2px;">{{item.hzs}}</i><a herf="javascript:;" style="cursor:pointer" @click="yy(item.lj,index)">有用</a></div>
                <router-link to="" class="lp_li_a">{{item.name}}</router-link>
                <span class="xing" :class="item.fenshu"></span><span class="sj">{{item.sj}}</span>
                <p>{{item.content}}</p>
            </li>
        </ul>
    </div>
</template>
<style scoped>
    @import "../assets/css/plgy.css";
    @import "../assets/css/xiaox.css";
</style>
<script>
    export default{
        props: ['lb','uid'],
        methods:{
            //对相应短评进行投票，投过一次便不能再投
            yy(a,i){
                if(this.uid!=-1){
                    let data={'cid':a,'uid':this.uid};
                    this.$http.post('http://localhost/douban/pl/yy.php',data,{emulateJSON:true})
                    .then((res)=>{
                        console.log(res);
                        if(res.data.post==0){
                            alert("这条短评您已经投过票了");
                        }
                        else{
                            this.lb[i].hzs=res.data.hz;
                        }
                    });
                }
            }
        }
    }
</script>  