<template>
    <div>
        <v-container fill-height>
            <v-layout justify-center align-center row>
                <v-flex xs6>
                    <v-card>
                        <v-card-title>Work in progress</v-card-title>
                        <v-card-text>STAY</v-card-text>
                        <v-btn :to="{ name: 'Blog.PostPage', params: {post_id: 'qwerty'}}">Open</v-btn>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
export default {
    name: 'BlogMainPage'
};
</script>

<style scoped>

</style>
