<template>
    <div>
        <v-container fluid>
            <v-layout
                fill-height
                align-center
                justify-center
                row
            >
                <v-flex
                    md3
                    sm5
                    py-2
                >
                    <v-form>
                        <v-card>
                            <v-card-title>
                                <v-flex my-2>
                                    Авторизация
                                </v-flex>
                            </v-card-title>
                            <v-card-text>
                                <v-text-field
                                    v-model="form.login"
                                    :error-messages="checkError('login')"
                                    label="Login"
                                    required
                                    :disabled="loading"
                                />
                                <v-text-field
                                    v-model="form.password"
                                    :append-icon="showPass ? 'visibility' : 'visibility_off'"
                                    :type="showPass ? 'text' : 'password'"
                                    label="Password"
                                    :error-messages="checkError('password')"
                                    :disabled="loading"
                                    @click:append="showPass = !showPass"
                                    @keyup="onKeyup"
                                />
                            </v-card-text>
                            <v-card-actions class="justify-center">
                                <v-btn
                                    color="primary"
                                    :disabled="loading"
                                    :loading="loading"
                                    @click="login"
                                >
                                    Auth
                                </v-btn>
                                <v-btn
                                    color="error"
                                    :to="{name:'RegisterPage'}"
                                >
                                    Register
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-form>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
import axios from 'axios';
import Auth from '../helpers/Auth';

export default {
    name: 'LoginPage',
    created () {
        Auth.checkAlready();
    },
    data () {
        return {
            form: {
                login: null,
                password: null
            },
            showPass: false,
            loading: false,

            errors: {}
        };
    },
    methods: {
        login: function () {
            this.loading = true;
            axios.post('/api/login', this.form).then(response => {
                if (response.data.status === 422) {
                    this.form.password = null;
                    this.loading = false;
                    this.errors = response.data.errors;
                } else {
                    Auth.login(response.data.user);
                    this.$router.push({ name: 'HomePage' });
                }
            }).catch(error => {
                this.loading = false;
                this.errors = error.response.data.errors;
            });
        },
        checkError: function (field) {
            return this.errors.hasOwnProperty(field) ? this.errors[field] : [];
        },
        onKeyup (e) {
            if (e.code === 'Enter') {
                this.login();
            }
        }
    }
};
</script>

<style scoped>

</style>
