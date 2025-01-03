<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DataTable from "@/Components/DataTable.vue";
import CenterSheet from "@/Components/CenterSheet.vue";

defineProps({
    students: Object,
});
</script>

<script>
export default {
    data() {
        return {
            headers: [
                {title: 'الرمز', align: 'start', key: 'id'},
                {title: 'الاسم', align: 'start', key: 'name_ar'},
                {title: 'رقم الهاتف', align: 'start', key: 'phone'},
                {title: 'تاريخ الانضمام', align: 'start', key: 'created_at'},
            ],
        }
    },
}


</script>

<template>
    <MainLayout title="المتدربين/ات">
        <center-sheet cols="12">
            <v-row class="pt-5">
                <data-table uneditable showable :headers="headers" :data="students.data" actions_route="student"/>
            </v-row>
        </center-sheet>
    </MainLayout>
</template>
