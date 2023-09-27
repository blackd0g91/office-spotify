<script setup>

    import SectionTitle from '@/Components/SectionTitle.vue';

    defineProps({
        queue: Object,
        playing: Object
    });
</script>

<template>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 pt-1 mb-2">

        <SectionTitle title="Now Playing" />

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-row p-3">

            <div class="flex flex-col basis-1/4">

                <img 
                    id="now-playing-album-image" 
                    :src="`${ playing.album.images[0].url}`" 
                    :alt="`${ playing.album.name }`"
                >

            </div>

            <div class="flex flex-col ml-2">

                <div class="p-1 text-gray-900 dark:text-gray-100">
                    <b class="underline decoration-solid">Album</b>: 
                    <span id="now-playing-album-name">{{ playing.album.name }}</span>
                </div>

                <div class="p-1 text-gray-900 dark:text-gray-100">
                    <b class="underline decoration-solid">Song</b>: 
                    <span id="now-playing-name">{{ playing.name }}</span>
                </div>

                <div class="p-1 text-gray-900 dark:text-gray-100">
                    <b class="underline decoration-solid">Artist</b>: 
                    <span id="now-playing-artist">{{ playing.artists[0].name }}</span>
                </div>
            </div>

        </div>

    </div>
</template>
