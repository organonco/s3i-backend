<script setup>
import { Head } from '@inertiajs/vue3';
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
    <Head>
        <title>
            Nationalities
        </title>
    </Head>

    <MainLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nationalities</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="row py-4">
                    <Link :href="route('nationality.create')">
                        <v-btn color="primary"> Create </v-btn>
                    </link>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <data-table :headers="headers" :data="nationalities.data" actions_route="nationality"/>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
