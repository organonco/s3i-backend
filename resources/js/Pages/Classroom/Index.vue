<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import ChipWithBadge from "@/Components/ChipWithBadge.vue";
import ConfirmationDialog from "@/Components/ConfirmationDialog.vue";
import QuizSubmissionPreview from "@/Components/Course/QuizSubmissionPreview.vue";
import CenterSheet from "@/Components/CenterSheet.vue";

defineProps({
    classrooms: Object,
    is_super_admin: Boolean
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
                    {title: 'الاسم', key: 'name_ar', align: 'start'},
                ],
                quizzes: [
                    {title: 'نوع الاختبار', key: 'quiz_type', align: "start"},
                    {title: 'اسم المتدرب', key: 'student_name', align: "start"},
                    {title: 'الحالة', key: 'status', align: 'start'},
                ],
                homeworks: [
                    {title: 'اسم المتدرب', key: 'student_name', align: "start"},
                    {title: 'الحالة', key: 'status', align: 'start'},
                ],
                meetings: [
                    {title: 'اسم الاجتماع', key: 'name', align: "start"},
                    {title: 'الحالة', key: 'status', align: 'start'},
                ],
            },
            dialogs: {
                homework: false,
                quiz: false,
                meeting: false,
                destroy_homework_feedback_confirmation: false,
                destroy_quiz_feedback_confirmation: false,
                destroy_meeting_information_confirmation: false,
                quiz_submission_preview: false,
            },
            selected: {
                classroom: null,
                homework: null,
                quiz: null,
                meeting: null,
            },
            forms: {
                homework: {
                    feedback: ""
                },
                quiz: {
                    feedback: "",
                },
                meeting: {
                    date: "",
                    time: "",
                    url: "",
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
            this.loading.classroom = (this.loading.classroom + 1) % 5;
        },

        fetchClassroom: function (index) {
            this.loading.classroom = 1;
            this.fetchStudents(index);
            this.fetchQuizzes(index);
            this.fetchHomeworks(index);
            this.fetchMeetings(index);
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

        fetchMeetings: function (index) {
            axios.get(route('classroom.meetings', this.classroomsData[index].id)).then((response) => {
                this.addLoaded();
                this.classroomsData[index].meetings = response.data.data;
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
        openMeetingsDialog: function (_, item) {
            let selected_id = item.item.raw.id;
            this.selectedClassroom['meetings'].forEach((value, index) => {
                if (selected_id === value.id)
                    this.selected.meeting = index;
            });
            if (this.selectedMeeting.is_set) {
                this.forms.meeting.date = this.selectedMeeting.classroom_meeting.date
                this.forms.meeting.time = this.selectedMeeting.classroom_meeting.time
                this.forms.meeting.url = this.selectedMeeting.classroom_meeting.url
            }
            this.dialogs.meeting = true
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
        submitQuizFeedback: async function (_) {
            this.loading.feedback = true;
            var feedback = this.forms.quiz.feedback;
            axios.post(route('quiz.submission.feedback', this.selectedQuiz.id), {
                "feedback": feedback
            }).then((_) => {
                this.selectedQuiz.has_feedback = true;
                this.selectedQuiz.feedback = feedback;
                this.loading.feedback = false;
                this.forms.homework.feedback = null
                this.selectedClassroom.number_of_pending_quizzes--;
            })
        },
        submitMeetingInformation: async function (_) {
            this.forms.meeting.classroom_id = this.selectedClassroom.id;
            axios.post(route('meeting.information', this.selectedMeeting.id), this.forms.meeting).then((_) => {
                this.selectedMeeting.is_set = true;

                this.selectedMeeting.classroom_meeting = {
                    'date': this.forms.meeting.date,
                    'time': this.forms.meeting.time,
                    'url': this.forms.meeting.url,
                }

                this.selectedClassroom.number_of_pending_meetings--;
            })
        },
        confirmHomeworkDestroyDialog: function () {
            this.loading.destroy_homework_feedback_confirmation = true;
            axios.delete(route('homework.feedback.destroy', {'hash': this.selectedHomework.id})).then(() => {
                this.selectedHomework.has_feedback = false;
                this.selectedHomework.feedback = null;
                this.loading.destroy_homework_feedback_confirmation = false;
                this.selectedClassroom.number_of_pending_homeworks++;
            })
        },
        confirmQuizDestroyDialog: function () {
            this.loading.destroy_quiz_feedback_confirmation = true;
            axios.delete(route('quiz.submission.feedback.destroy', {'hash': this.selectedQuiz.id})).then(() => {
                this.selectedQuiz.has_feedback = false;
                this.selectedQuiz.feedback = null;
                this.loading.destroy_quiz_feedback_confirmation = false;
                this.selectedClassroom.number_of_pending_quizzes++;
            })
        },
        activateDestroyHomeworkDialog: function () {
            this.dialogs.destroy_homework_feedback_confirmation = true;
        },
        activateDestroyQuizDialog: function () {
            this.dialogs.destroy_quiz_feedback_confirmation = true;
        },
        nextHomework: function () {
            this.selected.homework = (this.selected.homework + 1) % this.selectedClassroom['homeworks'].length
            this.forms.homework.feedback = this.selectedHomework.feedback
        },
        previousHomework: function () {
            this.selected.homework = this.selected.homework === 0 ? this.selectedClassroom['homeworks'].length - 1 : this.selected.homework - 1
            this.forms.homework.feedback = this.selectedHomework.feedback
        },

        nextQuiz: function () {
            this.selected.quiz = (this.selected.quiz + 1) % this.selectedClassroom['quizzes'].length
            this.forms.quiz.feedback = this.selectedQuiz.feedback
        },
        previousQuiz: function () {
            this.selected.quiz = this.selected.quiz === 0 ? this.selectedClassroom['quizzes'].length - 1 : this.selected.quiz - 1
            this.forms.quiz.feedback = this.selectedQuiz.feedback
        },

        nextMeeting: function () {
            this.selected.meeting = (this.selected.meeting + 1) % this.selectedClassroom['meetings'].length
            if (this.selectedMeeting.is_set) {
                this.forms.meeting.date = this.selectedMeeting.classroom_meeting.date
                this.forms.meeting.time = this.selectedMeeting.classroom_meeting.time
                this.forms.meeting.url = this.selectedMeeting.classroom_meeting.url
            }
        },
        previousMeeting: function () {
            this.selected.meeting = this.selected.meeting === 0 ? this.selectedClassroom['meetings'].length - 1 : this.selected.meeting - 1
            if (this.selectedMeeting.is_set) {
                this.forms.meeting.date = this.selectedMeeting.classroom_meeting.date
                this.forms.meeting.time = this.selectedMeeting.classroom_meeting.time
                this.forms.meeting.url = this.selectedMeeting.classroom_meeting.url
            }
        },

        openQuizDialog: function (_, item) {
            let selected_id = item.item.raw.id;
            this.selectedClassroom['quizzes'].forEach((value, index) => {
                if (selected_id === value.id)
                    this.selected.quiz = index;
            });
            this.dialogs.quiz_submission_preview = false;
            this.dialogs.quiz = true
        },

        fetchQuizSubmission: function () {
            var id = this.selectedClassroom['quizzes'][this.selected.quiz].id;
            axios.get(route('quiz.submission.show', id)).then((response) => {
                this.classroomsData[this.selected.classroom]['quizzes'][this.selected.quiz].answers = response.data.data.answers;
                this.classroomsData[this.selected.classroom]['quizzes'][this.selected.quiz].answers_fetched = true;
            })
        },

        openQuizSubmissionPreviewDialog: function () {
            if (!this.selectedQuiz.answers_fetched)
                this.fetchQuizSubmission();
            this.dialogs.quiz_submission_preview = true
        },

        closeQuizSubmissionPreviewDialog: function () {
            this.dialogs.quiz_submission_preview = false
        }


    },
    computed: {
        selectedClassroom: function () {
            return this.classroomsData[this.selected.classroom]
        },
        selectedHomework: function () {
            return this.selectedClassroom['homeworks'][this.selected.homework]
        },
        selectedMeeting: function () {
            return this.selectedClassroom['meetings'][this.selected.meeting]
        },
        selectedQuiz: function () {
            return this.selectedClassroom['quizzes'][this.selected.quiz];
        },
        requiredRule: function () {
            return [v => !!v || 'مطلوب'];
        },
    }
}
</script>

<template>
    <MainLayout title="لوحة التحكم">
        <v-container>
            <v-row>
                <v-col cols="3">
                    <center-sheet>
                        <v-row class="flex-row justify-center">
                            <template v-for="(classroom, index) in classroomsData">
                                <v-col cols="12">
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
                    </center-sheet>
                </v-col>
                <v-col cols="9">
                    <v-expand-transition>
                        <template v-if="selected.classroom">
                            <center-sheet>
                                <v-row justify="center">
                                    <h1 class="pb-4">
                                        {{ selectedClassroom.name }}
                                    </h1>
                                    <v-divider class="py-5"/>
                                </v-row>
                                <v-row justify="center">
                                    <v-col cols="8" class="pa-6">
                                        <v-row>
                                            <v-col cols="12">
                                                <h3 class="pb-4">
                                                    الاختبارات
                                                </h3>
                                                <v-divider class="pb-4" length="40%"/>
                                                <v-data-table-virtual
                                                        :group-by="[{key: 'quiz_name', order: 'asc', align: 'end'}]"
                                                        :headers="headers.quizzes"
                                                        :items="selectedClassroom.quizzes"
                                                        @click:row="openQuizDialog"
                                                        class="pa-3 elevation-1">
                                                    <template
                                                            v-slot:item.quiz_type="{ item }">
                                                        <template
                                                                v-if="item.raw.quiz_type === 'multiple_choice'">
                                                            اختيار من متعدد
                                                        </template>
                                                        <template v-else>
                                                            نصي
                                                        </template>
                                                    </template>

                                                    <template
                                                            v-slot:item.status="{ item }">
                                                        <v-chip color="success"
                                                                v-if="item.raw.has_feedback">
                                                            تم
                                                            التصحيح
                                                        </v-chip>
                                                        <v-chip color="success"
                                                                v-else-if="item.raw.quiz_type === 'multiple_choice'">
                                                            تم التصحيح التلقائي
                                                        </v-chip>
                                                        <v-chip color="warning"
                                                                v-else> بانتظار
                                                            التصحيح
                                                        </v-chip>
                                                    </template>

                                                </v-data-table-virtual>
                                            </v-col>
                                        </v-row>
                                        <v-row>
                                            <v-col cols="12">
                                                <h3 class="pb-4">
                                                    الوظائف
                                                </h3>
                                                <v-divider class="pb-4" length="40%"/>
                                                <v-data-table-virtual
                                                        :group-by="[{key: 'homework_name', order: 'asc', align: 'end'}]"
                                                        :headers="headers.homeworks"
                                                        :items="selectedClassroom.homeworks"
                                                        item-value="name"
                                                        @click:row="openHomeworksDialog"
                                                        class="pa-3 elevation-1">
                                                    <template
                                                            v-slot:item.status="{ item }">
                                                        <v-chip color="success"
                                                                v-if="item.raw.has_feedback">
                                                            تم التصحيح
                                                        </v-chip>
                                                        <v-chip color="warning"
                                                                v-else> بانتظار
                                                            التصحيح
                                                        </v-chip>
                                                    </template>
                                                </v-data-table-virtual>
                                            </v-col>
                                        </v-row>

                                        <v-row>
                                            <v-col cols="12">
                                                <h3 class="pb-4">
                                                    الاجتماعات
                                                </h3>
                                                <v-divider class="pb-4" length="40%"/>
                                                <v-data-table-virtual
                                                        :headers="headers.meetings"
                                                        :items="selectedClassroom.meetings"
                                                        item-value="name"
                                                        @click:row="openMeetingsDialog"
                                                        class="pa-3 elevation-1">
                                                    <template
                                                            v-slot:item.status="{ item }">
                                                        <v-chip color="success"
                                                                v-if="item.raw.is_set">
                                                            تم التحديد
                                                        </v-chip>
                                                        <v-chip color="warning"
                                                                v-else> بانتظار
                                                            التحديد
                                                        </v-chip>
                                                    </template>
                                                </v-data-table-virtual>
                                            </v-col>
                                        </v-row>

                                    </v-col>
                                    <v-col cols="4" class="pa-6">
                                        <h3 class="pb-4">
                                            المتدربين
                                        </h3>
                                        <v-divider class="pb-4" length="40%"/>
                                        <v-data-table-virtual :headers="headers.students"
                                                              :items="selectedClassroom.students"
                                                              class="pa-3 elevation-1"/>
                                    </v-col>
                                </v-row>
                                <v-row align-content="center">
                                        <v-btn variant="text" @click="closeClassroom" width="100%"> إغلاق</v-btn>
                                </v-row>
                            </center-sheet>
                        </template>
                    </v-expand-transition>
                </v-col>
            </v-row>
        </v-container>

        <v-dialog v-model="dialogs.homework" width="auto" height="auto">
            <v-card width="800px">
                <v-form @submit.prevent="submitHomeworkFeedback">
                    <v-card-title class="text-center">
                        <v-chip color="success" class="my-3" v-if="selectedHomework.has_feedback"> تم التصحيح
                        </v-chip>
                        <v-chip color="warning" class="my-3" v-else> بانتظار التصحيح</v-chip>
                        <br/>
                        {{ selectedHomework.homework_name }}
                    </v-card-title>
                    <v-card-subtitle class="text-center">
                        {{ selectedHomework.student_name }}
                    </v-card-subtitle>
                    <v-divider class="my-4"/>
                    <v-card-text class="text-center">
                        <a :href="selectedHomework.file_url" download>
                            <v-btn variant="outlined" color="black" class="mb-12 mr-5"> تحميل حل المتدرب
                            </v-btn>
                        </a>
                        <a :href="selectedHomework.file_url" target="_blank">
                            <v-btn variant="outlined" color="black" class="mb-12"> عرض حل المتدرب</v-btn>
                        </a>
                        <v-textarea
                                v-if="selectedHomework.has_feedback"
                                class="v-locale--is-rtl text-success"
                                variant="filled"
                                v-model="selectedHomework.feedback"
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
                            <template v-if="selectedHomework.has_feedback">
                                <v-btn color="error" width="250px" variant="outlined"
                                       @click="activateDestroyHomeworkDialog">
                                    حذف التصحيح
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
            <v-card width="800">
                <v-form @submit.prevent="submitQuizFeedback">
                    <v-card-title class="text-center">
                        <div class="my-3">
                            <v-chip color="success"
                                    v-if="selectedQuiz.has_feedback"> تم
                                التصحيح
                            </v-chip>
                            <v-chip color="success"
                                    v-else-if="selectedQuiz.quiz_type === 'multiple_choice'">
                                تم التصحيح التلقائي
                            </v-chip>
                            <v-chip color="warning" v-else> بانتظار
                                التصحيح
                            </v-chip>
                        </div>
                        {{ selectedQuiz.quiz_name }}
                    </v-card-title>
                    <v-card-subtitle class="text-center">
                        {{ selectedQuiz.student_name }}
                    </v-card-subtitle>
                    <v-divider class="my-4"/>
                    <v-card-text class="text-center">
                        <div v-if="dialogs.quiz_submission_preview" @click="closeQuizSubmissionPreviewDialog"
                             class="mb-6">
                            اخفاء حل المتدرب
                            <v-btn icon="mdi-chevron-up" variant="flat"></v-btn>
                        </div>
                        <div v-else @click="openQuizSubmissionPreviewDialog" class="mb-6">
                            عرض حل المتدرب
                            <v-btn icon="mdi-chevron-down" variant="flat"></v-btn>
                        </div>
                        <v-expand-transition>
                            <div v-show="dialogs.quiz_submission_preview">
                                <quiz-submission-preview :answers="selectedQuiz.answers"></quiz-submission-preview>
                            </div>
                        </v-expand-transition>
                        <v-textarea
                                v-if="selectedQuiz.has_feedback"
                                class="v-locale--is-rtl text-success"
                                variant="filled"
                                v-model="selectedQuiz.feedback"
                                readonly
                        />
                        <v-textarea
                                v-else
                                label="النتيجة"
                                class="v-locale--is-rtl"
                                variant="outlined"
                                :rules="requiredRule"
                                name="submission"
                                v-model="forms.quiz.feedback"
                        />
                    </v-card-text>
                    <v-divider/>
                    <v-card-actions class="pa-8">
                        <v-row class="justify-space-between">
                            <v-btn variant="text" @click="nextQuiz">
                                التالي
                            </v-btn>
                            <template v-if="selectedQuiz.has_feedback">
                                <v-btn color="error" width="250px" variant="outlined"
                                       @click="activateDestroyQuizDialog"> حذف التصحيح
                                </v-btn>
                            </template>
                            <template v-else>
                                <v-btn variant="outlined" width="250px" color="success" type="submit">
                                    تصحيح
                                </v-btn>
                            </template>
                            <v-btn variant="text" @click="previousQuiz">
                                السابق
                            </v-btn>
                        </v-row>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>

        <v-dialog v-model="dialogs.meeting" width="auto" height="auto">
            <v-card width="800px">
                <v-form @submit.prevent="submitMeetingInformation">
                    <v-card-title class="text-center">
                        <v-chip color="success" class="my-3" v-if="selectedMeeting.is_set"> تم التحديد
                        </v-chip>
                        <v-chip color="warning" class="my-3" v-else> بانتظار التحديد</v-chip>
                        <br/>
                        {{ selectedMeeting.name }}
                    </v-card-title>
                    <v-divider class="my-4"/>
                    <v-card-text class="text-center">
                        <v-text-field v-model="forms.meeting.url" label="رابط الاجتماع" variant="outlined"
                                      prepend-icon="mdi-link"/>
                        <v-text-field v-model="forms.meeting.date" type="date" label="وقت الاجتماع" variant="outlined"
                                      prepend-icon="mdi-clock"/>
                        <v-text-field v-model="forms.meeting.time" type="time" label="تاريخ الاجتماع" variant="outlined"
                                      prepend-icon="mdi-calendar"/>
                    </v-card-text>
                    <v-divider/>
                    <v-card-actions class="pa-8">
                        <v-row class="justify-space-between">
                            <v-btn variant="text" @click="nextMeeting">
                                التالي
                            </v-btn>
                            <v-btn variant="outlined" width="250px" color="success" type="submit">
                                حفظ
                            </v-btn>
                            <v-btn variant="text" @click="previousMeeting">
                                السابق
                            </v-btn>
                        </v-row>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>

        <confirmation-dialog v-model="dialogs.destroy_quiz_feedback_confirmation" title="حذف التصحيح"
                             @confirm="confirmQuizDestroyDialog">
        </confirmation-dialog>

        <confirmation-dialog v-model="dialogs.destroy_homework_feedback_confirmation" title="حذف التصحيح"
                             @confirm="confirmHomeworkDestroyDialog">
        </confirmation-dialog>

    </MainLayout>
</template>
