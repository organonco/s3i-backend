<template>
    <v-badge v-if="value > 0" :content="value" color="success">
        <v-chip color="secondary">{{ content }}</v-chip>
    </v-badge>
    <v-chip v-else color="secondary">{{ content }}</v-chip>
</template>

<script>
export default {
    name: "ChipWithBadge",
    props: ['value', 'content']
}
</script>

<style scoped>

</style>
