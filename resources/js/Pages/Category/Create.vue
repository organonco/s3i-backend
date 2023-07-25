<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
import SimpleFormSheet from "@/Components/SimpleFormSheet.vue";
defineProps({});
</script>

<script>
import {useForm} from "@inertiajs/vue3";
export default {
    data: function () {
        return {
            form: useForm({
                name: "",
                icon: ""
            })
        }
    },
    methods: {
        submit: function() {
            this.form.post(route('category.store'));
        }
    }
}
</script>

<template>
    <MainLayout title="قسم كورسات جديد">
        <simple-form-sheet @save="submit">
            <v-text-field label="اسم القسم" variant="solo" v-model="form.name" :error-messages="form.errors.name"></v-text-field>
            <v-file-input prepend-icon="mdi-image" name="icon" label="أيقونة القسم" variant="solo"
                          :error-messages="form.errors.icon"
                          @input="form.icon = $event.target.files[0]"></v-file-input>
        </simple-form-sheet>
    </MainLayout>
</template>
