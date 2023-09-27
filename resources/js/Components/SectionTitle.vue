<script setup>
    defineProps({
        title: String
    });
</script>

<template>
    <div class="flex flex-row text-white italic m-3 ml-0">
            {{ title }}
    </div>
</template>
