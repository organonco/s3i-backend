<template>
    <v-card class="mt-12 text-right">
        <v-card-title>
            {{ title }}
        </v-card-title>
        <v-card-text>
            <v-col cols="12">
                <v-list lines="two">
                    <v-list-item v-for="question in questions">
                        <v-row class="pa-4 justify-content-end">
                            {{ question.object.text }}
                        </v-row>
                        <v-row class="pa-4 text-right" v-if="question.type === 'text'">
                            <v-textarea v-if="question.type === 'text'"></v-textarea>
                        </v-row>
                        <v-row class="pa-4 text-right ml-2" v-if="question.type === 'multiple_choice'">
                            <v-col v-if="question.object.type === 'check'" cols="12">
                                <v-row v-for="option in question.object.options" >
                                    <v-checkbox-btn density="compact" :label="option.object.text" :class="(option.object.is_correct? 'text-green' : 'text-red')"/>
                                </v-row>
                            </v-col>
                            <v-radio-group v-else>
                                <v-radio v-for="option in question.object.options" :value="option.object.text" :label="option.object.text" density="compact" :class="'text-right ' + (option.object.is_correct ? 'text-green' : 'text-red')"/>
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
