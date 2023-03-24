<script setup>
import draggable from "vuedraggable";
</script>

<script>
export default {
    components: [draggable],
    props: ['modelValue'],
    emits: ['update:modelValue'],
    methods: {
        remove(index){
            this.value.splice(index, 1)
        },
        click(index){
            this.$emit("clickOnItem", index, this.value[index].type)
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
        dragOptions() {
            return {
                animation: 250,
                group: "people",
                disabled: false,
                ghostClass: "ghost"
            };
        },
    }
}
</script>

<template>
    <v-list select-strategy="classic">
        <draggable v-model="value" item-key="id" v-bind="dragOptions" handle=".handle">
            <template #item="{ element, index }">
                <div class="bg-blue-grey-lighten-5 ma-1">
                    <v-list-item>
                        <template v-slot:prepend>
                            <v-icon class="handle">mdi-menu</v-icon>
                        </template>
                        <v-list-item-title @click="click(index)">{{ element.type }}</v-list-item-title>
                        <v-list-item-subtitle @click="click(index)"> {{ element.object.name }} </v-list-item-subtitle>
                        <template v-slot:append>
                            <v-icon @click="remove(index)">mdi-delete</v-icon>
                        </template>
                    </v-list-item>
                </div>
            </template>
        </draggable>
    </v-list>
</template>
