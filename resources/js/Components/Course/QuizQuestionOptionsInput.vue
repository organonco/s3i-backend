<template>
    <v-row>
        <h2>
            الخيارات المتاحة
        </h2>
    </v-row>
    <v-row>
        <v-col cols="12">
            <options-input v-model="value"></options-input>
        </v-col>
    </v-row>
</template>

<script setup>
import OptionsInput from "@/Components/OptionsInput.vue";
</script>
<script>
export default {
    name: "QuizQuestionOptionsInput",
    props: ['modelValue'],
    emits: ['update:modelValue'],
    computed: {
        value: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', JSON.parse(JSON.stringify(value)))
            }
        },
    },
}
</script>

<style scoped>

</style>
