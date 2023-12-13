<script setup>
const types = {
    'multiple_choice': 'اختبار',
    'text': 'وظيفة',
    'quiz': 'اختبار',
    'homework': 'استلام ملف',
    'section': 'محور',
    'file': 'رفع ملف',
    'video': 'فيديو',
    'meeting': 'اجتماع',
}
</script>

<script>
export default {
    props: ['modelValue'],
    emits: ['update:modelValue'],
    methods: {
        remove(index) {
            this.value.splice(index, 1)
        },
        click(index) {
            this.$emit("clickOnItem", index, this.value[index].type)
        }
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
                        <v-list-item-title v-if="element.type === 'quiz'">{{ types[element.object.type] }}</v-list-item-title>
                        <v-list-item-title v-else>{{ types[element.type] }}</v-list-item-title>
                        <v-list-item-subtitle > {{ element.object.name }} {{
                            element.object.text
                            }}
                        </v-list-item-subtitle>
                        <template v-slot:append>

                            <v-btn @click="click(index)" append-icon="mdi-pencil" variant="text" color="primary">
                                تعديل
                            </v-btn>
                            <v-btn append-icon="mdi-delete" variant="text" @click="remove(index)" color="error">
                                حذف
                            </v-btn>
                        </template>
                    </v-list-item>
                </div>
            </template>
        </draggable>
    </v-list>
</template>
