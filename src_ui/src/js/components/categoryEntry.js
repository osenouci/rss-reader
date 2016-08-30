import React from "react"
import { connect } from "react-redux"

import { fetchCategoryArticles } from "./../actions/articles"

@connect((store) => ({}))   // Added in order to give us access to the dispatch function

export default class CategoryEntryComponent extends React.Component {

    loadCategories(event) {
        event.preventDefault();
        this.props.dispatch(fetchCategoryArticles(this.props.name));
    }
    render() {

        const {key, favorite, name} = this.props;
        const itemClass = favorite?"fav-icon-pressed":"fav-icon";
        const itemIcon  = favorite?"glyphicon-star":"glyphicon-star-empty";

        return <li key={key}>
                <a href="#" className={itemClass}>
                    <span className={"glyphicon " + itemIcon} aria-hidden="true"></span>
                </a>
                <a href="#" class="link" onClick={this.loadCategories.bind(this)}>{name}</a>
            </li>
    }
}