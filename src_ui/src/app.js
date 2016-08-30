import React from "react"
import ReactDOM from "react-dom"
import { Provider } from "react-redux"

import store from "./js/store/store"

import CategoryComponent from "./js/components/categories"


const categoriesContainer = document.getElementById('sidebar-wrapper');
const articleContainer    = document.getElementById('article-wrapper');


ReactDOM.render(<Provider store={store}>
    <CategoryComponent />
</Provider>, categoriesContainer);