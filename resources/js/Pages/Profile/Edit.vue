<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
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
        submit: function() {
            this.form.post(route('password.update'));
        }
    }
}
</script>
<template>
    <MainLayout title="Update Password">
        <v-form @submit.prevent="submit">
            <v-text-field label="Current Password" variant="solo" v-model="form.current_password" :error-messages="form.errors.current_password"></v-text-field>
            <v-text-field label="New Password" variant="solo" v-model="form.password" :error-messages="form.errors.password"></v-text-field>
            <v-text-field label="New Password Again" variant="solo" v-model="form.password_confirmation" :error-messages="form.errors.password_confirmation"></v-text-field>
            <save-button/>
        </v-form>
    </MainLayout>
</template>
