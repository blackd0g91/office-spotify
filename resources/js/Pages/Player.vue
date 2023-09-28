<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NowPlayingHeader from '@/Components/NowPlayingHeader.vue';
import PlayerControls from '@/Components/PlayerControls.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    playing: Object
});

</script>

<template>
    <Head title="Spotify" />

    <AuthenticatedLayout>
        <template #header>
            <NowPlayingHeader :playing="playing.item" />
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <!-- <NowPlaying :playing="playing.item" /> -->

                <PlayerControls />
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
