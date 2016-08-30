/**
 * Created by Othmane on 8/30/2016.
 */
import React from "react"
import { connect } from "react-redux"

import { fetchNewsSources, setNewsSource } from "./../actions/newsSources"

@connect((store) => {
    return {
        sources     : store.sources.sources,
        activeSource: store.sources.activeSource,
        fetching    : store.sources.fetching,
        error       : store.sources.error,
    };
})
export default class NewsSourceComponent extends React.Component {

    componentWillMount() {
        this.props.dispatch(fetchNewsSources());
    }
    changeSource(source) {
        this.props.dispatch(setNewsSource(source));
    }
    GetNameOfActiveSource() {

        for(var key in this.props.sources) {

            if(this.props.sources[key].key == this.props.activeSource){
                return this.props.sources[key].name;
            }
        }

        return "";
    }
    render() {

        const newsSources = this.props.sources.map((source, key) => ( <li key={key}>
            <a href="#" onclick="return false;" onClick={this.changeSource.bind(this, source.key)} >{source.name}</a>
        </li>));

        return  <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                News source: { this.GetNameOfActiveSource() }
                <span class="caret"></span>
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                {newsSources}
            </ul>
        </div>
    }
}