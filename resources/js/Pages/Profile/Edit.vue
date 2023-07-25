<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SimpleFormSheet from "@/Components/SimpleFormSheet.vue";
</script>
<script>
import {useForm} from "@inertiajs/vue3";

export default {
    data: function () {
        return {
            form: useForm({
                current_password: '',
                password: '',
                password_confirmation: '',
            })
        }
    },
    methods: {
        submit: function () {
            this.form.put(route('password.update'));
        }
    }
}
</script>
<template>
    <MainLayout title="تغيير كلمة المرور">
        <simple-form-sheet @save="submit">
            <v-text-field label="كلمة المرور الحالية" variant="solo" v-model="form.current_password"
                          :error-messages="form.errors.current_password" type="password"></v-text-field>
            <v-text-field label="كلمة المرور الجديدة" variant="solo" v-model="form.password"
                          :error-messages="form.errors.password" type="password"></v-text-field>
            <v-text-field label="إعادة كلمة المرور الجديدة" variant="solo" v-model="form.password_confirmation"
                          :error-messages="form.errors.password_confirmation" type="password"></v-text-field>
        </simple-form-sheet>
    </MainLayout>
</template>
