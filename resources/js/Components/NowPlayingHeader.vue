<script setup>

defineProps({
    playing: Object
});

</script>

<template>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded">

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded flex flex-row">

            <div class="flex flex-col shrink-0">

                <img 
                    id="now-playing-album-image" 
                    class="w-16 rounded hover:w-40 hover:rounded-none hover:ml-1 transition-all duration-200 ease-in-out"
                    :src="`${ playing.album.images[0].url}`" 
                    :alt="`${ playing.album.name }`"
                >

            </div>

            <div class="flex flex-col px-4 content-around">

                <p class="text-gray-900 dark:text-gray-100">
                    Now playing: 
                    <b id="now-playing-name" class="text-lg underline"> {{ playing.name }} </b>
                    by
                    <b id="now-playing-artist" class="text-lg underline"> {{ playing.artists[0].name }} </b>
                </p>

            </div>

        </div>

    </div>
</template>
