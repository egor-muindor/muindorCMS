<template>
    <v-app>
        <v-navigation-drawer v-model="show" app>
            <v-list>

                <v-list-group v-if="auth.status === 'guest'" no-action class="hidden-md-and-up">
                    <template v-slot:activator>
                        <v-list-item-content>
                            <v-list-item-title>Авторизация</v-list-item-title>
                        </v-list-item-content>
                    </template>
                    <v-list-item
                        v-for="item in authRoutes"
                        v-if="item.auth === auth.status || item.auth === 'both' && (!(auth.admin ^ item.admin) ||
                            auth.admin)"
                        :key="item.name"
                        :to="{ name: item.name }"
                    >
                        <v-list-item-icon v-if="item.icon">
                            <v-icon>
                                {{ item.icon }}
                            </v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>
                            {{ item.title }}
                        </v-list-item-title>
                    </v-list-item>
                </v-list-group>

                <v-list-group v-if="auth.status === 'auth'" no-action>
                    <template v-slot:activator>
                        <v-list-item>
                            <v-list-item-avatar>
                                <v-img src="https://randomuser.me/api/portraits/men/78.jpg"></v-img>
                            </v-list-item-avatar>
                            <v-list-item-title>
                                <v-list-item-title>{{ auth.name }}</v-list-item-title>
                            </v-list-item-title>
                        </v-list-item>
                    </template>
                    <v-list-item
                        v-for="item in profileNav"
                        v-if="!(auth.admin ^ item.admin) || auth.admin"
                        :key="item.name"
                        :to="{ name: item.name }"
                    >
                        <v-list-item-title>
                            {{ item.title }}
                        </v-list-item-title>
                    </v-list-item>
                    <v-list-item
                        color="red"
                        @click="logout()"
                    >
                        <v-list-item-title>
                            Выйти
                        </v-list-item-title>
                    </v-list-item>
                </v-list-group>

                <v-divider v-if="auth.status === 'guest'" class="hidden-md-and-up" />
                <v-divider v-else />

                <v-list-item
                    v-for="item in nav"
                    v-if="(item.auth === auth.status || item.auth === 'both') &&
                        (!(auth.admin ^ item.admin) || auth.admin)"
                    :key="item.name"
                    :to="(item.name !== undefined) ? { name: item.name } : item.path"
                    link
                >
                    <v-list-item-icon>
                        <v-icon v-if="item.icon">
                            {{ item.icon }}
                        </v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>
                            {{ item.title }}
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar
            app dark short
            flat color="primary"
        >
            <v-app-bar-nav-icon @click="show = !show" />
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
                    v-for="item in authRoutes"
                    v-if="item.auth === auth.status || item.auth === 'both' && (!(auth.admin ^ item.admin) ||
                        auth.admin)"
                    :key="item.name"
                    text
                    :to="{ name: item.name }"
                >
                    <v-icon v-if="item.icon">
                        {{ item.icon }}
                    </v-icon>
                    {{ item.title }}
                </v-btn>
            </v-toolbar-items>
        </v-app-bar>

        <gdpr-banner />

        <v-content>
            <v-container fluid>
                <router-view />
            </v-container>
        </v-content>

        <v-footer
            app inset padless
            dark absolute
        >
            <v-flex text-center xs12>
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
import axios from 'axios';

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
            active: null,
            show: false
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

<style scoped>

</style>
