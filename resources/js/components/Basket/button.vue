<template>
    <a href="/cart/" class="item-header-right cart" :class="{'active':count}">

    </a>
</template>

<script>
    export default {
        data() {
            return {
                count:0
            }
        },
        mounted() {
            setInterval(this.getCount,300);
        },
        methods: {
            getCount:function () {
                let  data = localStorage.getItem('basket');
                data = JSON.parse(data);
                if(data){
                    this.count = data.length;
                }else{
                    this.count = 0;
                }
                // console.log(data);
            }
        },
    }
</script>
