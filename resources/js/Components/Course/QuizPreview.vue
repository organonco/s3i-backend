<template>
    <v-card class="mt-12">
        <v-card-title>
            {{ title }}
        </v-card-title>
        <v-card-text>
            <v-col cols="12">
                <v-list lines="two">
                    <v-list-item v-for="question in questions">
                        <v-row class="pa-4">
                            {{ question.object.text }}
                        </v-row>
                        <v-row class="pa-4" v-if="question.type === 'text'">
                            <v-textarea v-if="question.type === 'text'"></v-textarea>
                        </v-row>
                        <v-row class="pa-4" v-if="question.type === 'check'">
                            <v-col cols="12">
                                <v-row v-for="option in question.object.options" class="pl-4">
                                    <v-checkbox-btn density="compact" :label="option.object.text">
                                    </v-checkbox-btn>
                                </v-row>
                            </v-col>
                        </v-row>
                        <v-row class="pl-4" v-if="question.type === 'radio'">
                            <v-radio-group v-if="question.type === 'radio'">
                                <v-radio v-for="option in question.object.options" :value="option.object.text"
                                         class="pl-4" density="compact">
                                    <template v-slot:label>
                                        {{ option.object.text }}
                                    </template>
                                </v-radio>
                            </v-radio-group>
                        </v-row>
                        <v-divider class="mt-2"/>
                    </v-list-item>
                </v-list>
            </v-col>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    name: "QuizPreview",
    props: ['questions', 'title'],
}
</script>

<style scoped>

</style>
