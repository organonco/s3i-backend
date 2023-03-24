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
            <v-btn class="ma-1" color="primary" width="100%">Add Video</v-btn>
            <v-btn class="ma-1" color="primary" width="100%">Add Meeting</v-btn>
            <v-btn class="ma-1" color="primary" width="100%">Add Quiz</v-btn>
        </v-col>
        <add-section-popup title="Add Section" v-model="section.dialog" @save="saveDialog" :index="index">
            <v-text-field label="Name" variant="solo" v-model="section.object.name"/>
        </add-section-popup>
    </v-row>
</template>

<script setup>
import CustomDraggable from "@/Components/CustomDraggable.vue";
import AddSectionPopup from "@/Components/Course/AddSectionPopup.vue";

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
        value: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', value)
            }
        },
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
            }
        }
    }
}
</script>

<style scoped>

</style>
