<template>
    <v-row class="text-h5">
        Course Items
    </v-row>
    <v-row>
        <v-col cols="8">
            <custom-draggable v-model="value" @clickOnItem="openSectionDialog"></custom-draggable>
        </v-col>
        <v-col>
            <v-btn class="ma-1 mt-4" color="primary" width="100%" @click="openSectionDialog(-1)">Add Section</v-btn>
            <v-btn class="ma-1" color="primary" width="100%">Add Video</v-btn>
            <v-btn class="ma-1" color="primary" width="100%">Add Meeting</v-btn>
            <v-btn class="ma-1" color="primary" width="100%">Add Quiz</v-btn>
        </v-col>
        <add-section-popup title="Add Section" v-model="add_section.dialog" @save="saveSectionDialog" :index="index">
            <v-text-field label="Name" variant="solo" v-model="add_section.object.name"/>
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
        saveSectionDialog: function () {
            this.add_section.dialog = false;
            if(this.index === -1)
                this.value.push({"type": "section", "object": {"name": this.add_section.object.name}})
            else
                this.value[this.index].object =  {"name": this.add_section.object.name}
            this.add_section.object.name = null
        },
        openSectionDialog: function(index) {
            this.index = index
            this.add_section.object.name = index === -1 ? null : this.value[this.index].object.name
            this.add_section.dialog = true
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
            "add_section": {
                "dialog": false,
                "object": {
                    "name": null,
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
