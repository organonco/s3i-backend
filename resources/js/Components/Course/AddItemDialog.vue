<template>
    <v-dialog
        v-model="value"
        persistent
        width="1024"
    >
        <v-card>
            <v-card-title>
                <span class="text-h5">{{ title }}</span>
            </v-card-title>
            <v-divider/>
            <v-card-text>
                <v-container>
                    <slot/>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue-darken-1"
                    variant="text"
                    @click="close"
                >
                    Close
                </v-btn>
                <v-btn
                    color="blue-darken-1"
                    variant="text"
                    @click="save"
                >
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: "AddSectionPopup",
    props: ['modelValue', "title"],
    emits: ['update:modelValue'],
    methods: {
        close: function(){
            this.value = false;
        },
        save: function(){
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
                this.$emit('update:modelValue', value)
            }
        },
    },
}
</script>
