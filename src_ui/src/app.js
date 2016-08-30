import React from "react"
import ReactDOM from "react-dom"
import { Provider } from "react-redux"

import store from "./js/store/store"

import CategoryComponent from "./js/components/categories"


const app = document.getElementById('test-container');

console.log(CategoryComponent);

ReactDOM.render(<Provider store={store}>
    <CategoryComponent />
</Provider>, app);