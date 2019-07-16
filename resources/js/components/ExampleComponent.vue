<template>
    <div>
        <v-container>
            <v-layout
                align-center
                justify-center
                row
                fill-height
            >
                <v-card>
                    <v-card-text>
                        Привет мир!
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
    }
};
</script>
