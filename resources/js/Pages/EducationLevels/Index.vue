<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DataTable from "@/Components/DataTable.vue";
import { Link } from '@inertiajs/vue3';

defineProps({
    education_levels: Array,
});
</script>

<script>
export default {
    data () {
        return {
            headers: [
                { title: 'ID', align: 'start', key: 'id' },
                { title: 'Name', align: 'end', key: 'name' },
            ],
        }
    },
}


</script>

<template>
    <MainLayout title="Education Levels">
        <v-row>
            <Link :href="route('education_level.create')">
                <v-btn color="primary"> Create </v-btn>
            </link>
        </v-row>
        <v-row class="pt-5">
            <data-table :headers="headers" :data="education_levels.data" actions_route="education_level"/>
        </v-row>
    </MainLayout>
</template>
