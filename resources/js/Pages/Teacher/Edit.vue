<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SimpleFormSheet from "@/Components/SimpleFormSheet.vue";

defineProps({
    teacher: Object,
});
</script>

<script>
import { useForm } from "@inertiajs/vue3";

export default {
    data: function () {
        return {
            form: useForm({
                _method: "put",
                name: this.teacher.data.name,
                username: this.teacher.data.username,
                password: '',
                bio: this.teacher.data.bio,
                education: this.teacher.data.education,
                visible: this.teacher.data.visible,
                image: "",
            })
        }
    },
    methods: {
        submit: function () {
            this.form.post(route('teacher.update', this.teacher.data.id));
        }   
    }
}
</script>

<template>
    <MainLayout title="تعديل المدرب">
        <simple-form-sheet cols="12" @save="submit" >
            <v-row>
                <v-col cols="6">
                    <img :src="teacher.data.image_url" style="width: 100%"/>
                </v-col>
                <v-col cols="6">
                    <v-text-field label="اسم المدرب" variant="solo" v-model="form.name"
                        :error-messages="form.errors.name"></v-text-field>
                    <v-text-field label="اسم المستخدم" variant="solo" v-model="form.username"
                        :error-messages="form.errors.username"></v-text-field>
                    <v-textarea label="لمحة" variant="solo" v-model="form.bio"
                        :error-messages="form.errors.bio"></v-textarea>
                    <v-text-field label="الاختصاص" variant="solo" v-model="form.education"
                        :error-messages="form.errors.education"></v-text-field>
                    <v-file-input prepend-icon="mdi-image" name="image" label="الصورة" variant="solo"
                        :error-messages="form.errors.image" @input="form.image = $event.target.files[0]"></v-file-input>
                    <v-text-field label="كلمة المرور" variant="solo" v-model="form.password"
                        :error-messages="form.errors.password" type="password"></v-text-field>
                    <v-checkbox label="ظهور في صفحة الكادر التدريسي" v-model="form.visible" :true-value="1" :false-value="0">
                    </v-checkbox>
                </v-col>
            </v-row>
        </simple-form-sheet>
    </MainLayout>
</template>

