import React from "react"

export default class ArticleMainComponent extends React.Component {

    render() {

        const {date, detail, img, title, url} = this.props;
        var articleImage = "";

        if(img.length) {
            articleImage = <div dangerouslySetInnerHTML={{__html:img[0]}}/>
        }

        return <div class="jumbotron">
            <h2>{title}</h2>
            <div>{articleImage}</div>
            <div dangerouslySetInnerHTML={{__html:detail}}/>
            <a type="button" class="btn btn-primary" href={url} target="_blank">More</a>
            <div class="main-article-date"><span>Date: {date}</span></div>
        </div>
    }
}