<template>
    <DashboardLayout>
        ALL DEPARTMENTS PAGE 
    </DashboardLayout>

</template>

<script setup>
import DashboardLayout from '../DashboardLayout.vue'

const data = defineProps({
    departments:Array,
})
</script>