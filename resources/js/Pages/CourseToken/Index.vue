<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DataTable from "@/Components/DataTable.vue";
import {Link} from '@inertiajs/vue3';
import CreateButton from "@/Components/CreateButton.vue";
import CenterSheet from "@/Components/CenterSheet.vue";

defineProps({
    batches: Array,
});
</script>

<script>
export default {
    data() {
        return {
            headers: [
                {title: 'الرمز', align: 'start', key: 'id'},
                {title: 'تاريخ الصلاحية', align: 'start', key: 'expires_at'},
                {title: 'الدورات', align: 'start', key: 'courses'},
                {title: 'الوسوم', align: 'start', key: 'tags'},
                {title: 'عدد الأكواد', align: 'start', key: 'number_of_tokens'},
                {title: 'عدد الأكواد المستعملة', align: 'start', key: 'number_of_used_tokens'},
            ],
        }
    },
}


</script>

<template>
    <MainLayout title="الأكواد">
        <create-button :link="route('course_token.create')"/>
        <center-sheet cols="12">
            <data-table :headers="headers" :data="batches.data" actions_route="course_token" uneditable showable/>
        </center-sheet>
    </MainLayout>
</template>
