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
                        <v-card-title>
                            Поиск пар преподавателя
                        </v-card-title>
                        <v-card-text>
                            <p style="color:red; font-weight: bold">На время сессии отключен!</p>
                            <v-autocomplete
                                v-model="selected"
                                :items="items"
                                :loading="loading"
                                :search-input.sync="search"
                                item-text="name"
                                item-value="id"
                                hide-no-data
                                hide-selected
                                label="ФИО преподавателя"
                                placeholder="Начните вводить ФИО преподавателя"
                                clearable
                                disabled
                            />
                        </v-card-text>
                        <v-card-actions>
                            <v-tooltip top>
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        v-if="selected" icon v-on="on"
                                        @click="mode = !mode"
                                    >
                                        <v-icon>{{ modeIcon }}</v-icon>
                                    </v-btn>
                                </template>
                                <span>Сменить отображение</span>
                            </v-tooltip>
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
                <v-flex v-if="pairs" md12>
                    <v-layout v-if="mode" row>
                        <v-flex
                            v-for="(i, key) in pairs" :key="key"
                            xl2 lg3 md4 sm6
                            xs12 pa-2
                        >
                            <v-card>
                                <v-card-text>
                                    <span>
                                        Групп{{ (i.groups.length > 1) ? 'ы' : 'а' }}:
                                        <span
                                            v-for="(group, number) in i.groups"
                                            class="font-weight-bold"
                                            style="color: darkred"
                                        >
                                            {{ group.name }}
                                            {{ (i.groups.length > 1 && i.groups.length !== number+1) ? ', ' : '' }}
                                        </span>
                                    </span>
                                    <br>
                                    <span>Аудитори{{ (i.auditories.length > 1) ? 'и':'я' }}:</span>
                                    <span
                                        v-for="(a, ind) in i.auditories" style="color: darkcyan"
                                        class="font-weight-bold"
                                    >
                                        {{ a.name }}
                                    </span>
                                    <v-divider />
                                    <span class="font-weight-bold text--primary">{{ i.subject }}</span>
                                    <br>
                                    <span class="font-weight-bold text--secondary">{{ i.type }}</span>
                                    <v-divider />
                                    <span class="text--primary">
                                        День: <span class="font-weight-bold">{{ i.day | convertDay }}</span>
                                    </span>
                                    <br>
                                    <v-tooltip top>
                                        <template v-slot:activator="{ on }">
                                            <span class="text--primary" v-on="on">
                                                Пара: <span class="font-weight-bold" style="border-bottom: 1px dashed">
                                                    {{ i.pair_number | convertPair }}</span>
                                            </span>
                                        </template>
                                        <span>Время указано для групп очного образования.</span>
                                    </v-tooltip>
                                    <br>
                                    <span class="font-weight-light">
                                        {{ i.date_from }} - {{ i.date_to }}
                                    </span>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                    <v-layout v-else justify-center row>
                        <v-flex md8 sm6>
                            <v-expansion-panels>
                                <v-expansion-panel
                                    v-for="(i, key) in pairs"
                                    :key="key"
                                >
                                    <v-expansion-panel-header>
                                        <span class="font-weight-bold">
                                            {{ i.day | convertDay }}:
                                            {{ i.pair_number | convertPair }}
                                        </span>
                                    </v-expansion-panel-header>
                                    <v-expansion-panel-content style="font-size: 14px">
                                        <span>
                                            Групп{{ (i.groups.length > 1) ? 'ы' : 'а' }}:
                                            <span
                                                v-for="(group, number) in i.groups"
                                                class="font-weight-bold"
                                                style="color: darkred"
                                            >
                                                {{ group.name }}{{ (i.groups.length > 1 && i.groups.length !== number+1) ? ', ' : '' }}
                                            </span>
                                        </span>
                                        <v-divider />
                                        <span>Аудитори{{ (i.auditories.length > 1) ? 'и':'я' }}:</span>
                                        <span
                                            v-for="(a, ind) in i.auditories" style="color: darkcyan"
                                            class="font-weight-bold"
                                        >
                                            {{ a.name }}
                                        </span>
                                        <v-divider />
                                        <span class="font-weight-bold text--primary">{{ i.subject }}</span>
                                        <br>
                                        Тип: <span class="font-weight-bold text--secondary">{{ i.type }}</span>
                                        <v-divider />
                                        Преподавател{{ (i.teachers.length > 1) ? 'и':'ь' }}:
                                        <span
                                            class="font-weight-black"
                                            v-for="(teacher, tk) in i.teachers"
                                            :key="tk"
                                        >
                                            {{ teacher.name }}
                                            {{ (i.teachers.length > 1 && i.teachers.length !== tk+1) ? ', ':'' }}
                                        </span>
                                        <br>
                                        <span class="font-weight-light">
                                            {{ i.date_from }} - {{ i.date_to }}
                                        </span>
                                        <br>
                                        <sup>* - Время указано для групп очного образования.</sup>
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                            </v-expansion-panels>
                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
import { mdiViewList, mdiViewModule } from '@mdi/js';
import axios from 'axios';

export default {
    name: 'TimetablePage',
    filters: {
        convertDay: function (val) {
            if (!val) return '';
            switch (val) {
            case '1':
                return 'Понедельник';
            case '2':
                return 'Вторник';
            case '3':
                return 'Среда';
            case '4':
                return 'Четверг';
            case '5':
                return 'Пятница';
            case '6':
                return 'Суббота';
            default:
                return val;
            }
        },
        convertPair: function (val) {
            if (!val) return '';
            switch (val) {
            case 1:
                return '9:00-10:30';
            case 2:
                return '10:40-12:10';
            case 3:
                return '12:20-13:50';
            case 4:
                return '14:30-16:00';
            case 5:
                return '16:10-17:40';
            case 6:
                return '17:50-19:20';
            case 7:
                return '19:30-21:00';
            default:
                return val;
            }
        }
    },
    data () {
        return {
            icons: {
                ViewList: mdiViewList,
                ViewModule: mdiViewModule
            },
            mode: true,
            items: [],
            loading: false,
            selected: null,
            search: null,
            pairs: []
        };
    },
    computed: {
        modeIcon () {
            return (this.mode) ? this.icons.ViewList : this.icons.ViewModule;
        }
    },
    watch: {
        search (val) {
            this.searchTeacher(val);
        },
        selected (val) {
            if (val == null) {
                this.pairs = [];
                return;
            }

            axios.post('/api/timeboard/', { id: val })
                .then(res => {
                    this.pairs = res.data;
                })
                .catch(err => {
                    console.log(err);
                })
                .finally(() => (this.loading = false));
        }
    },
    created () {
        this.searchTeacher = _.debounce(function (val) {
            if (this.loading) return;

            if (val !== null && val.length < 3) return;

            this.loading = true;

            axios.post('/api/timeboard/search', { search: val })
                .then(res => {
                    console.log(res);
                    this.items = res.data;
                })
                .catch(err => {
                    console.log(err);
                })
                .finally(() => (this.loading = false));
        }, 500);
    },
    methods: {}
};
</script>

<style scoped>

</style>
