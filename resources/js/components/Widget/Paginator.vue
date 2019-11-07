<template>
	<ul class="uk-pagination uk-flex-center" v-if="list" uk-margin>
		<li><a v-if="current_page!=1" :href="''+path+''+(current_page-1)+(rubric_id?'/'+rubric_id:'')"><span uk-pagination-previous></span></a></li>
		<li v-if="current_page>3"><a :href="''+path+'1'+(rubric_id?'/'+rubric_id:'')" >1</a></li>
		<li v-if="current_page>3" class="uk-disabled"><span>...</span></li>
		<li v-for="item in list" :class="{'uk-active':item==current_page}"><a :href="''+path+''+item+(rubric_id?'/'+rubric_id:'')">{{item}}</a></li>
		<li><a :href="''+path+''+(current_page+1)+(rubric_id?'/'+rubric_id:'')"><span uk-pagination-next></span></a></li>
	</ul>
</template>

<script>
    export default {
        props: {
            list:null,
            current_page:{
                type:Number
			},
			path:{},
            rubric_id:{},

        },
        data() {
            return {}
        },
    }
</script>