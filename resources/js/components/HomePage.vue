<template>
    <div>
        <header class="uk-content-header uk-background-default">
            <div class="title">
                <h2>Главная страница</h2>
            </div>
        </header>
        <div class="uk-margin-top">
            <div class="uk-margin-top">
                <ul class="media-grid">
                    <li>
                        <article class="uk-comment uk-textarea uk-position-relative">
                            <header class="uk-comment-header uk-question-grid">
                                <div>
                                    <h4 class="uk-comment-title uk-margin-remove">
                                        <a href="/admin/product" title="Товаров на сайте"
                                           class="uk-link-reset">Товаров</a>
                                    </h4>
                                    <ul class="uk-comment-meta uk-list uk-child-padding-remove">
                                        <li><a href="#" title="Количество изображений: 0" class="uk-link-muted">
                                            Количество:<strong>0</strong></a></li>
                                    </ul>
                                </div>
                                <div class="uk-comment-footer uk-padding-small">
                                    <a href="/admin/media_list/icon" title="Добавить товар"
                                       class="uk-button uk-button-primary">
                                        <span uk-icon="plus"></span>
                                    </a>
                                </div>
                            </header>
                            <div class="uk-comment-body uk-position-relative">
                                <hr>
                                <p class="uk-padding-small uk-padding-remove-top"></p></div>
                        </article>
                    </li>
                    <li>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        }
    }
</script>
