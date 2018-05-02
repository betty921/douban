<template>
<!-- 电影详情页的电影详细相关信息 -->
	<ul :xb="xb">
		<li v-for="(item,index) in xb" :key="index"><span class="p1">{{item.name}}：<span v-for="(itemm,index) in item.nr" :key="index">{{itemm}}</span></span></li><br/>
	</ul>
</template>
<style>
	.pl{
		margin-top: 10px;
		margin-bottom: 5px;
	}
	.p1 span{
		margin: 0 3px;
		color: black;
	}
	li{
		margin-bottom: 4px;
	}
</style>

<script>
	export default{
		props: ['xb'],
	}
</script>