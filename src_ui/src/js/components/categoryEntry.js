import React from "react"
import { connect } from "react-redux"

import { fetchCategoryArticles } from "./../actions/articles"
import {addAsFavorite, removeAsFavorite, fetchCategories} from "./../actions/categories"

@connect((store) => ({
    fetching  : store.categories.fetching
}))

export default class CategoryEntryComponent extends React.Component {

    loadCategories(event) {
        event.preventDefault();
        this.props.dispatch(fetchCategoryArticles(this.props.name));
    }
    markAsFavoriteCategory(){
        const {favorite, name, fetching} = this.props;

        if(fetching) {  // Cannot select a favorite while fetching data
            return;
        }

        if(favorite) {  // Remove as favorite
            this.props.dispatch(removeAsFavorite(name, function(){
                this.props.dispatch(fetchCategories())
            }.bind(this)));
        }else {          // Mark as favorite
            this.props.dispatch(addAsFavorite(name, function(){
                this.props.dispatch(fetchCategories());
            }.bind(this)));
        }

    }
    render() {

        const {key, favorite, name} = this.props;
        const itemClass = favorite?"fav-icon-pressed":"fav-icon";
        const itemIcon  = favorite?"glyphicon-star":"glyphicon-star-empty";

        return <li key={key}>
                <a href="#" className={itemClass} onclick="return false" onClick={this.markAsFavoriteCategory.bind(this)}>
                    <span className={"glyphicon " + itemIcon} aria-hidden="true"></span>
                </a>
                <a href="#" class="link" onClick={this.loadCategories.bind(this)}>{name}</a>
            </li>
    }
}