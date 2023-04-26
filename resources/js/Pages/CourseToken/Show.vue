<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DataTable from "@/Components/DataTable.vue";
import {Link} from "@inertiajs/vue3";
defineProps({
    batch: Object,
    tags: Array,
});
</script>


<script>


export default {
    data() {
        return {
            headers: [
                {title: 'Token', align: 'start', key: 'token'},
                {title: 'Student', align: 'end', key: 'student'},
            ],
        }
    },
    computed: {
        courses: function(){
            return this.batch.data.courses.map(i => i['name'])
        }
    }
}
</script>

<template>
    <MainLayout title="Show Tokens">
        <v-container>
            <v-text-field v-model="batch.data.id" label="ID" readonly></v-text-field>
            <v-autocomplete v-model="courses" chips readonly label="Courses"/>
            <v-combobox
                v-model="batch.data.tags"
                :hide-no-data="false"
                :items="tags.data"
                hide-selected
                label="Tags"
                multiple
                persistent-hint
                small-chips
                readonly
            >
            </v-combobox>
            <v-text-field v-model="batch.data.expires_at" label="Expires At" readonly></v-text-field>
            <v-text-field v-model="batch.data.number_of_tokens" label="Number Of Tokens" readonly></v-text-field>
            <v-text-field v-model="batch.data.number_of_used_tokens" label="Number Of Used Tokens" readonly></v-text-field>
            <Link as="div" :href="route('course_token.export', batch.data.id)" class="my-4">
                <v-btn color="primary"> Export To CSV </v-btn>
            </link>
            <data-table :headers="headers" :data="batch.data.tokens" actions_route="token" uneditable></data-table>
        </v-container>
    </MainLayout>
</template>
