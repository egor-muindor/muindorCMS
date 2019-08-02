<template>
    <div>
        <v-container fill-height>
            <v-layout justify-center align-center row>
                <v-flex sm8>
                    <v-card>
                        <v-card-title>
                            <v-avatar color="teal">
                                <v-img v-if="auth.avatar" :src="auth.avatar"></v-img>
                                <span class="white--text headline" v-else>
                                    {{ auth.name.slice(0,1) }}
                                </span>
                            </v-avatar>
                            {{ auth.name }}
                        </v-card-title>
                        <v-card-text>STAY</v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
import Auth from '../helpers/Auth';
import axios from 'axios';

export default {
    name: 'ProfilePage',
    data () {
        return {

        };
    },
    computed: {
        auth: function () {
            return this.$store.state.Auth;
        }
    }
};
</script>

<style scoped>

</style>
