import {ref, onMounted} from 'vue';

export default() => {
	let current_order_list = ref([]);
	
	onMounted(() => {
		Event.on('update_order', () => {
			current_order_list.value = document.getElementsByName('order_item')?.length
				? Array.from(document.getElementsByName('order_item')).filter(element => element.checked).map(element => element.id)
				: [];
		});
	});
	
	return {current_order_list};
};