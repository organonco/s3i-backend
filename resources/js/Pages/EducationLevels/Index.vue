<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DataTable from "@/Components/DataTable.vue";
import CreateButton from "@/Components/CreateButton.vue";
import CenterSheet from "@/Components/CenterSheet.vue";

defineProps({
    education_levels: Array,
});
</script>

<script>
export default {
    data() {
        return {
            headers: [
                {title: 'الرمز', align: 'start', key: 'id'},
                {title: 'الاسم', align: 'start', key: 'name'},
            ],
        }
    },
}


</script>

<template>
    <MainLayout title="المستويات الدراسية">
        <center-sheet cols="12">
            <v-row class="pt-5">
                <data-table :headers="headers" :data="education_levels.data" actions_route="education_level" uneditable/>
            </v-row>
        </center-sheet>
    </MainLayout>
</template>
