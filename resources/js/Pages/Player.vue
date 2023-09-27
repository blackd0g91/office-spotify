<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NowPlaying from '@/Components/NowPlaying.vue';
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
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Player</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <NowPlaying :playing="playing.item" />

                <PlayerControls />
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
