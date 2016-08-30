import axios from "axios";

import * as constants from './../constants/reducers';
import * as urls from './../constants/urls';

export function fetchHomePageArticles() {
    return function(dispatch) {
        axios.get(urls.URL_GET_HOMEPAGE_ARTICLES)
            .then((response) => {
                dispatch({type: constants.ARTICLES_FETCH_FULFILLED, value: response.data})
            })
            .catch((err) => {
                dispatch({type: constants.ARTICLES_FETCH_REJECTED, value: err})
            })
    }
}

export function fetchCategoryArticles(category) {
    return function(dispatch) {
        axios.get(urls.URL_GET_HOMEPAGE_ARTICLES + "/" + category)
            .then((response) => {
                dispatch({type: constants.ARTICLES_FETCH_FULFILLED, value: response.data})
            })
            .catch((err) => {
                dispatch({type: constants.ARTICLES_FETCH_REJECTED, value: err})
            })
    }
}