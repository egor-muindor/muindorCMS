<template>
    <div>
        <v-container>
            <v-layout
                justify-center
                fill-height
                align-center
                row
            >
                <v-card>
                    <v-card-title>
                        Ошибка 404
                    </v-card-title>
                    <v-card-text>
                        <p>Страница не найдена</p>
                        <v-btn
                            text
                            color="error"
                            :to="{name: 'HomePage'}"
                        >
                            НА ГЛАВНУЮ
                        </v-btn>
                    </v-card-text>
                </v-card>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
export default {
    name: 'NotFoundPage'
};
</script>

<style scoped>

</style>
