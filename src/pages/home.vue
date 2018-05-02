<template>   
        <!-- 主页 --> 
    <div class="contanier">   
        <home-header></home-header> 
        <div class="wrapper">
            <div class="side"></div>
            <div class="main">
                <h2 class="lv">更多<span class="lvnei">(<router-link :to="luyou" class="link">更多</router-link>)</span><div class="side-control">
                    <div class="side-dots">
                        <div v-for="index in geshu" class="dot" :class="{ 'active':index==1 }" :data-index="index" :key="index"></div>
                    </div>
                    <span class="side-btn">
                        <div  class="prev"><</div>
                        <div  class="next">></div>
                    </span>
                </div></h2> 
                <div class="slide"> 
                    <div class="slideshow" style="width: 4050px;left: -675px">
                        <vm-ul v-for="(haha,index) in itemss" :items="haha.items" :key="index"></vm-ul>
                    </div>
                </div>
            </div>
        </div>
        <foot></foot>
    </div>   
</template>  
<style scoped>  
    @import "../assets/css/home.css";
</style>  

<script>  
    // 导入要用到的子组件  
    import HomeHeader from '../components/HomeHeader'   
    import Foot from '../components/Foot'
    import List from '../components/List'
    import VmUl from '../components/VmUl'
    import {a} from '../assets/a.js'
    import {setCookie,getCookie} from '../assets/cookie.js'
    export default {  
        data () {  
            return { 
                name: "更多",
                luyou: "/detail", 
                mark: 0,
                geshu:[1,2,3,4],
                itemss:[
                    {items: [  
                        { luyou: "/1", name: "大学", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2512983475.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "中庸", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2506889386.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "论语", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2515018270.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "孟子", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2507709428.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "道德经", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2508926717.jpg", fenshu: "x3", fen: "8.8" },
                        { luyou: "/detail", name: "大学", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2512983475.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "中庸", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2506889386.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "论语", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2515018270.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "孟子", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2507709428.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "道德经", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2508926717.jpg", fenshu: "x3", fen: "8.8" },   
                    ]},
                    {items: [  
                        { luyou: "", name: "", img: "", fenshu: "", fen: "" },  
                        { luyou: "", name: "", img: "", fenshu: "", fen: "" },  
                        { luyou: "", name: "", img: "", fenshu: "", fen: "" },  
                        { luyou: "", name: "", img: "", fenshu: "", fen: "" },  
                        { luyou: "", name: "", img: "", fenshu: "", fen: "" }, 
                        { luyou: "", name: "", img: "", fenshu: "", fen: "" },  
                        { luyou: "", name: "", img: "", fenshu: "", fen: "" },  
                        { luyou: "", name: "", img: "", fenshu: "", fen: "" },  
                        { luyou: "", name: "", img: "", fenshu: "", fen: "" },  
                        { luyou: "", name: "", img: "", fenshu: "", fen: "" }
                    ]},
                    {items: [  
                        { luyou: "/detail", name: "大学", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2507709428.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "中庸", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2506889386.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "论语", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2515018270.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "孟子", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2507709428.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "道德经", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2508926717.jpg", fenshu: "x3", fen: "8.8" }, 
                        { luyou: "/detail", name: "大学", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2512983475.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "中庸", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2506889386.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "论语", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2515018270.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "孟子", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2507709428.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "道德经", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2508926717.jpg", fenshu: "x3", fen: "8.8" }, 
                    ]},
                    {items: [  
                        { luyou: "/detail", name: "大学", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2512983475.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "中庸", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2506889386.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "论语", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2515018270.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "孟子", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2507709428.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "道德经", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2508926717.jpg", fenshu: "x3", fen: "8.8" },
                        { luyou: "/detail", name: "大学", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2512983475.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "中庸", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2506889386.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "论语", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2515018270.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "孟子", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2507709428.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "道德经", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2508926717.jpg", fenshu: "x3", fen: "8.8" },   
                    ]},
                    {items: [  
                        { luyou: "/detail", name: "大学", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2512983475.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "中庸", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2506889386.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "论语", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2515018270.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "孟子", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2507709428.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "道德经", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2508926717.jpg", fenshu: "x3", fen: "8.8" },
                        { luyou: "/detail", name: "大学", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2512983475.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "中庸", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2506889386.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "论语", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2515018270.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "孟子", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2507709428.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "道德经", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2508926717.jpg", fenshu: "x3", fen: "8.8" },   
                    ]},
                    {items: [  
                        { luyou: "/detail", name: "大学", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2512983475.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "中庸", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2506889386.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "论语", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2515018270.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "孟子", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2507709428.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "道德经", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2508926717.jpg", fenshu: "x3", fen: "8.8" },
                        { luyou: "/detail", name: "大学", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2512983475.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "中庸", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2506889386.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "论语", img: "https://img3.doubanio.com/view/photo/s_ratio_poster/public/p2515018270.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "孟子", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2507709428.jpg", fenshu: "x3", fen: "8.8" },  
                        { luyou: "/detail", name: "道德经", img: "https://img1.doubanio.com/view/photo/s_ratio_poster/public/p2508926717.jpg", fenshu: "x3", fen: "8.8" },   
                    ]}
                ]
            }  
        },
        // 在components字段中，包含导入的子组件  
        components: {  
            HomeHeader,Foot,List,VmUl
        },
        created(){
            //后台传来的json数据呈现至页面
            this.$http.get('http://localhost/douban/pl/zy.php')
            .then((res)=>{
                console.log(res);
                for(var i=0;i<10;i++){
                    this.itemss[1].items[i].luyou="/Ym"+res.body.data.mid[i];
                    this.itemss[1].items[i].name=res.body.data.name[i];
                    this.itemss[1].items[i].img=res.body.data.img[i];
                    this.itemss[1].items[i].fenshu=res.body.data.xx[i];
                    this.itemss[1].items[i].fen=res.body.data.fs[i];
                }
                this.itemss[1].items[0].name="那些年";
            });
            $(function(){
                a();
            });
        }  
    } 
    
</script> 