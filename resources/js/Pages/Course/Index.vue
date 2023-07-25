<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DataTable from "@/Components/DataTable.vue";
import CenterSheet from "@/Components/CenterSheet.vue";
import CreateButton from "@/Components/CreateButton.vue";

defineProps({
    courses: Array,
});
</script>

<script>
export default {
    data() {
        return {
            headers: [
                {title: 'الرمز', align: 'start', key: 'id'},
                {title: 'اسم الكورس', align: 'start', key: 'name'},
            ],
        }
    },
}
</script>

<template>
    <MainLayout title="الكورسات">
        <create-button :link="route('course.create')"/>
        <center-sheet cols="12">
            <v-row class="pt-5">
                <data-table :headers="headers" :data="courses.data" actions_route="course"/>
            </v-row>
        </center-sheet>
    </MainLayout>
</template>
