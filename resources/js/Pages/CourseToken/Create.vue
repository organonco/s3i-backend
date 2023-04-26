<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";

defineProps({
    'courses': Array,
    'tags': Array
});
</script>

<script>
import {useForm} from "@inertiajs/vue3";

export default {
    data: function () {
        return {
            search: null,
            form: useForm({
                courses: [],
                expiry_date: "",
                count: "",
                tags: [],
            })
        }
    },
    methods: {
        submit: function () {
            this.form.post(route('course_token.store'));
        }
    }
}
</script>

<template>
    <MainLayout title="Create Tokens">
        <v-form @submit.prevent="submit">
            <v-autocomplete v-model="form.courses" label="Courses" :items="courses.data" multiple chips clearable item-value="id" item-title="name"></v-autocomplete>
            <v-combobox
                v-model="form.tags"
                v-model:search="search"
                :hide-no-data="false"
                :items="tags.data"
                hide-selected
                label="Tags"
                multiple
                persistent-hint
                small-chips
            >
                <template v-slot:no-data>
                    <v-list-item>
                        <v-list-item-title>
                            No results matching. Press <kbd>enter</kbd> to create a new one
                        </v-list-item-title>
                    </v-list-item>
                </template>
            </v-combobox>
            <v-text-field v-model="form.expiry_date" label="Expiry Date" type="date"/>
            <v-text-field v-model="form.count" label="Number Of Tokens" type="number"/>
            <save-button/>
        </v-form>
    </MainLayout>
</template>
