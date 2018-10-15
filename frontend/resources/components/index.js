import Vue from 'vue'
import Child from './common/Child'
import RenderImage from './common/RenderImage'

[Child, RenderImage].forEach(Component => {
    Vue.component(Component.name, Component)
});