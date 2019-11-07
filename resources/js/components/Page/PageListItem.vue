<template>
	<article class="uk-comment uk-textarea uk-position-relative">
		<header class="uk-comment-header uk-question-grid">
			<div>
				<h4 class="uk-comment-title uk-margin-remove">
					<a :href="'/admin/page/single/'+item.id" class="uk-link-reset">{{item.title}}</a>
				</h4>
				<ul class="uk-comment-meta uk-list uk-child-padding-remove">
					<li>
						<a class="uk-link-muted" href="#">
							ID:<strong>{{item.id}}</strong>
						</a>
					</li>
					<li>
						<a class="uk-link-muted" href="#">
							<span>Отредактировано:</span>
							<strong>{{item.bk_update_dt}}</strong>
						</a>
					</li>
				</ul>
			</div>
			<div class="uk-comment-footer uk-padding-small" :class="classObject">
				<a class="uk-button uk-button-default uk-background-muted uk-button-secondary" :href="'/admin/page/edit/'+item.id">
					<span class="uk-text-success" uk-icon="file-edit"></span>
				</a>
				<button @click="del(item)" class="uk-button uk-button-danger">
					<span uk-icon="trash"></span>
				</button>
			</div>
		</header>
		<div class="uk-comment-body uk-position-relative">
			<span v-if="item.lock" class="uk-overlay-primary uk-background-primary uk-padding-small uk-position-top-center uk-width-1-1" :title="item.lock.name+' сейчас редактирует эту запись'">
					<i uk-icon="pencil" class="uk-margin-small-right"></i>
					{{item.lock.name}}
			</span>
			<hr>
			<p class="uk-padding-small uk-padding-remove-top" v-html="item.announce"></p>
		</div>
	</article>
</template>

<script>
    export default {
        props: {
            item: {
                type: Object,
                required: true
            }
        },
        data() {
            return {}
        },
        computed: {
            classObject: function () {
                return {
                    'uk-status-unpublished': this.item.status == 'unpublished',
                    'uk-status-published': this.item.status == 'published',
                    'uk-status-ready': this.item.status == 'ready',
                    'uk-status-new': this.item.status == 'new',
                    'uk-status-editing': this.item.status == 'editing',
                    'uk-status-deleted': this.item.status == 'deleted',
                    'uk-status-hidden': this.item.status == 'hidden',
                    'uk-status-planned': this.item.status == 'planned'
                }
            }
        },
        methods: {
			del:function () {
                this.$emit('Delete', this.item);
            }
        }
    }
</script>
