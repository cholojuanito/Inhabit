import Vue from 'vue';
import Vuex from 'vuex';
import listingsModule from './modules/listings/listingsModule';
import messagesModule from './modules/messages/messagesModule';


Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        listings: listingsModule,
        messages: messagesModule
    }
});
