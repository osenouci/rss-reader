/**
 * Created by Othmane on 8/30/2016.
 */
import React from "react"

export default class SpinnerComponent extends React.Component {

    render() {
        return <div class="loading-message-container">
            <img src="./imgs/spinner.gif" alt="spinner image" />
            <h1>Loading...</h1>
        </div>
    }
}