/**
 * Created by Othmane on 8/30/2016.
 */
import React from "react"
import { connect } from "react-redux"

import { fetchHomePageArticles } from "./../actions/articles"
import ArticleMainComponent from "./articlesMain"
import ArticleItemComponent from "./articleItem"
import ArticlesListComponent from "./articlesList"

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

        var articles = "",
            mainArticle = "";

        if(this.props.articles.length) {

            var mainArticle = <ArticleMainComponent {...this.props.articles[0]} />;

            if(this.props.articles.length > 1) {
                articles = <ArticlesListComponent articles={this.props.articles.slice(1)}/>
            }
        }
        return <div>
            {mainArticle}
            {articles}
            </div>
    }
}