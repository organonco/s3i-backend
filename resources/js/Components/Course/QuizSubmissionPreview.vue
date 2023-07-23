<template>
    <v-list lines="two">
        <v-list-item v-for="answer in this.answers">
            <v-row class="pa-4">
                {{ answer.quiz_question.object.text }}
            </v-row>
            <v-row class="pa-4 text-right" v-if="answer.quiz_question.type === 'text'">
                <v-textarea v-model="answer.answer.text" readonly></v-textarea>
            </v-row>
            <v-row class="pa-4 text-right ml-2" v-if="answer.quiz_question.type === 'multiple_choice'">
                <v-col v-if="answer.quiz_question.object.type === 'check'" cols="12">
                    <v-row v-for="option in answer.quiz_question.object.options">
                        <v-checkbox-btn density="compact" :label="option.object.text"
                                        :class="option.object.is_correct ? 'text-green' : 'text-red'"/>
                    </v-row>
                </v-col>
                <v-radio-group v-else>
                    <v-radio v-for="option in answer.quiz_question.object.options" :value="option.object.text"
                             :label="option.object.text" density="compact"
                             :class="'text-right' + option.object.is_correct ? 'text-green' : 'text-red'"/>
                </v-radio-group>
            </v-row>
            <v-divider class="mt-2"/>
        </v-list-item>
    </v-list>
</template>

<script>
export default {
    name: "QuizSubmissionPreview",
    props: ["answers"]
}
</script>

<style scoped>

</style>