import { setInterval } from 'core-js';

window.Vue = require('vue');

const components = [
	'Recipes',
	'RandomRecipesSidebar'
]

components.forEach(comp => {
	Vue.component(comp, require('./components/' + comp + '.vue'))
})

const app = new Vue({
	el: '#app'
});