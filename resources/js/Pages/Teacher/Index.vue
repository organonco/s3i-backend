<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DataTable from "@/Components/DataTable.vue";
import { Link } from '@inertiajs/vue3';
import CreateButton from "@/Components/CreateButton.vue";
import CenterSheet from "@/Components/CenterSheet.vue";

defineProps({
    teachers: Array,
});
</script>

<script>
export default {
    data () {
        return {
            headers: [
                { title: 'الرمز', align: 'start', key: 'id' },
                { title: 'اسم المستخدم', align: 'start', key: 'username' },
                { title: 'الاسم', align: 'start', key: 'name' },
                { title: 'الاختصاص', align: 'start', key: 'education' },
            ],
        }
    },
}


</script>

<template>
    <MainLayout title="المدربين">
        <create-button :link="route('teacher.create')"/>
        <center-sheet cols="12">
            <v-row class="pt-5">
                <data-table :headers="headers" :data="teachers.data" actions_route="teacher"/>
            </v-row>
        </center-sheet>
    </MainLayout>
</template>
