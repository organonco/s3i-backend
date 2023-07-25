<template>
    <v-dialog
            v-model="value"
            persistent
            width="1024"
    >
        <v-card>
            <v-card-title class="pa-8">
                <h2>{{ title }}</h2>
            </v-card-title>
            <v-divider/>
            <v-form ref="form" v-model="isFormValid">
                <v-card-text>
                    <v-container>
                        <slot/>
                    </v-container>
                </v-card-text>
                <v-divider/>
                <v-card-actions class="pa-6">
                    <v-row justify="space-between">
                        <v-col cols="2">
                            <v-btn
                                    color="error"
                                    variant="text"
                                    @click="close"
                                    width="100%"
                            >
                                الغاء
                            </v-btn>
                        </v-col>
                        <v-col cols="2">
                            <v-btn
                                    color="success"
                                    variant="flat"
                                    @click="save"
                                    width="100%"
                            >
                                حفظ
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: "AddSectionPopup",
    props: ['modelValue', "title"],
    emits: ['update:modelValue'],
    data() {
        return {
            isFormValid: false,
        }
    },
    methods: {
        close: function () {
            this.value = false;
        },
        save: function () {
            this.$emit('save')
            this.value = false
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
    },
}
</script>
