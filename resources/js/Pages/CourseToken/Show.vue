<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import DataTable from "@/Components/DataTable.vue";
import CenterSheet from "@/Components/CenterSheet.vue";
import CreateButton from "@/Components/CreateButton.vue";

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
                {title: 'الكود', align: 'start', key: 'token'},
                {title: 'المتدرب', align: 'start', key: 'student'},
            ],
        }
    },
    computed: {
        courses: function () {
            return this.batch.data.courses.map(i => i['name'])
        }
    }
}
</script>

<template>
    <MainLayout title="عرض الأكواد">
        <center-sheet cols="12">
            <v-text-field v-model="batch.data.id" label="الرمز" readonly></v-text-field>
            <v-autocomplete v-model="courses" chips readonly label="التدريبات"/>
            <v-combobox
                    v-model="batch.data.tags"
                    :hide-no-data="false"
                    :items="tags.data"
                    hide-selected
                    label="الوسوم"
                    multiple
                    persistent-hint
                    small-chips
                    readonly
            >
            </v-combobox>
            <v-text-field v-model="batch.data.expires_at" label="تاريخ الصلاحية" readonly></v-text-field>
            <v-text-field v-model="batch.data.number_of_tokens" label="عدد الأكواد" readonly></v-text-field>
            <v-text-field v-model="batch.data.number_of_used_tokens" label="عدد الأكواد المستخدمة"
                          readonly></v-text-field>
            <data-table :headers="headers" :data="batch.data.tokens" actions_route="token" uneditable></data-table>
        </center-sheet>
        <create-button icon="mdi-download" :link="route('course_token.export', batch.data.id)"/>
    </MainLayout>
</template>
