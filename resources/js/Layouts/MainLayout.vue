<script setup>
import {Head, Link} from '@inertiajs/vue3';
import {adminMenuItems, teacherMenuItems} from "@/Menus/NavMenu";
</script>
<script>

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
                            class="text-right">
            <template v-slot:prepend>
                <v-list-item lines="two"
                             prepend-icon="mdi-account"
                             :title="$page.props.auth.user.name">
                    <Link as="a" class="text-black" :href="route('logout')" method="post"> تسحيل الخروح</Link>
                </v-list-item>
            </template>
            <v-divider></v-divider>
            <v-list density="compact" nav>
                <template v-for="listItem in listItems">
                    <Link as="div" :href="route(listItem.route)">
                        <v-list-item
                                variant="text"
                                active-color="secondary"
                                as="v-list-item" :prepend-icon="listItem.icon" :title="listItem.title"
                                :value="listItem.value"
                                :active="listItem.value === $page.props.metadata.route"></v-list-item>
                    </Link>
                </template>
            </v-list>
        </v-navigation-drawer>
        <v-main class="">
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
