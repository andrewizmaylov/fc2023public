<template>
    <section v-if="show_list"
             class="max-w-[1000px]">
        <h3 class="header_21 my-8">{{ $t('team.coaches') }}</h3>
        <section class="grid_responsive gap-4 mb-4">
            <UserCard v-for="member in coaches"
                      :key="member.index"
                      :user="member"/>
        </section>
        <h3 class="header_21 my-8">{{ $t('team.players') }}</h3>
        <section class="grid_responsive gap-4 mb-6"
                 v-for="(role, i) in [goalkeepers, defenders, half_defenders, attacks]"
                 :key="i">
            <UserCard v-for="member in role"
                      :key="member.index"
                      :user="member"/>
        </section>
    </section>
</template>
<script setup>
import UserCard from '@/Pages/User/Components/UserCard.vue';
import {onMounted, ref, computed} from 'vue';
import {RolesEnum} from '@/Enums/RolesEnum.js';
let members = ref([]);

const props = defineProps(['team']);
let show_list = ref(false);
let coaches = computed(() => members.value.filter(member => member.roles.map(role => role.id).includes(RolesEnum.TRENER)));
let goalkeepers = computed(() => members.value.filter(member => member.roles.map(role => role.id).includes(RolesEnum.VRATAR)));
let defenders = computed(() => members.value.filter(member => member.roles.map(role => role.id).includes(RolesEnum.ZASHHITNIK)));
let half_defenders = computed(() => members.value.filter(member => member.roles.map(role => role.id).includes(RolesEnum.POLUZASHHITNIK)));
let attacks = computed(() => members.value.filter(member => member.roles.map(role => role.id).includes(RolesEnum.NAPADAIUSHHII)));
function getMembers() {
    axios.post(route('get_team_members'), {
        team_id: props.team.id
    }).then(response => {
        // console.log(response.data);
        members.value = response.data;
        show_list.value = true;
    });
}

onMounted(() => {
    getMembers();
    Event.on('new_records', () => {
        show_list.value = false;
        getMembers();
    });
});
</script>