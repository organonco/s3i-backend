<script setup>
import { Head } from '@inertiajs/vue3';
import MainLayout from "@/Layouts/MainLayout.vue";
import SaveButton from "@/Components/SaveButton.vue";

defineProps({

});
</script>

<script>

import { router } from '@inertiajs/vue3'
export default {

    data: function () {
        return {
            name: ""
        }
    },
    methods: {
        submit: function() {
            let self = this
            router.post('/education_level', {
                name: self.name
            })
        }
    }
}

</script>

<template>
    <Head>
        <title>
            Education Levels
        </title>
    </Head>

    <MainLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Education Levels</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <v-text-field v-model="name"/>
                        <save-button/>
                    </form>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
