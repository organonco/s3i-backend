<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
defineProps({
    education_level: Object,
});
</script>

<script>
import {useForm} from "@inertiajs/vue3";
export default {
    data: function () {
        return {
            form: useForm({
                name: this.education_level.data.name
            })
        }
    },
    methods: {
        submit: function() {
            this.form.put(route('education_level.update', this.education_level.data.id));
        }
    }
}
</script>

<template>
    <MainLayout title="Edit Education Level">
        <v-form @submit.prevent="submit">
            <v-text-field label="Name" variant="solo" v-model="form.name" :error-messages="form.errors.name"></v-text-field>
            <save-button/>
        </v-form>
    </MainLayout>
</template>
