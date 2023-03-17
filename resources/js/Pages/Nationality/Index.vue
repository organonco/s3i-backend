<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DataTable from "@/Components/DataTable.vue";
import { Link } from '@inertiajs/vue3';

defineProps({
    nationalities: Array,
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
    <MainLayout title="Nationalities">
        <v-row>
            <Link as="div" :href="route('nationality.create')">
                <v-btn color="primary"> Create </v-btn>
            </link>
        </v-row>
        <v-row class="pt-5">
            <data-table :headers="headers" :data="nationalities.data" actions_route="nationality"/>
        </v-row>
    </MainLayout>
</template>
