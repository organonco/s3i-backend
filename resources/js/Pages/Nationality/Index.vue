<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DataTable from "@/Components/DataTable.vue";
import { Link } from '@inertiajs/vue3';
import CreateButton from "@/Components/CreateButton.vue";
import CenterSheet from "@/Components/CenterSheet.vue";

defineProps({
    nationalities: Array,
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
    <MainLayout title="الجنسيات">
        <create-button :link="route('nationality.create')"/>
        <center-sheet cols="12">
            <v-row class="pt-5">
                <data-table :headers="headers" :data="nationalities.data" actions_route="nationality"/>
            </v-row>
        </center-sheet>
    </MainLayout>
</template>
