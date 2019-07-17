<template>
    <div>
        <v-container>
            <v-layout
                align-center
                justify-center
                row
                fill-height
            >
                <v-card height="1000px">
                    <v-card-text>
                        Привет мир!
                        <v-btn @click="changeTitle">CHANGE!!</v-btn>
                    </v-card-text>
                </v-card>
            </v-layout>
        </v-container>
    </div>
</template>

<script>
export default {
    mounted () {
        console.log('Component mounted.');
    },
    methods: {
        changeTitle: function () {
            this.$store.commit('setTitle', 'new');
        }
    }
};
</script>
