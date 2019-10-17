<template>
    <div>
        <v-container>
            <v-card>
                <v-card-title>Московский политех. Рейтинг по физической культуре.</v-card-title>
                <v-card-text>
                    <text-p>
                        Работа идет медленно. API уже есть, скоро орки-рабочие сверстают эту страницу и всё будет
                        работать как задумывалось. Надеемся на скорый запуск.
                    </text-p>
                    <text-p>
                        <a href="http://bit.ly/mospolytech-gym-2019">Ссылка на таблицу 2019/2020</a>
                    </text-p>
                    <br>
                    <a href="https://muindor.com/api/ofp?name=Аб&group=17">P.S. [GET запрос]
                    https://muindor.com/api/ofp?name=ФИО&group=ГРУППА</a>
                </v-card-text>
            </v-card>
        </v-container>
    </div>
</template>

<script>
import TextParagraphComponent from '../helpers/TextParagraphComponent';

export default {
    name: 'RatingPhyEduPage',
    components: {
        'text-p': TextParagraphComponent
    }
};
</script>

<style scoped>

</style>
