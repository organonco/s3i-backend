<script setup>
import draggable from "vuedraggable";
</script>

<script>
export default {
    components: [draggable],
    props: ['modelValue'],
    emits: ['update:modelValue'],
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
    <v-list lines="three" select-strategy="classic">
        <draggable v-model="value" item-key="id" v-bind="dragOptions">
            <template #item="{ element, index }">
                <div class="bg-blue-grey-lighten-5 ma-1">
                    <v-list-item>
                        <v-list-item-title>Section</v-list-item-title>
                        <v-list-item-subtitle>
                            {{ element.name }}
                        </v-list-item-subtitle>
                    </v-list-item>
                </div>
            </template>
        </draggable>
    </v-list>
</template>
