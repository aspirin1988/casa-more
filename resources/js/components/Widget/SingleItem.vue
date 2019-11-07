<template>
	<strong class="uk-width-1-1" v-html="data || 'Не назначено'"></strong>
</template>

<script>
    export default {
        props: ['data'],
        data() {
            return {}
        },
    }
</script>

<style>
	iframe{
		width: 100%;
	}
</style>