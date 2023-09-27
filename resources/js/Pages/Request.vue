<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SectionTitle from '@/Components/SectionTitle.vue';
import MainButton from '@/Components/MainButton.vue';
import { Head } from '@inertiajs/vue3';

// defineProps({
//     playing: Object
// });


function search() {
    console.log('search');

    let text = document.querySelector('#search').value;
    fetch(`search/${text}`)
        .then(response => response.json())
        .then(data => {
            var ul = document.querySelector('#search-results ul')
            ul.innerHTML = "";
            var html = '';
            for (const item of data.tracks.items) {
                html += 
                    `
                        <li v-for="item in queue" class="my-1 p-1 bg-gray-500 rounded">
                            <div class="grid grid-cols-6 content-center">
                                <div class="grid col-span-1 content-around">
                                    <img class="w-15 h-15" src="${item.album.images[2].url}" alt="${ item.album.name }">
                                </div>
                                <div class="grid col-span-4 content-around ml-2">
                                    <p class="flex flex-row">${item.album.name}</p>
                                    <p class="flex flex-row">${item.name}</p>
                                    <p class="flex flex-row">${item.artists[0].name}</p>
                                </div>
                                <div class="grid col-span-1 content around">
                                    <button class="flex flex-row">Add</button>
                                </div>
                            </div>
                        </li>
                    `;





                // let li = document.createElement("li");
                // li.appendChild(document.createTextNode(song));
                // ul.appendChild(li);
            }
            document.querySelector('#search-results').classList.remove('hidden');
            ul.innerHTML = html;
        });
}

    // function player(action){
    //     console.log(`Player ${action}`);
    //     fetch(`/player/${action}`, {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         }
    //     }).then(response => response.json())
    //     .then(data => {
    //         console.log(data);
    //         document.querySelector('#now-playing-album-image').src = data.item.album.images[0].url;
    //         document.querySelector('#now-playing-album-image').alt = data.item.album.name;
    //         document.querySelector('#now-playing-album-name').innerHTML = data.item.album.name;
    //         document.querySelector('#now-playing-name').innerHTML = data.item.name;
    //         document.querySelector('#now-playing-artist').innerHTML = data.item.artists[0].name;
    //     })
    //     .catch((error) => {
    //         console.error('Error:', error);
    //     });
    // }


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
                        <div class="grid col-span-11">
                            <input @keyup.enter="search()" type="search" name="search-song" id="search">
                        </div>
                        <div class="grid col-span-1">
                            <button @click="search()">Search</button>
                        </div>
                    </div>

                </div>

                <div  id="search-results" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 pt-1 mt-2 hidden">

                    <SectionTitle title="Results" />

                    <ul></ul>
                </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
