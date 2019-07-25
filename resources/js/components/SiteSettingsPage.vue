<template>
    <div>
        <v-container>
            <v-layout justify-center align-center fill-height>
                <v-flex xs6>
                    <v-card>
                        <v-card-title>
                            Настройки сайта
                        </v-card-title>
                        <v-card-text>
                            <!-- TODO: SiteSettingsPage -->
                            <div style="text-align: center;">WIP</div>
                            <div v-for="item in form" :key="item.name">
                                <h5>Параметр: {{item.name}}</h5>
                                <v-layout align-center justify-space-around>
                                    <v-flex xs5>
                                        <v-text-field
                                            v-model="item.value"
                                            :error-messages="[]"
                                            label="Значение"
                                            required
                                            :disabled="loading"
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs5>
                                        <v-text-field
                                            v-model="item.comment"
                                            :error-messages="[]"
                                            label="Комментарий"
                                            required
                                            :disabled="loading"
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-divider/>
                            </div>
                        </v-card-text>
                        <v-card-actions class="justify-center">
                            <v-btn
                                color="primary"
                                :disabled="loading"
                                :loading="loading"
                                @click="sendData"
                            >
                                Сохранить
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
import axios from 'axios';
import Auth from '../helpers/Auth';

export default {
    name: 'SiteSettingsPage',
    data () {
        return {
            form: [
                {
                    name: 'application_title',
                    value: '',
                    comment: ''
                },
                {
                    name: 'home_img',
                    value: '',
                    comment: ''
                }
            ],
            loading: false,
        };
    },
    methods: {
        sendData: function () {
            axios.post('/api/admin/settings', this.form).then(
                response => {
                    console.log(response);
            });
        }
    },
    computed: {},
    created () {
        Auth.init();
        Auth.checkAdmin();
    }
};
</script>

<style scoped>

</style>
