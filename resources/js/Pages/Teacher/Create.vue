<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
import CenterSheet from "@/Components/CenterSheet.vue";
import SimpleFormSheet from "@/Components/SimpleFormSheet.vue";

defineProps({});
</script>

<script>
import {useForm} from "@inertiajs/vue3";

export default {
    data: function () {
        return {
            form: useForm({
                name: "",
                username: "",
                password: "",
            })
        }
    },
    methods: {
        submit: function () {
            this.form.post(route('teacher.store'));
        }
    }
}
</script>

<template>
    <MainLayout title="معلم جديد">
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
