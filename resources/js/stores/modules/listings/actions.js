/**
 * All the urls that are use to access the API
 */
const searchURL = "/search";
const createURL = "/listing/create"
const favoriteURL = "/listing/id/favorite"

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
    toogleFavorite({
        commit
    }, listingId) {
        return new Promise((resolve, reject) => {

        });
    }
}

export default actions;
