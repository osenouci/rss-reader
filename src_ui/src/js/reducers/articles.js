import * as constants from './../constants/reducers';

var initialState = {
    articles  : [],
    fetching  : false,
    error     : null,
};
export default function reducer(state=initialState, action) {

    switch (action.type) {
        case constants.ARTICLES_FETCH: {
            return {...state, fetching: true}
        }
        case constants.ARTICLES_FETCH_REJECTED: {
            return {...state, fetching: false, error: action.value}
        }
        case constants.ARTICLES_FETCH_FULFILLED: {
            return {
                ...state,
                fetching: false,
                tweets: action.value,
            }
        }
    }

    return state;
}