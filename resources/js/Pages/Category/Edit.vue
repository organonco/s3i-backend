<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";

defineProps({
    category: Object,
});
</script>

<script>
import {useForm} from "@inertiajs/vue3";

export default {
    data: function () {
        return {
            form: useForm({
                _method: "put",
                name: this.category.data.name,
                icon: "",
            })
        }
    },
    methods: {
        submit: function () {
            this.form.post(route('category.update', this.category.data.id));
        }
    }
}
</script>

<template>
    <MainLayout title="Edit Category">
        <v-form @submit.prevent="submit">
            <v-row>
                <v-col cols="11">
                    <v-text-field name="name" label="Name" variant="solo" v-model="form.name"
                                  :error-messages="form.errors.name"></v-text-field>
                </v-col>
                <v-col>
                    <v-img :src="category.data.icon_url" height="50px"/>
                </v-col>
            </v-row>
            <v-file-input prepend-icon="mdi-image" name="icon" label="Icon" variant="solo"
                          :error-messages="form.errors.icon"
                          @input="form.icon = $event.target.files[0]"></v-file-input>
            <save-button/>
        </v-form>
    </MainLayout>
</template>
