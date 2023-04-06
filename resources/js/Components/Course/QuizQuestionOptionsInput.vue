<template>
    <v-row class="text-h5">
        Quiz Questions
    </v-row>
    <v-row>
        <v-col cols="8">
            <custom-draggable v-model="value" @clickOnItem="openDialog"></custom-draggable>
        </v-col>
        <v-col>
            <v-btn class="ma-1 mt-4" color="primary" width="100%" @click="openDialog(-1, 'option')">Add Option</v-btn>
        </v-col>
        <add-item-dialog title="Add Option" v-model="option.dialog" @save="saveDialog('option')" :index="index">
            <v-text-field label="Option" variant="solo" v-model="option.object.text" :rules="requiredRule"/>
            <v-checkbox label="Is Correct" variant="solo" v-model="option.object.is_correct" false-value="0"/>
        </add-item-dialog>
    </v-row>
</template>

<script setup>
import CustomDraggable from "@/Components/CustomDraggable.vue";
import AddItemDialog from "@/Components/Course/AddItemDialog.vue";
</script>
<script>
export default {
    name: "QuizQuestionOptionsInput",
    props: ['modelValue'],
    emits: ['update:modelValue'],
    methods: {
        saveDialog: function (type) {
            if (this.index === -1)
                this.value.push({"type": type, "object": {...this[type].object}})
            else
                this.value[this.index].object = {...this[type].object}
            this[type].object = this[type].initial()
        },
        openDialog: function (index, type) {
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
    },
    data: () => {
        return {
            "index": null,
            "option": {
                "dialog": false,
                initial: function () {
                    return {
                        "text": null,
                        "is_correct": false,
                    }
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
