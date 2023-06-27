<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import ChipWithBadge from "@/Components/ChipWithBadge.vue";

defineProps({
    classrooms: Object,
});
</script>

<script>
import {useForm} from "@inertiajs/vue3";
import _ from "lodash";
import axios from "axios";


export default {
    data: function () {
        return {
            selectedClassroomIndex: -1,
            loading: {
                students: 0,
                feedback: false,
            },
            classroomsData: {...this.$props.classrooms.data},
            headers: {
                students: [
                    {title: 'الاسم', key: 'name_ar', align: 'end'},
                ],
                quizzes: [
                    {title: 'اسم الطالب', key: 'student_name', align: "end"},
                ],
                homeworks: [
                    {title: '', align: 'end', key: 'actions'},
                    {title: 'اسم الطالب', key: 'student_name', align: "end"},
                ],
            },
            dialogs: {
                homework: false,
                feedback: false,
            },
            selected: {
                classroom: {
                    index: null,
                },
                homework: {
                    submission_id: null,
                    homework_name: null,
                    feedback: null,
                },
            },
            forms: {
                homework: {
                    feedback: ""
                }
            }
        }
    },
    methods: {
        selectClassroom: function (index) {
            this.openClassroom(index);
            this.fetchClassroom(index);
        },

        addLoaded: function () {
            this.loading.classroom = (this.loading.classroom + 1) % 4;
        },

        fetchClassroom: function (index) {
            this.loading.classroom = 1;
            this.selected.classroom.index = index;
            this.fetchStudents(index);
            this.fetchQuizzes(index);
            this.fetchHomeworks(index);
        },

        fetchStudents: function (index) {
            axios.get(route('classroom.students', this.classroomsData[index].id)).then((response) => {
                this.addLoaded();
                this.classroomsData[index].students = response.data.data;
            })
        },

        fetchQuizzes: function (index) {
            axios.get(route('classroom.quizzes', this.classroomsData[index].id)).then((response) => {
                this.addLoaded();
                this.classroomsData[index].quizzes = response.data.data;
            })
        },

        fetchHomeworks: function (index) {
            axios.get(route('classroom.homeworks', this.classroomsData[index].id)).then((response) => {
                this.addLoaded();
                this.classroomsData[index].homeworks = response.data.data;
            })
        },

        openClassroom: function (index) {
            if (this.selectedClassroomIndex === -1) {
                this.selectedClassroomIndex = index;
                return
            }
            this.selectedClassroomIndex = -1;

            function sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }

            sleep(700).then(() => {
                this.selectedClassroomIndex = index;
            });
        },
        closeClassroom: function () {
            this.selectedClassroomIndex = -1;
        },
        openHomeworksDialog: function (item) {
            this.selected.homework.submission_id = item.id
            this.selected.homework.homework_name = item.homework_name
            this.dialogs.homework = true
        },
        closeHomeworksDialog: function () {
            this.forms.homework.feedback = ""
            this.dialogs.homework = false
        },
        submitHomeworkFeedback: async function (event) {
            this.loading.feedback = true;
            var feedback = this.forms.homework.feedback;
            axios.post(route('homework.feedback', this.selected.homework.submission_id), {
                "feedback": feedback
            }).then((response) => {
                this.classroomsData[this.selected.classroom.index].homeworks.forEach((homework) => {
                    if (homework.id == this.selected.homework.submission_id) {
                        homework.has_feedback = true;
                        homework.feedback = feedback
                    }
                });
                this.loading.feedback = true;
                this.closeHomeworksDialog();
            })
        },
        openFeedbackDialog: function (item) {
            this.selected.homework.feedback = item.feedback
            this.selected.homework.homework_name = item.homework_name
            this.dialogs.feedback = true
        },
    },
    computed: {
        selectedClassroom: function () {
            return this.classroomsData[this.selectedClassroomIndex]
        },
        requiredRule: function () {
            return [v => !!v || 'مطلوب'];
        },
    }
}
</script>

