<template>
    <v-dialog v-model="value" persistent width="20%">
        <v-card>
            <v-card-title>
                <span class="text-h5">{{ title }}</span>
            </v-card-title>
            <v-divider/>
            <v-card-text>
                <slot/>
            </v-card-text>
            <v-divider/>
            <v-card-actions class="justify-space-between">
                <v-btn variant="plain" @click="close">cancel</v-btn>
                <v-btn variant="flat" @click="confirm" color="primary">Confirm</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: "ConfirmationDialog",
    props: ['modelValue', "title"],
    emits: ['update:modelValue', 'confirm'],
    methods: {
        close: function(){
            this.value = false;
        },
        confirm: function(){
            this.$emit('confirm')
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
    }
}
</script>

<style scoped>

</style>
