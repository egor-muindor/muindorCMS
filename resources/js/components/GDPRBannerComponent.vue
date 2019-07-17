<template>
    <v-dialog
        v-model="dialog"
        persistent
        max-width="450"
    >
        <v-card>
            <v-card-title class="headline">
                Внимание
            </v-card-title>
            <v-card-text>
                <p>
                    Этот сайт использует куки-файлы и другие технологии, чтобы помочь вам в навигации, а также
                    предоставить лучший пользовательский опыт.
                </p>
                <p v-if="disagree">
                    <strong>Вы уверены?</strong>
                </p>
            </v-card-text>
            <v-card-actions>
                <v-spacer />
                <v-btn
                    v-if="!disagree"
                    color="error"
                    text
                    @click="disagree = true"
                >
                    Отклонить
                </v-btn>
                <v-btn
                    v-else
                    color="error"
                    text
                    @click="onDisagree"
                >
                    Покинуть сайт
                </v-btn>
                <v-btn
                    color="success"
                    text
                    @click="onAgree"
                >
                    Принять
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: 'GDPRBannerComponent',
    data () {
        return {
            disagree: false,
            dialog: false
        };
    },
    mounted () {
        this.dialog = !(this.$cookie.get('GDPR') === 'true');
    },
    methods: {
        onDisagree: function () {
            window.location.href = 'https://google.com';
        },
        onAgree: function () {
            this.dialog = false;
            this.$cookie.set('GDPR', true, { expires: '1M' });
            this.$store.commit('updateGDPR', true);
        }
    }
};
</script>

<style scoped>

</style>
