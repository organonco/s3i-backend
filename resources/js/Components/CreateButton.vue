<template>
    <VLayoutItem model-value position="bottom" class="text-end" size="88">
        <div class="ma-4">
            <a :href="link">
              <VBtn :icon="icon? icon : 'mdi-plus'" size="large" color="secondary" elevation="8" />
            </a>
        </div>
    </VLayoutItem>
</template>

<script>
export default {
    name: "CreateButton",
    props: ['link', 'icon']
}
</script>

<style scoped>

</style>