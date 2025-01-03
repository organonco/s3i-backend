<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DataTable from "@/Components/DataTable.vue";
import { Link } from '@inertiajs/vue3';
import CreateButton from "@/Components/CreateButton.vue";
import CenterSheet from "@/Components/CenterSheet.vue";

defineProps({
    categories: Array,
});
</script>

<script>
export default {
    data () {
        return {
            headers: [
                { title: 'الرمز', align: 'start', key: 'id' },
                { title: 'الاسم', align: 'start', key: 'name' },
            ],
        }
    },
}


</script>

<template>
    <MainLayout title="التخصصات">
        <create-button :link="route('category.create')"/>
        <center-sheet cols="12">
            <v-row class="pt-5">
                <data-table :headers="headers" :data="categories.data" actions_route="category" delete-message="حذف التخصص سيؤدي الى حذفه وحذف كل التدريبات التابعة له"/>
            </v-row>
        </center-sheet>
    </MainLayout>
</template>
