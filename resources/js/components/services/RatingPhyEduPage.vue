<template>
    <div>
        <v-container>
            <v-card>
                <v-card-title>Московский политех. Рейтинг по физической культуре.</v-card-title>
                <v-card-text>
                    <text-p>
                        Временно не работает. Планирую запустить как только появиться источник информации.
                        Если у вас имеется ссылка на новую таблицу рейтинга — напишите мне в одну из соц.сетей,
                        указанных у меня в футере сайта (нижний правый угол)
                    </text-p>
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
