<script setup>

    import SectionTitle from '@/Components/SectionTitle.vue';

    defineProps({
        queue: Object
    });

</script>

<template>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 pt-1">

        <SectionTitle title="Queue" />

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2">
            <div class="flex flex-col">
                <ul class="list-outside hover:list-inside">
                    <li v-for="item in queue" class="my-1 p-1 bg-gray-500 rounded">
                        <div class="flex flex-row content-center">
                            <div class="grid grid-cols-1 gap-1 content-around">
                                <img 
                                class="w-15 h-15"
                                :src="`${ item.album.images[2].url}`" 
                                :alt="`${ item.album.name }`"
                                >
                            </div>
                            <div class="grid gap-1 content-around ml-2">
                                <p class="flex flex-row">{{ item.album.name }}</p>
                                <p class="flex flex-row">{{ item.name }}</p>
                                <p class="flex flex-row">{{ item.artists[0].name }}</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
