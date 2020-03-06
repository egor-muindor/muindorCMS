<template>
    <div>
        <v-container fluid>
            <v-layout
                fill-height
                align-center
                justify-center
                row
            >
                <v-flex md6 sm8 py-2>
                    <v-card>
                        <v-card-title><h2>НЕ Московский Политех</h2></v-card-title>
                        <v-card-title><h4>Рейтинг по физической культуре</h4></v-card-title>
                        <v-card-text>
                            <p style="color: darkgray; font-weight: bold">
                                Таблица за второй семестр 2019/2020 учебного года.
                            </p>
                            <v-layout align-center justify-space-around class="d-flex flex-wrap">
                                <v-flex sm7 xs12>
                                    <v-text-field v-model="name" label="ФИО" />
                                </v-flex>
                                <v-flex sm4 xs12>
                                    <v-text-field v-model="group" label="Учебная группа" />
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                        <v-card-actions class="justify-end">
                            <v-btn color="primary" @click="onClickFind">
                                Найти
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </v-layout>
            <v-layout
                fill-height
                align-center
                justify-center
                row
            >
                <v-flex md6 sm8 py-2>
                    <div v-if="state.find">
                        <RatingStudentInfoBlock :data="results" />
                    </div>
                    <v-card id="results">
                        <div class="results__not-found" v-if="state.error">
                            <h1>Не найдено</h1>
                        </div>
                        <div class="results__not-found" v-if="state.findFew">
                            <h1>Найдено несколько студентов с такими данными, уточните запрос</h1>
                        </div>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
import TextParagraphComponent from '../helpers/TextParagraphComponent';
// eslint-disable-next-line no-unused-vars
import { VuetifyObject as $vuetify } from 'vuetify';
import axios from 'axios';
import RatingStudentInfoBlock from './RatingStudentInfoBlock';

export default {
    name: 'RatingPhyEduPage',
    components: {
        RatingStudentInfoBlock,
        // eslint-disable-next-line vue/no-unused-components
        'text-p': TextParagraphComponent
    },
    data () {
        return {
            name: null,
            group: null,
            results: null,
            state: {
                find: false,
                findFew: false,
                error: false
            }
        };
    },
    methods: {
        onClickFind () {
            let params = {
                name: this.name,
                group: this.group
            };

            let options = {
                params: params
            };

            axios.get('/api/ofp', options).then(res => {
                this.results = res.data;
                this.findState(this.results);
                this.$vuetify.goTo('#results');
            }).catch(res => {
                console.log('error');
            });
        },
        findState (result) {
            this.state = {
                find: false,
                findFew: false,
                error: false
            };
            if (result.students.length === 0) {
                this.state.error = true;
                this.state.find = false;
                this.state.findFew = false;
            } else if (result.students.length > 1) {
                this.state.findFew = true;
                this.state.error = false;
                this.state.find = false;
            } else {
                this.state.find = true;
                this.state.error = false;
                this.state.findFew = false;
            }
        }
    }
};
</script>

<style scoped>
    .results__not-found {
        min-height: 100px;
    }

    .results__not-found > h1 {
        text-align: center
    }
</style>
