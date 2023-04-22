<template>
    <v-row>
        <v-col cols="8">
            <custom-draggable v-model="value" @clickOnItem="openDialog"></custom-draggable>
        </v-col>
        <v-col cols="4">
            <v-btn v-if="quiz_type === 'text'" class="ma-1 mt-4" color="primary" width="100%" @click="openDialog(-1, 'text')">Add Question</v-btn>
            <v-btn v-if="quiz_type === 'multiple_choice'" class="ma-1 mt-4" color="primary" width="100%" @click="openDialog(-1, 'multiple_choice')">Add Question</v-btn>
        </v-col>

        <add-item-dialog title="Add Question" v-model="text.dialog" @save="saveDialog('text')" :index="index">
            <v-text-field label="Question" variant="solo" v-model="text.object.text" :rules="requiredRule"/>
        </add-item-dialog>

        <add-item-dialog title="Add Question" v-model="multiple_choice.dialog" @save="saveDialog('multiple_choice')" :index="index">
            <v-text-field label="Question" variant="solo" v-model="multiple_choice.object.text" :rules="requiredRule"/>
            <v-checkbox label="Student Can Select Multiple Answers" variant="solo" v-model="multiple_choice.object.type" true-value="check" false-value="radio"/>
            <quiz-question-options-input v-model="multiple_choice.object.options"></quiz-question-options-input>
        </add-item-dialog>
    </v-row>

</template>

<script setup>
import CustomDraggable from "@/Components/CustomDraggable.vue";
import AddItemDialog from "@/Components/Course/AddItemDialog.vue";
import QuizQuestionOptionsInput from "@/Components/Course/QuizQuestionOptionsInput.vue";

</script>
<script>

import _ from 'lodash'
export default {
    name: "QuizQuestionsInput",
    props: ['modelValue', 'title', 'quiz_type'],
    emits: ['update:modelValue'],
    methods: {
        saveDialog: function (type) {
            let val = _.cloneDeep(this.value)
            if(this.index === -1)
                val.push({"type": type, "object": {...this[type].object}})
            else
                val[this.index].object =  {...this[type].object}
            this.value = val
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
                this.$emit('update:modelValue',  _.cloneDeep(value))
            }
        },
    },
    data: () => {
        return {
            "index": null,
            "text": {
                "dialog": false,
                initial: function(){
                    return {
                        "text": null,
                        "type": "text"
                    }
                }
            },
            "multiple_choice": {
                "dialog": false,
                initial: function(){
                    return {
                        "text": null,
                        "type": null,
                        "options": []
                    }
                }
            },
        }
    }
}
</script>

<style scoped>

</style>
