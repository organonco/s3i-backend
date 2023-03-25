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
            <v-btn class="ma-1" color="primary" width="100%">Add Quiz</v-btn>
        </v-col>
        <add-item-dialog title="Add Section" v-model="section.dialog" @save="saveDialog('section')" :index="index">
            <v-text-field label="Name" variant="solo" v-model="section.object.name"/>
        </add-item-dialog>

        <add-item-dialog title="Add Video" v-model="video.dialog" @save="saveDialog('video')" :index="index">
            <v-text-field label="Name" variant="solo" v-model="video.object.name"/>
            <v-text-field label="Video Link" variant="solo" v-model="video.object.url"/>
        </add-item-dialog>

        <add-item-dialog title="Add Meeting" v-model="meeting.dialog" @save="saveDialog('meeting')" :index="index">
            <v-text-field label="Name" variant="solo" v-model="meeting.object.name"/>
            <v-text-field label="Meeting Link" variant="solo" v-model="meeting.object.url"/>
            <v-text-field label="Date" type="date" variant="solo" v-model="meeting.object.date"/>
            <v-text-field label="Time" type="time" variant="solo" v-model="meeting.object.time"/>
        </add-item-dialog>

        <add-item-dialog title="Add File" v-model="file.dialog" @save="saveDialog('file')" :index="index">
            <v-text-field label="Name" variant="solo" v-model="file.object.name"/>

            <v-file-input prepend-icon="mdi-attachment" label="File" variant="solo"
                          @input="file.object.file = $event.target.files[0]"
            />

<!--            <v-file-input prepend-icon="mdi-attachment" label="File" variant="solo"-->
<!--                          v-model="file.object.file"-->
<!--            />-->
        </add-item-dialog>

    </v-row>
</template>

<script setup>
import CustomDraggable from "@/Components/CustomDraggable.vue";
import AddItemDialog from "@/Components/Course/AddItemDialog.vue";

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
            }
        }
    }
}
</script>

<style scoped>

</style>
