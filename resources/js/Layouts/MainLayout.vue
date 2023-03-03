
<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<script>
export default {
    data() {
        return {
            listItems: [
                { icon: "mdi-view-dashboard-outline", title: "Home", 'route': 'dashboard', 'value': 'dashboard' },
                { icon: "mdi-account-outline", title: "Profile", 'route': 'profile.edit', 'value': 'profile' },
                { icon: "mdi-folder-multiple-outline", title: "Categories", 'route': 'category.index', 'value': 'categories' },
            ]
        }
    }
}
</script>


<template>
    <v-card>
        <v-layout>
            <v-navigation-drawer
                permanent
                location="left"
            >
                <template v-slot:prepend>
                    <v-list-item
                        lines="two"
                        prepend-avatar="https://www.citypng.com/public/uploads/small/11640168385jtmh7kpmvna5ddyynoxsjy5leb1nmpvqooaavkrjmt9zs7vtvuqi4lcwofkzsaejalxn7ggpim4hkg0wbwtzsrp1ldijzbdbsj5z.png"
                        :title="$page.props.auth.user.name"
                    >
                        <Link :href="route('logout')" method="post" class="underline">
                            Log Out
                        </Link>
                    </v-list-item>
                </template>

                <v-divider></v-divider>
                <v-list density="compact" nav>
                    <Link v-for="listItem in listItems" :href="route(listItem.route)"><v-list-item :prepend-icon="listItem.icon" :title="listItem.title" :value="listItem.value" :active="listItem.value == $page.props.metadata.route"></v-list-item></Link>
                </v-list>
            </v-navigation-drawer>
            <v-main>
                <header class="bg-white shadow" v-if="$slots.header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>
                <slot></slot>
            </v-main>
        </v-layout>
    </v-card>

</template>
