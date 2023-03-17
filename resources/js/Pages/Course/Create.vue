<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
defineProps({
    categories: Array
});
</script>

<script>
import {useForm} from "@inertiajs/vue3";
export default {
    data: function () {
        return {
            form: useForm({
                name: "",
                description: "",
                introduction_video_url: "",
                category_id: "",
                image: ""
            })
        }
    },
    methods: {
        submit: function() {
            this.form.post(route('course.store'));
        }
    }
}
</script>

<template>
    <MainLayout title="Create Course">
        <v-form @submit.prevent="submit">
            <v-text-field label="Name" variant="solo" v-model="form.name" :error-messages="form.errors.name"></v-text-field>
            <v-text-field label="Description" variant="solo" v-model="form.description" :error-messages="form.errors.description"></v-text-field>
            <v-text-field label="Introduction Video URL" variant="solo" v-model="form.introduction_video_url" :error-messages="form.errors.introduction_video_url"></v-text-field>
            <v-select
                label="Category"
                variant="solo"
                v-model="form.category_id"
                :items="categories.data"
                :error-messages="form.errors.category_id"
                item-title="name"
                item-value="id"
            ></v-select>
            <v-file-input prepend-icon="mdi-image" name="image" label="Image" variant="solo" :error-messages="form.errors.image" @input="form.image = $event.target.files[0]"></v-file-input>
            <save-button/>
        </v-form>
    </MainLayout>
</template>
