<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
import CenterSheet from "@/Components/CenterSheet.vue";
import SimpleFormSheet from "@/Components/SimpleFormSheet.vue";

defineProps({});
</script>

<script>
import {useForm} from "@inertiajs/vue3";

export default {
    data: function () {
        return {
            form: useForm({
                name: ""
            })
        }
    },
    methods: {
        submit: function () {
            this.form.post(route('education_level.store'));
        }
    }
}
</script>

<template>
    <MainLayout title="مستوى دراسي جديد">
        <simple-form-sheet @save="submit">
            <v-text-field label="اسم المستوى الدراسي" variant="solo" v-model="form.name"
                          :error-messages="form.errors.name"></v-text-field>
        </simple-form-sheet>
    </MainLayout>
</template>
