<script setup>
import {Head, Link} from '@inertiajs/vue3';
import {adminMenuItems, teacherMenuItems} from "@/Menus/NavMenu";
</script>
<script>
const version = "1.5.2";

export default {
    props: {
        'title': String
    },
    data() {
        let is_admin = this.$page.props.auth.user.super_admin;
        return {
            listItems: is_admin ? adminMenuItems : teacherMenuItems
        }
    }
}
</script>
<template>
    <Head><title> {{ title }} </title></Head>
    <v-layout>
        <v-navigation-drawer expand-on-hover
                             rail
                             location="right"
                             class="text-right"
                             color="secondary"
        >
            <template v-slot:prepend>
<!--                <v-list-item>-->
                        <v-img src="logo.png" style="margin: 5px; margin-top: 20px"></v-img>
<!--                </v-list-item>-->
                <v-list-item lines="two"
                             prepend-icon="mdi-account"
                             :title="$page.props.auth.user.name">
                    <Link as="a" class="text-white" :href="route('logout')" method="post"> تسحيل الخروح</Link>
                </v-list-item>
            </template>
            <v-divider></v-divider>
            <v-list density="compact" nav>
                <template v-for="listItem in listItems">
                    <Link as="div" :href="route(listItem.route)">
                        <v-list-item
                                variant="text"
                                active-color=""
                                as="v-list-item" :prepend-icon="listItem.icon" :title="listItem.title"
                                :value="listItem.value"
                                :active="listItem.value === $page.props.metadata.route"></v-list-item>
                    </Link>
                </template>
            </v-list>
            <template v-slot:append>
                <v-list-item
                        class="text-center" style="width: 100%"
                        variant="text"
                        :title="'V' + version"
                >
                </v-list-item>
            </template>

        </v-navigation-drawer>
        <v-main>
            <v-container class="">
                <v-row class="mt-12 mb-6 mx-2">
                    <h1>
                        {{ title }}
                    </h1>
                </v-row>
                <v-divider class="my-8"/>
                <v-row>
                    <v-container>
                        <slot></slot>
                    </v-container>
                </v-row>
            </v-container>
        </v-main>
    </v-layout>
</template>
