<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
defineProps({});
</script>

<script>
import {useForm} from "@inertiajs/vue3";
export default {
    data: function () {
        return {
            form: useForm({
                name: ""
            })
        }
    },
    methods: {
        submit: function() {
            this.form.post(route('education_level.store'));
        }
    }
}
</script>

<template>
    <MainLayout title="Create Education Level">
        <v-form @submit.prevent="submit">
            <v-text-field label="Name" variant="solo" v-model="form.name" :error-messages="form.errors.name"></v-text-field>
            <save-button/>
        </v-form>
    </MainLayout>
</template>
