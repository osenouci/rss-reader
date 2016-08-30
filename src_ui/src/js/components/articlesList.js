import React from "react"

import ArticleItemComponent from "./articleItem"

export default class ArticlesListComponent extends React.Component {

    render() {

        const articles = this.props.articles.map((article, i) => {
            return <ArticleItemComponent key={i} article={article} />
        });

        return <div class="row">
            {articles}
        </div>
    }
}