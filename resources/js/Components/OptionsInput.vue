<script setup>
</script>
<script>
export default {
    props: ['modelValue'],
    emits: ['update:modelValue'],
    data: function () {
        return {
            option: null,
        }
    },
    methods: {
        remove(index) {
            this.value.splice(index, 1)
        },
        addOption() {
            if (this.option != null && this.option !== '')
                this.value.push({"type": 'option', "object": {is_correct: 0, text: this.option}})
            this.option = null
        },
    },
    computed: {
        value: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', JSON.parse(JSON.stringify(value)))
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
    <v-list select-strategy="classic" class="bg-blue-grey-lighten-5">
        <draggable :list="value" item-key="id" v-bind="dragOptions" handle=".handle">
            <template #item="{ element, index }">
                <div class="ma-1">
                    <v-list-item style="border: gray solid 1px">
                        <template v-slot:prepend>
                            <v-icon class="handle" color="primary">mdi-menu</v-icon>
                        </template>
                        <v-list-item-title>
                            <v-row>
                                <v-col cols="1" class="fill-height v-input--dense">
                                    <v-checkbox hide-details density="compact" v-model="element.object.is_correct" :true-value="1" :false-value="0"/>
                                </v-col>
                                <v-col cols="11" class="fill-height" align-self="center">
                                    {{ element.object.text }}
                                </v-col>
                            </v-row>
                        </v-list-item-title>
                        <template v-slot:append>
                            <v-btn append-icon="mdi-delete" variant="text" @click="remove(index)" color="error">
                                حذف
                            </v-btn>
                        </template>
                    </v-list-item>
                </div>
            </template>
            <template
                    v-slot:footer
                    key="footer"
            >
                <div class="ma-1">
                    <v-list-item style="border: gray solid 1px">
                        <v-list-item-title>
                            <v-text-field variant="outlined" label="إجابة جديدة" hide-details class="pa-1"
                                          v-model="option"/>
                        </v-list-item-title>
                        <template v-slot:append>
                            <v-btn append-icon="mdi-plus" text="إضافة" variant="text" class="ma-2" @click="addOption"/>
                        </template>
                    </v-list-item>
                </div>
            </template>
        </draggable>
    </v-list>
</template>
