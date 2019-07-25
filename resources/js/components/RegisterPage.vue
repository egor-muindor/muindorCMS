<template>
    <div>
        <v-container fill-height>
            <v-layout justify-center>
                <v-flex
                    md6
                    sm8
                >
                    <v-layout>
                        <v-flex xs12>
                            <v-form>
                                <v-card>
                                    <v-card-title class="justify-center">
                                        <h4>Registration on MUINDOR.COM</h4>
                                    </v-card-title>
                                    <v-card-text>
                                        <v-text-field
                                            v-model="form.name"
                                            :error-messages="nameErrors"
                                            label="Name"
                                            required
                                            :disabled="loading"
                                            @input="$v.form.name.$touch()"
                                            @blur="$v.form.name.$touch()"
                                        />
                                        <v-text-field
                                            v-model="form.email"
                                            :error-messages="emailErrors"
                                            label="E-mail"
                                            required
                                            :disabled="loading"
                                            @input="$v.form.email.$touch()"
                                            @blur="$v.form.email.$touch()"
                                        />
                                        <v-text-field
                                            v-model="form.password"
                                            :append-icon="showPass ? 'visibility' : 'visibility_off'"
                                            :type="showPass ? 'text' : 'password'"
                                            label="Password"
                                            hint="At least 8 characters"
                                            :error-messages="passwordErrors"
                                            :disabled="loading"
                                            @click:append="showPass = !showPass"
                                            @input="$v.form.password.$touch()"
                                            @blur="$v.form.password.$touch()"
                                        />
                                        <v-text-field
                                            v-model="form.password_confirmation"
                                            :append-icon="showPass ? 'visibility' : 'visibility_off'"
                                            :type="showPass ? 'text' : 'password'"
                                            label="Password confirmation"
                                            hint="At least 8 characters"
                                            :error-messages="passwordConfirmErrors"
                                            :disabled="loading"
                                            @click:append="showPass = !showPass"
                                            @input="$v.form.password_confirmation.$touch()"
                                            @blur="$v.form.password_confirmation.$touch()"
                                        />
                                    </v-card-text>
                                    <v-card-actions class="justify-center">
                                        <v-btn
                                            color="error"
                                            :disabled="loading || $v.$invalid"
                                            :loading="loading"
                                            @click="register"
                                        >
                                            Register
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-form>
                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-layout>
        </v-container>
        <privacy-policy
            :dialog="showPrivacyPolicy"
            @accepted="accepted"
        />
    </div>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, maxLength, email, minLength, helpers } from 'vuelidate/lib/validators';
import PrivacyPolicyModalComponent from './PrivacyPolicyModalComponent';
import axios from 'axios';
import Auth from '../helpers/Auth';

const nameRule = helpers.regex('nameRule', /^[a-zA-Z0-9\-_#]*$/);
const passwordConfirmRule = (password) => (v) => {
    return (!!v && !!password) ? password === v : true;
};

export default {
    name: 'RegisterPage',
    components: { 'privacy-policy': PrivacyPolicyModalComponent },
    mixins: [validationMixin],
    data () {
        return {
            form: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null
            },
            loading: false,
            showPass: false,
            showPrivacyPolicy: false,

            errors: {}
        };
    },
    computed: {
        nameErrors () {
            let field = 'name';
            const errors = [];
            if (this.errors.hasOwnProperty(field)) return this.errors[field];
            if (!this.$v.form.name.$dirty) return errors;
            !this.$v.form[field].maxLength && errors.push('Name must be at most 10 characters long');
            !this.$v.form[field].minLength && errors.push('Name must be at least 3 characters long');
            !this.$v.form[field].required && errors.push('Name is required');
            !this.$v.form[field].nameRule && errors.push('Name can only consist of a-z A-Z 0-9 -_#');
            return errors;
        },
        emailErrors () {
            let field = 'email';
            const errors = [];
            if (this.errors.hasOwnProperty(field)) return this.errors[field];
            if (!this.$v.form[field].$dirty) return errors;
            !this.$v.form[field].email && errors.push('Must be valid e-mail');
            !this.$v.form[field].required && errors.push('E-mail is required');
            return errors;
        },
        passwordErrors () {
            let field = 'password';
            const errors = [];
            if (this.errors.hasOwnProperty(field)) return this.errors[field];
            if (!this.$v.form[field].$dirty) return errors;
            !this.$v.form[field].required && errors.push('Password is required');
            !this.$v.form[field].minLength && errors.push('Password must be at least 8 characters long');
            !this.$v.form[field].maxLength && errors.push('Password must be at most 48 characters long');
            !this.$v.form.password_confirmation.passwordConfirmRule && this.$v.form.password_confirmation.$touch();
            return errors;
        },
        passwordConfirmErrors () {
            let field = 'password_confirmation';
            const errors = [];
            if (this.errors.hasOwnProperty(field)) return this.errors[field];
            if (!this.$v.form[field].$dirty) return errors;
            !this.$v.form[field].required && errors.push('Password confirmation is required');
            !this.$v.form[field].minLength && errors.push('Password confirmation must be at least 8 characters long');
            !this.$v.form[field].maxLength && errors.push('Password confirmation must be at most 48 characters long');
            !this.$v.form[field].passwordConfirmRule && errors.push('Passwords must be equal');
            return errors;
        }
    },
    created () {
        Auth.checkAlready();
    },
    methods: {
        register: function () {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                this.showPass = false;
                this.showPrivacyPolicy = true;
            }
        },
        accepted: function () {
            this.showPrivacyPolicy = false;
            this.loading = true;
            axios.post('/api/register', this.form).then(response => {
                this.$router.push({ name: 'LoginPage' });
            }).catch(error => {
                this.loading = false;
                this.errors = error.response.data.errors;
            });
        }
    },
    validations () {
        let pass = this.form.password;
        return {
            form: {
                name: { required, maxLength: maxLength(255), minLength: minLength(3), nameRule },
                email: { required, email },
                password: { required, minLength: minLength(8), maxLength: maxLength(48) },
                password_confirmation: {
                    required,
                    minLength: minLength(8),
                    maxLength: maxLength(48),
                    passwordConfirmRule: passwordConfirmRule(pass)
                }
            }
        };
    }
};
</script>

<style scoped>

</style>
