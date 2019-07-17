<template>
    <v-app>
        <v-content>
            <v-toolbar
                color="primary"
                dark
            >
                <v-toolbar-title class="pr-2">
                    <v-btn
                        text
                        @click="onHome"
                        tile
                    >
                        {{ title }}
                    </v-btn>
                </v-toolbar-title>
                <v-divider vertical />
                <v-spacer />
                <v-toolbar-items class="hidden-sm-and-down">
                    <v-btn
                        v-for="item in nav"
                        :key="item.path"
                        text
                        :to="item.path"
                    >
                        <v-icon v-if="item.icon">
                            {{ item.icon }}
                        </v-icon>
                        {{ item.title }}
                    </v-btn>
                </v-toolbar-items>
                <v-spacer />
                <v-toolbar-items class="">
                    <v-btn
                        target="_blank"
                        rel="noopener noreferrer"
                        href="https://github.com/egor-muindor/"
                    >
                        <v-icon>{{ icons.mdiGithubBox }}</v-icon>
                        Github
                    </v-btn>
                </v-toolbar-items>
            </v-toolbar>
            <gdpr-banner />
            <router-view />
        </v-content>
        <v-footer padless>
            <v-flex
                text-xs-center
                xs12
            >
                {{ new Date().getFullYear() }} — <strong>Egor Muindor Fadeev</strong>
            </v-flex>

        </v-footer>

    </v-app>
</template>

<script>
import { mapState } from 'vuex';
import { mdiGithubBox } from '@mdi/js';

export default {
    computed: {
        ...mapState(['nav']),
        title: function () {
            return this.$store.state.app.title;
        }
    },
    data () {
        return {
            icons: {
                mdiGithubBox: mdiGithubBox
            },
            active: null
        };
    },
    methods: {
        onHome: function () {
            this.$router.push('/');
        }
    },
    beforeCreate () {
        let gdpr = this.$cookie.get('GDPR');
        if (gdpr === 'true') {
            this.$store.commit('updateGDPR', true);
        } else {
            this.$store.commit('updateGDPR', false);
        }
    }
};
</script>
