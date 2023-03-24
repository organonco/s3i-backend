<template>
    <v-row class="text-h5">
        Course Items
    </v-row>
    <v-row>
        <v-col cols="8">
            <custom-draggable v-model="value"></custom-draggable>
        </v-col>
        <v-col>
            <v-btn class="ma-1 mt-4" color="primary" width="100%">Add Section</v-btn>
            <v-btn class="ma-1" color="primary" width="100%">Add Video</v-btn>
            <v-btn class="ma-1" color="primary" width="100%">Add Meeting</v-btn>
            <v-btn class="ma-1" color="primary" width="100%">Add Quiz</v-btn>
        </v-col>
    </v-row>
</template>

<script setup>
import CustomDraggable from "@/Components/CustomDraggable.vue";
</script>
<script>
export default {
    name: "CourseItemsInput",
    props: ['modelValue'],
    emits: ['update:modelValue'],
    computed: {
        value: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', value)
            }
        },
    },
}
</script>

<style scoped>

</style>
