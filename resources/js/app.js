import { createApp } from 'vue';
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import SearchComponent from './components/SearchComponent.vue';

const app = createApp(SearchComponent);
app.use(ElementPlus);
app.mount('#app');
