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
            },
            classroomsData: {...this.$props.classrooms.data},
            headers: {
                students: [
                    {title: 'الاسم', key: 'name_ar'},
                ],
                quizzes: [
                    {title: 'اسم الطالب', key: 'student_name', align: "end"},
                ],
                homeworks: [
                    {title: 'اسم الطالب', key: 'student_name', align: "end"},
                ],
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
        }
    },
    computed: {
        selectedClassroom: function () {
            return this.classroomsData[this.selectedClassroomIndex]
        }
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
                                style="text-align: right"
                                :loading="loading.classroom"
                                variant="elevated"
                        >
                            <v-card-title class="pt-8 text-center" style="font-size: xx-large; font-weight: bold">
                                {{ this.selectedClassroom.name }}
                            </v-card-title>
                            <v-card-text class="pa-12">
                                <v-container>
                                    <v-row>
                                        <v-col cols="3">
                                            <v-card variant="outlined" class="text-center">
                                                <v-card-title class="pt-4 text-center">
                                                    الطلاب
                                                </v-card-title>
                                                <v-card-text>
                                                    <v-table
                                                            fixed-header
                                                            height="700px"
                                                    >
                                                        <thead>
                                                        <tr>
                                                            <th v-for="header in headers.students" class="text-right">
                                                                {{ header.title }}
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="student in selectedClassroom.students">
                                                            <td v-for="header in headers.students" class="text-right">
                                                                {{ student[header.key] }}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </v-table>
                                                </v-card-text>
                                            </v-card>
                                        </v-col>

                                        <v-col cols="9">
                                            <v-row>
                                                <v-col cols="12">
                                                    <v-card variant="outlined" class="text-left">
                                                        <v-card-title class="pt-4 text-center">
                                                            الاختبارات
                                                        </v-card-title>
                                                        <v-card-text>
                                                            <v-data-table
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
                                                                    :group-by="[{key: 'homework_name', order: 'asc', align: 'end'}]"
                                                                    :headers="headers.homeworks"
                                                                    :items="selectedClassroom.homeworks"
                                                            ></v-data-table>
                                                        </v-card-text>
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
                                <div style="font-size: smalle; font-weight: lighter">
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

    </MainLayout>
</template>
