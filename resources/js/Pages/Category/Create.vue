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
                name: "",
                icon: ""
            })
        }
    },
    methods: {
        submit: function() {
            this.form.post(route('category.store'));
        }
    }
}
</script>

<template>
    <MainLayout title="Create Category">
        <v-form @submit.prevent="submit">
            <v-text-field label="Name" variant="solo" v-model="form.name" :error-messages="form.errors.name"></v-text-field>
            <v-file-input prepend-icon="mdi-image" name="icon" label="Icon" variant="solo"
                          :error-messages="form.errors.icon"
                          @input="form.icon = $event.target.files[0]"></v-file-input>
            <save-button/>
        </v-form>
    </MainLayout>
</template>
