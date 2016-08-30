import axios from "axios";

import * as constants from './../constants/reducers';
import * as urls from './../constants/urls';

export function fetchNewsSources() {
    return function(dispatch) {
        axios.get(urls.URL_GET_NEWS_SOURCES)
            .then((response) => {
                dispatch({type: constants.SOURCES_FETCH_FULFILLED, value: response.data})
            })
            .catch((err) => {
                dispatch({type: constants.SOURCES_FETCH_REJECTED, value: err})
            })
    };
}
export function setNewsSource(newsSource){
    return function(dispatch) {
        axios.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded';
        axios.put(urls.URL_SET_NEWS_SOURCES, { newsSource })
            .then((response) => {
                if(response.data == true) {
                    dispatch({type: constants.SOURCES_SET_FULFILLED, value: newsSource});
                }
            })
            .catch((err) => {
                dispatch({type: constants.SOURCES_SET_REJECTED, value: err})
            })
    };
}