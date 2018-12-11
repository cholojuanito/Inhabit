/**
 * All the urls that are use to access the API
 */
const searchURL = '/search';
const listingURL = '/listing';
const userListingsURL = '/user-listings';
const favoriteListingURL = '/user-favorites';
const createURL = '/listing/create'
const favoriteURL = '/listing/favorite'
const unfavoriteURL = '/listing/unfavorite'

/**
 * Actions are the gateway to the mutation methods
 * the only way to change the state is to call an action
 * and let it call the mutation method.
 * 
 * Actions are called using the 'dispatch' method
 * on the state object. Like so: 
 * this.$store.dispatch('listings/searchListings') would call
 * the 'searchListings' function.
 * 
 */
let actions = {
    searchListings({
        commit
    }, formObj, city, stateAbbr) {
        return new Promise((resolve, reject) => {
            formObj.get(searchURL)
                .then(response => {
                    let resData = response.data;
                    let pagination = {};
                    pagination.baseURL = resData['path'];
                    pagination.currentPage = resData['current_page'];
                    pagination.lastPage = resData['last_page'];
                    pagination.firstPageURL = resData['first_page_url'];
                    pagination.lastPageURL = resData['last_page_url'];
                    pagination.nextPageURL = resData['next_page_url'];
                    pagination.prevPageURL = resData['prev_page_url'];
                    pagination.upTo = resData['to'];
                    pagination.from = resData['from'];
                    pagination.numPerPage = resData['per_page'];
                    pagination.totalHits = resData['total'];

                    let prevQuery = {};
                    prevQuery.city = city;
                    prevQuery.state = stateAbbr;


                    // Update the state
                    commit('SET_LISTINGS', resData.data);
                    commit('SET_PAGINATION', pagination);
                    commit('SET_PREV_QUERY', prevQuery);
                    resolve(resData);
                })
                .catch(errors => {
                    reject(errors);
                })
        });
    },

    getInitialListings({
        commit
    }) {
        return new Promise((resolve, reject) => {
            axios.get('/listing')
                .then((response) => {
                    let resData = response.data.data;
                    let pagination = {};
                    pagination.baseURL = resData['path'];
                    pagination.currentPage = resData['current_page'];
                    pagination.lastPage = resData['last_page'];
                    pagination.firstPageURL = resData['first_page_url'];
                    pagination.lastPageURL = resData['last_page_url'];
                    pagination.nextPageURL = resData['next_page_url'];
                    pagination.prevPageURL = resData['prev_page_url'];
                    pagination.upTo = resData['to'];
                    pagination.from = resData['from'];
                    pagination.numPerPage = resData['per_page'];
                    pagination.totalHits = resData['total'];


                    // Update the state
                    commit('SET_LISTINGS', resData.data);
                    commit('SET_PAGINATION', pagination);
                    resolve(resData);
                })
                .catch((errors) => {
                    reject(errors)
                })
        });
    },

    getUserListings({
        commit
    }, userId) {
        return new Promise((resolve, reject) => {
            axios.get(userListingsURL, {
                    params: {
                        user_id: userId
                    }
                })
                .then(response => {
                    let resData = response.data;

                    commit('SET_USER_LISTING', resData.data)
                    resolve(resData);
                })
                .catch(
                    errors => {
                        console.log(errors);
                        reject(errors);
                    }
                )
        });

    },

    getFavoriteListings({
        commit
    }, userId) {
        return new Promise((resolve, reject) => {
            axios.get(favoriteListingURL, {
                    params: {
                        user_id: userId
                    }
                })
                .then(response => {
                    let resData = response.data;

                    commit('SET_FAVORITE_LISTINGS', resData.data)
                    resolve(resData);
                })
                .catch(
                    errors => {
                        console.log(errors);
                        reject(errors);
                    }
                )
        });

    },

    createListing({
        commit
    }, formObj) {
        return new Promise((resolve, reject) => {
            formObj.post(createURL)
                .then(response => {
                    let resData = response.data;
                    commit('ADD_USER_LISTING', resData);
                    resolve(resData);
                })
                .catch(errors => {
                    reject(errors);
                })
        });
    },

    favorite({
        commit
    }, listingId) {
        return new Promise((resolve, reject) => {
            axios.post(favoriteURL, {
                    listing_id: listingId
                })
                .then(response => {
                    commit('ADD_FAVORITE_LISTING', listingId);
                    resolve(response);
                })
                .catch(errors => {

                    reject(errors);
                })
        });
    },
    unfavorite({
        commit
    }, listingId) {
        return new Promise((resolve, reject) => {
            axios.post(unfavoriteURL, {
                    listing_id: listingId
                })
                .then(response => {
                    commit('REMOVE_FAVORITE_LISTING', listingId);
                    resolve(response);
                })
                .catch(errors => {
                    reject(errors);
                })
        });
    },

}

export default actions;
