<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import CenterSheet from "@/Components/CenterSheet.vue";
import AddItemDialog from "@/Components/Course/AddItemDialog.vue";

defineProps({
    student: Object,
    success: Boolean,
});

const rows = [
    { icon: "mdi-account", key: "name_ar", name: "الاسم" },
    { icon: "mdi-account", key: "name_en", name: "الاسم باللغة الانكليزية" },
    { icon: "mdi-phone", key: "phone", name: "رقم الهاتف" },
    { icon: "mdi-email", key: "email", name: "البريد الالكتروني" },
    { icon: "mdi-calendar", key: "date_of_birth", name: "تاريخ الميلاد" },
    { icon: "mdi-earth", key: "nationality", name: "الجنسية" },
    { icon: "mdi-school", key: "education_level", name: "المستوى الدراسي" },
    { icon: "mdi-map-marker", key: "address", name: "العنوان" },
    { icon: "mdi-information-variant", key: "reference", name: "كيف علمت عنا" },
    { icon: "mdi-calendar", key: "created_at", name: "تاريخ الانضمام" },
];
</script>

<script>
import { useForm } from "@inertiajs/vue3";

export default {
    computed: {
        requiredRule: function () {
            return [(v) => !!v || "Required"];
        },
    },
    data() {
        return {
            form: useForm({
                attempts: this.student.data["number_of_login_attempts"],
            }),
            pwd_form: useForm({
                password: null,
            }),
            modal: false,
        };
    },
    methods: {
        resetLoginAttempts: function (id) {
            this.form.put(route("student.unfreeze", { student: id }));
            if (
                this.form.attempts ==
                this.student.data["number_of_login_attempts"]
            )
                this.form.attempts = 0;
        },
        submitpwd: function () {
            this.pwd_form.put(
                route("student.reset_password", {
                    student: this.student.data.id,
                })
            );
        },
        opendialog: function () {
            this.modal = true;
        },
    },
};
</script>

<template>
    <MainLayout title="عرض بطاقة المتدرب">
        <center-sheet cols="12">
            <v-row v-for="row in rows">
                <v-col cols="1" align-self="center">
                    <v-icon>{{ row.icon }}</v-icon>
                </v-col>
                <v-col cols="11" align-self="center">
                    <v-text-field
                        variant="outlined"
                        :label="row.name"
                        v-model="student.data[row.key]"
                        readonly
                        hide-details
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row justify="space-around">
                <v-col cols="1" align-self="center">
                    <v-icon>mdi-login</v-icon>
                </v-col>
                <v-col cols="7" align-self="center">
                    <v-text-field
                        variant="outlined"
                        label="عدد مرات تسجيل الدخول"
                        v-model="form.attempts"
                    ></v-text-field>
                </v-col>
                <v-col cols="4" align-self="center">
                    <v-btn
                        append-icon="mdi-lock-reset"
                        variant="text"
                        color="secondary"
                        @click="resetLoginAttempts(student.data.id)"
                        >اعادة التعيين
                    </v-btn>
                </v-col>
            </v-row>
            <v-row justify="space-around">
                <v-divider/>
                <br/>
                <v-col cols="7" align-self="center">
                    <v-text-field
                        variant="outlined"
                        label="كلمة المرور"
                        v-model="pwd_form.password"
                        :error-messages="pwd_form.errors.password"
                    ></v-text-field>
                </v-col>
                <v-col cols="5" align-self="center">
                    <v-btn
                        append-icon="mdi-account-lock"
                        variant="text"
                        color="error"
                        @click="submitpwd()"
                        >إعادة تعيين
                    </v-btn>
                </v-col>
            </v-row>
        </center-sheet>
    </MainLayout>
</template>
