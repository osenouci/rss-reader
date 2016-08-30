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
        case constants.FAVORITES_REMOVE:{
            return {
                ...state,
                fetching: true
            }
        }
        case constants.FAVORITES_ADD: {
            return {
                ...state,
                fetching: true
            }
        }
        case constants.FAVORITES_REMOVE_REJECTED:{
            return {
                ...state,
                fetching: false,
                error: action.value
            }
        }
        case constants.FAVORITES_ADD_REJECTED: {
            return {
                ...state,
                fetching: false,
                error: action.value
            }
        }
        case constants.FAVORITES_REMOVE_FULFILLED:{
            return {
                ...state,
                fetching: false
            }
        }
        case constants.FAVORITES_ADD_FULFILLED: {
            return {
                ...state,
                fetching: false
            }
        }

    }

    return state;
}