<template>
    <v-row>
        <v-col cols="8">
            <custom-draggable v-model="value" @clickOnItem="openDialog"></custom-draggable>
        </v-col>
        <v-col cols="4">
            <v-btn class="ma-1 mt-4" color="primary" width="100%" @click="openDialog(-1, 'text')">Add Text Question</v-btn>
            <v-btn class="ma-1 mt-4" color="primary" width="100%" @click="openDialog(-1, 'check')">Add Multiple Choice Question</v-btn>
            <v-btn class="ma-1 mt-4" color="primary" width="100%" @click="openDialog(-1, 'radio')">Add Single Choice Question</v-btn>
        </v-col>
        <add-item-dialog title="Add Text Question" v-model="text.dialog" @save="saveDialog('text')" :index="index">
            <v-text-field label="Question" variant="solo" v-model="text.object.text"/>
        </add-item-dialog>
        <add-item-dialog title="Add Multiple Choice Question" v-model="check.dialog" @save="saveDialog('check')" :index="index">
            <v-text-field label="Question" variant="solo" v-model="check.object.text"/>
            <quiz-question-options-input v-model="check.object.options"></quiz-question-options-input>
        </add-item-dialog>

        <add-item-dialog title="Add Single Choice Question" v-model="radio.dialog" @save="saveDialog('radio')" :index="index">
            <v-text-field label="Question" variant="solo" v-model="radio.object.text"/>
            <quiz-question-options-input v-model="radio.object.options"></quiz-question-options-input>
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
    props: ['modelValue', 'title'],
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
                        "text": null
                    }
                }
            },
            "check": {
                "dialog": false,
                initial: function(){
                    return {
                        "text": null,
                        "options": []
                    }
                }
            },
            "radio": {
                "dialog": false,
                initial: function(){
                    return {
                        "text": null,
                        "options": []
                    }
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
