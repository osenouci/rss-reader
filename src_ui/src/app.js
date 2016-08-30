import React from "react"
import ReactDOM from "react-dom"
import { Provider } from "react-redux"

import store from "./js/store/store"

import CategoryComponent from "./js/components/categories"
import ArticleComponent from "./js/components/articles"
import NewsSourceComponent from "./js/components/newsSource"

// Render the categories
const categoriesContainer = document.getElementById('sidebar-wrapper');
ReactDOM.render(<Provider store={store}>
    <CategoryComponent />
</Provider>, categoriesContainer);

// Render the articles
const articleContainer    = document.getElementById('article-wrapper');
ReactDOM.render(<Provider store={store}>
    <ArticleComponent />
</Provider>, articleContainer);

// Render the sources
const newsSourcesContainer    = document.getElementById('source-selector');
ReactDOM.render(<Provider store={store}>
    <NewsSourceComponent />
</Provider>, newsSourcesContainer);


