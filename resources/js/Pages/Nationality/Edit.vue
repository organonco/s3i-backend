<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
defineProps({
    nationality: Object,
});
</script>

<script>
import {useForm} from "@inertiajs/vue3";
export default {
    data: function () {
        return {
            form: useForm({
                name: this.nationality.data.name
            })
        }
    },
    methods: {
        submit: function() {
            this.form.put(route('nationality.update', this.nationality.data.id));
        }
    }
}
</script>

<template>
    <MainLayout title="Edit Nationality">
        <v-form @submit.prevent="submit">
            <v-text-field label="Name" variant="solo" v-model="form.name" :error-messages="form.errors.name"></v-text-field>
            <save-button/>
        </v-form>
    </MainLayout>
</template>
