<template>
<!-- 电影详情页的电影分值情况 -->
<div class="container" :xsf="xsf">
	<span class="zi">豆瓣评分</span>
	<div v-if="xsf===1">
		<div class="you" :xx="xx" :rs="rs"><div :class="xx" class="rating"></div><div>{{rs}}人评价</div></div>
		<div class="fs" :fz="fz">{{fz}}</div>
		<div :fs="fs">
			<div v-for="(item,index) in fs"><span>{{item.x}}</span><div class="h" :style="item.kd"></div><span>{{item.bfb}}</span></div>
		</div>
	</div>
	<div v-else>
		<div class="xx00 rating"></div>
		<span>暂无评分</span>
	</div>
</div>
</template>

<style scoped>
@import "../assets/css/pf.css";	
</style>

<script>
	export default{
		props: ['fs','xx','rs','fz','xsf']
	}
</script>
