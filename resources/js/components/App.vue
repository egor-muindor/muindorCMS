<template>
    <v-app>
        <v-toolbar
            dark
            color="primary"
        >
            <v-toolbar-title>Muindor CMS</v-toolbar-title>
            <v-spacer />
            <v-btn
                v-for="item in nav"
                :key="item.path"
                flat
                :to="item.path"
            >
                {{ item.title }}
            </v-btn>
            <v-spacer />
            <v-btn
                flat
                target="_blank"
                rel="noopener noreferrer"
                href="https://github.com/egor-muindor/"
            >
                Github
            </v-btn>
        </v-toolbar>
        <v-content>
            <v-container>
                <router-view />
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
import { mapState } from 'vuex';

export default {
    computed: {
        ...mapState(['nav'])
    },
    data () {
        return {
            active: null
        };
    },
    methods: {}
};
</script>
