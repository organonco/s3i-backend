<script setup>
import {Head, Link} from '@inertiajs/vue3';
import {adminMenuItems, teacherMenuItems} from "@/Menus/NavMenu";
</script>
<script>
import {teacherMenuItems} from "@/Menus/NavMenu";

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
    <v-layout class="v-locale--is-rtl">
        <v-navigation-drawer permanent location="right">
            <template v-slot:prepend>
                <v-list-item lines="two"
                             prepend-avatar="https://www.citypng.com/public/uploads/small/11640168385jtmh7kpmvna5ddyynoxsjy5leb1nmpvqooaavkrjmt9zs7vtvuqi4lcwofkzsaejalxn7ggpim4hkg0wbwtzsrp1ldijzbdbsj5z.png"
                             :title="$page.props.auth.user.name">
                    <Link as="div" :href="route('logout')" method="post" class="underline"> تسحيل الخروح </Link>
                </v-list-item>
            </template>
            <v-divider></v-divider>
            <v-list density="compact" nav>
                <template v-for="listItem in listItems">
                    <Link as="div" :href="route(listItem.route)">
                        <v-list-item as="v-list-item" :prepend-icon="listItem.icon" :title="listItem.title"
                                     :value="listItem.value"
                                     :active="listItem.value === $page.props.metadata.route"></v-list-item>
                    </Link>
                </template>
            </v-list>
        </v-navigation-drawer>
        <v-main>
            <v-container class="pa-16">
                <div class="text-h4 mb-8">
                    {{ title }}
                </div>
                <v-divider
                    :thickness="3"
                    class="border-opacity-100 mb-8"
                ></v-divider>
                <slot></slot>
            </v-container>
        </v-main>
    </v-layout>
</template>
