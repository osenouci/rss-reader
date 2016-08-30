import { combineReducers } from "redux"

import articles from "./articles"
import categories from "./categories"
import favorites from "./favorites"
import sources from "./sources"

export default combineReducers({
    articles,
    categories,
    favorites,
    sources
});