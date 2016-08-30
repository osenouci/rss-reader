/**
 * Created by Othmane on 8/30/2016.
 */
import React from "react"
import ReactDOM from "react-dom"
import { Provider } from "react-redux"
import store from "./js/store/store"

const app = document.getElementById('wrapper');

ReactDOM.render(<Provider store={store}>
    <h1>Hello</h1>
</Provider>, app);