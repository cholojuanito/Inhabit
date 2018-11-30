import mutations from './mutations';
import getters from './getters';
import actions from './actions';


let state = {
    conversations: []
}

let messagesModule = {
    namespaced: true,
    state,
    mutations,
    getters,
    actions
}
export default messagesModule;
