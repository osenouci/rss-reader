import * as constants from './../constants/reducers';

var initialState = {
    sources     : [],
    activeSource: "",
    fetching    : false,
    error       : null,
};
export default function reducer(state=initialState, action) {

    switch (action.type) {
        case constants.SOURCES_FETCH: {
            return {...state, fetching: true}
        }
        case constants.SOURCES_FETCH_REJECTED: {
            return {...state, fetching: false, error: action.value}
        }
        case constants.SOURCES_FETCH_FULFILLED: {
            return {
                ...state,
                fetching: false,
                sources: action.value.sources,
                activeSource: action.value.active,
            }
        }
        case constants.SOURCES_SET_FULFILLED: {

            return {
                ...state,
                fetching: false,
                activeSource: action.value,
            }
        }
        case constants.SOURCES_SET_REJECTED: {
            return {
                ...state,
                fetching: false
            }
        }
        case constants.SOURCES_SET: {
            return {...state, fetching: true}
        }
    }

    return state;
}