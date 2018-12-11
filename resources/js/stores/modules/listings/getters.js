let getters = {
    currentListings: state => state.listings,
    favorites: state => state.favoriteListings,
    usersListings: state => state.favoriteListings,
    pagination: state => state.pagination,
    currentQ: state => state.currQuery,
}

export default getters;
