<script setup>
import { Link } from '@inertiajs/vue3';
import ConfirmationDialog from "@/Components/ConfirmationDialog.vue";
defineProps({
    headers: {type: Array},
    data: {type: Array},
    actions_route: {type: String},
    uneditable: {type: Boolean},
    showable: {type: Boolean},
});
</script>

<script>
import {useForm} from "@inertiajs/vue3";

export default {
    data() {
        if(this.showable || !this.uneditable)
            this.headers.push({ title: 'Actions', align: 'end', key: 'actions' })
        return {
            itemsPerPage: 25,
            search: "",
            dialogs: {
                destroy: {
                    active: false,
                    id: null
                }
            }
        }
    },
    methods: {
        activateDestroyDialog: function(id){
            this.dialogs.destroy.active = true;
            this.dialogs.destroy.id = id;
        },
        confirmDestroyDialog: function(){
            useForm({}).delete(route(this.actions_route + '.destroy', { [this.actions_route]: this.dialogs.destroy.id }))
        }
    },
}
</script>

<template>
    <v-container>
        <confirmation-dialog v-model="dialogs.destroy.active" title="Confirm Delete" @confirm="confirmDestroyDialog">
            are you sure you want to delete this
        </confirmation-dialog>

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
                    <v-icon v-if="!uneditable" @click="activateDestroyDialog(item.columns.id)">mdi-delete</v-icon>
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
