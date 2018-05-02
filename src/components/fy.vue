<template>  
<!-- 分页组件 -->
    <div class="container" :num='num' :limit='limit' :offset='offset' :uid='uid' :name='name' :mid='mid' :path="path" :gjc="gjc">
    <div class="qyhy">
        <span class="prev next" v-if="prePage" @click="qy"><前页</span>
        <span v-else class="prev"><前页</span>
        <ul>
            <li v-for="(i, index) in showPageBtn" :key="index" :class="{active: i === currentPage, pointer:  i && i !== currentPage, hover: i && i !== currentPage}" @click="zy(index)">
                <span v-if="i" class="notPointer">{{i}}</span>
                <span v-else>···</span>
            </li>
        </ul>
        <span class="prev next" v-if="nextPage" @click="hy">后页></span>
        <span v-else class="prev">后页></span>
    </div>
    </div>
</template>

<style scoped>
    @import "../assets/css/fy.css";
</style>

<script>
    export default{
        props: ['num','limit','offset','uid','name','mid','path','gjc'],
        computed: {
            prePage() {
                return this.offset !== 0 && this.num
            },
            nextPage() {
                return (this.offset + this.limit < this.num) && this.num
            },
            totalPage () {
                return Math.ceil(this.num / this.limit)
            },
            currentPage () {
                return Math.ceil(this.offset / this.limit) + 1
            },
            showPageBtn() {
                let pageNum = this.totalPage,
                    index = this.currentPage,
                    arr = []
                if (pageNum <= 5) {
                    for(let i = 1; i <= pageNum; i++) {
                        arr.push(i)
                    }
                    return arr
                }
                if (index <= 2) return [1,2,3,0,pageNum]
                if (index >= pageNum -1) return [1,0, pageNum -2, pageNum -1, pageNum]
                if (index === 3) return [1,2,3,4,0,pageNum]
                if (index === pageNum -2) return [1,0, pageNum-3, pageNum-2, pageNum-1, pageNum]
                return [1,0, index-1, index, index + 1, 0, pageNum]
            }
        },
        methods:{
            hy(){
                this.$router.push({path:this.path,query:{gjc:this.gjc,name:this.name,mid:this.mid,uid:this.uid,dp:parseInt(this.offset)+this.limit}});
            },
            qy(){
                this.$router.push({path:this.path,query:{gjc:this.gjc,name:this.name,mid:this.mid,uid:this.uid,dp:parseInt(this.offset)-this.limit}});
            },
            zy(i){
                this.$router.push({path:this.path,query:{gjc:this.gjc,name:this.name,mid:this.mid,uid:this.uid,dp:i*this.limit}});
            }
        }
    }
</script>