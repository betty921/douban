<template>
<!-- 选影视的电影列表 -->
    <div class="container" :dy="dy">
        <div class="dy">
            <ul>
                <li v-for="(item,index) in dy">
                    <router-link :to="item.lj" style="font-size:0px;"><img :src="item.img" width="115px" height="165px" style="display:block;"></router-link>
                    <div style="width:115px;"><router-link :to="item.lj">{{item.name}}</router-link></div>
                    <span style="display:block;color:#ffac2d;">{{item.fs}}</span>
                </li>
            </ul>
        </div>
    </div>
</template>
<style scoped>
.dy{
    margin:15px 0;
}
.dy li{
    display:inline-block;
    padding:0 10px;
    text-align:center;
    vertical-align:middle;
}
</style>
<script>
    export default{
        props: ['dy']
    }
</script>