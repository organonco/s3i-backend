<template>
    <v-row justify="center">
        <v-col :cols="cols">
            <v-sheet class="pa-4 " elevation="4" color="surface">
                <v-container>
                    <slot/>
                </v-container>
            </v-sheet>
        </v-col>
    </v-row>
</template>

<script>
import SaveButton from "@/Components/SaveButton.vue";

export default {
    name: "CenterSheet",
    components: {SaveButton},
    props: ['cols']
}
</script>

<style scoped>

</style>