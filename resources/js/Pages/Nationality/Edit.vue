<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
import CenterSheet from "@/Components/CenterSheet.vue";
import SimpleFormSheet from "@/Components/SimpleFormSheet.vue";

defineProps({
    nationality: Object,
});
</script>

<script>
import {useForm} from "@inertiajs/vue3";

export default {
    data: function () {
        return {
            form: useForm({
                name: this.nationality.data.name
            })
        }
    },
    methods: {
        submit: function () {
            this.form.put(route('nationality.update', this.nationality.data.id));
        }
    }
}
</script>

<template>
    <MainLayout title="تعديل المحافظة">
        <simple-form-sheet @save="submit">
            <v-text-field label="اسم المحافظة" variant="solo" v-model="form.name"
                          :error-messages="form.errors.name"></v-text-field>
        </simple-form-sheet>
    </MainLayout>
</template>
