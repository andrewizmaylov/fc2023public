export const currency = [
	{id: 1, name: 'руб'},
	{id: 2, name: 'usd'},
	{id: 3, name: 'euro'},
	{id: 4, name: 'kzt'},
	{id: 5, name: 'gel'},
];

export const product_price = (product) => {
	return product?.details?.price ?
		product?.details?.price +' '+ currency[product?.details?.currency - 1]?.name : '';
};