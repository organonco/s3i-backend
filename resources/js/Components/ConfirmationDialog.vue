<template>
    <v-dialog v-model="value" persistent width="20%">
        <v-card class="text-center">
            <v-card-title>
                <div class="ma-4">{{ title }}</div>
            </v-card-title>
            <v-divider/>
            <v-card-actions class="justify-space-between">
                <v-btn variant="text" @click="confirm" color="warning">نعم</v-btn>
                <v-btn variant="text" @click="close" color="success">لا</v-btn>
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
