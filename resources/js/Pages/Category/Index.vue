<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DataTable from "@/Components/DataTable.vue";
import { Link } from '@inertiajs/vue3';

defineProps({
    categories: Array,
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
    <MainLayout title="Categories">
        <v-row>
            <Link :href="route('category.create')">
                <v-btn color="primary"> Create </v-btn>
            </link>
        </v-row>
        <v-row class="pt-5">
            <data-table :headers="headers" :data="categories.data" actions_route="category"/>
        </v-row>
    </MainLayout>
</template>
