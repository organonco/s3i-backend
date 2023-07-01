<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import ChipWithBadge from "@/Components/ChipWithBadge.vue";
import ConfirmationDialog from "@/Components/ConfirmationDialog.vue";

defineProps({
    classrooms: Object,
});
</script>

<script>
import axios from "axios";

export default {
    data: function () {
        return {
            loading: {
                students: 0,
                feedback: false,
                destroy_feedback: false,
            },
            classroomsData: {...this.$props.classrooms.data},
            headers: {
                students: [
                    {title: 'الاسم', key: 'name_ar', align: 'end'},
                ],
                quizzes: [
                    {title: '', key: 'status', align: 'end'},
                    {title: 'نوع الاختبار', key: 'quiz_type', align: "end"},
                    {title: 'اسم الطالب', key: 'student_name', align: "end"},
                ],
                homeworks: [
                    {title: '', key: 'status', align: 'end'},
                    {title: 'اسم الطالب', key: 'student_name', align: "end"},
                ],
            },
            dialogs: {
                homework: false,
                quiz: false,
                destroy_feedback_confirmation: false,
            },
            selected: {
                classroom: null,
                homework: null,
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
            if (this.selected.classroom == null) {
                this.selected.classroom = index;
                return
            }
            this.closeClassroom();

            function sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }

            sleep(700).then(() => {
                this.selected.classroom = index;
            });
        },
        closeClassroom: function () {
            this.selected.classroom = null;
        },
        openHomeworksDialog: function (_, item) {
            let selected_id = item.item.raw.id;
            this.selectedClassroom['homeworks'].forEach((value, index) => {
                if (selected_id === value.id)
                    this.selected.homework = index;
            });
            this.dialogs.homework = true
        },
        submitHomeworkFeedback: async function (_) {
            this.loading.feedback = true;
            var feedback = this.forms.homework.feedback;
            axios.post(route('homework.feedback', this.selectedHomework.id), {
                "feedback": feedback
            }).then((_) => {
                this.selectedHomework.has_feedback = true;
                this.selectedHomework.feedback = feedback;
                this.loading.feedback = false;
                this.forms.homework.feedback = null
                this.selectedClassroom.number_of_pending_homeworks--;
            })
        },
        confirmDestroyDialog: function () {
            this.loading.destroy_feedback_confirmation = true;
            axios.delete(route('homework.feedback.destroy', {'hash': this.selectedHomework.id})).then(() => {
                this.selectedHomework.has_feedback = false;
                this.selectedHomework.feedback = null;
                this.loading.destroy_feedback_confirmation = false;
                this.selectedClassroom.number_of_pending_homeworks++;
            })
        },
        activateDestroyDialog: function () {
            this.dialogs.destroy_feedback_confirmation = true;
        },
        nextHomework: function () {
            this.selected.homework = (this.selected.homework + 1) % this.selectedClassroom['homeworks'].length
            this.forms.homework.feedback = this.selectedHomework.feedback
        },
        previousHomework: function () {
            this.selected.homework = this.selected.homework === 0 ? this.selectedClassroom['homeworks'].length - 1 : this.selected.homework - 1
            this.forms.homework.feedback = this.selectedHomework.feedback
        },
        openQuizDialog: function (_, item) {
            let selected_id = item.item.raw.id;
            this.selectedClassroom['quizzes'].forEach((value, index) => {
                if (selected_id === value.id)
                    this.selected.quiz = index;
            });
            this.dialogs.quiz = true
        },


    },
    computed: {
        selectedClassroom: function () {
            return this.classroomsData[this.selected.classroom]
        },
        selectedHomework: function () {
            return this.selectedClassroom['homeworks'][this.selected.homework]
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
                        <template v-if="selected.classroom">
                            <v-card
                                    width="100%"
                                    class="text-right"
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
                                                                        @click:row="openQuizDialog"
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
                                                                        item-value="name"
                                                                        @click:row="openHomeworksDialog"
                                                                >
                                                                    <template v-slot:item.status="{ item }">
                                                                        <v-chip color="success" v-if="item.raw.has_feedback"> تم التصحيح </v-chip>
                                                                        <v-chip color="warning" v-else> بانتظار التصحيح </v-chip>
                                                                    </template>
                                                                </v-data-table>
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
                        </template>
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


        <v-dialog v-model="dialogs.homework" width="auto" height="auto">
            <v-card width="800px">
                <v-form @submit.prevent="submitHomeworkFeedback">
                    <v-card-title class="text-center">
                        <v-chip color="success" class="my-3" v-if="this.selectedHomework.has_feedback"> تم التصحيح </v-chip>
                        <v-chip color="warning" class="my-3" v-else> بانتظار التصحيح </v-chip>
                        <br/>
                        {{ this.selectedHomework.homework_name }}
                    </v-card-title>
                    <v-card-subtitle class="text-center">
                        {{this.selectedHomework.student_name}}
                    </v-card-subtitle>
                    <v-divider class="my-4"/>
                    <v-card-text class="text-center">
                        <a :href="this.selectedHomework.file_url" download>
                            <v-btn variant="outlined" color="black" class="mb-12 mr-5"> تحميل حل الطالب
                            </v-btn>
                        </a>
                        <a :href="this.selectedHomework.file_url" target="_blank">
                            <v-btn variant="outlined" color="black" class="mb-12"> عرض حل الطالب</v-btn>
                        </a>
                        <v-textarea
                                v-if="this.selectedHomework.has_feedback"
                                class="v-locale--is-rtl text-success"
                                variant="filled"
                                v-model="this.selectedHomework.feedback"
                                readonly
                        />
                        <v-textarea
                                v-else
                                label="النتيجة"
                                class="v-locale--is-rtl"
                                variant="outlined"
                                :rules="requiredRule"
                                name="submission"
                                v-model="forms.homework.feedback"
                        />
                    </v-card-text>
                    <v-divider/>
                    <v-card-actions class="pa-8">
                        <v-row class="justify-space-between">
                            <v-btn variant="text" @click="nextHomework">
                                التالي
                            </v-btn>
                            <template v-if="this.selectedHomework.has_feedback">
                                <v-btn color="error" width="250px" variant="outlined" @click="activateDestroyDialog"> حذف التصحيح
                                </v-btn>
                            </template>
                            <template v-else>
                                <v-btn variant="outlined" width="250px" color="success" type="submit">
                                    تصحيح
                                </v-btn>
                            </template>
                            <v-btn variant="text" @click="previousHomework">
                                السابق
                            </v-btn>
                        </v-row>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>

        <v-dialog v-model="dialogs.quiz" width="auto" height="auto">
            <v-card width="800px">

            </v-card>
        </v-dialog>

        <confirmation-dialog v-model="dialogs.destroy_feedback_confirmation" title="حذف التصحيح"
                             @confirm="confirmDestroyDialog">
        </confirmation-dialog>

    </MainLayout>
</template>
