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
                                            v-model="name"
                                            :error-messages="nameErrors"
                                            label="Name"
                                            required
                                            :disabled="loading"
                                            @input="$v.name.$touch()"
                                            @blur="$v.name.$touch()"
                                        />
                                        <v-text-field
                                            v-model="email"
                                            :error-messages="emailErrors"
                                            label="E-mail"
                                            required
                                            :disabled="loading"
                                            @input="$v.email.$touch()"
                                            @blur="$v.email.$touch()"
                                        />
                                        <v-text-field
                                            v-model="password"
                                            :append-icon="showPass ? 'visibility' : 'visibility_off'"
                                            :type="showPass ? 'text' : 'password'"
                                            label="Password"
                                            hint="At least 8 characters"
                                            :error-messages="passwordErrors"
                                            :disabled="loading"
                                            @click:append="showPass = !showPass"
                                            @input="$v.password.$touch()"
                                            @blur="$v.password.$touch()"
                                        />
                                        <v-text-field
                                            v-model="password_confirm"
                                            :append-icon="showPass ? 'visibility' : 'visibility_off'"
                                            :type="showPass ? 'text' : 'password'"
                                            label="Password confirmation"
                                            hint="At least 8 characters"
                                            :error-messages="passwordConfirmErrors"
                                            :disabled="loading"
                                            @click:append="showPass = !showPass"
                                            @input="$v.password_confirm.$touch()"
                                            @blur="$v.password_confirm.$touch()"
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
            loading: false,
            name: null,
            email: null,
            password: null,
            password_confirm: null,
            showPass: false,
            showPrivacyPolicy: false
        };
    },
    computed: {
        nameErrors () {
            const errors = [];
            if (!this.$v.name.$dirty) return errors;
            !this.$v.name.maxLength && errors.push('Name must be at most 10 characters long');
            !this.$v.name.minLength && errors.push('Name must be at least 3 characters long');
            !this.$v.name.required && errors.push('Name is required');
            !this.$v.name.nameRule && errors.push('Name can only consist of a-z A-Z 0-9 -_#');
            return errors;
        },
        emailErrors () {
            const errors = [];
            if (!this.$v.email.$dirty) return errors;
            !this.$v.email.email && errors.push('Must be valid e-mail');
            !this.$v.email.required && errors.push('E-mail is required');
            return errors;
        },
        passwordErrors () {
            const errors = [];
            if (!this.$v.password.$dirty) return errors;
            !this.$v.password.required && errors.push('Password is required');
            !this.$v.password.minLength && errors.push('Password must be at least 8 characters long');
            !this.$v.password.maxLength && errors.push('Password must be at most 48 characters long');
            return errors;
        },
        passwordConfirmErrors () {
            const errors = [];
            if (!this.$v.password_confirm.$dirty) return errors;
            !this.$v.password_confirm.required && errors.push('Password confirmation is required');
            !this.$v.password_confirm.minLength && errors.push('Password confirmation must be at least 8 characters long');
            !this.$v.password_confirm.maxLength && errors.push('Password confirmation must be at most 48 characters long');
            !this.$v.password_confirm.passwordConfirmRule && errors.push('Passwords must be equal');
            return errors;
        }
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
            // TODO: ДОБАВИТЬ ЗАПРОС НА РЕГИСТРАЦИЮ
        }
    },
    validations () {
        let pass = this.password;
        return {
            name: { required, maxLength: maxLength(255), minLength: minLength(3), nameRule },
            email: { required, email },
            password: { required, minLength: minLength(8), maxLength: maxLength(48) },
            password_confirm: {
                required,
                minLength: minLength(8),
                maxLength: maxLength(48),
                passwordConfirmRule: passwordConfirmRule(pass)
            }
        };
    }
};
</script>

<style scoped>

</style>
