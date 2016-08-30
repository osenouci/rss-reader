/**
 * Created by Othmane on 8/30/2016.
 */
import React from "react"
import { connect } from "react-redux"

import { fetchNewsSources } from "./../actions/newsSources"

@connect((store) => {
    return {
        articles    : store.articles.articles,
        activeSource: store.articles.activeSource,
        fetching    : store.articles.fetching,
        error       : store.articles.error,
    };
})
export default class NewsSourceComponent extends React.Component {

    componentWillMount() {
        this.props.dispatch(fetchNewsSources())
    }
    render() {

        console.log(this.props);
/*
        if(this.props.articles.length) {

            if(this.props.articles.length > 1) {
                articles = <ArticlesListComponent articles={this.props.articles}/>
            }
        }
        */
        return <div></div>
    }
}