<template>
    <div>
        <section
            id="welcome"
            class="hide-overflow"
        >
            <v-layout>
                <v-flex
                    hidden-sm-and-down
                    md6
                >
                    <v-img
                        :src="background"
                        lazy-src
                        height="100vh"
                    />
                </v-flex>

                <v-flex
                    xs12
                    md6
                    align-content-space-between
                    layout
                    :pa-5="$vuetify.breakpoint.smAndDown"
                    wrap

                >
                    <v-layout
                        align-center
                        justify-center
                        wrap
                    >
                        <v-flex
                            xs10
                            md10
                        >
                            <v-avatar size="108" class="my-5">
                                <v-img :src="avatar"></v-img>
                            </v-avatar>
                            <h1 class="display-2 v-heading mb-3 font-weight-light">Привет, <br>меня зовут Егор и я
                                разработчик, человек, нёрд.</h1>
                            <p
                                class="title font-weight-light"
                                style="line-height: 1.7 !important;"
                            >
                                20-летний парень, увлеченный разработкой сайтов, компьютерами, аниме, космосом,
                                антропологией многими другими науками о прошлом, настоящем и будущем.
                            </p>
                            <p
                                class="title font-weight-light"
                                style="line-height: 1.7 !important;"
                            >
                                Я пишу на JavaScript, PHP, HTML, CSS и Python. Я могу говорить с базами данных,
                                и заставлять код делать вещи.
                            </p>
                        </v-flex>
                    </v-layout>
                </v-flex>
            </v-layout>
        </section>
    </div>
</template>

<script>
export default {
    name: 'HomePage',
    data () {
        return {
            avatar: 'https://pp.userapi.com/c848732/v848732981/16e723/rAK_EcHz4Rw.jpg',
            background: 'https://muindor.com/imgs/bg_min.png'
        };
    }
};
</script>

<style scoped>

</style>
