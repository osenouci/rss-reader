import React from "react"

export default class ArticleItemComponent extends React.Component {

    render() {

        const {date, detail, img, title, url} = this.props.article;
        var articleImage = "";

        if(img.length) {
            articleImage = <div dangerouslySetInnerHTML={{__html:img[0]}}/>
        }

        return <div class="col-xs-6 col-lg-4 news-article">
            <h4 class="truncate">{title}</h4>
                <div class="image">{articleImage}</div>
                <div class="article-description truncate" dangerouslySetInnerHTML={{__html:detail}}/>
                <a type="button" class="btn btn-primary" href={url} target="_blank">More</a>
                <div class="main-article-date"><span>Date: {date}</span></div>
            </div>
    }
}
