<template>
    <div>
        <p>Поделиться:</p>
        <social-sharing :url="url"
                        :title="getTitle()"
                        :description="getTitle()"
                        :quote="getTitle()"
                        :hashtags="'www.laguna-parfumes.kz'"
                        inline-template>
            <div class="share_grid">
                <network network="facebook">
                    <i class="fa fa-facebook"></i>
                </network>
                <network network="twitter">
                    <i class="fa fa-twitter"></i>
                </network>
                <network network="vk">
                    <i class="fa fa-vk"></i>
                </network>
                <network network="odnoklassniki">
                    <i class="fa fa-odnoklassniki"></i>
                </network>
                <network network="telegram">
                    <i class="fa fa-telegram"></i>
                </network>
                <network network="whatsapp">
                    <i class="fa originfa-whatsapp"></i>
                </network>
                <network network="email">
                    <i class="fa fa-envelope"></i>
                </network>
            </div>
        </social-sharing>
    </div>
</template>

<script>
    export default {
        props: ['title'],
        data() {
            return {
                url: location.href,
            }
        },

        methods: {
            getTitle:function () {
                return this.title.replace("'", '')
            }
        }
    }
</script>
