/**
 * Created by Othmane on 8/30/2016.
 */
import React from "react"
import { connect } from "react-redux"

import { fetchCategories } from "./../actions/categories"

@connect((store) => {
    return {
        categories: store.categories.categories,
        fetching   : store.categories.fetching,
        error     : store.categories.error,
    };
})
export default class CategoryComponent extends React.Component {

    componentWillMount() {
        this.props.dispatch(fetchCategories())
    }

    render() {

        console.log(this.props);
        return <div>
            <h1>categories</h1>
        </div>
    }
}