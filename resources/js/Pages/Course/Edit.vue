<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";
import CourseItemsInput from "@/Components/Course/CourseItemsInput.vue";
import SimpleFormSheet from "@/Components/SimpleFormSheet.vue";

defineProps({
	course: Object,
	categories: Object,
	teachers: Array,
});
</script>

<script>
import { useForm } from "@inertiajs/vue3";
import _ from 'lodash'

export default {
	mounted() {
		console.log(this.course)
	},
	data: function () {
		return {
			items: this.course.data.items,
			form: useForm({
				_method: "put",
				name: this.course.data.name,
				description: this.course.data.description,
				introduction_video_url: this.course.data.introduction_video_url,
				category_id: this.course.data.category.id,
				students_limit: this.course.data.students_limit,
				user_ids: this.course.data.user_ids,
				telegram_url: this.course.data.telegram_url,
				image: "",
				price: this.course.data.price
			})
		}
	},
	methods: {
		submit: function () {
			for (let i = 0; i < this.items.length; i++)
				this.items[i] = _.cloneDeep(this.items[i])
			this.form.transform((data) => ({
				...data,
				items: this.items,
			})).post(route('course.update', this.course.data.id))
		}
	}
}
</script>

<template>
	<MainLayout title="تعديل دورة">
		<simple-form-sheet cols="8" @save="submit">
			<v-text-field label="اسم الدورة" variant="solo" v-model="form.name"
				:error-messages="form.errors.name"></v-text-field>
			<v-textarea label="الوصف" variant="solo" v-model="form.description"
				:error-messages="form.errors.description"></v-textarea>
			<v-text-field label="رابط الفيديو التعريفي" variant="solo" v-model="form.introduction_video_url"
				:error-messages="form.errors.introduction_video_url"></v-text-field>
			<v-text-field label="رابط مجموعة التلغرام" variant="solo" v-model="form.telegram_url"
				:error-messages="form.errors.telegram_url"></v-text-field>
			<v-text-field label="عدد الطلاب في كل صف" type="number" variant="solo" v-model="form.students_limit"
				:error-messages="form.errors.students_limit"></v-text-field>
			<v-text-field label="السعر بالليرة السورية" type="number" variant="solo" v-model="form.price" :error-messages="form.errors.price"></v-text-field>
			<v-autocomplete label="القسم" variant="solo" v-model="form.category_id" :items="categories.data"
				:error-messages="form.errors.category_id" item-title="name" item-value="id"></v-autocomplete>
			<v-select label="المدربين" variant="solo" v-model="form.user_ids" :items="teachers.data"
				:error-messages="form.errors.user_ids" multiple item-title="name" item-value="id"></v-select>
			<v-row>
				<v-col>
					<v-file-input prepend-icon="mdi-image" label="الصورة" variant="solo"
						:error-messages="form.errors.image"
						@change="form.image = $event.target.files[0]"></v-file-input>
				</v-col>
				<v-col cols="3"><v-img :src="course.data.image_url" width="500px" /></v-col>
			</v-row>
			<course-items-input v-model="items" />
		</simple-form-sheet>
	</MainLayout>
</template>
