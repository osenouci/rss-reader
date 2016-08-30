import React from "react"

export default class CategoryEntryComponent extends React.Component {

    render() {

        console.log("Category props: ");
        console.log(this.props);

        const {key, favorite, name} = this.props;
        const itemClass = favorite?"fav-icon-pressed":"fav-icon";
        const itemIcon  = favorite?"glyphicon-star":"glyphicon-star-empty";

        return <li key={key}>
                <a href="#" className={itemClass}>
                    <span className={"glyphicon " + itemIcon} aria-hidden="true"></span>
                </a>
                <a href="#" class="link">{name}</a>
            </li>
    }
}