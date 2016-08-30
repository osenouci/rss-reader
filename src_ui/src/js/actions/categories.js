import axios from "axios";

import * as constants from './../constants/reducers';
import * as urls from './../constants/urls';

export function fetchCategories() {
    return function(dispatch) {
        axios.get(urls.URL_GET_CATEGORIES)
            .then((response) => {
                dispatch({type: constants.CATEGORIES_FETCH_FULFILLED, value: response.data})
            })
            .catch((err) => {
                dispatch({type: constants.CATEGORIES_FETCH_REJECTED, value: err})
            })
    }
}