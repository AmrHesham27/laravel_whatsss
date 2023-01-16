import React from "react";
import { useSelector } from "react-redux";

function pageHeader({image}) {

    const cart = useSelector(state => state)
    return (
        <div className="my-header">
            <div>
                <img
                    src={`/images/${image}`}
                    alt="store logo"
                />
            </div>
        </div>
    );
}

export default pageHeader;
