<template>
    <div>
        <v-container>
            <v-layout justify-center>
                <v-card>
                    <v-card-text>
                        Привет мир!
                        <v-btn>CHANGE!!</v-btn>
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
    }
};
</script>
