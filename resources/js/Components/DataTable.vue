<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    headers: {type: Array},
    data: {type: Array},
    actions_route: {type: String},
    uneditable: {type: Boolean},
    showable: {type: Boolean},
});
</script>

<script>
export default {
    data() {
        this.headers.push({ title: 'Actions', align: 'end', key: 'actions' })
        return {
            itemsPerPage: 25,
            search: "",
        }
    },
}
</script>

<template>
    <v-container>
        <v-row>
            <v-text-field
                v-model="search"
                append-inner-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
            ></v-text-field>
        </v-row>
        <v-row>
            <v-data-table
                v-model:items-per-page="itemsPerPage"
                :headers="headers"
                :items="data"
                :search="search"
                item-value="name"
                class="elevation-1"
            >
                <template v-slot:item.actions="{ item }">
                    <Link v-if="!uneditable" as="button" :href="route(actions_route + '.destroy', { [actions_route]: item.columns.id })" method="delete" class="underline">
                        <v-icon
                            size="small"
                            class="me-2"
                        >
                            mdi-delete
                        </v-icon>
                    </Link>
                    <Link v-if="!uneditable" as="button" :href="route(actions_route + '.edit', { [actions_route]: item.columns.id })" method="get" class="underline">
                        <v-icon
                            size="small"
                            class="me-2"
                        >
                            mdi-pencil
                        </v-icon>
                    </Link>
                    <Link v-if="showable" as="button" :href="route(actions_route + '.show', { [actions_route]: item.columns.id })" method="get" class="underline">
                        <v-icon
                            size="small"
                            class="me-2"
                        >
                            mdi-eye
                        </v-icon>
                    </Link>
                </template>
            </v-data-table>
        </v-row>
    </v-container>
</template>
