import * as constants from './../constants/reducers';

var initialState = {
    categories: [],
    fetching  : false,
    error     : null,
};
export default function reducer(state=initialState, action) {

    switch (action.type) {
        case constants.CATEGORIES_FETCH: {
            return {
                ...state,
                fetching: true
            }
        }
        case constants.CATEGORIES_FETCH_REJECTED: {
            return {
                ...state,
                fetching: false,
                error: action.value
            }
        }
        case constants.CATEGORIES_FETCH_FULFILLED: {
            return {
                ...state,
                fetching: false,
                categories: action.value,
            }
        }
    }

    return state;
}