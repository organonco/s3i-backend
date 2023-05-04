<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
import CourseItemsInput from "@/Components/Course/CourseItemsInput.vue";

defineProps({
    course: Object,
    categories: Object,
});
</script>

<script>
import {useForm} from "@inertiajs/vue3";
import _ from 'lodash'

export default {
    data: function () {
        return {
            items: this.course.data.items,
            form: useForm({
                _method: "put",
                name: this.course.data.name,
                description: this.course.data.description,
                introduction_video_url: this.course.data.introduction_video_url,
                category_id: this.course.data.category.id,
                students_limit: this.course.data.students_limit,
                image: "",
            })
        }
    },
    methods: {
        submit: function() {
            for(let i = 0; i < this.items.length; i++)
                this.items[i] = _.cloneDeep(this.items[i])
            this.form.transform((data) => ({
                ...data,
                items: this.items,
            })).post(route('course.update', this.course.data.id))
        }
    }
}
</script>

<template>
    <MainLayout title="Edit Course">
        <v-form @submit.prevent="submit">
            <v-text-field label="Name" variant="solo" v-model="form.name" :error-messages="form.errors.name"></v-text-field>
            <v-textarea label="Description" variant="solo" v-model="form.description" :error-messages="form.errors.description"></v-textarea>
            <v-text-field label="Introduction Video URL" variant="solo" v-model="form.introduction_video_url" :error-messages="form.errors.introduction_video_url"></v-text-field>
            <v-text-field label="Students Per Class" type="number" variant="solo" v-model="form.students_limit" :error-messages="form.errors.students_limit"></v-text-field>
            <v-autocomplete
                label="Category"
                variant="solo"
                v-model="form.category_id"
                :items="categories.data"
                item-title="name"
                item-value="id"
            ></v-autocomplete>
            <v-row>
                <v-col>
                    <v-file-input prepend-icon="mdi-image" label="Image" variant="solo" :error-messages="form.errors.image" @change="form.image = $event.target.files[0]"></v-file-input>
                </v-col>
                <v-col cols="3"><v-img :src="course.data.image_url" width="500px"/></v-col>
            </v-row>
            <course-items-input v-model="items"/>
            <save-button/>
        </v-form>
    </MainLayout>
</template>
