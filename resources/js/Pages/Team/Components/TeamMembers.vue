<template>

	
    <ImportPlayers :input="setup_data">
        <UserCard class="col-span-1 cursor-pointer"
                  v-for="user in members"
                  :user="user"
                  :key="user.id"
                  @click="router.get(route('users.edit', {user: user}))"/>
    </ImportPlayers>
	
    <CurrentTeam :team="team"/>
    <!--	hiring section -->
<!--    <SearchComponent :model="'User'"-->
<!--                     :input="team"-->
<!--                     @update_results="updateSearchResults"/>-->
<!--    <section class="grid grid-cols-5 gap-4">-->
<!--        <UserCard :user="user"-->
<!--                  v-for="user in search_results"-->
<!--                  :key="user.id"/>-->
<!--    </section>-->
</template>
<script setup>
import {ref} from 'vue';
import UserCard from '@/Pages/User/Components/UserCard.vue';
import SearchComponent from '@/Pages/Shared/SearchComponent.vue';
import ImportPlayers from '@/Pages/Shared/ExcelImport.vue';
import {router} from '@inertiajs/vue3';
import CurrentTeam from '@/Pages/Team/Components/CurrentTeam.vue';

const props = defineProps(['team']);

let members = ref([]);
let search_results = ref([]);

const setup_data = {
    appendable_id: props.team.id,
    appendable: 'Team',
    creatable: 'User',
};

function updateSearchResults(data) {
    console.log('data updated after search', data);
    search_results.value = data;
}

</script>