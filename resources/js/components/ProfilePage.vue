<template>
    <div>
        <v-container fill-height>
            <v-layout align-start justify-center row>
                <v-flex md2 pr-2 class="hidden-md-and-down">
                    <v-card>
                        <v-avatar v-if="auth.avatar" color="teal" size="100%" tile>
                            <v-img :src="auth.avatar" />
                        </v-avatar>

                        <div v-if="!true" class="text-center pt-2">
                            <v-btn>
                                Загрузить аватар
                            </v-btn>
                        </div>
                        <v-card-title>
                            {{ auth.name }}
                        </v-card-title>

                        <v-card-text><!-- TODO: ProfileMenu --></v-card-text>
                    </v-card>
                </v-flex>
                <v-flex
                    md8 sm10 xs12
                    mb-2 class="hidden-lg-and-up"
                >
                    <v-card>
                        <v-layout align-start justify-start row>
                            <v-flex xs3 px-2>
                                <v-card-title>
                                    <v-avatar color="teal" style="min-height: 64px; min-width: 64px;" size="100%">
                                        <v-img v-if="auth.avatar" :src="auth.avatar" />
                                        <span v-else class="white--text headline">
                                            {{ auth.name.slice(0,1) }}
                                        </span>
                                    </v-avatar>
                                </v-card-title>
                            </v-flex>
                            <v-flex xs8>
                                <v-card-text>{{ auth.name }}</v-card-text>
                            </v-flex>
                        </v-layout>
                    </v-card>
                </v-flex>
                <v-flex md8 sm10 xs12>
                    <v-card>
                        <v-card-title>
                            Профиль
                        </v-card-title>
                        <v-card-text>
                            <v-text-field
                                v-model="profileCard.form.name"
                                name="name"
                                :error-messages="checkProfileError('name')"
                                label="Имя"
                                required
                                :disabled="profileCard.loading"
                            />
                            <v-text-field
                                v-model="profileCard.form.email"
                                name="email"
                                :error-messages="checkProfileError('email')"
                                label="Email"
                                required
                                :disabled="profileCard.loading"
                            />
                            <v-text-field
                                v-model.lazy="profileCard.form.password"
                                name="Новый пароль"
                                :append-icon="profileCard.showPass ? 'visibility' : 'visibility_off'"
                                :type="profileCard.showPass ? 'text' : 'password'"
                                label="Пароль"
                                :error-messages="checkProfileError('password')"
                                :disabled="profileCard.loading"
                                @click:append="profileCard.showPass = !profileCard.showPass"
                                @keyup="onKeyup"
                            />
                            <v-text-field
                                v-model.lazy="profileCard.form.oldPassword"
                                name="newPassword"
                                :append-icon="profileCard.showOldPass ? 'visibility' : 'visibility_off'"
                                :type="profileCard.showOldPass ? 'text' : 'password'"
                                label="Текущий пароль"
                                :error-messages="checkProfileError('old_password')"
                                :disabled="profileCard.loading"
                                @click:append="profileCard.showOldPass = !profileCard.showOldPass"
                                @keyup="onKeyup"
                            />
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer />
                            <v-btn :disabled="!profileCard.oldData.oldPassword " @click="updateProfile">
                                <v-icon>save</v-icon>
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
import Auth from '../helpers/Auth';
import axios from 'axios';
import TextHeaderComponent from './helpers/TextHeaderComponent';

export default {
    name: 'ProfilePage',
    components: {
        textHeader: TextHeaderComponent
    },
    data () {
        return {
            profileCard: {
                form: {
                    name: null,
                    email: null,
                    password: null,
                    oldPassword: null
                },
                oldData: {
                    name: null,
                    email: null,
                    password: false,
                    oldPassword: false
                },
                showPass: false,
                showOldPass: false,
                loading: false,

                errors: {}
            }
        };
    },
    computed: {
        auth: function () {
            return this.$store.state.Auth;
        },
        changedName: function () {
            return (this.profileCard.form.name !== this.profileCard.oldData.name)
                ? this.profileCard.form.name : null;
        },
        changedEmail: function () {
            return (this.profileCard.form.email.toLowerCase() !== this.profileCard.oldData.email)
                ? this.profileCard.form.email.toLowerCase() : null;
        },
        changedPassword: function () {
            return (this.profileCard.oldData.password) ? this.profileCard.form.password : null;
        }
    },
    watch: {
        'profileCard.form.password': function (newVal, oldVal) {
            if (newVal !== null) {
                this.profileCard.oldData.password = true;
            } else {
                this.profileCard.oldData.password = false;
            }
        },
        'profileCard.form.oldPassword': function (oldVal, newVal) {
            if (newVal !== null && newVal.length >= 5) {
                this.profileCard.oldData.oldPassword = true;
            } else {
                this.profileCard.oldData.oldPassword = false;
            }
        }
    },
    mounted () {
        this.profileCard.form.name = `${this.auth.name}`;
        this.profileCard.form.email = `${this.auth.email}`;
        this.profileCard.oldData.name = `${this.auth.name}`;
        this.profileCard.oldData.email = `${this.auth.email}`;
    },
    methods: {
        checkProfileError: function (field) {
            return this.profileCard.errors.hasOwnProperty(field) ? this.profileCard.errors[field] : [];
        },
        updateProfile: function () {
            // TODO: Добавить запрос на обновление данных профиля
            axios.post('/api/user/profile', {
                name: this.changedName,
                email: this.changedEmail,
                password: this.changedPassword,
                'old_password': this.profileCard.form.oldPassword
            }).then(response => {
                this.profileCard.form.oldPassword = null;
                this.profileCard.form.password = null;
                this.profileCard.errors = [];
                this.profileCard.oldData.password = false;
                this.profileCard.oldData.oldPassword = false;
                Auth.login(response.data.user);
                this.profileCard.oldData.name = `${this.auth.name}`;
                this.profileCard.oldData.email = `${this.auth.email}`;
            }).catch(error => {
                this.loading = false;
                this.profileCard.errors = error.response.data.errors;
            });
        },
        onKeyup (e) {
            if (e.code === 'Enter') {
                this.updateProfile();
            }
        }
    }
};
</script>

<style scoped>

</style>
