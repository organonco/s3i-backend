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


export default {
    data: function () {
        return {
            selectedClassroomIndex: -1,
            loading: {
                classroom: false,
                meetings: false,
                homeworks: false,
                quizzes: false,
            },
            classroomsData: {...this.$props.classrooms.data},
        }
    },
    methods: {
        selectClassroom: function (index) {
            this.openClassroom(index);
            this.fetchClassroom(index);
        },

        fetchClassroom: function (index) {
            this.loading.classroom = true;
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
                            <v-card-title class="pt-8 text-center text-h4">
                                {{ this.selectedClassroom.name }}
                            </v-card-title>
                            <v-card-text>

                            </v-card-text>
                            <v-card-actions>
                                <v-btn variant="text" @click="closeClassroom"> Close</v-btn>
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
                            <v-card-title class="text-h5 mt-2">
                                {{ classroom.name }}
                                <div class="text-subtitle-1">
                                    {{ classroom.course.category }}
                                </div>
                            </v-card-title>
                            <v-card-subtitle>
                                {{ classroom.number_of_students }} / {{ classroom.course.students_limit }}
                                <v-icon icon="mdi-account" :color="isHovering ? 'primary' : undefined"></v-icon>
                            </v-card-subtitle>
                            <v-card-text>
                                <chip-with-badge class="ma-1" :value="classroom.number_of_pending_quizzes" content="Quiz"/>
                                <chip-with-badge class="ma-1" :value="classroom.number_of_pending_homeworks" content="Homework"/>
                                <chip-with-badge class="ma-1" :value="classroom.number_of_pending_meetings" content="Meeting"/>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </template>
            </v-row>
        </v-container>

    </MainLayout>
</template>
