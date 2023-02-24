
<script setup>
import { Link } from '@inertiajs/vue3';
</script>
<script>
export default {
    data() {
        let currentRoute = this.$page.props.metadata.route;
        return {
            listItems: [
                { icon: "mdi-home-city", title: "Home", 'route': 'dashboard', 'value': 'dashboard' },
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
                    <v-list-item v-for="listItem in listItems" :prepend-icon="listItem.icon" :title="listItem.title" :value="listItem.value" :active="listItem.value == $page.props.metadata.route"></v-list-item>
                </v-list>
            </v-navigation-drawer>
            <v-main>
                <slot></slot>
            </v-main>
        </v-layout>
    </v-card>

</template>
