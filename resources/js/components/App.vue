<template>
    <v-app>
        <v-navigation-drawer v-model="show" app>
            <v-list dense nav>

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
                            <v-list-item-avatar color="teal">
                                <v-img v-if="auth.avatar" :src="auth.avatar"></v-img>
                                <span class="white--text headline" v-else>
                                    {{ auth.name.slice(0,1) }}
                                </span>
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
                            <span class="red--text">Выход</span>
                        </v-list-item-title>
                    </v-list-item>
                </v-list-group>

                <v-divider v-if="auth.status === 'guest'" class="hidden-md-and-up" />
                <v-divider v-else />

                <v-list-item
                    v-for="(item) in nav"
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

                <v-list-group no-action>
                    <template v-slot:activator>
                        <v-list-item-icon>
                            <v-icon>{{ icons.mdiPuzzle }}</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Сервисы</v-list-item-title>
                    </template>
                    <v-list-group sub-group no-action>
                        <template v-slot:activator>
                            <v-list-item-title>Московский политех</v-list-item-title>
                        </template>
                        <v-list-item
                            v-for="(item) in servicesRoutes"
                            v-if="(item.auth === auth.status || item.auth === 'both') &&
                        (!(auth.admin ^ item.admin) || auth.admin)"
                            :key="item.name"
                            :to="(item.name !== undefined) ? { name: item.name } : item.path"
                            link
                        >
                            <v-list-item-title v-html="item.title" />
                            <v-list-item-icon>
                                <v-icon v-if="item.icon">
                                    {{ item.icon }}
                                </v-icon>
                            </v-list-item-icon>
                        </v-list-item>
                    </v-list-group>
                </v-list-group>

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
                <router-view keep-alive />
            </v-container>
        </v-content>

        <v-footer
            app inset padless
            dark absolute
        >

            <v-layout justify-space-between xs11>
                <v-flex xs4 text-left>
                    <span>
                        Powered by
                        <a href="https://laravel.com/">
                            <v-icon>{{ icons.mdiLaravel }}</v-icon>
                        </a>
                        <a href="https://vuejs.org/">
                            <v-icon>{{ icons.mdiVuejs }}</v-icon>
                        </a>
                        <a href="https://vuetifyjs.com/">
                            <v-icon>{{ icons.mdiVuetify }}</v-icon>
                        </a>

                    </span>
                </v-flex>
                <v-flex xs4 text-center>
                    <strong>Egor 'Muindor' Fadeev</strong>
                    — {{ new Date().getFullYear() }}
                </v-flex>
                <v-flex xs4 text-right>
                    My links —
                    <a href="https://github.com/egor-muindor">
                        <v-icon>{{ icons.mdiGithubBox }}</v-icon>
                    </a>
                    <a href="https://vk.com/muindor">
                        <v-icon>{{ icons.mdiVkBox }}</v-icon>
                    </a>
                    <a href="https://t.me/Muindor">
                        <v-icon>{{ icons.mdiTelegram }}</v-icon>
                    </a>
                    <a href="mailto:contact@muindor.com" aria-placeholder="contact@muindor.com">
                        <v-icon>{{ icons.mdiEmail }}</v-icon>
                    </a>
                </v-flex>
            </v-layout>

        </v-footer>
    </v-app>
</template>

<script>
import { VListItemIcon } from 'vuetify/lib';
import { mapState } from 'vuex';
import { mdiGithubBox, mdiVkBox, mdiEmail, mdiLaravel, mdiVuejs, mdiVuetify, mdiTelegram, mdiPuzzle } from '@mdi/js';
import Auth from '../helpers/Auth';
import axios from 'axios';

export default {
    data () {
        return {
            icons: {
                mdiGithubBox: mdiGithubBox,
                mdiEmail: mdiEmail,
                mdiVkBox: mdiVkBox,
                mdiLaravel: mdiLaravel,
                mdiVuejs: mdiVuejs,
                mdiVuetify: mdiVuetify,
                mdiTelegram: mdiTelegram,
                mdiPuzzle: mdiPuzzle,
            },
            active: null,
            show: false
        };
    },
    components: {
        VListItemIcon
    },
    computed: {
        ...mapState(['nav', 'authRoutes', 'profileNav', 'servicesRoutes']),
        auth () {
            return this.$store.state.Auth;
        },
        title: function () {
            return this.$store.state.app.title;
        }
    },
    created () {
        Auth.verify();
    },
    beforeCreate () {
        Auth.init();
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
