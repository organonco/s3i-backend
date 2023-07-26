<template>
    <Head><title> تسجيل الدخول </title></Head>
    <v-container fluid>
        <v-row align="center" justify="center" class="ma-16">
            <v-col cols="12" sm="8" md="3">
                <v-card class="elevation-12">
                    <v-toolbar dark flat>
                        <v-toolbar-title>تسجيل الدخول</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form @submit.prevent="submit">
                            <v-text-field v-model="form.username" label="اسم المستخدم" type="text" required :error-messages="form.errors.username "></v-text-field>
                            <v-text-field v-model="form.password" label="كلمة المرور" type="password" required :error-messages="form.errors.password"></v-text-field>
                            <v-btn :disabled="form.processing" color="black" block type="submit">تسجيل الدخول</v-btn>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>`
</template>

<script setup>

import {useForm} from "@inertiajs/vue3";
import { Head } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    username: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
}

</script>
