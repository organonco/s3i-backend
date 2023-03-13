<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
defineProps({
    category: Object,
});
</script>

<script>
import {useForm} from "@inertiajs/vue3";
export default {
    data: function () {
        return {
            form: useForm({
                name: this.category.data.name
            })
        }
    },
    methods: {
        submit: function() {
            this.form.put(route('category.update', this.category.data.id));
        }
    }
}
</script>

<template>
    <MainLayout title="Edit Category">
        <v-form @submit.prevent="submit">
            <v-text-field label="Name" variant="solo" v-model="form.name" :error-messages="form.errors.name"></v-text-field>
            <save-button/>
        </v-form>
    </MainLayout>
</template>
