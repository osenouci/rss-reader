/**
 * Created by Othmane on 8/30/2016.
 */
import React from "react"
import { connect } from "react-redux"

import { fetchCategories } from "./../actions/categories"
import CategoryEntryComponent from "./categoryEntry"

@connect((store) => {
    return {
        categories: store.categories.categories,
        fetching  : store.categories.fetching,
        error     : store.categories.error,
    };
})
export default class CategoryComponent extends React.Component {

    componentWillMount() {
        this.props.dispatch(fetchCategories())
    }
    render() {

        console.log("Categories to display: ");
        console.log(this.props.categories);
        const categories = this.props.categories.map((category, i) => {
            return <CategoryEntryComponent key={i}  {...category}/>
        });


        return <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <h2>Categories</h2>
            </li>
            {categories}
        </ul>
    }
}