// Library imports
import { createStore, applyMiddleware } from "redux"
import promise from "redux-promise-middleware"
import thunk from "redux-thunk"
import logger from "redux-logger"

// file imports
import reducers from "./../reducers/index" // Exports all the reducers located in reducers directory

/**
 * The middleware will contain the following libraries
 *  1- promise: Will automatically resolve promises for us.
 *  2- thunk: Redux Thunk middleware allows you to write action creators that return a function instead of an action!
 *  3- logger: Displays a nice log in the web browser's console
 */
const middleware = applyMiddleware(promise(), thunk, logger());
export default createStore(reducers, middleware);