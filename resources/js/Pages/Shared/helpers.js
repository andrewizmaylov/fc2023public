import {computed} from 'vue';
import {router, usePage} from '@inertiajs/vue3';

export const page = usePage();
export const lorem_text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea, eius, sapiente. Adipisci assumenda dolores eaque inventore quis. Asperiores consectetur doloribus in iure labore minima perspiciatis recusandae, reiciendis, sed sunt suscipit?';
export const cloud_path = 'https://storage.yandexcloud.net/zvezda-spb/';

export const default_image = '/img/empty.svg';

export const initials = computed(() => {
	let first_name = page.props?.auth?.user?.contact?.first_name ?? 0;
	let last_name = page.props?.auth?.user?.contact?.last_name ?? 0;
	
	return first_name.substring(0, 1) + last_name.substring(0, 1);
});

export const full_name = computed(() => {
	let first_name = page.props?.auth?.user?.contact?.first_name ?? 'John';
	let last_name = page.props?.auth?.user?.contact?.last_name ?? 'Dow';
	
	return first_name + ' ' + last_name;
});

export function checkAccess(input) {
	let out = false;
	
	input.forEach(role => {
		if (page?.props?.auth?.roles && page?.props?.auth?.roles.map(role => Number(role)).includes(role)) {
			out = true;
		}
	});
	return out;
}

export function copyClipboard(id) {
	const el_clipBoArd = document.createElement('textarea');
	el_clipBoArd.value = id;
	el_clipBoArd.setAttribute('readonly', '');
	el_clipBoArd.style.position = 'absolute';
	el_clipBoArd.style.left = '-9999px';
	document.body.appendChild(el_clipBoArd);
	el_clipBoArd.select();
	document.execCommand('copy');
	document.body.removeChild(el_clipBoArd);
}

export function copyContent(id) {
	let out = document.getElementById(id).textContent;
	document.getElementById(`copy_${id}`).classList.add('hidden');
	document.getElementById(`copy_done_${id}`).classList.remove('hidden');
	setTimeout(() => {
		document.getElementById(`copy_done_${id}`).classList.add('hidden');
		document.getElementById(`copy_${id}`).classList.remove('hidden');
	}, 1000);
	const el_clipBoArd = document.createElement('textarea');
	el_clipBoArd.value = out;
	el_clipBoArd.setAttribute('readonly', '');
	el_clipBoArd.style.position = 'absolute';
	el_clipBoArd.style.left = '-9999px';
	document.body.appendChild(el_clipBoArd);
	el_clipBoArd.select();
	document.execCommand('copy');
	document.body.removeChild(el_clipBoArd);
}

export async function getTheGame(game) {
	return await axios.post(route('get_team_for_game'), {
		game_id: game.id,
		team_a: game.team_a,
		team_b: game.team_b,
	});
}

export function showNews(element) {
	router.get(route('news.show', {slug: element.slug}));
}

export function showModel(element, route_prefix) {
	router.get(route(route_prefix + '.show', {slug: element.slug}));
}

export function editModel(element, model) {
	router.get(route(model.toLowerCase() + '.edit', {slug: element.slug}));
}

export function defineTab(tabs, defined_tab = null) {
	let index = 1;
	if (tabs.length && defined_tab) {
		index = tabs.find(row => row.route === defined_tab).id;
	}
	return index;
}

export function proceedUrl(element) {
	if (element.external) {
		window.open(element.href, '_blank');
	} else {
		router.get(route(element.href));
	}
}

export function toggleClub(id, model) {
	axios.post(route('toggle_club'),{
		id: id,
		model: model
	}).then(() => Event.emit('club_toggled'));
}