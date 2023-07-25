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
            this.headers.push({ title: '', align: 'end', key: 'actions' })
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
        <confirmation-dialog v-model="dialogs.destroy.active" title="تأكيد الحذف" @confirm="confirmDestroyDialog">
        </confirmation-dialog>

        <v-row>
            <v-text-field
                v-model="search"
                append-inner-icon="mdi-magnify"
                label="البحث"
                single-line
                hide-details
            ></v-text-field>
        </v-row>
        <v-row>
            <v-data-table-virtual
                :headers="headers"
                :items="data"
                :search="search"
                item-value="name"
                class="elevation-1"
            >
                <template v-slot:item.actions="{ item }">
                    <Link v-if="!uneditable" as="button" :href="route(actions_route + '.edit', { [actions_route]: item.columns.id })" method="get" class="underline">
                        <v-btn prepend-icon="mdi-pencil" color="primary" variant="text">
                            تعديل
                        </v-btn>
                    </Link>
                    <v-btn v-if="!uneditable" prepend-icon="mdi-delete" @click="activateDestroyDialog(item.columns.id)" color="error" variant="text">
                        حذف
                    </v-btn>
                    <Link v-if="showable" as="button" :href="route(actions_route + '.show', { [actions_route]: item.columns.id })" method="get" class="underline">
                        <v-btn prepend-icon="mdi-eye" color="secondary" variant="text">
                            عرض
                        </v-btn>
                    </Link>
                </template>
            </v-data-table-virtual>
        </v-row>
    </v-container>
</template>
