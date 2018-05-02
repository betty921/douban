<template>
<!-- 轮播控制组件 -->
	<h2 class="lv">{{ name }}<span class="lvnei">(<router-link :to="luyou" class="link">更多</router-link>)</span>
    <div class="side-control">
        <div class="side-dots">
            <div v-for="index in geshu" class="dot" :class="{ 'active':index==1 }" :data-index="index" :key="index"></div>
        </div>
        <span class="side-btn">
            <div  class="prev"><</div>
            <div  class="next">></div>
        </span>
    </div></h2>
</template>

<style scoped>
	@import "../assets/css/dot.css";
</style>

<script>
	export default{
		props: ['luyou','name']
	}
</script>