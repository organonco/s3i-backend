<template>
    <v-row class="text-h5">
        Course Items
    </v-row>
    <v-row>
        <v-col cols="8">
            <custom-draggable v-model="value" @clickOnItem="openDialog"></custom-draggable>
        </v-col>
        <v-col>
            <v-btn class="ma-1 mt-4" color="primary" width="100%" @click="openDialog(-1, 'section')">Add Section</v-btn>
            <v-btn class="ma-1" color="primary" width="100%" @click="openDialog(-1, 'video')">Add Video</v-btn>
            <v-btn class="ma-1" color="primary" width="100%" @click="openDialog(-1, 'meeting')">Add Meeting</v-btn>
            <v-btn class="ma-1" color="primary" width="100%" @click="openDialog(-1, 'file')">Add File</v-btn>
            <v-btn class="ma-1" color="primary" width="100%" @click="openDialog(-1, 'homework')">Add Homework</v-btn>
            <v-btn class="ma-1" color="primary" width="100%" @click="openDialog(-1, 'quiz')">Add Quiz</v-btn>
        </v-col>
        <add-item-dialog title="Add Section" v-model="section.dialog" @save="saveDialog('section')" :index="index">
            <v-text-field label="Name" variant="solo" v-model="section.object.name" :rules="requiredRule"/>
        </add-item-dialog>

        <add-item-dialog title="Add Video" v-model="video.dialog" @save="saveDialog('video')" :index="index">
            <v-text-field label="Name" variant="solo" v-model="video.object.name" :rules="requiredRule"/>
            <v-text-field label="Video Link" variant="solo" v-model="video.object.url" :rules="requiredRule"/>
        </add-item-dialog>

        <add-item-dialog title="Add Meeting" v-model="meeting.dialog" @save="saveDialog('meeting')" :index="index">
            <v-label>Meeting Time, Date, and URL are different for each classroom</v-label>
            <v-text-field label="Name" variant="solo" v-model="meeting.object.name" :rules="requiredRule"/>
        </add-item-dialog>

        <add-item-dialog title="Add File" v-model="file.dialog" @save="saveDialog('file')" :index="index">
            <v-text-field label="Name" variant="solo" v-model="file.object.name" :rules="requiredRule"/>
            <v-file-input prepend-icon="mdi-attachment" label="File" variant="solo" @input="file.object.file = $event.target.files[0]" :rules="requiredRule"/>
        </add-item-dialog>

        <add-item-dialog title="Add Homework" v-model="homework.dialog" @save="saveDialog('homework')" :index="index">
            <v-label>This item allows students to submit files as homeworks. The homework questions must be added as a file</v-label>
            <v-text-field label="Name" variant="solo" v-model="homework.object.name" :rules="requiredRule"/>
        </add-item-dialog>

        <add-item-dialog title="Add Quiz" v-model="quiz.dialog" @save="saveDialog('quiz')" :index="index">
            <v-text-field label="Name" variant="solo" v-model="quiz.object.name" :rules="requiredRule"/>
            <v-select label="Type" variant="solo" v-model="quiz.object.type" :rules="requiredRule" :items="quiz_types" item-title="name" item-value="value" :disabled="quiz.object.questions.length !== 0"/>
            <quiz-questions-input v-model="quiz.object.questions" :quiz_type="quiz.object.type"></quiz-questions-input>
            <quiz-preview :questions="quiz.object.questions" :title="quiz.object.name"></quiz-preview>
        </add-item-dialog>

    </v-row>
</template>

<script setup>
import CustomDraggable from "@/Components/CustomDraggable.vue";
import AddItemDialog from "@/Components/Course/AddItemDialog.vue";
import QuizQuestionsInput from "@/Components/Course/QuizQuestionsInput.vue";
import QuizPreview from "@/Components/Course/QuizPreview.vue";

</script>
<script>

export default {
    name: "CourseItemsInput",
    props: ['modelValue'],
    emits: ['update:modelValue'],
    methods: {
        saveDialog: function (type) {
            if(this.index === -1)
                this.value.push({"type": type, "object": {...this[type].object}})
            else
                this.value[this.index].object =  {...this[type].object}
            this[type].object = this[type].initial()
        },
        openDialog: function(index, type) {
            this.index = index
                this[type].object = index === -1 ? this[type].initial() : this.value[this.index].object
            this[type].dialog = true
        }
    },
    computed: {
        requiredRule: function(){
            return [v => !!v || 'Required'];
        },
        value: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', JSON.parse(JSON.stringify(value)))
            }
        },
        quiz_types: function(){
            return [
                {
                    "name": "text",
                    "value": "text"
                },
                {
                    "name": "multiple choice",
                    "value": "multiple_choice"
                }
            ]
        }
    },
    data: () => {
        return {
            "index": null,
            "section": {
                "dialog": false,
                initial: function(){
                    return {
                        "name": null
                    }
                }
            },
            "video": {
                "dialog": false,
                initial: function(){
                    return {
                        "name": null,
                        "url": null,
                    }
                }
            },
            "meeting": {
                "dialog": false,
                initial: function(){
                    return {
                        "name": null,
                        "url": null,
                        "date": null,
                        "time": null,
                    }
                }
            },
            "file": {
                "dialog": false,
                initial: function(){
                    return {
                        "name": null,
                        "file": null,
                    }
                }
            },
            "homework": {
                "dialog": false,
                initial: function(){
                    return {
                        "name": null,
                    }
                }
            },
            "quiz": {
                "dialog": false,
                initial: function(){
                    return {
                        "name": null,
                        "type": null,
                        "questions": []
                    }
                }
            }
        }
    },
}
</script>

<style scoped>

</style>
