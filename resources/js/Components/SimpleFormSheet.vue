<template>
    <center-sheet :cols="cols ? cols : 5">
        <v-form @submit.prevent="$emit('save')">
            <v-row>
                <v-col cols="12">
                    <slot/>
                </v-col>
            </v-row>
            <v-row>
                <v-divider class="mb-4"/>
            </v-row>
            <v-row justify="center">
                <v-col cols="4">
                    <save-button/>
                </v-col>
            </v-row>
        </v-form>
    </center-sheet>
</template>

<script>
import CenterSheet from "@/Components/CenterSheet.vue";
import SaveButton from "@/Components/SaveButton.vue";

export default {
    name: "SimpleFormSheet",
    components: {SaveButton, CenterSheet},
    props: ['cols'],
    emits: ['save']
}
</script>

<style scoped>

</style>