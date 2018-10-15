import Vue from 'vue';
import moment from 'moment';

Vue.filter('formatDate', function (value, format = 'MMMM Do, YYYY') {
    if (value) {
        return moment.unix(value).format(format)
    }
});