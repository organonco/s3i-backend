<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DataTable from "@/Components/DataTable.vue";

defineProps({
    students: Object,
});
</script>

<script>
export default {
    data () {
        return {
            headers: [
                { title: 'ID', align: 'start', key: 'id' },
                { title: 'Name', align: 'end', key: 'name_ar' },
                { title: 'Phone', align: 'end', key: 'phone' },
            ],
        }
    },
}


</script>

<template>
    <MainLayout title="Students">
        <v-row class="pt-5">
            <data-table uneditable showable :headers="headers" :data="students.data" actions_route="student"/>
        </v-row>
    </MainLayout>
</template>
