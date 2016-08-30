import axios from "axios";

import * as constants from './../constants/reducers';
import * as urls from './../constants/urls';
/**
 * @type: ACTION
 * Redux action used to fetch the articles from the servers.
 * It gets the articles of either of the favorite page or the home page.
 */
export function fetchHomePageArticles() {
    return function(dispatch) {

        dispatch({type: constants.ARTICLES_FETCH}); // Show the spinner

        axios.get(urls.URL_GET_HOMEPAGE_ARTICLES)
            .then((response) => {
                dispatch({type: constants.ARTICLES_FETCH_FULFILLED, value: response.data})
            })
            .catch((err) => {
                dispatch({type: constants.ARTICLES_FETCH_REJECTED, value: err})
            })
    }
}
/**
 * @type: ACTION
 * Redux action used to fetch the articles from the servers.
 * It gets the articles of a given category.
 */
export function fetchCategoryArticles(category) {
    return function(dispatch) {

        dispatch({type: constants.ARTICLES_FETCH}); // Show the spinner

        axios.get(urls.URL_GET_HOMEPAGE_ARTICLES + "/" + category)
            .then((response) => {
                dispatch({type: constants.ARTICLES_FETCH_FULFILLED, value: response.data})
            })
            .catch((err) => {
                dispatch({type: constants.ARTICLES_FETCH_REJECTED, value: err})
            })
    }
}