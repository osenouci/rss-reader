/**
 * Created by Othmane on 8/30/2016.
 */
import React from "react"
import { connect } from "react-redux"

import { fetchHomePageArticles } from "./../actions/articles"
import ArticlesListComponent from "./articlesList"
import SpinnerComponent from "./spinner"

@connect((store) => {
    return {
        articles: store.articles.articles,
        fetching: store.articles.fetching,
        error   : store.articles.error,
    };
})
export default class ArticleComponent extends React.Component {

    componentWillMount() {
        this.props.dispatch(fetchHomePageArticles())
    }
    render() {

        console.log("is loading: " + this.props.fetching);

        if(this.props.fetching) {
            return <SpinnerComponent />
        }

        var articles = "";

        if(this.props.articles.length) {

            if(this.props.articles.length > 1) {
                articles = <ArticlesListComponent articles={this.props.articles}/>
            }
        }
        return <div>{articles}</div>
    }
}