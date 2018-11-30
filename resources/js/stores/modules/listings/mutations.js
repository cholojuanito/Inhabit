/**
 * Mutations are the only way to change the 
 * state of the Vuex state. These should ONLY be called
 * by ACTIONS (i.e. after a successful api call)
 * 
 * Mutations are called using the 'commit' method
 * on the state object. Like so: 
 * this.$store.commit('listings/setListings') would call
 * the 'setListings' function in the actions.
 */
let mutations = {
    SET_LISTINGS(state, newListings) {
        state.listings = newListings
    },
    SET_PAGINATION(state, pagination) {
        state.pagination = pagination;
    },
    SET_USER_LISTING(state, listings) {
        state.userListings = listings;
    },
    ADD_LISTING(state, newListing) {
        state.listings.push(newListing);
    },
    ADD_USER_LISTING(state, newListing) {
        state.userListings.push(newListing);
    },
    SET_CURR_QUERY(state, currQuery) {
        state.currQuery = currQuery
    },
    SET_PREV_QUERY(state, prevQuery) {
        state.prevQuery = prevQuery
    }
}

export default mutations;
