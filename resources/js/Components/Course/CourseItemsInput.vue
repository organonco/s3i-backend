<template>
    <v-row>
        <v-col cols="12">
            <custom-draggable v-model="value" @clickOnItem="openDialog"></custom-draggable>
        </v-col>
    </v-row>

    <v-row justify="center" class="mb-2">
        <v-btn class="ma-1" color="primary" @click="openDialog(-1, 'section')">إضافة محور</v-btn>
        <v-btn class="ma-1" color="primary" @click="openDialog(-1, 'video')">إضافة فيديو</v-btn>
        <v-btn class="ma-1" color="primary" @click="openDialog(-1, 'meeting')">إضافة اجتماع</v-btn>
        <v-btn class="ma-1" color="primary" @click="openDialog(-1, 'file')">رفع ملف</v-btn>
        <v-btn class="ma-1" color="primary" @click="openDialog(-1, 'homework')">استلام ملف</v-btn>
        <v-btn class="ma-1" color="primary" @click="openDialog(-1, 'quiz', 'multiple_choice')">إضافة اختبار</v-btn>
        <v-btn class="ma-1" color="primary" @click="openDialog(-1, 'quiz', 'text')">إضافة وظيفة</v-btn>
    </v-row>

    <add-item-dialog title="إضافة محور" v-model="section.dialog" @save="saveDialog('section')" :index="index">
        <v-text-field label="اسم المحور" variant="solo" v-model="section.object.name" :rules="requiredRule"/>
    </add-item-dialog>

    <add-item-dialog title="إضافة فيديو" v-model="video.dialog" @save="saveDialog('video')" :index="index">
        <v-text-field label="عنوان الفيديو" variant="solo" v-model="video.object.name" :rules="requiredRule"/>
        <v-text-field label="رابط الفيديو" variant="solo" v-model="video.object.url" :rules="requiredRule"/>
    </add-item-dialog>

    <add-item-dialog title="إضافة اجتماع" v-model="meeting.dialog" @save="saveDialog('meeting')" :index="index">
        <v-label>يتم تحديد وقت ورابط الاجتماع لاحقاً لكل صف على حدى</v-label>
        <v-text-field label="عنوان الاجتماع" variant="solo" v-model="meeting.object.name" :rules="requiredRule"/>
    </add-item-dialog>

    <add-item-dialog title="رفع ملف" v-model="file.dialog" @save="saveDialog('file')" :index="index">
        <v-text-field label="عنوان الملف" variant="solo" v-model="file.object.name" :rules="requiredRule"/>
        <v-file-input prepend-icon="mdi-attachment" label="الملف" variant="solo"
                      @input="file.object.file = $event.target.files[0]" :rules="requiredRule"/>
    </add-item-dialog>

    <add-item-dialog title="استلام ملف" v-model="homework.dialog" @save="saveDialog('homework')" :index="index">
        <v-label>تتيح الوظيفة للطالب رفع ملف
        </v-label>
        <v-text-field label="عنوان الملف" variant="solo" v-model="homework.object.name" :rules="requiredRule"/>
    </add-item-dialog>

    <add-item-dialog :title="quiz?.object?.type === 'text' ? 'إضافة وظيفة' : 'إضافة اختبار' " v-model="quiz.dialog" @save="saveDialog('quiz')" :index="index">
        <v-text-field :label="quiz?.object?.type === 'text' ? 'اسم الوظيفة' : 'اسم الاختبار' " variant="solo" v-model="quiz.object.name"  :rules="requiredRule"/>
        <v-select style="display: none" label="نوع الاختبار" variant="solo" v-model="quiz.object.type" :rules="requiredRule" :items="quiz_types"
                  item-title="name" item-value="value" :disabled="quiz.object.questions.length !== 0"/>
        <quiz-questions-input v-if="quiz.object.type !== null" v-model="quiz.object.questions" :quiz_type="quiz.object.type"></quiz-questions-input>
        <quiz-preview v-if="quiz.object.questions.length > 0" :questions="quiz.object.questions" :title="quiz.object.name"></quiz-preview>
    </add-item-dialog>
</template>

<script setup>
import CustomDraggable from "@/Components/CustomDraggable.vue";
import AddItemDialog from "@/Components/Course/AddItemDialog.vue";
import QuizQuestionsInput from "@/Components/Course/QuizQuestionsInput.vue";
import QuizPreview from "@/Components/Course/QuizPreview.vue";
</script>
<script>

export default {
    name: "CourseItemsInput",
    props: ['modelValue'],
    emits: ['update:modelValue'],
    methods: {
        saveDialog: function (type) {
            if (this.index === -1)
                this.value.push({"type": type, "object": {...this[type].object}})
            else
                this.value[this.index].object = {...this[type].object}
            this[type].object = this[type].initial()
        },
        openDialog: function (index, type, quiz_type) {
            this.index = index
            this[type].object = index === -1 ? this[type].initial() : this.value[this.index].object
            if(index === -1 && type === 'quiz')
                this[type].object.type = quiz_type
            this[type].dialog = true
        }
    },
    computed: {
        requiredRule: function () {
            return [v => !!v || 'Required'];
        },
        value: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', JSON.parse(JSON.stringify(value)))
            }
        },
        quiz_types: function () {
            return [
                {
                    "name": "اختبار نصي",
                    "value": "text"
                },
                {
                    "name": "اختبار اختيار من متعدد",
                    "value": "multiple_choice"
                }
            ]
        }
    },
    data: () => {
        return {
            "index": null,
            "section": {
                "dialog": false,
                initial: function () {
                    return {
                        "name": null
                    }
                }
            },
            "video": {
                "dialog": false,
                initial: function () {
                    return {
                        "name": null,
                        "url": null,
                    }
                }
            },
            "meeting": {
                "dialog": false,
                initial: function () {
                    return {
                        "name": null,
                        "url": null,
                        "date": null,
                        "time": null,
                    }
                }
            },
            "file": {
                "dialog": false,
                initial: function () {
                    return {
                        "name": null,
                        "file": null,
                    }
                }
            },
            "homework": {
                "dialog": false,
                initial: function () {
                    return {
                        "name": null,
                    }
                }
            },
            "quiz": {
                "dialog": false,
                initial: function () {
                    return {
                        "name": null,
                        "type": null,
                        "questions": []
                    }
                }
            }
        }
    },
}
</script>

<style scoped>

</style>
