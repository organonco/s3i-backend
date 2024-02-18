<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SimpleFormSheet from "@/Components/SimpleFormSheet.vue";

defineProps({
    teacher: Object,
});
</script>

<script>
import {useForm} from "@inertiajs/vue3";

export default {
    data: function () {
        return {
            form: useForm({
                username: this.teacher.data.username,
                name: this.teacher.data.name,
                password: ''
            })
        }
    },
    methods: {
        submit: function () {
            this.form.put(route('teacher.update', this.teacher.data.id));
        }
    }
}
</script>

<template>
    <MainLayout title="تعديل المدرب">
        <simple-form-sheet @save="submit">
            <v-text-field label="اسم المدرب" variant="solo" v-model="form.name"
                          :error-messages="form.errors.name"></v-text-field>
            <v-text-field label="اسم المستخدم" variant="solo" v-model="form.username"
                          :error-messages="form.errors.username"></v-text-field>
            <v-text-field label="كلمة المرور" variant="solo" v-model="form.password"
                          :error-messages="form.errors.password" type="password"></v-text-field>
        </simple-form-sheet>
    </MainLayout>
</template>
