<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SectionTitle from '@/Components/SectionTitle.vue';
import MainButton from '@/Components/MainButton.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const results = ref([]);


function search() {

    results.value = [];
    let text = document.querySelector('#search').value;

    fetch(
        `search/${text}`
    ).then(
        response => response.json()
    ).then(data => {
        for (const item of data.tracks.items) results.value.push(item);
        document.querySelector('#search-results').classList.remove('hidden');
    });

}

function requestSong(id) {

    fetch(
        `queue/track`, 
        {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({id: id})
        }
    ).then(
        () => {
            results.value = [];
            document.querySelector('#search').value = '';
            document.querySelector('#search-results').classList.add('hidden');
        }
    ).catch((error) => {
        console.error('Error:', error);
    });

}

</script>

<template>
    <Head title="Spotify" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Request</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 pt-1">

                    <SectionTitle title="Search" />

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-2 grid grid-cols-12 gap-4">
                        <div class="grid col-span-10">
                            <input @keyup.enter="search()" type="search" name="search-song" id="search">
                        </div>
                        <div class="grid col-span-2">
                            <MainButton @click="search()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" /></svg>
                            </MainButton>
                        </div>
                    </div>

                </div>

                <div  id="search-results" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 pt-1 mt-2 hidden">

                    <SectionTitle title="Results" />

                    <ul>
                        <li v-for="item in results" class="my-1 p-1 bg-gray-500 rounded">

                            <div class="grid grid-cols-6 content-center">
                                <div class="grid col-span-1 content-around justify-end">
                                    <img class="w-15 h-15" :src="`${ item.album.images[2].url }`">
                                </div>
                                <div class="grid col-span-4 content-around ml-2">
                                    <p class="flex flex-row">{{ item.album.name }}</p>
                                    <p class="flex flex-row">{{ item.name }}</p>
                                    <p class="flex flex-row">{{ item.artists[0].name }}</p>
                                </div>
                                <div class="grid col-span-1 place-items-center">
                                    <MainButton @click="requestSong(`${ item.id }`)">Add</MainButton>
                                </div>
                            </div>

                        </li>
                    </ul>
                    
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
