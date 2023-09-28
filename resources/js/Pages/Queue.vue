<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NowPlayingHeader from '@/Components/NowPlayingHeader.vue';
import PlaylistQueue from '@/Components/PlaylistQueue.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    queue: Object,
    playing: Object
});

</script>

<template>
    <Head title="Spotify" />

    <AuthenticatedLayout>
        <template #header>
            <NowPlayingHeader :playing="playing" />
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- <NowPlaying :playing="playing" /> -->

                <PlaylistQueue :queue="queue" />
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
