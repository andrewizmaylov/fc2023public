import dayjs from 'dayjs';
import 'dayjs/locale/ru';
import 'dayjs/locale/en';
import localizedFormat from 'dayjs/plugin/localizedFormat';
dayjs.extend(localizedFormat);
dayjs.locale(localStorage.getItem('locale') ?? 'ru');
export default() => {
	function getHumanDate(element) {
		let data = element.published_at ?? element.created_at;
		
		dayjs.locale(localStorage.getItem('locale') ?? 'ru');
		return dayjs(data).format('LLL');
	}
	
	function getGameDate(element) {
		dayjs.locale(localStorage.getItem('locale') ?? 'ru');
		return dayjs(element.date).format('LL');
	}
	
	function getGameTime(element) {
		return element.time;
	}
	
	return {
		getHumanDate, getGameDate, getGameTime
	};
};