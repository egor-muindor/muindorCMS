<template>
    <v-app>
        <v-app-bar
            dark
            app
            color="primary"
        >
            <v-toolbar-title>Muindor CMS</v-toolbar-title>
            <v-spacer />
            <v-btn
                v-for="item in nav"
                :key="item.path"
                :to="item.path"
            >
                <v-icon v-if="item.icon">
                    {{ item.icon }}
                </v-icon>
                {{ item.title }}
            </v-btn>
            <v-spacer />
            <v-btn
                target="_blank"
                rel="noopener noreferrer"
                href="https://github.com/egor-muindor/"
            >
                <v-icon>{{ icons.mdiGithubBox }}</v-icon>
                Github
            </v-btn>
        </v-app-bar>
        <v-content>
            <v-container>
                <router-view />
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
import { mapState } from 'vuex';
import { mdiGithubBox } from '@mdi/js';

export default {
    computed: {
        ...mapState(['nav'])
    },
    data () {
        return {
            icons: {
                mdiGithubBox: mdiGithubBox
            },
            active: null
        };
    },
    methods: {}
};
</script>
