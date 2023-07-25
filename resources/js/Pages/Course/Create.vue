<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
import CourseItemsInput from "@/Components/Course/CourseItemsInput.vue";
import SimpleFormSheet from "@/Components/SimpleFormSheet.vue";

defineProps({
    categories: Array,
    teachers: Array,
});
</script>

<script>
import {useForm} from "@inertiajs/vue3";
import _ from "lodash";

export default {
    data: function () {
        return {
            items: [],
            form: useForm({
                name: "",
                description: "",
                introduction_video_url: "",
                category_id: "",
                image: "",
                students_limit: "",
                user_ids: [],
            })
        }
    },
    methods: {
        submit: function () {
            for (let i = 0; i < this.items.length; i++)
                this.items[i] = _.cloneDeep(this.items[i])
            this.form.transform((data) => ({
                ...data,
                items: this.items,
            })).post(route('course.store'));
        }
    }
}
</script>

<template>
    <MainLayout title="كورس جديد">
        <simple-form-sheet cols="8" @save="submit">
            <v-row>
                <v-text-field label="اسم الكورس" variant="solo" v-model="form.name"
                              :error-messages="form.errors.name"></v-text-field>
            </v-row>
            <v-row>
                <v-textarea label="الوصف" variant="solo" v-model="form.description"
                              :error-messages="form.errors.description"></v-textarea>
            </v-row>
            <v-row>
                <v-text-field label="رابط الفيديو التعريفي" variant="solo" v-model="form.introduction_video_url"
                              :error-messages="form.errors.introduction_video_url"></v-text-field>
            </v-row>
            <v-row>
                <v-text-field label="عدد الطلاب في كل صف" type="number" variant="solo" v-model="form.students_limit"
                              :error-messages="form.errors.students_limit"></v-text-field>
            </v-row>
            <v-row>
                <v-autocomplete
                        label="القسم"
                        variant="solo"
                        v-model="form.category_id"
                        :items="categories.data"
                        :error-messages="form.errors.category_id"
                        item-title="name"
                        item-value="id"
                ></v-autocomplete>
            </v-row>
            <v-row>
                <v-select
                        label="المعلمين"
                        variant="solo"
                        v-model="form.user_ids"
                        :items="teachers.data"
                        :error-messages="form.errors.user_ids"
                        multiple
                        item-title="name"
                        item-value="id"
                ></v-select>
            </v-row>
            <v-row>
                <v-file-input prepend-icon="mdi-image" name="image" label="الصورة" variant="solo"
                              :error-messages="form.errors.image"
                              @input="form.image = $event.target.files[0]"></v-file-input>
            </v-row>
            <course-items-input v-model="items"/>
        </simple-form-sheet>
    </MainLayout>
</template>
