import axios from "axios";

import * as constants from './../constants/reducers';
import * as urls from './../constants/urls';

export function fetchNewsSources() {
    return function(dispatch) {
        axios.get(urls.URL_GET_HOMEPAGE_ARTICLES)
            .then((response) => {
                dispatch({type: constants.SOURCES_FETCH_FULFILLED, value: response.data})
            })
            .catch((err) => {
                dispatch({type: constants.SOURCES_FETCH_REJECTED, value: err})
            })
    }
}
