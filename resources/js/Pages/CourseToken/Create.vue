<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SimpleFormSheet from "@/Components/SimpleFormSheet.vue";

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
    <MainLayout title="مجموعة أكواد جديدة">
        <simple-form-sheet cols="6" @save="submit">
            <v-autocomplete v-model="form.courses" label="الدورات" :items="courses.data"
                            item-value="id" item-title="name"
                            chips
                            closable-chips
                            multiple
            >

            </v-autocomplete>
            <v-combobox
                    v-model="form.tags"
                    v-model:search="search"
                    :items="tags"
                    label="الوسوم"
                    multiple
                    closable-chips
                    chips
            >
                <template v-slot:no-data>
                    <v-list-item>
                        <v-list-item-title>
                            لإنشاء واحدة جديدة <kbd> Enter </kbd> لا توجد نتائج مطابقة. اضغط على
                        </v-list-item-title>
                    </v-list-item>
                </template>
            </v-combobox>
            <v-text-field v-model="form.expiry_date" label="تاريخ الصلاحية" type="date"/>
            <v-text-field v-model="form.count" label="عدد الأكواد" type="number"/>
        </simple-form-sheet>
    </MainLayout>
</template>
