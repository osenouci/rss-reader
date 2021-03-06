import * as constants from './../constants/reducers';

var initialState = {
    favorites : [],
    fetching  : false,
    error     : null,
};
export default function reducer(state=initialState, action) {

    switch (action.type) {
        case constants.FAVORITES_FETCH: {
            return {...state, fetching: true}
        }
        case constants.FAVORITES_FETCH_REJECTED: {
            return {...state, fetching: false, error: action.value}
        }
        case constants.FAVORITES_FETCH_FULFILLED: {
            return {
                ...state,
                fetching: false,
                tweets: action.value,
            }
        }
    }

    return state;
}