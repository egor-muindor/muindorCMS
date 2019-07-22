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
                        tile
                        @click="onHome"
                    >
                        {{ title }}
                    </v-btn>
                </v-toolbar-title>
                <v-divider vertical />
                <v-spacer />
                <v-toolbar-items class="hidden-sm-and-down">
                    <v-btn
                        v-for="item in nav"
                        v-if="item.auth === auth.status || item.auth === 'both'"
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
                <v-divider vertical />
                <v-toolbar-items>
                    <v-btn
                        v-for="item in authRoutes"
                        v-if="item.auth === auth.status || item.auth === 'both'"
                        :key="item.name"
                        text
                        :to="{ name: item.name }"
                    >
                        <v-icon v-if="item.icon">
                            {{ item.icon }}
                        </v-icon>
                        {{ item.title }}
                    </v-btn>


                    <v-menu
                        v-if="auth.status === 'auth' || auth.status === 'admin'"
                        offset-y
                        open-on-hover
                    >
                        <template v-slot:activator="{on}">
                            <v-btn
                                text
                                dark
                                v-on="on"
                            >
                                {{ auth.name }}
                            </v-btn>
                        </template>

                        <v-list>
                            <v-list-item
                                v-for="item in profileNav"
                                :key="item.name"
                                @click="onClick(item)"
                            >
                                {{ item.title }}
                            </v-list-item>
                            <v-list-item
                                @click="logout()"
                            >
                                Выйти
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </v-toolbar-items>
            </v-toolbar>
            <gdpr-banner />
            <router-view />
        </v-content>
        <v-footer padless>
            <v-flex
                text-center
                xs12
            >
                {{ new Date().getFullYear() }} — <strong>Egor 'Muindor' Fadeev</strong>
                <a href="https://github.com/egor-muindor">
                    <v-icon>{{ icons.mdiGithubBox }}</v-icon>
                </a>
            </v-flex>
        </v-footer>
    </v-app>
</template>

<script>
import { mapState } from 'vuex';
import { mdiGithubBox } from '@mdi/js';
import Auth from '../helpers/Auth';

export default {
    computed: {
        ...mapState(['nav', 'authRoutes', 'profileNav']),
        auth () {
            return this.$store.state.Auth;
        },
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
    created () {
        Auth.init();
    },
    beforeCreate () {
        if (this.$store.state.app.GDPR_enable) {
            let gdpr = this.$cookie.get('GDPR');
            if (gdpr === 'true') {
                this.$store.commit('updateGDPR', true);
            } else {
                this.$store.commit('updateGDPR', false);
            }
        }
    },
    methods: {
        onHome: function () {
            this.$router.push('/');
        },
        onClick: function (item) {
            this.$router.push(item.path);
            return true;
        },
        logout: function () {
            axios.post('/api/logout').then(response => {
                if (response.data.success) {
                    Auth.logout();
                    this.$router.push('/');
                }
            });
        }
    }
};
</script>
