import axios from "axios";

import * as constants from './../constants/reducers';
import * as urls from './../constants/urls';

export function fetchCategories() {
    return function(dispatch) {

        console.log("Reloading the categories");
        dispatch({type: constants.CATEGORIES_FETCH});
        axios.get(urls.URL_GET_CATEGORIES)
            .then((response) => {
                dispatch({type: constants.CATEGORIES_FETCH_FULFILLED, value: response.data})
            })
            .catch((err) => {
                dispatch({type: constants.CATEGORIES_FETCH_REJECTED, value: err})
            })
    }
}
export function addAsFavorite(category, fx) {

    return function(dispatch) {

        dispatch({type: constants.FAVORITES_ADD});

        axios.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded';
        axios.post(urls.URL_ADD_FAVORITE, {category})
            .then((response) => {

                if(response.data == true){
                    console.log("function 2 call");
                    console.log(fx);
                    fx();
                    dispatch({type: constants.FAVORITES_ADD_FULFILLED, value: response.data});
                    return;
                }

                throw -1;
            })
            .catch((err) => {
                dispatch({type: constants.FAVORITES_ADD_REJECTED, value: err})
            })
    }

}
export function removeAsFavorite(category, fx) {

    return function(dispatch) {

        dispatch({type: constants.FAVORITES_REMOVE});

        axios.delete(urls.URL_REMOVE_FAVORITE + "/" + category)
            .then((response) => {
                dispatch({type: constants.FAVORITES_REMOVE_FULFILLED});
                fx();
            })
            .catch((err) => {
                dispatch({type: constants.FAVORITES_REMOVE_REJECTED, value: err});
                fx();
            })
    }

}
