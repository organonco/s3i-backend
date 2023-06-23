<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";

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
            classroomLoading: false,
        }
    },
    methods: {
        selectClassroom: function (index) {
            this.classroomLoading = true;
            this.openClassroom(index)
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

            sleep(500).then(() => {
                this.selectedClassroomIndex = index;
            });
        },
        closeClassroom: function () {
            this.selectedClassroomIndex = -1;
        }
    },
    computed: {
        selectedClassroom: function () {
            return this.classrooms.data[this.selectedClassroomIndex]
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
                        <v-card v-if="selectedClassroomIndex !== -1" width="100%" style="text-align: right"
                                :loading="classroomLoading">
                            <v-card-title>
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
            <v-row>
                <v-col cols="3" v-for="(classroom, index) in classrooms.data">
                    <v-card
                        style="text-align: right"
                        @click="selectClassroom(index)"
                    >
                        <v-card-title>
                            {{ classroom.course.category }} - {{ classroom.name }}
                        </v-card-title>
                        <v-card-text>
                            <v-hover>
                                <template v-slot:default="{ isHovering, props }">
                                    {{ classroom.number_of_students }} / {{ classroom.course.students_limit }}
                                    <v-icon icon="mdi-account" :color="isHovering ? 'primary' : undefined"></v-icon>
                                </template>
                            </v-hover>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>

    </MainLayout>
</template>
