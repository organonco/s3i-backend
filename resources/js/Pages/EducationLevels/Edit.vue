<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
import CenterSheet from "@/Components/CenterSheet.vue";
import SimpleFormSheet from "@/Components/SimpleFormSheet.vue";

defineProps({
    education_level: Object,
});
</script>

<script>
import {useForm} from "@inertiajs/vue3";

export default {
    data: function () {
        return {
            form: useForm({
                name: this.education_level.data.name
            })
        }
    },
    methods: {
        submit: function () {
            this.form.put(route('education_level.update', this.education_level.data.id));
        }
    }
}
</script>

<template>
    <MainLayout title="تعديل المستوى الدراسي">
        <simple-form-sheet @save="submit">
            <v-text-field label="اسم المستوى الدراسي" variant="solo" v-model="form.name"
                          :error-messages="form.errors.name"></v-text-field>
        </simple-form-sheet>
    </MainLayout>
</template>