<template>
    <MainLayout title="Classrooms">
        <v-container>
            <v-row>
                <v-col cols="12">
                    <v-expand-transition>
                        <v-card v-if="selectedClassroomIndex !== -1"
                                width="100%"
                                class="text-right"
                                :loading="loading.classroom"
                                variant="elevated"
                        >
                            <v-card-title class="pt-8 text-center" style="font-size: xx-large; font-weight: bold">
                                {{ this.selectedClassroom.name }}
                            </v-card-title>
                            <v-card-text class="pa-12">
                                <v-container>
                                    <v-row>
                                        <v-col cols="4" sm="3">
                                            <v-card variant="outlined" class="text-center">
                                                <v-card-title class="pt-4 text-center">
                                                    الطلاب
                                                </v-card-title>
                                                <v-card-text>
                                                    <v-data-table
                                                            density="compact"
                                                            :headers="headers.students"
                                                            :items="selectedClassroom.students"
                                                    >
                                                    </v-data-table>
                                                </v-card-text>
                                            </v-card>
                                        </v-col>

                                        <v-col cols="8">
                                            <v-row>
                                                <v-col cols="12">
                                                    <v-card variant="outlined" class="text-left">
                                                        <v-card-title class="pt-4 text-center">
                                                            الاختبارات
                                                        </v-card-title>
                                                        <v-card-text>
                                                            <v-data-table
                                                                    density="compact"
                                                                    :group-by="[{key: 'quiz_name', order: 'asc', align: 'end'}]"
                                                                    :headers="headers.quizzes"
                                                                    :items="selectedClassroom.quizzes"
                                                            ></v-data-table>
                                                        </v-card-text>
                                                    </v-card>
                                                </v-col>
                                            </v-row>
                                            <v-row>
                                                <v-col cols="12">
                                                    <v-card variant="outlined" class="text-left">
                                                        <v-card-title class="pt-4 text-center">
                                                            الوظائف
                                                        </v-card-title>
                                                        <v-card-text>
                                                            <v-data-table
                                                                    density="compact"
                                                                    :group-by="[{key: 'homework_name', order: 'asc', align: 'end'}]"
                                                                    :headers="headers.homeworks"
                                                                    :items="selectedClassroom.homeworks"
                                                                    item-value="name"
                                                            >
                                                                <template v-slot:item.actions="{ item }">
                                                                    <v-btn v-if="!item.raw.has_feedback"
                                                                           variant="text"
                                                                           color="success"
                                                                           @click="openHomeworksDialog(item.raw)">
                                                                        تصحيح
                                                                    </v-btn>
                                                                    <v-btn v-else variant="text" color="success"
                                                                           @click="openFeedbackDialog(item.raw)">
                                                                        عرض التصحيح
                                                                    </v-btn>
                                                                </template>
                                                            </v-data-table>
                                                        </v-card-text>
                                                        <v-card-actions>
                                                            <v-col>
                                                                <v-btn variant="outlined" color="success"
                                                                       @click="openHomeworksDialog"> تصحيح جميع الوظائف
                                                                </v-btn>
                                                            </v-col>
                                                        </v-card-actions>
                                                    </v-card>
                                                </v-col>
                                            </v-row>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn variant="text" @click="closeClassroom"> اغلاق</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-expand-transition>
                </v-col>
            </v-row>
            <v-row class="flex-row justify-center">
                <template v-for="(classroom, index) in classroomsData">
                    <v-col cols="3">
                        <v-card
                                class="text-center"
                                @click="selectClassroom(index)"
                                variant="outlined"
                        >
                            <v-card-title class="mt-2" style="font-size: larger; font-weight: bolder">
                                {{ classroom.name }}
                                <div style="font-size: smaller; font-weight: lighter">
                                    {{ classroom.course.category }}
                                </div>
                            </v-card-title>
                            <v-card-subtitle>
                                {{ classroom.number_of_students }} / {{ classroom.course.students_limit }}
                                <v-icon icon="mdi-account"></v-icon>
                            </v-card-subtitle>
                            <v-card-text>
                                <chip-with-badge class="ma-1" :value="classroom.number_of_pending_quizzes"
                                                 content="Quiz"/>
                                <chip-with-badge class="ma-1" :value="classroom.number_of_pending_homeworks"
                                                 content="Homework"/>
                                <chip-with-badge class="ma-1" :value="classroom.number_of_pending_meetings"
                                                 content="Meeting"/>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </template>
            </v-row>
        </v-container>
        <v-dialog v-model="dialogs.homework" width="auto" persistent>
            <v-card width="800px">
                <v-card-title class="text-center ma-6">
                    {{ this.selected.homework.homework_name }}
                </v-card-title>
                <v-card-text class="text-center">
                    <v-btn variant="outlined" color="primary" class="mb-12"> تحميل حل الطالب</v-btn>
                    <v-form @submit.prevent="submitHomeworkFeedback">
                        <v-textarea label="النتيجة" class="v-locale--is-rtl" variant="outlined" :rules="requiredRule"
                                    name="submission" v-model="forms.homework.feedback"/>
                        <v-btn variant="elevated" color="success" class="ma-2" type="submit">تصحيح</v-btn>
                        <v-btn variant="elevated" color="warning" class="ma-4" @click="closeHomeworksDialog">
                            إغلاق
                        </v-btn>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>

        <v-dialog v-model="dialogs.feedback" width="auto">
            <v-card width="800px">
                <v-card-title class="text-center ma-6">
                    {{ this.selected.homework.homework_name }}
                </v-card-title>
                <v-card-text class="text-center ma-6">
                    {{ this.selected.homework.feedback }}
                </v-card-text>
            </v-card>
        </v-dialog>
    </MainLayout>
</template>
