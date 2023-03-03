
<script>
import { Link } from '@inertiajs/vue3';
export default {
    data() {
        this.headers.push({ title: 'Actions', align: 'end', key: 'actions' })
        return {
            itemsPerPage: 5,
            search: "",
        }
    },
}
</script>

<script setup>
defineProps({
    headers: {type: Array},
    data: {type: Array},
    actions_route: {type: String}
});
</script>

<template>
    <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
    ></v-text-field>

    <v-data-table
        v-model:items-per-page="itemsPerPage"
        :headers="headers"
        :items="data"
        :search="search"
        item-value="name"
        class="elevation-1"
    >
        <template v-slot:item.actions="{ item }">
            <Link :href="route(actions_route + '.destroy', { [actions_route]: item.columns.id })" method="delete" class="underline">
                <v-icon
                    size="small"
                    class="me-2"
                >
                    mdi-delete
                </v-icon>
            </Link>
            <Link :href="route(actions_route + '.edit', { [actions_route]: item.columns.id })" method="get" class="underline">
                <v-icon
                    size="small"
                    class="me-2"
                >
                    mdi-pencil
                </v-icon>
            </Link>
        </template>
    </v-data-table>
</template>
