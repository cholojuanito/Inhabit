import mutations from './mutations';
import getters from './getters';
import actions from './actions';


let state = {
    listings: [],
    userListings: [],
    favoriteListings: [],
    pagination: {},
    currQuery: null,
    prevQuery: null
}

let listingsModule = {
    namespaced: true,
    state,
    mutations,
    getters,
    actions
}
export default listingsModule;
