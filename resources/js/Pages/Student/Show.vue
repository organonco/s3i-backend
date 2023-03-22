<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from '@inertiajs/vue3';
defineProps({
    student: Object,
});
</script>


<script>
export default {
    data() {

    },
}
</script>

<template>
    <MainLayout title="Show Student">
        <v-container>
            <v-card class="mx-auto text-right" max-width="700">
                <v-card-title class="text-h5 font-weight-bold pa-5">{{ student.data.name_en + " - " + student.data.name_ar }}</v-card-title>
                <v-card-text>
                    <v-row>
                        <v-col cols="12">
                            <v-divider class="mt-4 mb-4"></v-divider>
                            <v-list dense>
                                <v-list-item>
                                    <v-list-item-title> {{ student.data.phone }} <v-icon>mdi-phone</v-icon> </v-list-item-title>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-title> {{ student.data.email }} <v-icon>mdi-email</v-icon> </v-list-item-title>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-title> {{ student.data.date_of_birth }} <v-icon>mdi-cake</v-icon> </v-list-item-title>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-title> {{ student.data.nationality }} <v-icon>mdi-flag</v-icon> </v-list-item-title>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-title> {{ student.data.education_level }} <v-icon>mdi-school</v-icon> </v-list-item-title>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-title> {{ student.data.address }} <v-icon>mdi-map-marker</v-icon> </v-list-item-title>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-title> {{ student.data.reference }} <v-icon>mdi-information-variant</v-icon> </v-list-item-title>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-title>
                                        <Link as="button" :href="route('student.unfreeze', { 'student': student.data.id })" method="put" class="underline">
                                            Reset
                                        </Link>
                                        {{student.data.number_of_login_attempts}}
                                        <v-icon> mdi-login </v-icon>
                                    </v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-container>
    </MainLayout>
</template>
