<template>
    <div>
        <v-card class="box">
            <h2>{{ data.students[0].name }}</h2>

            <p style="color: gray">
                Обновление от: {{ data.date.status }}
            </p>
            <div class="info_box">
                <span>Факультет:</span> {{ data.students[0].faculty.name }}
                <br>
                <span>Курс:</span> {{ data.students[0].course }}
                <br>
                <span>Группа:</span> {{ data.students[0].group.name }}
                <br>
                <p><span>Преподаватель:</span> {{ data.students[0].teacher.name }}</p>
            </div>
            <div class="info_box">
                <span>Группа здоровья:</span> {{ data.students[0].group_type }}
                <br>
                <span>Предыдущая сессия:</span> {{ data.students[0].mark }}
                <br>
                <span>Количество занятий:</span> {{ data.students[0].number_cls }}
                <br>
                <span>Сумма баллов<span style="color: red">*</span>:</span> {{ computedScore }}
                <p style="font-size: 12px; line-height: 12px"><span style="color: red">*</span>Сумма баллов
                    рассчитывается по формуле: количество занятий * 2 + сумма баллов за нормативы</p>
            </div>
        </v-card>
        <v-card style="margin-top: 10px">
            <v-tabs
                v-model="tab"
                grow
            >
                <v-tab href="#tab-pairs">
                    Посещения
                </v-tab>
                <v-tab href="#tab-norm">
                    Нормативы
                </v-tab>
            </v-tabs>

            <v-tabs-items v-model="tab">
                <v-tab-item
                    value="tab-pairs"
                >
                    <v-card flat>
                        <v-card-text>
                            <v-data-table
                                :headers="[{text: '№', value: 'num'}, {text:'Название дисциплины', value: 'name'}, {text: 'Дата посещения', value: 'date'}]"
                                :items="computedPairs"
                                dense
                                disable-filtering
                                disable-sort
                                items-per-page="15"
                                fixed-header
                                calculate-widths
                            />
                        </v-card-text>
                    </v-card>
                </v-tab-item>
                <v-tab-item
                    value="tab-norm"
                >
                    <v-card flat>
                        <v-card-text>
                            <v-card-text>
                                <v-data-table
                                    :headers="standards_headers"
                                    :items="computedStandards"
                                    dense
                                    disable-filtering
                                    disable-sort
                                    fixed-header
                                    calculate-widths
                                    disable-pagination
                                    hide-default-footer
                                />
                            </v-card-text>
                        </v-card-text>
                    </v-card>
                </v-tab-item>
            </v-tabs-items>
        </v-card>
    </div>
</template>

<script>
export default {
    name: 'RatingStudentInfoBlock',
    props: {
        data: {
            type: Object,
            default: null,
            required: true
        }
    },
    data () {
        return {
            tab: null,
            standards_headers: [
                { text: '№', value: 'num' },
                { text: 'Название норматива', value: 'name' },
                { text: 'Результат', value: 'result' },
                { text: 'Баллы', value: 'score' },
                { text: 'Дата посещения', value: 'date' }
            ]
        };
    },
    computed: {
        computedPairs () {
            return this.data.students[0].pairs.map(item => {
                return {
                    num: this.data.students[0].pairs.indexOf(item) + 1,
                    ...item
                };
            });
        },
        computedStandards () {
            return this.data.students[0].standards.map(item => {
                return {
                    num: this.data.students[0].standards.indexOf(item) + 1,
                    ...item
                };
            });
        },
        computedScore () {
            const standards = this.data.students[0].standards;
            let stdTmpScore = 0;
            // eslint-disable-next-line no-return-assign
            if (standards.length !== 0) standards.forEach(item => stdTmpScore += parseInt(item.score));
            return this.data.students[0].pairs.length * 2 + stdTmpScore;
        }
    },
    mounted () {
    }
};
</script>

<style scoped>
    .box {
        padding: 20px;
    }

    .info_box span {
        font-weight: bold;
    }
</style>
